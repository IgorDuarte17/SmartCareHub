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
            'cpf' => 'required|string|max:11',
            'cns' => 'required|string',
            'address.zipcode' => 'required|string',
            'address.street' => 'required|string',
            'address.number' => 'required|string',
            'address.complement' => 'required|string',
            'address.district' => 'required|string',
            'address.city' => 'required|string',
            'address.state' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator) {
        Log::error('Erro em campo obrigatório: ', $this->validator->errors()->messages());
        throw new ValidationException($validator);
    }
}
