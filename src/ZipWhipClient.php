<?php

namespace NotificationChannels\ZipWhip;

use NotificationChannels\ZipWhip\Exceptions\CouldNotSendNotification;
use stdClass;
use CollingMedia\ZipWhipClient as ZipWhipWrapper;

class ZipWhipClient
{
    const SUCCESSFUL_SEND = 0;
    const AUTH_FAILED = 1;

    /**
     * @var ZipWhipClient
     */
    private $zipwhip;

    /**
     * @param string $api_key
     * @param string $user
     * @param string $pass
     */
    public function __construct($api_key = null, $user = null, $pass = null)
    {
        if($api_key) {
            $this->zipwhip = new ZipWhipWrapper($api_key);
        } else {
            $this->zipwhip = new ZipWhipWrapper('');
            $this->zipwhip = $this->zipwhip->authenticate($user, $pass);
        }
    }

    /**
     * @param string|array $to String or Array of numbers
     * @param string $message
     */
    public function send($to, $message)
    {
        $to = collect($to)->toArray();

        $response = $this->zipwhip->sendMessage($to, $message);

        $this->handleProviderResponses($response);
    }

    /**
     * @param array $responses
     * @throws CouldNotSendNotification
     */
    protected function handleProviderResponses(stdClass $response)
    {
        if (!$response) {
            throw CouldNotSendNotification::serviceRespondedWithAnError(
                (string) $response->error,
                '500'
            );
        }
    }

    /**
     * @return array
     */
    public function getFailedQueueCodes()
    {
        return [
            self::AUTH_FAILED
        ];
    }

    /**
     * @return array
     */
    public function getRetryQueueCodes()
    {
        return [

        ];
    }
}
