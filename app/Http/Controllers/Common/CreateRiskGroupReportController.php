<?php

namespace App\Http\Controllers\Common;

use App\Models\File;
use App\Models\CoopCompany;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CompanyToFile;
use App\Models\EmployeeGroup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use PhpOffice\PhpWord\TemplateProcessor;

class CreateRiskGroupReportController extends Controller
{
    const RISK_GROUP_TEXT = "6331 sayılı İŞ SAĞLIĞI VE GÜVENLİĞİ KANUNU Resmi Gazete Tarihi: 30.06.2012 Sayısı: 28339 ile İŞ SAĞLIĞI VE GÜVENLİĞİ RİSK DEĞERLENDİRMESİ YÖNETMELİĞİ Resmi Gazete Tarihi:29.12.2012 Resmi Gazete Sayısı: 28512 Madde 6 ya göre Risk değerlendirmesi, işverenin oluşturduğu bir ekip tarafından gerçekleştirilir. Buna dayanarak Risk değerlendirmesi ekibine görevleriniz doğrultusunda altta yer alan şekliyle atanmış bulunmaktasınız.";

    public function create(CoopCompany $company, Request $request)
    {
        try {
            $templateProcessor = new TemplateProcessor(storage_path('app') . '/templates/risk-group.docx');
            $datas = [
                'company' => $company->name,
                'text' => $request->report_text ?? self::RISK_GROUP_TEXT,
                'published_at' => $request->published_at ?? date('d-m-Y'),
                'uzman' => $this->getExpert($company->id),
                'hekim' => $this->getDoctor($company->id),
                'isveren' => $this->getEmployeer($company->id),
                'destek_elemani' => $this->getSupporter($company->id),
                'calisan_temsilcisi' => $this->getRepresentative($company->id),
            ];
            foreach ($datas as $key => $value) {
                if ($value === null)
                    return back()->with('fail', 'Bütün atamaları yaptığınızdan emin olunuz!');
                $templateProcessor->setValue($key, $value);
            }
        } catch (\Throwable $th) {
            return back()->with('fail', 'Raporunuz oluştulurken bir hata ile karşılaşıldı!');
        }

        DB::beginTransaction();
        try {
            $fileName = Str::of($company->name)->limit(150)  .  '_RiskDegerlendirmeRaporu_' . date('Y-m-d_His') . '.docx';
            $templateProcessor->saveAs(storage_path('app') . '/public/uploads/assignment-files/' . $fileName);

            $fileModel = new File;
            $fileModel->name = $fileName;
            $fileModel->file_path = '/storage/app/public/uploads/assignment-files/' . $fileModel->name;
            $fileModel->save();

            CompanyToFile::create([
                'file_type' => 11,
                'company_id' => $company->id,
                'file_id' => $fileModel->id,
                'assigned_at' => $request->published_at ?? date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
            return back()->with('fail', 'Dosya indirilirken bir hata ile karşılaşıldı');
        }

        DB::commit();
        return back()->with('success', 'Raporunuz başarıyla oluşturuldu!');
    }

    private function getEmployeer($company_id)
    {
        $isveren = EmployeeGroup::where('company_id', $company_id)
            ->whereNotNull('isveren')
            ->where('group', 'İşveren')
            ->get();

        return $isveren->last()->isveren ?? null;
    }

    private function getDoctor($company_id)
    {
        $doctor = EmployeeGroup::where(['company_id' => $company_id, 'group' => 'İSG Görevlendirmesi'])
            ->with('osgbEmployee')
            ->whereHas('osgbEmployee', function ($query) {
                $query->where('job_id', 4);
            })
            ->get();

        return $doctor->last()
            ->osgbEmployee
            ->name ?? null;
    }

    private function getExpert($company_id)
    {
        $expert = EmployeeGroup::where(['company_id' => $company_id, 'group' => 'İSG Görevlendirmesi'])
            ->with('osgbEmployee')
            ->whereHas('osgbEmployee', function ($query) {
                $query->where('job_id', 1);
            })
            ->get();

        return $expert->last()
            ->osgbEmployee
            ->name ?? null;
    }

    private function getSupporter($company_id)
    {
        $supporter = EmployeeGroup::where(['company_id' => $company_id, 'group' => 'Risk Değerlendirme Ekibi', 'sub_group' => 'Destek Elemanı'])
            ->with('employee')
            ->get();

        return $supporter->first()
            ->employee
            ->name ?? null;
    }

    private function getRepresentative($company_id)
    {
        $representative = EmployeeGroup::where(['company_id' => $company_id, 'group' => 'Çalışan Temsilcisi'])
            ->with('employee')
            ->get();

        return $representative->first()
            ->employee
            ->name ?? null;
    }
}
