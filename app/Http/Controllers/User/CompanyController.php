<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\CoopCompany;
use Illuminate\Http\Request;
use App\Models\UserToCompany;
use App\Models\DeletedCompany;
use App\Http\Controllers\Controller;
use App\Models\DeleteRequest;
use App\Models\UpdateRequest;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index($id)
    {
        $relation = UserToCompany::where('company_id', $id)->where('user_id', Auth::id())->count();
        if ($relation < 1) {
            abort(401);
        }

        $company = CoopCompany::where('id', $id)->first();

        $employees['osgbEmployees'] = UserToCompany::whereHas('user', function ($query) {
            $query->whereBetween('job_id', [1, 7]);
        })->where('company_id', $id)->get();

        $employees['coopEmployees'] = UserToCompany::whereHas('user', function ($query) {
            $query->where('job_id', 8);
        })->where('company_id', $id)->get();

        return (view(
            'user.company',
            [
                'company' => $company,
                'employees' => $employees,
                'deleted' => false
            ],
        ));
    }

    public function deletedIndex($id)
    {
        $company = CoopCompany::onlyTrashed()->where('id', $id)->first();
        $employees = null;

        return (view(
            'user.company',
            [
                'company' => $company,
                'osgbEmployees' => $employees,
                'deleted' => true
            ],
        ));
    }

    public function updateRequest(CoopCompany $company, User $user, Request $request)
    {
        $istekler = [
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
        ];

        $changedData = array_diff_assoc($istekler, $company->getAttributes());
        if (empty($changedData)) {
            return redirect()->route('user.company', ['id' => $company->id])->with('updateRequestFail', 'Hiçbir değişiklik yapmadığınızı fark ettik lütfen tekrar deneyiniz!');
        }
        $changedData['user_id'] = $user->id;
        $changedData['company_id'] = $company->id;

        try {
            UpdateRequest::create($changedData);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('user.company', ['id' => $company->id])->with('updateRequestFail', 'Talebiniz iletilirken bir sorunla karşılaşıldı!');
        }

        return redirect()->route('user.company', ['id' => $company->id])->with('updateRequestSuccess', 'Değişiklik talebiniz yöneticinize iletilmiştir!');
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
            return redirect()->route('user.company', ['id' => $company->id])->with('deleteRequestFail', 'Talebiniz iletilirken bir sorunla karşılaşıldı!');
        }

        return redirect()->route('user.company', ['id' => $company->id])->with('deleteRequestSuccess', 'Silme talebiniz yöneticinize iletilmiştir!');
    }
}
