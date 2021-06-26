<?php

namespace Database\Seeders;

use App\Models\EmployeeEducationTypes;
use Illuminate\Database\Seeder;

class EmployeeEducationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmployeeEducationTypes::insert(
            [
                [
                    'name' => 'İSG Eğitimi 1',
                    'validity_period_type_1' => 36,
                    'validity_period_type_2' => 24,
                    'validity_period_type_3' => 12,
                ],
                [
                    'name' => 'iSG Eğitimi 2',
                    'validity_period_type_1' => 36,
                    'validity_period_type_2' => 24,
                    'validity_period_type_3' => 12,
                ],
                [
                    'name' => 'Sağlık Muayenesi',
                    'validity_period_type_1' => 60,
                    'validity_period_type_2' => 36,
                    'validity_period_type_3' => 12,
                ],
                [
                    'name' => 'İlk Yardım Sertifikası',
                    'validity_period_type_1' => null,
                    'validity_period_type_2' => null,
                    'validity_period_type_3' => null,
                ],
                [
                    'name' => 'Yangın Eğitim Sertifikası',
                    'validity_period_type_1' => null,
                    'validity_period_type_2' => null,
                    'validity_period_type_3' => null,
                ],
                [
                    'name' => 'Mesleki Yeterlilik Sertifikası',
                    'validity_period_type_1' => null,
                    'validity_period_type_2' => null,
                    'validity_period_type_3' => null,
                ],
                [
                    'name' => 'Hijyen Eğitim Sertifikası',
                    'validity_period_type_1' => null,
                    'validity_period_type_2' => null,
                    'validity_period_type_3' => null,
                ],
                [
                    'name' => 'Acil Durum Ekip Eğitimi',
                    'validity_period_type_1' => null,
                    'validity_period_type_2' => null,
                    'validity_period_type_3' => null,
                ],
                [
                    'name' => 'Yüksekte Çalışma Eğitimi',
                    'validity_period_type_1' => null,
                    'validity_period_type_2' => null,
                    'validity_period_type_3' => null,
                ],
                [
                    'name' => 'Özlük Dosyası Evrakları',
                    'validity_period_type_1' => null,
                    'validity_period_type_2' => null,
                    'validity_period_type_3' => null,
                ],
            ]
        );
    }
}
