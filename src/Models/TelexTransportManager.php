<?php

namespace DMatrix\Telex\Models;

use Illuminate\Mail\MailManager;

class TelexTransportManager extends MailManager
{
    protected function createTelexTransport()
    {

        $config = $this->app['config']->get('services.telex', []);

        return new TelexTransport(
            $this->guzzle($config),
            $config['endpoint'],
            $config['key'], $config['id'], $config['from'],$config['email'],
            $config['type'],$config['template'],$config['placeholders']

        );
    }
}
