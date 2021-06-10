<?php

namespace App\Http\Controllers\Common;

use App\Models\User;
use App\Models\CoopCompany;
use App\Http\Controllers\Controller;
use App\Models\UserToCompany;
use App\Notifications\CreateCompanyAdmin;
use GuzzleHttp\Psr7\Request;

class AssignCompanyAdminController extends Controller
{
    public function assign(CoopCompany $company, Request $request)
    {
        try {
            $this->createUser($company, $request->email);
        } catch (\Throwable $th) {
            return back()->with('fail', 'İşveren/vekili kayıt edilirken bir hata ile karşılaşıldı!');
        }
        return back()->with('success', 'İşveren/vekili hesabı oluşturuldu. Giriş bilgileri mail olarak gönderildi!');
    }

    public function createUser(CoopCompany $company, $email)
    {
        $password = $this->passGenerator();
        $email = null;
        $user = User::create([
            'recruitment_date' => date('Y-m-d'),
            'name' => $company->employer,
            'email' => $email,
            'password' => bcrypt($password)
        ])->syncRoles('CompanyAdmin');

        $this->createRelations($user, $company);

        $user->notify(new CreateCompanyAdmin($user, $password));
    }

    public static function createRelations($user, CoopCompany $company)
    {
        if ($company->is_group) {
            $members = CoopCompany::where('leader_company_id', $company->leader_company_id)->get('id');
            $relations = [];
            foreach ($members->toArray() as $member) {
                $relations[] = [
                    'user_id' => $user->id,
                    'company_id' => $member['id']
                ];
            }
            UserToCompany::insert($relations);
        }

        if (!$company->is_group) {
            UserToCompany::create(
                [
                    'user_id' => $user->id,
                    'company_id' => $company->id
                ]
            );
        }
    }


    public static function passGenerator()
    {
        $chars = "1234567890abcdefghijKLMNOPQRSTuvwxyzABCDEFGHIJklmnopqrstUVWXYZ0987654321+-/*-?=&%!";
        $password = '';
        for ($i = 0; $i < 16; $i++) {
            $password .= $chars[rand() % 72];
        }
        return $password;
    }
}
