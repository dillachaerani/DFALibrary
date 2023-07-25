<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GeneralMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    protected $configs;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $configs)
    {
        $this->data    = $data;
        $this->configs = $configs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $configs = $this->configs;
        return $this->subject($configs['subject'])
            ->view($data['view'], compact('data'));
    }
}
