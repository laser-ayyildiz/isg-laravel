<?php

namespace App\Exports;

use App\Models\CoopEmployee;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CoopEmployeesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    private $company_id;

    public function __construct($company_id)
    {
        $this->company_id = $company_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return
            CoopEmployee::where('company_id', $this->company_id)
            ->with('files')
            ->select('name', 'tc', 'phone', 'email', 'position', 'recruitment_date', 'first_edu', 'second_edu', 'examination')
            ->orderBy('name')
            ->get();
    }

    public function prepareRows($rows): array
    {
        return array_map(function ($employee) {

            $employee->first_edu = $employee->first_edu ? 'VAR' : 'YOK';
            $employee->second_edu = $employee->second_edu ? 'VAR' : 'YOK';
            $employee->examination = $employee->examination ? 'VAR' : 'YOK';

            return $employee;
        }, $rows);
    }

    public function headings(): array
    {
        return ["Ad Soyad", "T.C. Kimlik No", "Telefon", "Email", "Görev", "İşe Giriş Tarihi", "İSG Eğitimi 1", "İSG Eğitimi 2", "Sağlık Muayenesi"];
    }
}
