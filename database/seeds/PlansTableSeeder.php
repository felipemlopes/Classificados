<?php

use Illuminate\Database\Seeder;
use Artistas\PagSeguro\PagSeguroRecorrenteFacade;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reference = md5(str_random(15) . microtime());
        $response = PagSeguroRecorrente::setReference($reference)
            ->sendPreApprovalRequest([
            'preApprovalName' => 'Empresarial', //Nome do plano
            'preApprovalCharge' => 'Auto', //Tipo de Cobrança
            'preApprovalPeriod' => 'MONTHLY', //Periodicidade do plano
            'preApprovalAmountPerPayment' => '10.00', //Valor exato da cobrança
        ]);

        $plan = \App\Models\Plan::create([
            'name' => 'Empresarial',
            'price' => 10,
            'reference' => $response,
        ]);

        \App\Models\PlanFeature::create([
            'plan_id' => $plan->id,
            'name' => 'qtd_ads_art',
            'limit' => 5,
        ]);
        \App\Models\PlanFeature::create([
            'plan_id' => $plan->id,
            'name' => 'qtd_ads_pro',
            'limit' => 10,
        ]);
    }
}
