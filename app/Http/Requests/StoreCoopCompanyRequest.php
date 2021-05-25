<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoopCompanyRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'name' => 'required|string',
            'email' => 'required|email',
            'bill_address' => 'required|string',
            'danger_type' => 'required|numeric|between:1,3',
            'phone' => 'bail|required|numeric|digits:11',
            'employer' => 'required|string',
            'countrySelect' => 'required',
            'citySelect' => 'required',
            'contract_at' => 'required|before_or_equal:' . date("Y-m-d H:i:s"),
            'nace_kodu' => 'required|string',
            'mersis_no' => 'bail|required|numeric|unique:coop_companies,mersis_no|digits:16',
            'sgk_sicil' => 'bail|required|numeric|unique:coop_companies,sgk_sicil|digits:26',
            'vergi_no' => 'bail|required|numeric|unique:coop_companies,vergi_no|digits:10',
            'vergi_dairesi' => 'required|string',
            'front_acc_name' => 'required|string',
            'front_acc_email' => 'required|email',
            'front_acc_phone' => 'bail|required|numeric|digits:11',
            'out_acc_name' => 'required|string',
            'out_acc_email' => 'required|email',
            'out_acc_phone' => 'required|numeric|digits:11',
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
            'type' => 'Sektör',
            'name' => 'Şirket Adı',
            'email' => 'Email',
            'bill_address' => 'Fatura Adresi',
            'danger_type' => 'Tehlike Sınıfı',
            'phone' => 'Telefon No',
            'employer' => 'İşveren/Vekili',
            'countrySelect' => 'Şehir',
            'citySelect' => 'İlçe',
            'contract_at' => 'İşletme Anlaşma Tarihi',
            'nace_kodu' => 'Nace Kodu',
            'mersis_no' => 'Mersis No',
            'sgk_sicil' => 'SGK Sicil No',
            'vergi_no' => 'Vergi No',
            'vergi_dairesi' => 'Vergi Dairesi',
            'front_acc_name' => 'Ön Muhasebe Ad Soyad',
            'front_acc_email' => 'Ön Muhasebe Email',
            'front_acc_phone' => 'Ön Muhasebe Telefon No',
            'out_acc_name' => 'Dış Muhasebe Ad Soyad',
            'out_acc_email' => 'Dış Muhasebe Email',
            'out_acc_phone' => 'Dış Muhasebe Telefon No',
        ];
    }
}
