<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Equipment;
use App\Models\CoopCompany;
use App\Models\CoopEmployee;
use Illuminate\Http\Request;
use App\Models\CompanyToFile;
use App\Models\DeleteRequest;
use App\Models\EmployeeGroup;
use App\Models\OutAccountant;
use App\Models\UpdateRequest;
use App\Models\UserToCompany;
use App\Models\FrontAccountant;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAccountantRequest;
use App\Http\Requests\StoreCoopEmployeeRequest;

class CompanyController extends Controller
{
    public function index($id)
    {
        $relation = UserToCompany::where('company_id', $id)->where('user_id', Auth::id())->count();
        if ($relation < 1)
            abort(403);

        ////////////////////////////////////////////////////////////////////////////
        $company = CoopCompany::where('id', $id)->first();

        if (empty($company))
            return redirect()->route('user.deleted_company', ['id' => $id]);

        $employees['expert'] = UserToCompany::with('user')->whereHas('user', function ($query) {
            $query->where('job_id', 1);
        })->where('company_id', $id)->first() ?? '';

        $employees['doctor'] = UserToCompany::with('user')->whereHas('user', function ($query) {
            $query->where('job_id', 4);
        })->where('company_id', $id)->first() ?? '';

        $notifications = [];

        $employees['coopEmployees'] = CoopEmployee::where('company_id', $id)->count();

        $mandatory_files = CompanyToFile::with('file')->where('company_id', $id)->orderByDesc('assigned_at')->get();

        $defter_nushalari = $mandatory_files->where('file_type', 9)->groupBy(function ($date) {
            return Carbon::parse($date->assigned_at)->format('m');
        });

        $gozlem_raporlari = $mandatory_files->where('file_type', 10)->groupBy(function ($date) {
            return Carbon::parse($date->assigned_at)->format('m');
        });
        $mandatory_files = $mandatory_files->whereBetween('file_type', [1, 8])->unique('file_type');

        $equipments = Equipment::where('company_id', $id)->with('file')->get();

        $file_names = [
            1 => '???? Yeri Uzman S??zle??mesi',
            2 => '???? Yeri Hekim S??zle??mesi',
            3 => 'Acil Durum Eylem Plan??',
            4 => 'Risk Analizi Dosyas??',
            5 => 'Y??ll??k ??al????ma Plan??',
            6 => 'Y??ll??k E??itim Program??',
            7 => 'DSP S??zle??mesi',
            8 => 'Y??l Sonu De??erlendirme Raporu'
        ];
        return view(
            'user.company.home.index',
            [
                'company' => $company,
                'employees' => $employees,
                'notifications' => $notifications,
                'mandatory_files' => $mandatory_files,
                'file_names' => $file_names,
                'defter_nushalari' => $defter_nushalari[date('m')] ?? null,
                'gozlem_raporlari' => $gozlem_raporlari[date('m')] ?? null,
                'count' => 0,
                'equipments' => $equipments,
            ],
        );
    }

    public function showInfo($id)
    {
        $relation = UserToCompany::where('company_id', $id)->where('user_id', Auth::id())->count();
        if ($relation < 1)
            abort(403);

        ////////////////////////////////////////////////////////////////////////////

        $company = CoopCompany::where('id', $id)->first();
        if (empty($company))
            return redirect()->route('user.deleted_company', ['id' => $id]);

        $accountants['front'] = FrontAccountant::where('company_id', $id)->first();
        $accountants['out'] = OutAccountant::where('company_id', $id)->first();

        $employees['osgbEmployees'] = UserToCompany::select('user_id')->with('user')->whereHas('user', function ($query) {
            $query->whereBetween('job_id', [1, 7]);
        })->where('company_id', $id)->groupBy('user_id')->get();

        return (view(
            'user.company.informations.index',
            [
                'company' => $company,
                'employees' => $employees,
                'accountants' => $accountants,
            ],
        ));
    }

    public function showEmployees($id)
    {
        $relation = UserToCompany::where('company_id', $id)->where('user_id', Auth::id())->count();
        if ($relation < 1)
            abort(403);

        ////////////////////////////////////////////////////////////////////////////

        $company = CoopCompany::where('id', $id)->first();

        if (empty($company))
            return redirect()->route('user.deleted_company', ['id' => $id]);

        return view(
            'user.company.employees.index',
            [
                'company' => $company,
            ],
        );
    }

    public function showDocuments($id)
    {
        $relation = UserToCompany::where('company_id', $id)->where('user_id', Auth::id())->count();
        if ($relation < 1)
            abort(403);

        ////////////////////////////////////////////////////////////////////////////

        $company = CoopCompany::where('id', $id)->first();
        if (empty($company))
            return redirect()->route('user.deleted_company', ['id' => $id]);

        $files = CompanyToFile::with('file', 'type')->where('company_id', $id)->orderByDesc('assigned_at')->get();
        $mandatory_files = $files->whereBetween('file_type', [1, 8]);
        $defter_nushalari = $files->where('file_type', 9);
        $gozlem_raporlari = $files->where('file_type', 10);

        return view(
            'user.company.documents.index',
            [
                'company' => $company,
                'mandatory_files' => $mandatory_files,
                'defter_nushalari' => $defter_nushalari,
                'gozlem_raporlari' => $gozlem_raporlari,
            ],
        );
    }

