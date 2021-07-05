<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\CoopCompany;
use App\Models\CoopEmployee;
use Illuminate\Http\Request;
use App\Models\CompanyToFile;
use App\Models\DeleteRequest;
use App\Models\OutAccountant;
use App\Models\UpdateRequest;
use App\Models\UserToCompany;
use App\Models\FrontAccountant;
use Yajra\DataTables\DataTables;
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

        $employees['expert'] = UserToCompany::whereHas('user', function ($query) {
            $query->where('job_id', 1);
        })->where('company_id', $id)->first() ?? '';

        $employees['doctor'] = UserToCompany::whereHas('user', function ($query) {
            $query->where('job_id', 4);
        })->where('company_id', $id)->first() ?? '';

        $notifications = [];

        $employees['coopEmployees'] = CoopEmployee::where('company_id', $id)->count();

        $mandatory_files = CompanyToFile::with('file', 'type')->where('company_id', $id)->orderBy('file_type')->get();
        $file_types = [];
        foreach ($mandatory_files as $value) {
            $file_types[] = $value['type']['id'];
        }

        $defter_nushalari = $mandatory_files->where('file_type', 9)->sortByDesc('assigned_at')->groupBy(function ($date) {
            return Carbon::parse($date->assigned_at)->format('m');
        });

        $gozlem_raporlari = $mandatory_files->where('file_type', 10)->sortByDesc('assigned_at')->groupBy(function ($date) {
            return Carbon::parse($date->assigned_at)->format('m');
        });

        return view(
            'user.company.home.index',
            [
                'company' => $company,
                'employees' => $employees,
                'file_types' => $file_types,
                'notifications' => $notifications,
                'mandatory_files' => $mandatory_files->whereBetween('file_type', [1, 8]),
                'defter_nushalari' => $defter_nushalari[date('m')] ?? null,
                'gozlem_raporlari' => $gozlem_raporlari[date('m')] ?? null,
                'count' => 0

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

        $deletedEmployees = [];

        $employees = CoopEmployee::where('company_id', $id)
            ->with('files')
            ->orderBy('name')
            ->withTrashed()
            ->get();

        return view(
            'user.company.employees.index',
            [
                'company' => $company,
                'employees' => $employees,
                'deletedEmployees' => $deletedEmployees,
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
        ];

        $changedData = array_diff_assoc($istekler, $company->getAttributes());
        if (empty($changedData)) {
            return redirect()->route('user.company', ['id' => $company->id])->with('fail', 'Hiçbir değişiklik yapmadığınızı fark ettik lütfen tekrar deneyiniz!');
        }
        $changedData['user_id'] = $user->id;
        $changedData['company_id'] = $company->id;

        try {
            UpdateRequest::create($changedData);
        } catch (\Throwable $th) {
            return redirect()->route('user.company', ['id' => $company->id])->with('fail', 'Talebiniz iletilirken bir sorunla karşılaşıldı!');
        }

        return redirect()->route('user.company', ['id' => $company->id])->with('success', 'Değişiklik talebiniz yöneticinize iletilmiştir!');
    }

    public function deleteRequest(CoopCompany $company, User $user)
    {
        $requestExist = DeleteRequest::where('company_id', $company->id)->exists();
        if ($requestExist) {
            return redirect()->route('user.company', ['id' => $company->id])->with('existRequest', 'Bu işletmeye ait bir silme talebi zaten bulunmaktadır!');
        }

        try {
            DeleteRequest::create([
                'user_id' => $user->id,
                'company_id' => $company->id
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('user.company', ['id' => $company->id])->with('fail', 'Talebiniz iletilirken bir sorunla karşılaşıldı!');
        }

        return redirect()->route('user.company', ['id' => $company->id])->with('success', 'Silme talebiniz yöneticinize iletilmiştir!');
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
            return back()->with(
                [
                    'fail' => 'Bir hata ile karşılaşıldı!',
                    'tab' => 'osgb_calisanlar'
                ]
            );
        }
        return back()->with(
            [
                'success' => 'Seçtiğiniz çalışan şirketiniz ile eşleştirildi!',
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
                    'fail' => 'Bir hata ile karşılaşıldı!',
                    'tab' => 'isletme_calisanlar'
                ]
            );
        }
        return back()->with(
            [
                'success' => 'Yeni Çalışan Başarıyla Eklendi!',
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
                    'fail' => 'Bir hata ile karşılaşıldı!',
                    'tab' => 'isletme_calisanlar'
                ]
            );
        }
        return back()->with(
            [
                'success' => 'Çalışan başarıyla silindi. Silinen çalışanlara ARŞİV bölümünden ulaşabilirsiniz',
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

        if ($request->front_acc_name !== null) {
            try {
                FrontAccountant::create([
                    'name' => $request->front_acc_name,
                    'company_id' => $company->id,
                    'email' => $request->front_acc_email,
                    'phone' => $request->front_acc_phone,
                ]);
            } catch (\Throwable $th) {
                throw $th;
                return back()->with(
                    [
                        'tab' => 'muhasebe_bilgileri',
                        'fail' => 'Ön muhasebe eklenirken bir hata ile karşılaşıldı!'
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
                return back()->with(
                    [
                        'tab' => 'muhasebe_bilgileri',
                        'fail' => 'Dış muhasebe eklenirken bir hata ile karşılaşıldı!'
                    ]
                );
            }
        }

        return back()->with(
            [
                'tab' => 'muhasebe_bilgileri',
                'success' => 'Muhasebeciler başarıyla eklendi!'
            ]
        );
    }

    public function uploadAcc(CoopCompany $company, StoreAccountantRequest $request)
    {
        $request->validated();
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
            throw $th;
            return back()->with([
                'tab' => 'muhasebe_bilgileri',
                'fail' => 'Bir Hata ile Karşılaşıldı!'
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
            throw $th;
            return back()->with([
                'tab' => 'muhasebe_bilgileri',
                'fail' => 'Bir Hata ile Karşılaşıldı!'
            ]);
        }

        return back()->with([
            'tab' => 'muhasebe_bilgileri',
            'success' => 'Değişiklikleriniz başarıyla uygulanmıştır!'
        ]);
    }
}
