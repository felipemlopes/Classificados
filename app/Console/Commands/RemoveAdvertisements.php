<?php

namespace App\Console\Commands;

use App\Models\Advertisement;
use Illuminate\Console\Command;

class RemoveAdvertisements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'advertisements:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove anúncios que passaram do prazo';

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
        $date = \Carbon\Carbon::today()->subDays(30);
        $advertisements = Advertisement::where('created_at', '<', date($date))->delete();
    }
}
