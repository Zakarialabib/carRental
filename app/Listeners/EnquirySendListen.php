<?php
namespace Modules\Booking\Listeners;

use App\User;
use Modules\Booking\Emails\EnquirySendEmail;
use Modules\Booking\Events\EnquirySendEvent;
use Illuminate\Support\Facades\Mail;


class EnquirySendListen
{
    public function __construct()
    {

    }

    public const CODE = [
        'name'         => '[name]',
        'email'        => '[email]',
        'phone'        => '[phone]',
        'note'         => '[note]',
        'status'       => '[status]',
        'service_link' => '[service_link]',
        'service_name' => '[service_name]',
    ];

    /**
     * Handle the event.
     *
     * @param EnquirySendEvent $event
     * @return void
     */
    public function handle(EnquirySendEvent $event)
    {
        if (!empty(setting_item('admin_email') and !empty(setting_item('booking_enquiry_enable_mail_to_admin')))) {
            $body = $this->replaceContentEmail($event, setting_item_with_lang('booking_enquiry_mail_to_admin_content'));
            Mail::to(setting_item('admin_email'))->send(new EnquirySendEmail($event->enquiry, $body, 'admin'));
        }
    }

    public function replaceContentEmail($event, $content)
    {
        if (!empty($content)) {
            foreach (self::CODE as $item => $value) {
                switch ($value){
                    case "[service_link]":
                            $service = $event->enquiry->service;
                        $text = '<a href="'.$service->getDetailUrl().'" target="_blank"> '.$service->title.' </a>';
                        $content = str_ireplace($value, $text, $content);
                        break;
                    case "[service_name]":
                        $service = $event->enquiry->service;
                        $content = str_ireplace($value, $service->title, $content);
                        break;
                    default:
                        $content = str_ireplace($value, @$event->enquiry->$item, $content);
                }
            }
        }
        return $content;
    }
}
