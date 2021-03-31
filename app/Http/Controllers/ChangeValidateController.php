<?php

namespace App\Http\Controllers;

use Hashids\Hashids;
use Illuminate\Http\Request;
use App\Models\CoopCompanies;

class ChangeValidateController extends Controller
{
    public function index()
    {
        $companies =
            CoopCompanies::whereColumn([['change_from', '=', 'id']])
            ->orderBy('updated_at', "DESC")
            ->paginate(15);
        //->get();
        //$companies->query() = json_encode($companies);
        dd($companies);
        //$changedCompanies = CoopCompanies::where('')
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
            return redirect()->back()->with('Bir hata ile karşılaşıldı. Tekrar Deneyiniz!');
    }
}
