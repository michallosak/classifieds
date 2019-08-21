<?php

namespace App\Mail\Pages\Classifieds;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class AddMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    private $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        $u = new User();
        $this->name = $u->fullname();
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('email@example.pl', 'E-mail')
            ->subject('Verify Email '.$this->name)
            ->markdown('emails.pages.classifieds.add')
            ->with([
                'name' => $this->name,
                'title' => $this->data->title,
                'body' => $this->data->body,
                'created_at' => $this->data->created_at
            ]);
    }
}
