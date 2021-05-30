<?php

namespace App\Http\Controllers\Admin;

use App\Models\CoopCompany;
use Illuminate\Http\Request;
use App\Models\DeleteRequest;
use App\Models\UpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChangeValidateController extends Controller
{
    public function index()
    {
        $deletes = DeleteRequest::with('company', 'user')->get();
        $updates = UpdateRequest::with('company', 'user')->get();

        $demands = $deletes->merge($updates);
        $demands = $demands->sortBy('created_at')->paginate(10);

        return view(
            'admin.change_validate',
            ['demands' => $demands]
        );
    }

    public function update(UpdateRequest $demand, Request $request)
    {
        if ($request->has("rejectUpdate")) {
            try {
                UpdateRequest::where('id', $demand->id)->delete();
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail', 'İsteğiniz işlenirken bir hatayla karşıldı!');
            }
            return redirect()->back()->with('success', 'Değişiklik talebi başarıyla kaldırıldı!');
        }

        if ($request->has("acceptUpdate")) {
            $updateDemand = array_filter($demand->toArray());

            $company = $demand->company->toArray();

            $updatedData = array_diff_assoc($updateDemand, $company);

            unset($updatedData["company"], $updatedData["id"], $updatedData["user_id"], $updatedData["company_id"], $updatedData["created_at"], $updatedData["updated_at"]);

            try {
                UpdateRequest::where('id', $demand->id)->delete();
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail', 'İsteğiniz işlenirken bir hatayla karşıldı!');
            }

            try {
                CoopCompany::where('id', $company["id"])->update($updatedData);
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect()->back()->with('fail', 'Değişiklikler uygulanırken bir hatayla karşılaşıldı!');
            }
            return redirect()->back()->with('success', 'Değişiklikler başarıyla uygulandı!');
        }

        return redirect()->back()->with('warning', 'Üzgünüz ama İsteğinizi anlayamadık :(');
    }

    public function delete(DeleteRequest $demand, Request $request)
    {
        if ($request->has("rejectDelete")) {
            try {
                DB::table('delete_requests')->where('company_id', $demand->company->id)->delete();
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail', 'Talep kaldırılırken bir hatayla karşılaşıldı!');
            }
            return redirect()->back()->with('success', 'Silme talebi başarıyla kaldırıldı!');
        }
        if ($request->has("acceptDelete")) {
            try {
                DB::table('delete_requests')->where('company_id', $demand->company->id)->delete();
                DB::table('update_requests')->where('company_id', $demand->company->id)->delete();
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail', 'İşletme silinirken bir hatayla karşılaşıldı!');
            }
            try {
                CoopCompany::where('id', $demand->company->id)->delete();
            } catch (\Throwable $th) {
                return redirect()->back()->with('fail', 'İşletme silinirken bir hatayla karşılaşıldı!');
            }
            return redirect()->back()->with('success', 'İşletme başarıyla silindi. Silinen işletmelere ARŞİV bölümünden ulaşabilirsiniz!');
        }

        return redirect()->back()->with('warning', 'Üzgünüz ama İsteğinizi anlayamadık :(');
    }
}
