<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEquipmentRequest extends FormRequest
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
            'name' => 'required|string|max:250',
            'period' => ['required', Rule::in(['1', '2', '3', '6', '9', '12', '18', '24', '36', '48', '60', '84', '120'])],
            'maintained_at' => 'nullable|before_or_equal:' . date('Y-m-d'),
            'file' => 'nullable|file|mimes:csv,txt,xlx,xls,xlsx,odt,odf,pdf,png,jpg,jpeg,doc,docx,ppt,pptx|max:46080',
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
            'name' => 'Ekipman Adı',
            'period' => 'Bakım Sıklığı',
            'maintained_at' => 'Son Bakım Tarihi',
            'file' => 'Dosya',
        ];
    }
}
