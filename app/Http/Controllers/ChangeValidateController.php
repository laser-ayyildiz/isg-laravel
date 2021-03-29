<?php

namespace App\Http\Controllers;

use Hashids\Hashids;
use Illuminate\Http\Request;
use App\Models\CoopCompanies;

class ChangeValidateController extends Controller
{
    public function index()
    {
        $companies = CoopCompanies::where('change', 1)->orWhere('change', 2)->orderBy('updated_at')->paginate(15);
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
            CoopCompanies::where('id', $id)
                ->update(
                    [
                        'change' => '0'
                    ]
                );
            return redirect()->back()->with('deleteStatus', 'Silme talebi reddedildi!');
        } else if ($request->has('acceptDelete')) {
            CoopCompanies::where('id', $id)
                ->update(
                    [
                        'change' => '0',
                        'deleted' => '1'
                    ]
                );
            return redirect()->back()->with('deleteStatus', 'İşletme Silindi! İşletmeye ait bilgilere arşiv bölümünden ulaşabilirsiniz');
        } else
            return redirect()->back()->with('Hata');
    }
}
