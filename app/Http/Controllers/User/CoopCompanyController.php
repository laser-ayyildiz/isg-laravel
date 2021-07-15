<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\CoopCompany;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OutAccountant;
use App\Models\UserToCompany;
use App\Models\CompanyToGroup;
use App\Models\FrontAccountant;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCoopCompanyRequest;

class CoopCompanyController extends Controller
{
    public function index(Request $request)
    {
        $osgbEmployees = User::whereBetween('job_id', [1, 7])->get();
        $group_leaders = CoopCompany::select('id', 'name')->where('group_status', 'leader')->get();
        if ($request->ajax()) {
            $data = UserToCompany::with('company')->where('user_id', Auth::id())->get();
            $data = $data->unique('company_id');
            $companies = [];
            foreach ($data as $value) {
                if (isset($value->company)) {
                    $companies[] = $value->company;
                }
            }
            return DataTables::of($companies)
                ->make(true);
        }
        return view(
            'common.companies.index',
            [
                'osgbEmployees' => $osgbEmployees,
                'group_leaders' => $group_leaders
            ]
        );
    }

    public function store(StoreCoopCompanyRequest $request)
    {
        $request->validated();
        if ($request->isGroup == "true" && $request->company_status == 'member' && $request->leader_company_select == null) {
            return back()->with('fail', 'Grup şirketinin başındaki iş yerini seçmediniz!');
        }
        DB::beginTransaction();
        try {
            $company = CoopCompany::create([
                'type' => $request->type,
                'name' => $request->name,
                'sube_kodu' => $request->sube_kodu ?? null,
                'email' => $request->email,
                'address' => $request->address,
                'bill_address' => $request->bill_address,
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
            DB::rollBack();
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
            if (!array_key_exists(Auth::id(), $employeeIds)) {
                $employees[] = [
                    'user_id' => Auth::id(),
                    'company_id' => $company->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

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
            DB::rollBack();
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
            DB::rollBack();
            return back()->with('fail', 'İşletme grubuyla ilgili bir hata ile karşılaşıldı.');
        }

        try {
            if (isset($request->front_acc_name)) {
                FrontAccountant::create([
                    'company_id' => $company->id,
                    'name' => $request->front_acc_name,
                    'email' => $request->front_acc_email,
                    'phone' => $request->front_acc_phone,
                ]);
            }
            if (isset($request->out_acc_email)) {
                OutAccountant::create([
                    'company_id' => $company->id,
                    'name' => $request->out_acc_name,
                    'email' => $request->out_acc_email,
                    'phone' => $request->out_acc_phone,
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('fail', 'İşletmeye ait muhasebeciler eklenirken bir hata ile karşılaşıldı.');
        }
        DB::commit();
        return back()
            ->with('success', 'İşletme başarıyla eklendi. ' .
                '<a  href="/user/company/' . $company->id . '">' .
                Str::title($company->name) . ' İşletmesine Git</a>');
    }
}
