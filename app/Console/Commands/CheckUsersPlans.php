<?php

namespace App\Console\Commands;

use App\Models\PlanSubscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckUsersPlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:checkplan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checa se o plano dos usuários terminou ou está terminando';

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
        $datelimit = \Carbon\Carbon::now()->addDays(7)->toDateTimeString();
        $newexpire = \Carbon\Carbon::now()->addDays(100);
        PlanSubscription::where('plan_id','=',1)
            ->where('expires_on', '<', $datelimit)->update(['expires_on' => $newexpire]);
    }
}
