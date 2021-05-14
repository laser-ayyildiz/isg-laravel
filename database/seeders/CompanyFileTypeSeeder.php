<?php

namespace Database\Seeders;

use App\Models\CompanyFileType;
use Illuminate\Database\Seeder;

class CompanyFileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyFileType::create([
            'file_name' => 'İş Yeri Uzman Sözleşmesi'
        ]);

        CompanyFileType::create([
            'file_name' => 'İş Yeri Hekim Sözleşmesi'
        ]);

        CompanyFileType::create([
            'file_name' => 'Acil Durum Eylem Planı'
        ]);

        CompanyFileType::create([
            'file_name' => 'Risk Analizi Dosyası'
        ]);

        CompanyFileType::create([
            'file_name' => 'Yıllık Çalışma Planı'
        ]);

        CompanyFileType::create([
            'file_name' => 'Dsp Sözleşmesi'
        ]);

        CompanyFileType::create([
            'file_name' => 'Yıl Sonu Değerlendirme Raporu'
        ]);
    }
}
