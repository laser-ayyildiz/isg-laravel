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
            'file_name' => 'İş Yeri Uzman Sözleşmesi',
            'validity_period_type_1' => null,
            'validity_period_type_2' => null,
            'validity_period_type_3' => null,
        ]);

        CompanyFileType::create([
            'file_name' => 'İş Yeri Hekim Sözleşmesi',
            'validity_period_type_1' => null,
            'validity_period_type_2' => null,
            'validity_period_type_3' => null,
        ]);

        CompanyFileType::create([
            'file_name' => 'Acil Durum Eylem Planı',
            'validity_period_type_1' => 72,
            'validity_period_type_2' => 48,
            'validity_period_type_3' => 24,
        ]);

        CompanyFileType::create([
            'file_name' => 'Risk Analizi Dosyası',
            'validity_period_type_1' => 72,
            'validity_period_type_2' => 48,
            'validity_period_type_3' => 24,
        ]);

        CompanyFileType::create([
            'file_name' => 'Yıllık Çalışma Planı',
            'validity_period_type_1' => 12,
            'validity_period_type_2' => 12,
            'validity_period_type_3' => 12,

        ]);

        CompanyFileType::create([
            'file_name' => 'Yıllık Eğitim Programı',
            'validity_period_type_1' => 12,
            'validity_period_type_2' => 12,
            'validity_period_type_3' => 12,
        ]);

        CompanyFileType::create([
            'file_name' => 'Dsp Sözleşmesi',
            'validity_period_type_1' => null,
            'validity_period_type_2' => null,
            'validity_period_type_3' => null,
        ]);

        CompanyFileType::create([
            'file_name' => 'Yıl Sonu Değerlendirme Raporu',
            'validity_period_type_1' => 12,
            'validity_period_type_2' => 12,
            'validity_period_type_3' => 12,
        ]);

        CompanyFileType::create([
            'file_name' => 'Defter Nüshası',
            'validity_period_type_1' => 1,
            'validity_period_type_2' => 1,
            'validity_period_type_3' => 1,
        ]);

        CompanyFileType::create([
            'file_name' => 'Saha Gözlem Raporu',
            'validity_period_type_1' => 1,
            'validity_period_type_2' => 1,
            'validity_period_type_3' => 1,
        ]);

        CompanyFileType::create([
            'file_name' => 'Risk Değerlendirme Ekibi Dosyası',
            'validity_period_type_1' => null,
            'validity_period_type_2' => null,
            'validity_period_type_3' => null,
        ]);
    }
}
