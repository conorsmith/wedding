<?php

namespace ConorSmith\Wedding\Mail;

use ConorSmith\Wedding\Invite;
use ConorSmith\Wedding\SiteMode;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailInvite extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Invite */
    public $invite;

    /** @var SiteMode */
    public $siteMode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
        $this->siteMode = app(SiteMode::class);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->siteMode->getContactAddress(), $this->siteMode->getNames())
            ->subject("Please join us on August 18th, 2019")
            ->view('emails.invite');
    }
}
