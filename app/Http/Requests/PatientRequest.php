<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class PatientRequest extends FormRequest
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

    public function expectsJson()
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
        return [
            'full_name' => 'required|string',
            'mother_full_name' => 'required|string',
            'birthday' => 'required|string',
            'document.cpf' => 'required|string|max:11',
            'document.cns' => 'required|string',
            'address.zipcode' => 'required|string',
            'adrress.street' => 'required|string',
            'adrress.number' => 'required|string',
            'adrress.complement' => 'required|string',
            'adrress.district' => 'required|string',
            'adrress.city' => 'required|string',
            'adrress.state' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator) {
        Log::error('Erro em campo obrigatório: ', $this->validator->errors()->messages());
        throw new ValidationException($validator);
    }
}
