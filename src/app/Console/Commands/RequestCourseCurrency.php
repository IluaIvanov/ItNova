<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RequestCourseCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'request:currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command that allows you to get data on exchange rates, as well as implement an update scheduler';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        return 0;
        $this->info('success');
    }
}
