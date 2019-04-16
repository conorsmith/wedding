<?php

namespace ConorSmith\Wedding\Console\Commands;

use Illuminate\Console\Command;

class ImportGuestList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:guestlist {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports a new guest list, wiping the existing data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = __DIR__ . "/../../../" . $this->argument('path');

        (new \ConorSmith\Wedding\ImportGuestlist)($path);

        $this->info("Import complete");
    }
}
