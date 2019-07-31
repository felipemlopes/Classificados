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
        Advertisement::select('advertisements.*','users.*','plan_subscriptions.*')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'advertisements.user_id');
            })
            ->join('plan_subscriptions', function ($join) use($datefree){
                $join->on('users.id', '=', 'plan_subscriptions.user_id');
                $join->where('plan_subscriptions.plan_id','=', 1);
                $join->where('starts_on', '<', Carbon::now())->where('expires_on', '>', Carbon::now());
                $join->where('advertisements.created_at', '<', date($datefree));
            })
            ->delete();

        //premium
        $datepremium = \Carbon\Carbon::today()->subDays(setting('days_ads_premium'));
        Advertisement::select('advertisements.*','users.*','plan_subscriptions.*')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'advertisements.user_id');
            })
            ->join('plan_subscriptions', function ($join) use($datepremium){
                $join->on('users.id', '=', 'plan_subscriptions.user_id');
                $join->where('plan_subscriptions.plan_id','=', 2);
                $join->where('starts_on', '<', Carbon::now())->where('expires_on', '>', Carbon::now());
                $join->where('advertisements.created_at', '<', date($datepremium));
            })
            ->delete();
    }
}
