<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\CoopCompany;
use Illuminate\Http\Request;
use App\Models\UserToCompany;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\CreateCompanyAdmin;

class AssignCompanyAdminController extends Controller
{
    public function index()
    {
        $companyAdmins = UserToCompany::with('user','company')->whereHas('user', function ($query) {
            return $query->with('roles')->whereHas("roles", function ($user) {
                $user->where("name", "CompanyAdmin");
            });
        })->get();

        return view("admin.assigned-company-admins", ["companyAdmins" => $companyAdmins]);
    }

    public function assign(CoopCompany $company, Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email|unique:users,email',
                'name' => 'required|string|max:255',
                'phone' => 'nullable|numeric|digits:11',
                'tc' => 'nullable|numeric|digits:11'
            ],
            [],
            [
                'email' => 'Email',
                'name' => 'Ad Soyad',
                'phone' => 'Telefon No',
                'tc' => 'T.C. Kimlik No'
            ]
        );

        if ($request->company == "-1")
            return back()->with('fail', 'İşletme seçmediniz!');

        DB::beginTransaction();
        try {
            $this->createUser($company, $request);
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('fail', 'İşveren/vekili kayıt edilirken bir hata ile karşılaşıldı!');
        }
        DB::commit();
        return back()->with('success', 'İşveren/vekili hesabı oluşturuldu. Giriş bilgileri mail olarak gönderildi!');
    }

    public function createUser(CoopCompany $company, $request)
    {
        $password = $this->passGenerator();
        $user = User::create([
            'recruitment_date' => date('Y-m-d'),
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($password)
        ])->syncRoles('CompanyAdmin');

        $this->createRelations($user, $company);

        $user->notify(new CreateCompanyAdmin($user, $password));
    }

    public static function createRelations($user, CoopCompany $company)
    {
        if ($company->is_group == 1) {
            if ($company->group_status == "leader") {
                $members = CoopCompany::where('leader_company_id', $company->id)->get('id');
                $relations = [];
                foreach ($members->toArray() as $member) {
                    $relations[] = [
                        'user_id' => $user->id,
                        'company_id' => $member['id']
                    ];
                }
                $relations[] = [
                    'user_id' => $user->id,
                    'company_id' => $company->id
                ];
                UserToCompany::insert($relations);
            }

            if ($company->group_status == "member") {
                UserToCompany::create(
                    [
                        'user_id' => $user->id,
                        'company_id' => $company->id
                    ]
                );
            }
        }

        if ($company->is_group == 0) {
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
