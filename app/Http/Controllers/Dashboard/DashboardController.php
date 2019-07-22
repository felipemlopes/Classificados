<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $monthsarray[] = date('m/Y');
        for ($i = 1; $i < 6; $i++) {
            $monthsarray[] = date('m/Y', strtotime("-$i month"));
        }
        $months='';
        foreach ($monthsarray as $m){
            $months=$months."'".$m."'".",";
        }
        $result = User::select('id', 'created_at')
            ->where("created_at",">", Carbon::now()->subMonths(6))
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('m');
            });
        $resultarray = [];
        foreach ($result as $r){
            $resultarray[] = $r->count();
        }
        $aux = abs(count($resultarray) - 6);
        for($i = 1; $i <= $aux; $i++){
            $resultarray[] = 0;
        }
        $resultarray=array_reverse($resultarray);
        $resultarraystring='';
        foreach ($resultarray as $item){
            $resultarraystring=$resultarraystring."'".$item."'".",";
        }
        return view('dashboard.admin', compact('users','months','resultarraystring'));
    }

}
