<?php

    namespace Modules\Booking\Listeners;

    use App\Notifications\AdminChannelServices;
    use App\Notifications\PrivateChannelServices;
    use App\User;
    use Illuminate\Support\Facades\Auth;
    use Modules\Booking\Events\BookingCreatedEvent;

    class BookingCreatedListen
    {
        public function handle(BookingCreatedEvent $event)
        {
            $booking = $event->booking;
            $booking->sendNewBookingEmails();

            //case guest checkout
            if(!Auth::id()){
                $name = 'Guests';
                $avatar = '';
            }else{
                $name = Auth::user()->display_name;
                $avatar = Auth::user()->avatar_url;
            }

            $data = [
                'id'      => $booking->id,
                'event'   => 'BookingCreatedEvent',
                'to'      => 'admin',
                'name'    => $name,
                'avatar'  => $avatar,
                'link'    => route('report.admin.booking'),
                'type'    => $booking->object_model,
                'message' => __(':name has created new Booking', ['name' => $name])
            ];
           
            Auth::user()->notify(new AdminChannelServices($data));

         
        }
    }
