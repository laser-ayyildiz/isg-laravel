<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Hashids\Hashids;
use App\Models\CoopCompany;
use App\Models\DeletedCompany;
use Illuminate\Http\Request;

class ChangeValidateController extends Controller
{
    public function index()
    {
        $companies =
            CoopCompany::where('change', 1)
            ->orWhere('change', 2)
            ->orderBy('updated_at', "DESC")
            ->paginate(15);

        return view(
            'admin.change_validate',
            [
                'companies' => $companies
            ]
        );
    }

    public function deleteRequest(Request $request)
    {
        $hash = new Hashids();
        $id = $hash->decode($request->input('id'), 15, 298, 177)[0];
        if ($request->has('rejectDelete')) {
            CoopCompany::where('id', $id)
                ->update(
                    [
                        'change' => '0'
                    ]
                );
            return redirect()->back()->with('deleteStatus', 'Silme talebi reddedildi!');
        } else if ($request->has('acceptDelete')) {
            $willDelete = CoopCompany::find($id);
            DeletedCompany::create([
                'name' => $willDelete->name,
                'type' => $willDelete->type,
                'employer' => $willDelete->name,
                'email' => $willDelete->email,
                'phone' => $willDelete->phone,
                'address' => $willDelete->address,
                'city' => $willDelete->city,
                'town' => $willDelete->town,
                'nace_kodu' => $willDelete->nace_kodu,
                'mersis_no' => $willDelete->mersis_no,
                'sgk_sicil' => $willDelete->sgk_sicil,
                'vergi_no' => $willDelete->vergi_no,
                'vergi_dairesi' => $willDelete->vergi_dairesi,
                'katip_is_yeri_id' => $willDelete->katip_is_yeri_id,
                'katip_kurum_id' => $willDelete->katip_kurum_id,
                'contract_at' => $willDelete->contract_at
            ]);
            $willDelete->delete();
            return redirect()->back()->with('deleteStatus', 'İşletme Silindi! İşletmeye ait bilgilere arşiv bölümünden ulaşabilirsiniz');
        } else
            return redirect()->back()->with('Bir hata ile karşılaşıldı. Tekrar Deneyiniz!');
    }
}
