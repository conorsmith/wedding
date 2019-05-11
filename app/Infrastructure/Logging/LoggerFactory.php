<?php
declare(strict_types=1);

namespace ConorSmith\Wedding\Infrastructure\Logging;

use ConorSmith\Wedding\Mail\LogRecord;
use Illuminate\Support\Facades\Mail;
use Monolog\Formatter\HtmlFormatter;
use Monolog\Handler\MailHandler;
use Monolog\Logger;

final class LoggerFactory
{
    public function __invoke(array $config)
    {
        $logger = new Logger("email-logger");

        $handler = $this->createHandler();
        $handler->setFormatter(new HtmlFormatter);
        $logger->pushHandler($handler);

        return $logger;
    }

    private function createHandler()
    {
        return new class extends MailHandler
        {
            protected function send($content, array $records)
            {
                Mail::to("conorjbsmith@gmail.com")
                    ->send(new LogRecord($content));
            }
        };
    }
}
