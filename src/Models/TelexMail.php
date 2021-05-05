<?php

  namespace DMatrix\Telex\Models;

  use Illuminate\Container\Container;
  use Illuminate\Mail\Mailable;
  use Illuminate\Contracts\Mail\Factory as MailFactory;
  use DMatrix\Telex\Repository\Telex;

  class TelexMail extends Mailable
  {
    public $telex = [];
    public $telexSms = [];

    public function telex(array $telex)
    {
        $this->telex = $telex;
        return $this;
    }

    /**
     * Send the message using the given mailer.
     *
     * @param  \Illuminate\Contracts\Mail\Factory|\Illuminate\Contracts\Mail\Mailer  $mailer
     * @return void
     */
    public function send($mailer)
    {
        $this->withLocale($this->locale, function () use ($mailer) {
            Container::getInstance()->call([$this, 'build']);

           

            return (new Telex)->sendEmail($this->telex);
        });
    }
  }
