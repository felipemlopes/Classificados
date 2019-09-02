<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{


    public function getType()
    {
        if($this->paymentable_type=='App\Models\Advertisement'){
            return 'Anúncio';
        }elseif($this->paymentable_type=='App\Models\PlanSubscription'){
            return 'Assinatura';
        }else{
            return '-';
        }
    }

    public function getStatus()
    {
        if($this->status==1){
            return 'Aguardando pagamento';
        }elseif($this->status==2){
            return 'Em análise';
        }elseif($this->status==3){
            return 'Pago';
        }elseif($this->status==4){
            return 'Em disponível';
        }elseif($this->status==5){
            return 'Em disputa';
        }elseif($this->status==6){
            return 'Devolvido';
        }elseif($this->status==7){
            return 'Cancelado';
        }else{
            return '-';
        }
    }

    public function getLink()
    {
        if($this->paymentable_type=='App\Models\Advertisement'){
            return route('dashboard.advertisement.edit',$this->paymentable_id);
        }elseif($this->paymentable_type=='App\Models\PlanSubscription'){
            $subscription = PlanSubscription::find($this->paymentable_id);
            $id = User::find($subscription->user_id);
            return route('dashboard.user.edit',$id);
        }else{
            return '-';
        }
    }


    public function paymentable()
    {
        return $this->morphTo();
    }
}
