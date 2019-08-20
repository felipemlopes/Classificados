<?php

namespace App\PagSeguro;

use GuzzleHttp\Client;

class PagSeguro
{
    const SESSION = 0;
    const SESSION_SANDBOX = 1;
    const CHECKOUT = 2;
    const CHECKOUT_SANDBOX = 3;
    const CONSULT = 4;
    const CONSULT_SANDBOX = 5;
    const NOTIFICATION = 6;
    const NOTIFICATION_SANDBOX = 7;
    const PLAN = 8;
    const PLAN_SANDBOX = 9;
    const NOTIFICATION_PREAPPROVAL = 10;
    const NOTIFICATION_PREAPPROVAL_SANDBOX = 11;

    private $requests = [
        0 => [
            'url' => 'https://ws.pagseguro.uol.com.br/v2/sessions',
            'method' => 'POST',
            'options' => [
                'withBody' => false
            ],
        ],
        1 => [
            'url' => 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions',
            'method' => 'POST',
            'options' => [
                'withBody' => false
            ],
        ],
        2 => [
            'url' => 'https://ws.pagseguro.uol.com.br/v2/transactions',
            'method' => 'POST',
            'options' => [
                'withBody' => true
            ],
        ],
        3 => [
            'url' => 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions',
            'method' => 'POST',
            'options' => [
                'withBody' => true
            ],
        ],
        4 => [
            'url' => 'https://ws.pagseguro.uol.com.br/v2/transactions',
            'method' => 'GET',
            'options' => [
                'withBody' => false
            ],
        ],
        5 => [
            'url' => 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions',
            'method' => 'GET',
            'options' => [
                'withBody' => false
            ],
        ],
        6 => [
            'url' => 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/',
            'method' => 'GET',
            'options' => [
                'withBody' => false
            ],
        ],
        7 => [
            'url' => 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/',
            'method' => 'GET',
            'options' => [
                'withBody' => false
            ],
        ],
        8 => [
            'url' => 'https://ws.pagseguro.uol.com.br/pre-approvals/request',
            'method' => 'POST',
            'options' => [
                'withBody' => true
            ],
        ],
        9 => [
            'url' => 'https://ws.sandbox.pagseguro.uol.com.br/pre-approvals/request',
            'method' => 'POST',
            'options' => [
                'withBody' => true
            ],
        ],
        10 => [
            'url' => 'https://ws.pagseguro.uol.com.br/v2/pre-approvals/notifications/',
            'method' => 'GET',
            'options' => [
                'withBody' => false
            ],
        ],
        11 => [
            'url' => 'https://ws.sandbox.pagseguro.uol.com.br/v2/pre-approvals/notifications/',
            'method' => 'GET',
            'options' => [
                'withBody' => false
            ],
        ],

    ];

    public function request(int $url, array $data = [])
    {
        $request = $this->requests[$url];
        $url = $request['url'];

        if ($request['options']['withBody']) {
            $options['form_params'] = $data;
            $options['Content-Type'] = 'application/x-www-form-urlencoded';
        } else {
            $url = $url . '?' . http_build_query($data);
            $options['Content-Type'] = 'application/x-www-form-urlencoded';
        }

        $client = new Client(['headers' => ['Content-Type' => 'application/json']]);
        $response = $client->request($request['method'], $url, $options);

        return $response->getBody();
    }

    public function consulta(int $url, string $reference)
    {
        $request = $this->requests[$url];
        $url = $request['url'];
        $pagseguroemail = config('pagseguro.email');
        $pagsegurotoken = config('pagseguro.token');
        $aux = "?email=".$pagseguroemail."&token=".$pagsegurotoken."&reference=".$reference;


        $client = new Client(['headers' => ['Content-Type' => 'application/xml']]);
        $response = $client->request('GET', $url.$aux);
        $response = new \SimpleXMLElement($response->getBody()->getContents());

        return $response->transactions->transaction;
    }

    public function notificacao(int $url, string $code)
    {
        $request = $this->requests[$url];
        $url = $request['url'];
        $pagseguroemail = config('pagseguro.email');
        $pagsegurotoken = config('pagseguro.token');
        $aux = $code."?email=".$pagseguroemail."&token=".$pagsegurotoken;


        $client = new Client(['headers' => ['Content-Type' => 'application/xml']]);
        $response = $client->request('GET', $url.$aux);
        $response = new \SimpleXMLElement($response->getBody()->getContents());

        return $response;
    }

    public function session()
    {
        $data = [];
        $pagseguroemail = config('pagseguro.email');
        $pagsegurotoken = config('pagseguro.token');
        $data['email'] = $pagseguroemail;
        $data['token'] = $pagsegurotoken;

        $sandbox = config('pagseguro.sandbox');
        if($sandbox){
            $response = (new PagSeguro)->request(PagSeguro::SESSION_SANDBOX, $data);
        }else{
            $response = (new PagSeguro)->request(PagSeguro::SESSION, $data);
        }


        $session = new \SimpleXMLElement($response->getContents());
        $session = $session->id;

        return $session;
    }
}
