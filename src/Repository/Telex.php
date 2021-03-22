<?php
namespace DMatrix\Telex\Repository;

use DMatrix\Telex\Repository\Contracts\TelexServiceInterface;
use GuzzleHttp\Client as RequestClient;

class Telex implements TelexServiceInterface
{
    protected $key;
    protected $id;
    public function __construct() {

        $this->key = config('services.telex.key');
        $this->id = config('services.telex.id');

    }
    public function sendEmail($params, $attachment = false)
    {

        $receiver = rtrim($params['to'], ",");
        $receiver = explode(',', $receiver);

        $client = new RequestClient(
            [
                'headers' => [
                    'ORGANIZATION-KEY' => $this->key,
                    'ORGANIZATION-ID' => $this->id
                ]
            ]
        );
        $payload = [];
        $payload['template_uuid'] = $params['params']['message_type']['email_template_id'];
        $payload['sender'] = $params['params']['message_type']['sender_email'];
        $payload['sender_email'] = $params['params']['message_type']['sender_email'];
        $payload['placeholders'] = $params['params'];
        $payload['attachment'] = $params['attachments'];
        $payload['message_type'] = "email";
        $url = config('services.telex.endpoint');


        $receiverCount = count($receiver);

        if ($receiverCount > 1) {
            $tempParams = $payload;
            $customerData = [];
            for ($i = 0; $i < $receiverCount; $i++) {
                $tempParams['receiver_email'] = $receiver[$i];
                $customerData[] = [
                    'name' => $params['receiver_name'] ?? '',
                    'email' => $tempParams['receiver_email']
                ];
                $payload['customers'] = $customerData;

            }
        } else {
            $payload['receiver_email'] = $receiver[0];
            $customerData = [
                'name' => $params['receiver_name'] ?? '',
                'email' => $payload['receiver_email']
            ];
            $payload['customers'] = [$customerData];
        }
            if (!$attachment) {

                $payload = $this->getPayload("form_params",$payload);
                $res = $client->request('POST', $url, $payload);
                return $res->getStatusCode();
            }

            $newPayload = $this->modifyPayload($payload);
            $payload = $this->getPayload('multipart', $newPayload );

            $res = $client->request('POST', $url, $payload);
            return $res->getStatusCode();


    }

    public function sendSMS($params)
    {
        $receiver = rtrim($params['to'], ",");
        $receiver = explode(',', $receiver);
        $client = new RequestClient(
            [
                'headers' => [
                    'ORGANIZATION-KEY' => $this->key,
                    'ORGANIZATION-ID' => $this->id
                ]
            ]
        );
        $payload = [];
        $payload['template_uuid'] = $params['params']['message_type']['sms_template_id'];
        $payload['sender'] = env("DEFAULT_SMS_SENDER");
        $payload['placeholders'] = $params['params'];
        $payload['message_type'] = "sms";
        $url = config('services.telex.endpoint');

        $receiverCount = count($receiver);

        if ($receiverCount > 1) {
            $tempParams = $payload;
            $customerData = [];
            for ($i = 0; $i < $receiverCount; $i++) {
                $tempParams['receiver'] = $receiver[$i];
                $customerData = [
                    'name' => $params['receiver_name'] ?? '',
                    'email' => $tempParams['receiver_email'] ?? "",
                    'phone' => $tempParams['receiver']
                ];
                $tempParams['customers'] = $customerData;
            }

        } else {
            $payload['receiver'] = $receiver[0];
            $customerData = [
                'name' => $params['receiver_name'] ?? '',
                'email' => $payload['receiver_email'] ?? "",
                'phone' => $payload['receiver']
            ];
            $payload['customers'] = [$customerData];

            $res = $client->request('POST', $url, $this->getPayload('form_params',  $payload));
            return $res->getStatusCode();
        }
    }

    public function modifyPayload($params)
    {
        $multipart = [];
        //loop through the params
        foreach ($params as $name => $content) {
            //check if param is an attachment
            if ($name == 'attachment') {
                if(is_array($content)) {
                    foreach($content as $key => $attach) {

                        $multipart[] = ['name' => $name[$key], 'contents' => $attach['file'], 'filename' => time() . '.'.$attach['extension']];
                    }
                }
            }
            //if the content is an array loop through it
            //this can be used for placeholders
            if (is_array($content)) {
                foreach ($content as $placeholder => $value) {
                    //check if the value is also an array then loop through it
                    //for example rooms is an array
                    if (is_array($value)) {
                        foreach ($value as $detail) {
                            //looping through the value, the detail can also be an array e.g [roomname => 'deluxe']
                            if (is_array($detail)) {
                                foreach ($detail as $infoKey => $info) {
                                    $multipart[] = ['name' => $name . '[' . $placeholder . '][' . $infoKey . ']', 'contents' => $info];
                                }
                            }
                        }
                    } else {
                        $multipart[] = ['name' => $name . '[' . $placeholder . ']', 'contents' => $value];
                    }
                }
            } else {
                $multipart[] = ['name' => $name, 'contents' => $content];
            }
        }

        return $multipart;
    }
    /**
     * Get the HTTP payload for sending the message.
     *
     * @return array
     */
    protected function getPayload($type, $payload)
    {
        // Change this to the format your API accepts
        return [
            $type => $payload
        ];
    }
}
