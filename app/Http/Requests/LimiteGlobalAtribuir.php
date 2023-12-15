<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LimiteGlobalAtribuir extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cnpj_empresa' => 'required|string',
            'limite' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'cnpj_empresa.required' => 'É necessário enviar o CPNJ da empresa para realizar a atribuição de limite',
            'cnpj_empresa.string' => 'O formato do CPNJ não é valido',
            'limite.required' => 'É necessário enviar o limite para realizar a operação',
            'limite.numeric' => 'Favor verificar o valor do limite',
        ];
    }

}
