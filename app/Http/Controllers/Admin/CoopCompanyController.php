<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoopCompany;
use Illuminate\Http\Request;

class CoopCompanyController extends Controller
{
    public function index()
    {
        $companies = CoopCompany::paginate(15);
        return view(
            'admin.companies',
            [
                'companies' => $companies
            ]
        );
    }
    public function store(Request $request)
    {
        CoopCompany::create([
            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'employer' => $request->employer,
            'city' => $request->countrySelect,
            'town' => $request->citySelect,
            'contract_at' => $request->contract_at,
            'nace_kodu' => $request->nace_kodu,
            'mersis_no' => $request->mersis_no,
            'sgk_sicil' => $request->sgk_sicil,
            'vergi_no' => $request->vergi_no,
            'vergi_dairesi' => $request->vergi_dairesi,
            'katip_is_yeri_id' => $request->katip_is_yeri_id,
            'katip_kurum_id' => $request->katip_kurum_id,
            'uzman_id' => $request->uzman_id,
            'uzman_id_2' => $request->uzman_id_2,
            'uzman_id_3' => $request->uzman_id_3,
            'hekim_id' => $request->hekim_id,
            'hekim_id_2' => $request->hekim_id_2,
            'hekim_id_3' => $request->hekim_id_3,
            'saglık_p_id' => $request->saglık_p_id,
            'saglık_p_id_2' => $request->saglık_p_id_2,
            'ofis_p_id' => $request->ofis_p_id,
            'ofis_p_id_2' => $request->ofis_p_id_2,
            'remi_freq' => $request->remi_freq,
        ]);
        return redirect()->route('companies');
    }
}
