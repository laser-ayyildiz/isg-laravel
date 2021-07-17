<div class="tab-pane fade show" id="grup_bilgileri" role="tabpanel" aria-labelledby="grb-tab">
    <button class="float-md-left btn btn-primary mb-2" data-toggle="modal" data-target="#changeGroup"
    id="changeGroupBtn" data-whatever="@getbootstrap">Grup Bilgilerini Değiştir</button>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped" id="groups">
            <thead class="thead-dark">
                <th>İşletme</th>
                <th>Şube</th>
                <th>İşletme Statüsü</th>
            </thead>
            <tbody>
                @forelse ($groupCompanies as $company)
                <tr id="{{ $company->id }}" style="cursor: pointer;">
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->sube_kodu }}</td>
                    <td class="text-primary {{ $company->group_status == 'member' ? 'table-warning' : 'table-success' }}">{{ $company->group_status == 'member' ? 'Üye' : 'Lider' }}</td>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="3">
                        Bu işletme bir grup şirketi değil...
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
