<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PlanSubscription;
use App\PagSeguro\PagSeguro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PagseguroController extends Controller
{

    public function checkoutSuccess()
    {
        return view('frontend.checkout.success');
    }

    public function checkoutNotification(Request $request)
    {
        if($request->notificationType=="preApproval"){
            if(config('pagseguro.sandbox')){
                $response = (array)(new PagSeguro)->notificacao(PagSeguro::NOTIFICATION_PREAPPROVAL_SANDBOX, $request->notificationCode);
            }else{
                $response = (array)(new PagSeguro)->notificacao(PagSeguro::NOTIFICATION_PREAPPROVAL, $request->notificationCode);
            }
            //Log::info($request->all());
            //Log::info($response);
            $response['code']; //reference da assinatura
            //$response['reference']; //reference do pagamento
            $pagamento = Payment::where('reference', $response['reference'])->first();
            if ($pagamento) {
                //$pagamento->status = $response['status'];
                //$pagamento->save();
                $subscription = PlanSubscription::find($pagamento->paymentable_id);
                $subscription->status = $response['status'];
                $subscription->save();
                //Log::info($subscription);
            }
        }
        if($request->notificationType=="transaction") {
            if (config('pagseguro.sandbox')) {
                $response = (array)(new PagSeguro)->notificacao(PagSeguro::NOTIFICATION_SANDBOX, $request->notificationCode);
            } else {
                $response = (array)(new PagSeguro)->notificacao(PagSeguro::NOTIFICATION, $request->notificationCode);
            }
            $pagamento = Payment::where('reference', $response['reference'])->first();
            if ($pagamento) {
                $pagamento->status = $response['status'];
                $pagamento->save();
            }
            //Log::info($request->all());
            //Log::info($response);
            //Log::info($pagamento);
        }
    }

}
