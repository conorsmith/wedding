<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Mail;

use ConorSmith\Wedding\SiteMode;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

final class LogRecord extends Mailable
{
    use Queueable, SerializesModels;

    /** @var string */
    public $content;

    /** @var SiteMode */
    private $siteMode;

    public function __construct($content)
    {
        $this->content = $content;
        $this->siteMode = app(SiteMode::class);
    }

    public function build()
    {
        return $this
            ->from("errors@{$this->siteMode->getDomainName()}", "Wedding App")
            ->subject("Record logged")
            ->view('emails.logRecord');
    }
}
