<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CoopCompany;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OutAccountant;
use App\Models\UserToCompany;
use App\Models\CompanyToGroup;
use App\Models\FrontAccountant;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoopCompanyRequest;

class CoopCompanyController extends Controller
{
    public function index(Request $request)
    {
        $osgbEmployees = User::whereBetween('job_id', [1, 7])->get();
        $companies = CoopCompany::select('id', 'name', 'type', 'phone', 'email', 'city', 'town', 'contract_at');
        if ($request->ajax()) {
            return DataTables::of($companies)
                ->make(true);
        }
        return view(
            'admin.companies.index',
            [
                'osgbEmployees' => $osgbEmployees,
                'companies' => $companies
            ]
        );
    }

    public function store(StoreCoopCompanyRequest $request)
    {
        $request->validated();
        try {
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
                'danger_type' => $request->danger_type,
                'nace_kodu' => $request->nace_kodu,
                'mersis_no' => $request->mersis_no,
                'sgk_sicil' => $request->sgk_sicil,
                'vergi_no' => $request->vergi_no,
                'vergi_dairesi' => $request->vergi_dairesi,
                'is_group' => $request->isGroup == "true" ? 1 : 0,
                'group_status' => $request->company_status,
                'leader_company_id' => $request->leader_company_select,
                'katip_is_yeri_id' => $request->katip_is_yeri_id,
                'katip_kurum_id' => $request->katip_kurum_id,
            ]);
        } catch (\Throwable $th) {
            throw $th;
            return back()->with('fail', 'İşletme eklenirken bir hata ile karşılaşıldı');
        }

        try {
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

            foreach ($employeeIds as $employeeId) {

                if (!empty($employeeId)) {
                    $employees[] = [
                        'user_id' => $employeeId,
                        'company_id' => $company->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                } else
                    continue;
            }
            UserToCompany::insert($employees);
        } catch (\Throwable $th) {
            return back()->with('fail', 'İşletme Çalışanları eklenirken bir hata ile karşılaşıldı.');
        }

        try {
            if ($request->company_status == 'member') {
                CompanyToGroup::create(
                    [
                        'leader_id' => $request->leader_company_select,
                        'member_id' => $company->id
                    ]
                );
            }
        } catch (\Throwable $th) {
            return back()->with('fail', 'İşletme grubuyla ilgili bir hata ile karşılaşıldı.');
        }

        try {
            FrontAccountant::create([
                'company_id' => $company->id,
                'name' => $request->front_acc_name,
                'email' => $request->front_acc_email,
                'phone' => $request->front_acc_phone,
            ]);

            OutAccountant::create([
                'company_id' => $company->id,
                'name' => $request->out_acc_name,
                'email' => $request->out_acc_email,
                'phone' => $request->out_acc_phone,
            ]);
        } catch (\Throwable $th) {
            return back()->with('fail', 'İşletmeye ait muhasebeciler eklenirken bir hata ile karşılaşıldı.');
        }

        return back()
            ->with('success', 'İşletme başarıyla eklendi. ' .
                '<a  href="/admin/company/' . $company->id . '">' .
                Str::title($company->name) . ' İşletmesine Git</a>');
    }
}