    public function showEmployeeGroups($id)
    {
        $relation = UserToCompany::where('company_id', $id)->where('user_id', Auth::id())->count();
        if ($relation < 1)
            abort(403);

        ////////////////////////////////////////////////////////////////////////////

        $company = CoopCompany::where('id', $id)->first();
        if (empty($company))
            return redirect()->route('user.deleted_company', ['id' => $id]);

        $relations = EmployeeGroup::where('company_id', $id)
            ->with(['employee', 'file', 'osgbEmployee'])
            ->orderBy('group')->get();

        $riskFile = CompanyToFile::where('company_id', $id)->where('file_type', 11)->get();
        return view(
            'user.company.employee-groups.index',
            [
                'company' => $company,
                'relations' => $relations,
                'riskFile' => $riskFile->last(),
            ]
        );
    }

    public function deletedIndex($id, Request $request)
    {
        $relation = UserToCompany::where('company_id', $id)->where('user_id', Auth::id())->count();
        if ($relation < 1)
            abort(403);

        $company = CoopCompany::where('id', $id)->onlyTrashed()->first();
        if ($request->ajax()) {
            $coopEmployees = CoopEmployee::where('company_id', $id)->withTrashed()->get();
            return DataTables::of($coopEmployees)
                ->make(true);
        }
        $mandatory_files = CompanyToFile::with('file', 'type')->where('company_id', $id)->get();
        $accountants['front'] = FrontAccountant::where('company_id', $id)->first();
        $accountants['out'] = OutAccountant::where('company_id', $id)->first();


        return (view(
            'user.deleted_company.index',
            [
                'company' => $company,
                'osgbEmployees' => null,
                'accountants' => $accountants,
                'mandatory_files' => $mandatory_files
            ],
        ));
    }

    public function updateRequest(CoopCompany $company, User $user, Request $request)
    {
        $istekler = [
            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'bill_address' => $request->bill_address,
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
            'danger_type' => $request->danger_type,
        ];

        $changedData = array_diff_assoc($istekler, $company->getAttributes());
        if (empty($changedData)) {
            return redirect()->route('user.company', ['id' => $company->id])->with('fail', 'Hi??bir de??i??iklik yapmad??????n??z?? fark ettik l??tfen tekrar deneyiniz!');
        }
        $changedData['user_id'] = $user->id;
        $changedData['company_id'] = $company->id;

        try {
            UpdateRequest::create($changedData);
        } catch (\Throwable $th) {
            return redirect()->route('user.company', ['id' => $company->id])->with('fail', 'Talebiniz iletilirken bir sorunla kar????la????ld??!');
        }

        return redirect()->route('user.company', ['id' => $company->id])->with('success', 'De??i??iklik talebiniz y??neticinize iletilmi??tir!');
    }

