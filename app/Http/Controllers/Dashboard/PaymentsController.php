<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('Visualizar pagamentos')){
            return redirect()->back();
        }
        $peer_page = 15;
        $search = Input::get('search');
        $status = Input::get('status');
        $pagamentos = Payment::Query();
        if ($search <> "") {
            $pagamentos->where(function ($q) use ($search) {
                $q->where('reference', "like", "%{$search}%");
            });
        }
        if ($status <> "") {
            $pagamentos->where(function ($query) use ($status) {
                $query->where('status', $status);
            });
        }
        $pagamentos = $pagamentos->paginate($peer_page);
        if ($search) {
            $pagamentos->appends(['search' => $search]);
        }
        if ($status) {
            $pagamentos->appends(['status' => $status]);
        }

        return view('dashboard.payment.list', compact('pagamentos'));
    }

    public function show($id)
    {
        if(!Auth::user()->can('Visualizar pagamentos')){
            return redirect()->back();
        }
        $pagamento = Payment::find($id);

        return view('dashboard.payment.view', compact('pagamento'));
    }
}
