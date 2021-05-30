<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoopEmployeeRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
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
            'name' => 'required',
            'tc' => 'required|unique:coop_employees,tc|numeric|digits:11',
            'email' => 'email|nullable|unique:coop_employees,email',
            'phone' => 'nullable|numeric|digits:11',
            'recruitment_date' => 'nullable|before_or_equal:' . date("Y-m-d H:i:s"),
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'Ad Soyad',
            'tc' => 'T.C Kimlik No',
            'email' => 'Email',
            'phone' => 'Telefon No',
            'recruitment_date' => 'İşe Giriş Tarihi',
        ];
    }
}
