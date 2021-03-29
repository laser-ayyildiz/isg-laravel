<?php

namespace App\Http\Controllers;

use Illumi8nate\Http\Request;
use App\Models\CoopCompanies;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Hashids\Hashids;

class CompanyController extends Controller
{
    public function index($id)
    {
        $hash = new Hashids();
        $id = $hash->decode($id, 15, 298, 177)[0];

        $company = CoopCompanies::where('id', $id)->first();

        return (view(
            'admin.company',
            ['company' => $company]
        ));
    }

    public function deleteRequest($id)
    {
        $hash = new Hashids();
        $id = $hash->decode($id, 15, 298, 177)[0];

        CoopCompanies::where('id', $id)
            ->update(
                [
                    'change' => '2'
                ]
            );
        return redirect()->back()->with('deleteStatus', 'Silme talebiniz yöneticinize iletilmiştir. Lütfen onaylanmasını bekleyiniz!');
    }
}
