<?php

namespace DMatrix\Telex\Providers;

use Illuminate\Mail\MailServiceProvider as MailProvider;


class TelexServiceProvider extends MailProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    protected function registerIlluminateMailer()
    {

        $this->app->singleton('mail.manager', function ($app) {
            return new \DMatrix\Telex\Models\TelexTransportManager($app);
        });

        $this->app->bind('mailer', function ($app) {
            return $app->make('mail.manager')->mailer();
        });
    }


}
