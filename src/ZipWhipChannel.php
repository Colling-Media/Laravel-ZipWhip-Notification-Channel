<?php

namespace NotificationChannels\ZipWhip;

use NotificationChannels\Clickatell\Exceptions\CouldNotSendNotification;
use Illuminate\Notifications\Notification;

class ZipWhipChannel
{
    /** @var ZipWhipClient */
    protected $zipwhip;

    /**
     * @param ZipWhipClient $zipWhipClient
     */
    public function __construct(ZipWhipClient $zipWhipClient)
    {
        $this->zipwhip = $zipWhipClient;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     *
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('zipwhip')) {
            return;
        }

        $message = $notification->toZipWhip($notifiable);

        if (is_string($message)) {
            $message = new ZipWhipMessage($message);
        }

        $this->zipwhip->send($to, $message->getContent());
    }
}
