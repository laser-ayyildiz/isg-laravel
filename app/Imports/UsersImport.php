<?php

namespace App\Imports;

use Throwable;
use Carbon\Carbon;
use App\Models\CoopEmployee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class UsersImport implements
    ToModel,
    WithHeadingRow,
    SkipsOnError,
    WithValidation,
    SkipsOnFailure,
    WithEvents
{
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;

    public $company_id;

    public function __construct($company_id)
    {
        $this->company_id = $company_id;
    }

    /**
     * @param array $row
     *
     * @return User|null
     */

    public function model(array $row)
    {
        return new CoopEmployee([
            'name' => $row['ad_soyad'],
            'tc' => $row["tc"],
            'phone' => $row['telefon'],
            'email' => $row["email"],
            'position' => $row['pozisyon'],
            'recruitment_date' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ise_giris_tarihi'])),
            'company_id' => $this->company_id
        ]);
    }

    public function rules(): array
    {
        return [
            '*.email' => ['email', 'unique:coop_employees,email'],
            '*.tc' => ['required','unique:coop_employees,tc']
        ];
    }

    public static function afterImport(AfterImport $event)
    {
    }

    public function onFailure(Failure ...$failure)
    {
    }
}
