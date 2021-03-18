<?php
namespace DMatrix\Telex\Repository;

use DMatrix\Telex\Repository\Contracts\TelexServiceInterface;
use GuzzleHttp\Client as RequestClient;
use GuzzleHttp\Promise;

class Telex implements TelexServiceInterface
{

    public function sendEmail($params, $attachment = false)
    {

        $receiver = rtrim($params['to'], ",");
        $receiver = explode(',', $receiver);

        $client = new RequestClient();
        $payload = [];
        $payload['template_uuid'] = $params['params']['message_type']['email_template_id'];
        $payload['sender_email'] = $params['params']['message_type']['sender_email'];
        $payload['placeholders'] = $params['params'];
        $payload['attachment'] = $params['attachments'];
        $url = config('services.telex.endpoint');

        $receiverCount = count($receiver);

        if ($receiverCount > 1) {
            $promises = [];
            $tempParams = $payload;
            for ($i = 0; $i < $receiverCount; $i++) {
                $tempParams['receiver_email'] = $receiver[$i];

                if (!$attachment) {
                    $promises[] = $client->requestAsync('POST', $url, ['form_params' => $tempParams]);
                } else {
                    $newPayload = $this->modifyPayload($tempParams);
                    $promises[] = $client->requestAsync('POST', $url, ['multipart' => $newPayload]);
                }
            }

            return $results = Promise\unwrap($promises);
        } else {
            $payload['receiver_email'] = $receiver[0];

            if (!$attachment) {
                $res = $client->request('POST', $url, ['form_params' => $payload]);
                return $res->getStatusCode();
            }

            $newPayload = $this->modifyPayload($payload);

            $res = $client->request('POST', $url, ['multipart' => $newPayload]);
            return $res->getStatusCode();

        }
    }

    public function sendSMS($params)
    {
        $receiver = rtrim($params['to'], ",");
        $receiver = explode(',', $receiver);
        $client = new RequestClient();
        $payload = [];
        $payload['template_uuid'] = $params['params']['message_type']['sms_template_id'];
        $payload['sender'] = env("DEFAULT_SMS_SENDER");
        $payload['placeholders'] = $params['params'];
        $url = config('services.telex.endpoint');

        $receiverCount = count($receiver);

        if ($receiverCount > 1) {
            $promises = [];
            $tempParams = $payload;
            for ($i = 0; $i < $receiverCount; $i++) {
                $tempParams['receiver'] = $receiver[$i];
                $promises[] = $client->requestAsync('POST', $url, ['form_params' => $tempParams]);
            }

            return $results = Promise\unwrap($promises);
        } else {
            $payload['receiver'] = $receiver[0];
            $res = $client->request('POST', $url, ['form_params' => $payload]);
            return $res->getStatusCode();
        }
    }

    public function smsBalance()
    {
        $client = new RequestClient();
        $url = config('services.sms_balance.hms');
        $response = $client->get($url);
        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
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
}
