<?php

namespace App\Console\Commands;

use App\Models\Advertisement;
use Carbon\Carbon;
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
        //free
        $datefree = \Carbon\Carbon::today()->subDays(setting('days_ads_free'));

        //sempre foi free
        Advertisement::where('is_featured',false)->where('created_at','<',date($datefree))->delete();

        //é featured mas featured until é nulo segue o caso anterior
        Advertisement::where('is_featured',true)->where('featured_until',null)->where('created_at','<',date($datefree))->delete();

        //premium
        Advertisement::where('is_featured',true)->where('featured_until','>',\Carbon\Carbon::now())->delete();

    }
}
