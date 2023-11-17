<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;
use App\Emails\NewBookingEmail;
use App\Emails\StatusUpdatedEmail;
use App\Events\BookingUpdatedEvent;
use App\Traits\HasPassenger;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\BookingStatus;
use App\Traits\Rentable;

class Booking extends Model
{
    use SoftDeletes;
    use HasPassenger;
    use Rentable;
   
    protected $casts = [
        'status'            => BookingStatus::class,
    ];

    public function getGatewayObjAttribute()
    {
        return $this->gateway ? get_payment_gateway_obj($this->gateway) : false;
    }

   
    public function payment()
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }

    public function generateCode()
    {
        return md5(uniqid() . rand(0, 99999));
    }

    public function markAsProcessing($payment, $service)
    {

        $this->status = static::PROCESSING;
        $this->save();
        event(new BookingUpdatedEvent($this));
    }

    public function markAsPaid()
    {
        if($this->paid < $this->total){
            $this->status = static::PARTIAL_PAYMENT;
        }else{
            $this->status = static::PAID;
        }

        $this->save();
        event(new BookingUpdatedEvent($this));
    }

    public function markAsPaymentFailed(){

        $this->status = static::UNPAID;
        $this->tryRefundToWallet();
        $this->save();
        event(new BookingUpdatedEvent($this));

    }

    public function sendNewBookingEmails()
    {
        try {
            // To Admin
            Mail::to(setting_item('admin_email'))->send(new NewBookingEmail($this, 'admin'));

            // To Customer
            Mail::to($this->email)->send(new NewBookingEmail($this, 'customer'));

        }catch (\Exception | \Swift_TransportException $exception){

            Log::warning('sendNewBookingEmails: '.$exception->getMessage());
        }
    }

    public function sendStatusUpdatedEmails(){
        // Try to update locale
        $old = app()->getLocale();

        $bookingLocale = $this->getMeta('locale');
        if($bookingLocale){
            app()->setLocale($bookingLocale);
        }
        try{
            // To Admin
            Mail::to(setting_item('admin_email'))->send(new StatusUpdatedEmail($this,'admin'));

            // To Customer
            Mail::to($this->email)->send(new StatusUpdatedEmail($this,'customer'));


            app()->setLocale($old);

        } catch(\Exception $e){

            Log::warning('sendStatusUpdatedEmails: '.$e->getMessage());

        }

        app()->setLocale($old);
    }
    
    public function getDurationNightsAttribute(){

        $days = max(1,floor((strtotime($this->end_date) - strtotime($this->start_date)) / DAY_IN_SECONDS));

        return $days;
    }
    public function getDurationDaysAttribute(){

        $days = max(1,floor((strtotime($this->end_date) - strtotime($this->start_date)) / DAY_IN_SECONDS) + 1 );
        return $days;
    }
    public function getDurationHoursAttribute(){

        $days = max(1,floor((strtotime($this->end_date) - strtotime($this->start_date)) / HOUR_IN_SECONDS) );
        return $days;
    }

    public function  checkMaximumBooking($date){

    }

    public static function getBookingInRanges($from,$to){

        $query = parent::selectRaw(" * , SUM( total_guests ) as total_guests ")
            ->where('end_date','>=',$from)
            ->where('start_date','<=',$to)
            ->groupBy('start_date')
            ->take(200);

        return $query->get();
    }
    public static function getAllBookingInRanges($from,$to){

        $query = parent::selectRaw("*")
            ->where('end_date','>=',$from)
            ->where('start_date','<=',$to)
            ->take(200);
        return $query->get();
    }
  
	public function getTotalBeforeExtraPriceAttribute(){
		$extra_price = $this->getJsonMeta('extra_price');

        if(empty($extra_price) or !is_array($extra_price)) return $this->total_before_discount;

        $extra_price_collection = collect($extra_price);

        return $this->total_before_discount - $extra_price_collection->sum('total');
	}
    
}
