<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Models\Equipment;
use App\Models\CoopCompany;
use App\Models\CoopEmployee;
use App\Models\CompanyToFile;
use App\Models\OutAccountant;
use App\Models\UserToCompany;
use Illuminate\Support\Carbon;
use App\Models\FrontAccountant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            abort(404);

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
            'company-admin.company.home.index',
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
            abort(404);

        $accountants['front'] = FrontAccountant::where('company_id', $id)->first();
        $accountants['out'] = OutAccountant::where('company_id', $id)->first();

        $employees['osgbEmployees'] = UserToCompany::select('user_id')->with('user')->whereHas('user', function ($query) {
            $query->whereBetween('job_id', [1, 7]);
        })->where('company_id', $id)->groupBy('user_id')->get();

        return (view(
            'company-admin.company.informations.index',
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
            abort(404);

        $deletedEmployees = [];

        $employees = CoopEmployee::where('company_id', $id)
            ->with('files')
            ->orderBy('name')
            ->withTrashed()
            ->get();

        return view(
            'company-admin.company.employees.index',
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
            abort(404);

        $files = CompanyToFile::with('file', 'type')->where('company_id', $id)->orderByDesc('assigned_at')->get();
        $mandatory_files = $files->whereBetween('file_type', [1, 8]);
        $defter_nushalari = $files->where('file_type', 9);
        $gozlem_raporlari = $files->where('file_type', 10);

        return view(
            'company-admin.company.documents.index',
            [
                'company' => $company,
                'mandatory_files' => $mandatory_files,
                'defter_nushalari' => $defter_nushalari,
                'gozlem_raporlari' => $gozlem_raporlari,
            ],
        );
    }
}
