<?php

namespace App\Http\Requests\Frontend\Anuncio;

use Illuminate\Foundation\Http\FormRequest;

class PagarAnuncioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if(config('pagseguro.sandbox')){
            return [
                'itemAmount1' => 'required|numeric',
                'senderHash' => 'required',
                'senderName' => 'required',
                'senderPhone' => 'required|regex:/^[(]{1}[0-9]{2}[)]{1}[0-9]{5}-[0-9]{3,4}$/',
                'senderCPF' => 'required|regex:/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/',
                'creditCardToken' => 'required',
                'installmentValue' => 'required|numeric',
                'creditCardHolderName' => 'required',
                'creditCardHolderCPF' => 'required|regex:/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/',
                'creditCardHolderBirthDate' => 'required|date_format:d/m/Y',
                'installmentQuantity' => 'required|numeric',
                'billingAddressPostalCode' => 'required|regex:/^[0-9]{5}-[0-9]{3}$/',
                'billingAddressStreet' => 'required',
                'billingAddressNumber' => 'required',
                'billingAddressComplement' => '',
                'billingAddressDistrict' => 'required',
                'billingAddressState' => 'required',
                'billingAddressCity' => 'required',
                'senderEmail' => 'required',
            ];
        }else{
            return [
                'itemAmount1' => 'required|numeric',
                'senderHash' => 'required',
                'senderName' => 'required',
                'senderPhone' => 'required|regex:/^[(]{1}[0-9]{2}[)]{1}[0-9]{5}-[0-9]{3,4}$/',
                'senderCPF' => 'required|regex:/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/',
                'creditCardToken' => 'required',
                'installmentValue' => 'required|numeric',
                'creditCardHolderName' => 'required',
                'creditCardHolderCPF' => 'required|regex:/^[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}$/',
                'creditCardHolderBirthDate' => 'required|date_format:d/m/Y',
                'installmentQuantity' => 'required|numeric',
                'billingAddressPostalCode' => 'required|regex:/^[0-9]{5}-[0-9]{3}$/',
                'billingAddressStreet' => 'required',
                'billingAddressNumber' => 'required',
                'billingAddressComplement' => '',
                'billingAddressDistrict' => 'required',
                'billingAddressState' => 'required',
                'billingAddressCity' => 'required',
                'senderEmail' => '',
            ];
        }

    }


    public function messages()
    {
        return [
            'itemAmount1.required' => 'Ocorreu um erro, por favor atualize a página e tente novamente',
            'senderHash.required' => 'Ocorreu um erro, por favor atualize a página e tente novamente',
            'senderName.required' => 'Por favor informe o seu nome completo',
            'senderPhone.required' => 'Por favor informe o seu telefone',
            'senderCPF.required' => 'Por favor informe o seu CPF',
            'creditCardToken.required' => 'Ocorreu um erro, por favor atualize a página e tente novamente',
            'creditCardHolderName.required' => 'Por favor informe o nome impresso no cartão',
            'creditCardHolderCPF.required' => 'Por favor informe o CPF do titular do cartão',
            'creditCardHolderBirthDate.required' => 'Por favor informe a data de nascimento do titular do cartão',
            'billingAddressPostalCode.required' => 'Por favor informe o cep',
            'billingAddressStreet.required' => 'Por favor informe a rua do endereço',
            'billingAddressNumber.required' => 'Por favor informe o número do endereço',
            'billingAddressDistrict.required' => 'Por favor informe o bairro do endereço',
            'billingAddressState.required' => 'Por favor informe o estado',
            'billingAddressCity.required' => 'Por favor informe a cidade',
            'installmentQuantity.required' => 'Por favor selecione em quantas parcelas deseja pagar',
            'installmentValue.required' => 'Ocorreu um erro, por favor atualize a página e tente novamente',


            'senderPhone.regex' => 'Formato do telefone inválido',
            'senderCPF.regex' => 'Formato do seu CPF inválido',
            'creditCardHolderCPF.regex' => 'Formato do CPF do titular do cartão inválido',
            'billingAddressPostalCode.regex' => 'Formato do CEP inválido',

            'itemAmount1.numeric' => 'Ocorreu um erro, por favor atualize a página e tente novamente',
            'installmentValue.numeric' => 'Ocorreu um erro, por favor atualize a página e tente novamente',
            'installmentQuantity.numeric' => 'Ocorreu um erro, por favor atualize a página e tente novamente',

        ];
    }
}
