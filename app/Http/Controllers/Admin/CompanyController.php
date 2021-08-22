<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\CoopCompany;
use App\Models\CoopEmployee;
use Illuminate\Http\Request;
use App\Models\CompanyToFile;
use App\Models\OutAccountant;
use App\Models\UserToCompany;
use App\Models\FrontAccountant;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountantRequest;
use App\Http\Requests\StoreCoopEmployeeRequest;
use App\Models\EmployeeGroup;
use App\Models\Equipment;

class CompanyController extends Controller
{
    public function index($id)
    {
        $company = CoopCompany::where('id', $id)->first();
        if (empty($company))
            return redirect()->route('admin.deleted_company', ['id' => $id]);

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
            1 => 'İş Yeri Uzman Sözleşmesi',
            2 => 'İş Yeri Hekim Sözleşmesi',
            3 => 'Acil Durum Eylem Planı',
            4 => 'Risk Analizi Dosyası',
            5 => 'Yıllık Çalışma Planı',
            6 => 'Yıllık Eğitim Programı',
            7 => 'DSP Sözleşmesi',
            8 => 'Yıl Sonu Değerlendirme Raporu'
        ];
        return view(
            'admin.company.home.index',
            [
                'company' => $company,
                'employees' => $employees,
                'notifications' => $notifications,
                'mandatory_files' => $mandatory_files,
                'file_names' => $file_names,
                'defter_nushalari' => $defter_nushalari[date('m')] ?? null,
                'gozlem_raporlari' => $gozlem_raporlari[date('m')] ?? null,
                'equipments' => $equipments,
            ],
        );
    }

    public function showInfo($id)
    {
        $company = CoopCompany::where('id', $id)->first();
        if (empty($company))
            return redirect()->route('admin.deleted_company', ['id' => $id]);

        $accountants['front'] = FrontAccountant::where('company_id', $id)->first();
        $accountants['out'] = OutAccountant::where('company_id', $id)->first();

        $employees['osgbEmployees'] = UserToCompany::select('user_id')->with('user')->whereHas('user', function ($query) {
            $query->whereBetween('job_id', [1, 7]);
        })->where('company_id', $id)->groupBy('user_id')->get();

        if ($company->is_group == 1)
            $groupCompanies = CoopCompany::where('leader_company_id', $company->leader_company_id)->whereNotNull('leader_company_id')
                ->select('id', 'name', 'leader_company_id', 'sube_kodu', 'group_status')
                ->get();

        return (view(
            'admin.company.informations.index',
            [
                'company' => $company,
                'employees' => $employees,
                'accountants' => $accountants,
                'groupCompanies' => $groupCompanies ?? [],
            ],
        ));
    }

    public function showEmployees($id)
    {
        $company = CoopCompany::where('id', $id)->first();

        if (empty($company))
            return redirect()->route('admin.deleted_company', ['id' => $id]);

        return view(
            'admin.company.employees.index',
            [
                'company' => $company
            ],
        );
    }

    public function showDocuments($id)
    {
        $company = CoopCompany::where('id', $id)->first();
        if (empty($company))
            return redirect()->route('admin.deleted_company', ['id' => $id]);

        $files = CompanyToFile::with('file', 'type')->where('company_id', $id)->orderByDesc('assigned_at')->get();
        $mandatory_files = $files->whereBetween('file_type', [1, 8]);
        $defter_nushalari = $files->where('file_type', 9);
        $gozlem_raporlari = $files->where('file_type', 10);

        return view(
            'admin.company.documents.index',
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
        $company = CoopCompany::where('id', $id)->first();
        if (empty($company))
            return redirect()->route('admin.deleted_company', ['id' => $id]);

        $relations = EmployeeGroup::where('company_id', $id)
            ->with(['employee', 'file', 'osgbEmployee'])
            ->orderBy('group')->get();

        $riskFile = CompanyToFile::where('company_id', $id)->where('file_type', 11)->get();
        return view(
            'admin.company.employee-groups.index',
            [
                'company' => $company,
                'relations' => $relations,
                'riskFile' => $riskFile->last(),
            ]
        );
    }

    public function deletedIndex($id, Request $request)
    {
        $company = CoopCompany::where('id', $id)->onlyTrashed()->first();
        if (empty($company))
            abort(404);

        if ($request->ajax()) {
            $coopEmployees = CoopEmployee::where('company_id', $id)->withTrashed()->get();
            return DataTables::of($coopEmployees)
                ->make(true);
        }
        $mandatory_files = CompanyToFile::with('file', 'type')->where('company_id', $id)->get();
        $accountants['front'] = FrontAccountant::where('company_id', $id)->first();
        $accountants['out'] = OutAccountant::where('company_id', $id)->first();

        return (view(
            'admin.deleted_company.index',
            [
                'company' => $company,
                'osgbEmployees' => null,
                'accountants' => $accountants,
                'mandatory_files' => $mandatory_files
            ],
        ));
    }

    public function update(CoopCompany $company, Request $request)
    {

        $updatedData = array_diff_assoc($request->toArray(), $company->toArray());
        unset($updatedData['_token']);
        try {
            $company->update($updatedData);
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.company.informations.index', ['id' => $company->id])
                ->with('fail', 'Değişiklerinizi uygularken bir hatayla karşılaştık!');
        }
        return redirect()
            ->route('admin.company.informations.index', ['id' => $company->id])
            ->with('success', 'Yaptığınız değişiklikler başarıyla uygulanmıştır!');
    }

    public function delete(CoopCompany $company)
    {
        DB::beginTransaction();
        try {
            CoopCompany::where('id', $company->id)->delete();
            CoopEmployee::where('company_id', $company->id)->delete();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('admin.company.informations.index', ['id' => $company->id])
                ->with('fail', 'Silme esnasında bir hatayla karşılaşıldı!');
        }
        DB::commit();
        return redirect()
            ->route('admin.companies.index')
            ->with('success', 'Şirket başarıyla silinmiştir. Silinen işletmelere ARŞİV bölümünden ulaşabilirsiniz!');
    }

    public function assignEmployee(CoopCompany $company, Request $request)
    {
        $exist = UserToCompany::where('user_id', $request->user)->where('company_id', $company->id)->count();
        if ($exist >= 1) {
            return back()->with(
                [
                    'fail' => 'Çalışan zaten bu işletmeye atanmış!',
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
            return redirect()
                ->route('admin.company.informations.osgb', ['id' => $company->id])
                ->with('fail', 'Bir hata ile karşılaşıldı!',);
        }
        return redirect()
            ->route('admin.company.informations.osgb', ['id' => $company->id])
            ->with('success', 'Seçtiğiniz çalışan şirketiniz ile eşleştirildi!');
    }

    public function addEmployee(CoopCompany $company, StoreCoopEmployeeRequest $request)
    {
        $request->validated();

        try {
            $formData = $request->except('_token');
            $formData['company_id'] = $company->id;
            CoopEmployee::create($formData);
        } catch (\Throwable $th) {
            return back()->with('fail', 'Bir hata ile karşılaşıldı!');
        }
        return back()->with('success', 'Yeni Çalışan Başarıyla Eklendi!');
    }

    public function deleteEmployee(CoopCompany $company, $employee, Request $request)
    {
        try {
            CoopEmployee::where('id', $employee)->where('company_id', $company->id)->delete();
        } catch (\Throwable $th) {
            return redirect()
                ->route('admin.company.employees.deleted', ['id' => $company->id])
                ->with('fail', 'Bir hata ile karşılaşıldı!');
        }
        return redirect()
            ->route('admin.company.employees.deleted', ['id' => $company->id])
            ->with(
                'success',
                'Çalışan başarıyla silindi. Silinen çalışanlara ARŞİV bölümünden ulaşabilirsiniz',
            );
    }

    public function addAcc(CoopCompany $company, StoreAccountantRequest $request)
    {
        $request->validated();
        if ($request->front_acc_name === null && $request->out_acc_name === null) {
            return redirect()
                ->route('admin.company.informations.acc', ['id' => $company->id])
                ->with('fail', 'Eksik bilgi girdiniz!');
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
                return redirect()
                    ->route('admin.company.informations.acc', ['id' => $company->id])
                    ->with('fail', 'Ön muhasebe eklenirken bir hata ile karşılaşıldı!');
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
                return redirect()
                    ->route('admin.company.informations.acc', ['id' => $company->id])
                    ->with('fail', 'Dış muhasebe eklenirken bir hata ile karşılaşıldı!');
            }
        }
        DB::commit();
        return redirect()
            ->route('admin.company.informations.acc', ['id' => $company->id])
            ->with('success', 'Muhasebeciler başarıyla eklendi!');
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
            return redirect()
                ->route('admin.company.informations.acc', ['id' => $company->id])
                ->with('fail', 'Bir Hata ile Karşılaşıldı!');
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
            return redirect()
                ->route('admin.company.informations.acc', ['id' => $company->id])
                ->with('fail', 'Bir Hata ile Karşılaşıldı!');
        }

        DB::commit();
        return redirect()
            ->route('admin.company.informations.acc', ['id' => $company->id])
            ->with('success', 'Değişiklikleriniz başarıyla uygulanmıştır!');
    }

    public function changeGroup(CoopCompany $company, Request $request)
    {
        if ($request->isGroup === 'true' && $request->company_status === 'member') {
            if ($request->sube_kodu === null)
                return back()->with('fail', 'Lütfen Şube Adını Giriniz');

            if ($request->leader_company_select === null)
                return back()->with('fail', 'Lütfen Üst Şirketi Seçiniz');
        }

        DB::beginTransaction();
        $leaderChanged = false;
        try {
            if ($company->group_status === 'leader' && ($request->company_status === 'member' || $request->isGroup === 'false')) {
                CoopCompany::where('leader_company_id', '=', $company->id)
                    ->where('id', '!=', $company->id)
                    ->update(
                        [
                            'leader_company_id' => null,
                            'is_group' => 0,
                            'group_status' => null,
                            'sube_kodu' => null,
                        ]
                    );
                $leaderChanged = true;
            }

            if ($request->isGroup == "true" && $request->company_status == 'leader') {
                $sube_kodu = 'MERKEZ';
                $leader = $company->id;
            }

            $company->update([
                'is_group' => $request->isGroup == "true" ? 1 : 0,
                'sube_kodu' => $request->sube_kodu ?? $sube_kodu ?? null,
                'group_status' => $request->company_status,
                'leader_company_id' => $request->leader_company_select ?? $leader ?? null,
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return back()->with('fail', 'Bir Hata ile Karşılaşıldı!');
        }

        DB::commit();
        if ($leaderChanged) {
            return back()->with('success', 'Grup bilgileri başarıyla güncellendi. Daha önce bu gruba bağlı şirketlerin grup bağlantıları kaldırıldı.');
        } else {
            return back()->with('success', 'Grup bilgileri başarıyla güncellendi');
        }
    }
}
