<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use Hashids\Hashids;
use App\Models\CoopCompany;
use Illuminate\Http\Request;
use App\Models\UserToCompany;
use App\Models\DeletedCompany;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    private static function decryptedId($crypted)
    {
        try {
            $hash = new Hashids();
            $id = $hash->decode($crypted, 15, 298, 177)[0];
            return $id;
        } catch (Exception $e) {
            abort(404);
        }
    }

    public function index($crypted)
    {
        $id = CompanyController::decryptedId($crypted);
        $company = CoopCompany::where('id', $id)->first();

        $experts = UserToCompany::whereHas('user', function ($query) {
            return $query->where('auth_type', 1);
        })->where('company_id', $id)->get();

        return (view(
            'admin.company',
            ['company' => $company],
            ['experts' => $experts],

        ));
    }

    public function deletedIndex($crypted)
    {
        $id = CompanyController::decryptedId($crypted);
        $company = DeletedCompany::where('id', $id)->first();

        return (view(
            'admin.company',
            ['company' => $company]
        ));
    }

    public function handle(Request $request)
    {

        $crypted = $request->input('companyId');
        $id = CompanyController::decryptedId($crypted);
        if ($request->has('deleteRequest')) {
            $this->deleteRequest($id);
            return redirect()->route('companies')->with('status', 'Silme talebiniz yöneticinize iletilmiştir!');
        } else if ($request->has('changeRequest')) {
            $this->changeRequest($request, $id);
            return redirect()->route('companies')->with('status', 'Yaptığınız değişiklikler yöneticinize iletilmiştir. Lütfen onaylanana kadar bekleyiniz!');
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