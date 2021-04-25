<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CoopCompany;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\UserToCompany;

class CoopCompanyController extends Controller
{
    public function index(Request $request)
    {
        $osgbEmployees = User::whereBetween('job_id',[1,7])->get();
        if ($request->ajax()) {
            $data = CoopCompany::select('*');
            return DataTables::of($data)
                ->make(true);
        }
        return view(
            'admin.companies',
            ['osgbEmployees' => $osgbEmployees]
        );
    }


    public function store(Request $request)
    {
        $company = CoopCompany::create([
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
            'remi_freq' => $request->remi_freq,
        ]);


        /*
        $employees =[
            [
                'user_id' => $request->uzman_id,
                'company_id' => $company->id
            ],
            [
                'user_id' => $request->uzman_id_2,
                'company_id' => $company->id
            ],
            [
                'user_id' => $request->uzman_id_3,
                'company_id' => $company->id
            ],
            [
                'user_id' => $request->hekim_id,
                'company_id' => $company->id
            ],
            [
                'user_id' => $request->hekim_id_2,
                'company_id' => $company->id
            ],
            [
                'user_id' => $request->hekim_id_3,
                'company_id' => $company->id
            ],
            [
                'user_id' => $request->saglık_p_id,
                'company_id' => $company->id
            ],
            [
                'user_id' => $request->saglık_p_id_2,
                'company_id' => $company->id
            ],
            [
                'user_id' => $request->ofis_p_id,
                'company_id' => $company->id
            ],
            [
                'user_id' => $request->ofis_p_id_2,
                'company_id' => $company->id
            ],
            [
                'user_id' => $request->muhasebe_p_id,
                'company_id' => $company->id
            ],
            [
                'user_id' => $request->muhasebe_p_id_2,
                'company_id' => $company->id
            ]
        ];
        */

        $employeeIds = [
            $request->uzman_id,
            $request->uzman_id_2,
            $request->uzman_id_3,
            $request->hekim_id,
            $request->hekim_id_2,
            $request->hekim_id_3,
            $request->saglık_p_id,
            $request->saglık_p_id_2,
            $request->ofis_p_id,
            $request->ofis_p_id_2,
            $request->muhasebe_p_id,
            $request->muhasebe_p_id_2
        ];
        $employees = [];

        foreach ($employeeIds as $key => $employeeId) {

            if (!empty($employeeId)) {
                $employees[] =[
                    'user_id' => $employeeId,
                    'company_id' => $company->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            else
                continue;
        }
        UserToCompany::insert($employees);


        return redirect()->route('admin.companies.index');
    }
}