    public function deleteRequest(CoopCompany $company, User $user)
    {
        $requestExist = DeleteRequest::where('company_id', $company->id)->exists();
        if ($requestExist) {
            return redirect()->route('user.company', ['id' => $company->id])->with('existRequest', 'Bu i??letmeye ait bir silme talebi zaten bulunmaktad??r!');
        }

        try {
            DeleteRequest::create([
                'user_id' => $user->id,
                'company_id' => $company->id
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('user.company', ['id' => $company->id])->with('fail', 'Talebiniz iletilirken bir sorunla kar????la????ld??!');
        }

        return redirect()->route('user.company', ['id' => $company->id])->with('success', 'Silme talebiniz y??neticinize iletilmi??tir!');
    }

    public function assignEmployee(CoopCompany $company, Request $request)
    {
        $exist = UserToCompany::where('user_id', $request->user)->where('company_id', $company->id)->count();
        if ($exist >= 1) {
            return back()->with(
                [
                    'fail' => '??al????an zaten bu i??letmeye atanm????!',
                    'tab' => 'osgb_calisanlar'
                ]
            );
        }
        try {
            UserToCompany::create([
                'user_id' => $request->user,
                'company_id' => $company->id
            ]);
        } catch (\Throwable $th) {
            return back()->with(
                [
                    'fail' => 'Bir hata ile kar????la????ld??!',
                    'tab' => 'osgb_calisanlar'
                ]
            );
        }
        return back()->with(
            [
                'success' => 'Se??ti??iniz ??al????an ??irketiniz ile e??le??tirildi!',
                'tab' => 'osgb_calisanlar'
            ]
        );
    }

    public function addEmployee(CoopCompany $company, StoreCoopEmployeeRequest $request)
    {
        $request->validated();

        try {
            $formData = $request->except('_token');
            $formData['company_id'] = $company->id;
            CoopEmployee::create($formData);
        } catch (\Throwable $th) {
            return back()->with(
                [
                    'fail' => 'Bir hata ile kar????la????ld??!',
                    'tab' => 'isletme_calisanlar'
                ]
            );
        }
        return back()->with(
            [
                'success' => 'Yeni ??al????an Ba??ar??yla Eklendi!',
                'tab' => 'isletme_calisanlar'
            ]
        );
    }

    public function deleteEmployee($company, $employee)
    {
        try {
            CoopEmployee::where('id', $employee)->where('company_id', $company)->delete();
        } catch (\Throwable $th) {
            return back()->with(
                [
                    'fail' => 'Bir hata ile kar????la????ld??!',
                    'tab' => 'isletme_calisanlar'
                ]
            );
        }
        return back()->with(
            [
                'success' => '??al????an ba??ar??yla silindi. Silinen ??al????anlara AR????V b??l??m??nden ula??abilirsiniz',
                'tab' => 'isletme_calisanlar'
            ]
        );
    }

    public function addAcc(CoopCompany $company, StoreAccountantRequest $request)
    {
        $request->validated();

        if ($request->front_acc_name === null && $request->out_acc_name === null) {
            return back()->with(
                [
                    'tab' => 'muhasebe_bilgileri',
                    'fail' => 'Eksik bilgi girdiniz!'
                ]
            );
        }
        DB::beginTransaction();
        if ($request->front_acc_name !== null) {
            try {
                FrontAccountant::create([
                    'name' => $request->front_acc_name,
                    'company_id' => $company->id,
                    'email' => $request->front_acc_email,
                    'phone' => $request->front_acc_phone,
                ]);
            } catch (\Throwable $th) {
                DB::rollBack();
                return back()->with(
                    [
                        'tab' => 'muhasebe_bilgileri',
                        'fail' => '??n muhasebe eklenirken bir hata ile kar????la????ld??!'
                    ]
                );
            }
        }

        if ($request->out_acc_name !== null) {
            try {
                OutAccountant::create([
                    'name' => $request->out_acc_name,
                    'company_id' => $company->id,
                    'email' => $request->out_acc_email,
                    'phone' => $request->out_acc_phone,
                ]);
            } catch (\Throwable $th) {
                DB::rollBack();
                return back()->with(
                    [
                        'tab' => 'muhasebe_bilgileri',
                        'fail' => 'D???? muhasebe eklenirken bir hata ile kar????la????ld??!'
                    ]
                );
            }
        }
        DB::commit();
        return back()->with(
            [
                'tab' => 'muhasebe_bilgileri',
                'success' => 'Muhasebeciler ba??ar??yla eklendi!'
            ]
        );
    }

    public function uploadAcc(CoopCompany $company, StoreAccountantRequest $request)
    {
        $request->validated();
        DB::beginTransaction();
        try {
            $out_acc = OutAccountant::where('company_id', $company->id)->first();
            $out_acc_demand = [
                'name' => $request->out_acc_name,
                'email' => $request->out_acc_email,
                'phone' => $request->out_acc_phone,
            ];
            if ($out_acc !== null) {
                $out_acc_change = array_diff_assoc($out_acc_demand, $out_acc->toArray());
                if ($out_acc_change !== null && $out_acc_demand['name'] !== null) {
                    $out_acc->update($out_acc_change);
                }
            }
            if ($out_acc === null && $out_acc_demand['name'] !== null) {
                $out_acc_demand['company_id'] = $company->id;
                OutAccountant::create($out_acc_demand);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with([
                'tab' => 'muhasebe_bilgileri',
                'fail' => 'Bir Hata ile Kar????la????ld??!'
            ]);
        }

        try {
            $front_acc = FrontAccountant::where('company_id', $company->id)->first();
            $front_acc_demand = [
                'name' => $request->front_acc_name,
                'email' => $request->front_acc_email,
                'phone' => $request->front_acc_phone,
            ];
            if ($front_acc !== null) {
                $front_acc_change = array_diff_assoc($front_acc_demand, $front_acc->toArray());
                if ($front_acc_change !== null && $front_acc_demand['name'] !== null) {
                    $front_acc->update($front_acc_change);
                }
            }
            if ($front_acc === null && $front_acc_demand['name'] !== null) {
                $front_acc_demand['company_id'] = $company->id;
                FrontAccountant::create($front_acc_demand);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with([
                'tab' => 'muhasebe_bilgileri',
                'fail' => 'Bir Hata ile Kar????la????ld??!'
            ]);
        }
        DB::commit();
        return back()->with([
            'tab' => 'muhasebe_bilgileri',
            'success' => 'De??i??iklikleriniz ba??ar??yla uygulanm????t??r!'
        ]);
    }
}
