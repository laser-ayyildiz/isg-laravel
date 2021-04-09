<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CoopCompany;
use Illuminate\Http\Request;
use App\Models\UserToCompany;
use App\Models\DeletedCompany;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    public function index($id)
    {
        $company = CoopCompany::where('id', $id)->first();

        $employees = UserToCompany::whereHas('user', function ($query) {
            return $query->whereBetween('auth_type', [1, 6])
                ->orWhere('auth_type', 9);
        })->where('company_id', $id)->get();
        $types = [
            'İSG Uzmanı',
            'İş Yeri Hekimi',
            'Sağlık Personeli',
            'Ofis Personeli',
            'Muhasebeci'
        ];

        $osgbEmployees = null;
        $coopEmployees = null;
        $selectExperts = null;

        foreach ($employees as $employee) {
            $auth_type = $employee->user->auth_type;
            if ($auth_type == 9) {
                $coopEmployees[] = $employee;
            }
            if (isset($types[$auth_type])) {
                $osgbEmployees[] = $employee->user->name . " - " . $types[$auth_type];
            }
        }
        $selectExperts = null;
        for ($i = 1; $i < 6; $i++) {
            $selectExperts[] = User::where('auth_type', $i)->get();
        }

        return (view(
            'admin.company',
            [
                'company' => $company,
                'osgbEmployees' => $osgbEmployees,
                'coopEmployees' => $coopEmployees,
                'selectExperts' => $selectExperts,
                'deleted' => false
            ],
        ));
    }

    public function deletedIndex($id)
    {
        $company = DeletedCompany::where('id', $id)->first();
        $osgbEmployees = null;
        $coopEmployees = null;
        $selectExperts = null;

        return (view(
            'admin.company',
            [
                'company' => $company,
                'osgbEmployees' => $osgbEmployees,
                'coopEmployees' => $coopEmployees,
                'selectExperts' => $selectExperts,
                'deleted' => true
            ],

        ));
    }

    public function handle(Request $request)
    {
        $id = $request->input('companyId');
        if ($request->has('deleteRequest')) {
            $this->deleteRequest($id);
            return redirect()->route('admin.companies.index')->with('status', 'Silme talebiniz yöneticinize iletilmiştir!');
        } else if ($request->has('changeRequest')) {
            $this->changeRequest($request, $id);
            return redirect()->route('admin.companies.index')->with('status', 'Yaptığınız değişiklikler yöneticinize iletilmiştir. Lütfen onaylanana kadar bekleyiniz!');
        }
    }

    private function changeRequest(Request $request, $id)
    {

        CoopCompany::create([
            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
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
            'change' => 1,
            'changer' => Auth::user()->id,
            'change_from' => $id
        ]);
    }

    private function deleteRequest($id)
    {
        CoopCompany::where('id', $id)
            ->update(
                [
                    'change' => '2'
                ]
            );
    }
}
