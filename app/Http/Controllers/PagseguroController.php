<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Payment;
use App\Models\PlanSubscription;
use App\PagSeguro\PagSeguro;
use Carbon\Carbon;
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
            $response['code']; //reference da assinatura
            $pagamento = Payment::where('reference', $response['reference'])->first();
            if ($pagamento) {
                $subscription = PlanSubscription::find($pagamento->paymentable_id);
                $subscription->status = $response['status'];
                $subscription->save();
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






            if($pagamento->paymentable_type=="App\Models\Advertisement"){
                $dias = setting('days_ads_premium');
                $data = Carbon::now()->addDays($dias);
                $anuncio = Advertisement::find($pagamento->recurso_id);
                if($pagamento->status==3){
                    $anuncio->is_paid = true;
                    $anuncio->featured_until = $data;
                    $anuncio->save;
                }
                if($pagamento->status==4){
                    $anuncio->is_paid = true;
                    $anuncio->featured_until = $data;
                    $anuncio->save;
                }
            }



        }
    }

}
