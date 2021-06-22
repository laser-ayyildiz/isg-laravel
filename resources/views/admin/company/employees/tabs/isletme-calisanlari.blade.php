<div class="tab-pane fade show" id="isletme_calisanlar" role="tabpanel" aria-labelledby="ic-tab">
    <div class="mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addEmployee"
            data-whatever="@getbootstrap">Yeni
            Çalışan Ekle</button>
        <button class="btn btn-info ml-1" id="empListBtn" data-toggle="modal" data-target="#empList"
            data-whatever="@getbootstrap">Çalışan Listesi Yükle</button>

        <div class="float-right">
            @if ($employees->count() > 0)
            <button class="btn btn-secondary" id="batchFileBtn" data-toggle="modal" data-target="#addBatchFile"
                data-whatever="@getbootstrap">Toplu Eğitim Dosyası Atama</button>
            @endif
            <button class="btn btn-warning mx-1" data-toggle="modal" data-target="#addEmployerAcc"
                data-whatever="@getbootstrap">İşveren/vekili için hesap oluştur</button>
        </div>
    </div>
    <div class="float-right mb-2">
        <input class="form-control" type="text" id="searchBar" placeholder="Ara..." style="width: 255px">
    </div>
    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover" id="example">
            <thead class="thead-dark">
                <tr>
                    <th>Çalışan Adı Soyadı</th>
                    <th>T.C Kimlik No</th>
                    <th>Telefon No</th>
                    <th>E-mail</th>
                    <th>İşe Giriş Tarihi</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees->whereNull('deleted_at')->paginate(15) as $employee)
                <tr id="{{ $employee->id }}" style="cursor: pointer">
                    <td class="name">{{ $employee->name }}</td>
                    <td>{{ $employee->tc }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->recruitment_date }}</td>
                    <td class="text-center" width="5%"><button class="btn btn-danger" data-toggle="modal"
                            data-target="#deleteEmpModal" data-whatever="@getbootstrap">Sil</button>
                    </td>
                </tr>
                @empty
                <td colspan="6">
                    <h4 class="text-center">
                        <b>
                            Bu işletmeye henüz hiçbir çalışan eklenmedi!
                        </b>
                    </h4>
                </td>
                @endforelse
            </tbody>
        </table>
        <div class="float-right">{{ $employees->whereNull('deleted_at')->paginate(15)->links() }}</div>
    </div>
</div>