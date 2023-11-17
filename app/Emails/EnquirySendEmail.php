<?php
namespace App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\Enquiry;

class EnquirySendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $enquiry;
    public $content;
    protected $email_type;


    public function __construct(Enquiry $enquiry , $content ,$to = 'admin')
    {
        $this->enquiry = $enquiry;
        $this->content = $content;
        $this->email_type = $to;
    }

    public function build()
    {        
        $subject = __('New inquiry has been made');
            
        return $this->subject($subject)->view('admin.emails.enquiry')->with([
            'enquiry' => $this->enquiry,
            'content' => $this->content,
            'to'=>$this->email_type
        ]);
    }
}
