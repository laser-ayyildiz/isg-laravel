<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountantRequest extends FormRequest
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
        return [
            'front_acc_name' => 'nullable|string',
            'front_acc_email' => 'nullable|email',
            'front_acc_phone' => 'nullable|numeric|digits:11',
            'out_acc_name' => 'nullable|string',
            'out_acc_email' => 'nullable|email',
            'out_acc_phone' => 'nullable|numeric|digits:11'
        ];
    }
    public function attributes()
    {
        return [
            'front_acc_name' => 'Ön Muhasebe Ad Soyad',
            'front_acc_email' => 'Ön Muhasebe Email',
            'front_acc_phone' => 'Ön Muhasebe Telefon No',
            'out_acc_name' => 'Dış Muhasebe Ad Soyad',
            'out_acc_email' => 'Dış Muhasebe Email',
            'out_acc_phone' => 'Dış Muhasebe Telefon No'
        ];
    }
}
