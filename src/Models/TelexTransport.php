<?php

namespace DMatrix\Telex\Models;

use GuzzleHttp\ClientInterface;
use Swift_Mime_SimpleMessage;
use Illuminate\Mail\Transport\Transport;
use Illuminate\Support\Facades\Log;

class TelexTransport extends Transport
{
    /**
     * Guzzle client instance.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * API key.
     *
     * @var string
     */
    protected $key;

    /**
     * The API URL to which to POST emails.
     *
     * @var string
     */
    protected $endpoint;

    /**
     * Create a new Custom transport instance.
     *
     * @param  \GuzzleHttp\ClientInterface  $client
     * @param  string|null  $endpoint
     * @param  string  $key
     * @return void
     */

     protected $from;
     protected $email;
     protected $id;
     protected $type;
     protected $template;
     protected $placeholders;

    public function __construct(ClientInterface $client,  $endpoint, $key, $id, $from, $email,$type,$template,$placeholders)
    {
        $this->key = $key;
        $this->client = $client;
        $this->endpoint = $endpoint;
        $this->id = $id;
        $this->from = $from;
        $this->email = $email;
        $this->type = $type;
        $this->template = $template;
        $this->placeholders = $placeholders;
    }

    /**
     * {@inheritdoc}
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        $payload = $this->getPayload($message);

        $this->client->request('POST', $this->endpoint, $payload);

        $this->sendPerformed($message);

        return $this->numberOfRecipients($message);
    }

    /**
     * Get the HTTP payload for sending the message.
     *
     * @param  \Swift_Mime_SimpleMessage  $message
     * @return array
     */
    protected function getPayload(Swift_Mime_SimpleMessage $message)
    {
        // Change this to the format your API accepts
        return [
            'headers' => [
                'X-ORGANIZATION-KEY' => $this->key,
                'X-ORGANIZATION-ID' => $this->id,
                'Accept'        => 'application/json',
            ],
            'json' => [
                'customers' => $this->mapContactsToNameEmail($message->getTo()),
                'cc' => $this->mapContactsToNameEmail($message->getCc()),
                'bcc' => $this->mapContactsToNameEmail($message->getBcc()),
                'content' => $message->getBody(),
                'subject' => $message->getSubject(),
                'from_name' =>  $this->from,
                'from_email' => $this->email,
                'message_type' => $this->type,
                'placeholders' => $this->placeholders,
                'template_uuid' => $this->template,

            ],
        ];
    }

    protected function mapContactsToNameEmail($contacts)
    {
        $formatted = [];
        if (empty($contacts)) {
            return [];
        }
        foreach ($contacts as $address => $display) {
            $formatted[] =  [
                'name' => $display,
                'email' => $address,
            ];
        }
        return $formatted;
    }
}
