<div class="tab-pane fade show {{ session('tab') == 'isletme_calisanlar' ? 'active' : '' }}" id="isletme_calisanlar"
    role="tabpanel" aria-labelledby="ic-tab">
    <button class="btn btn-primary" data-toggle="modal" data-target="#addEmployee" data-whatever="@getbootstrap">Yeni
        Çalışan Ekle</button>
    <button class="btn btn-secondary" id="batchFileBtn" data-toggle="modal" data-target="#addBatchFile"
        data-whatever="@getbootstrap">Çalışanlara Dosya Ata</button>
    <div class="float-right">
        <form
            action="{{ route('download-file',['folder' => 'company-employee-lists', 'file_name' => 'employee-table.xlsx']) }}"
            method="post">
            @csrf
            <button class="btn btn-success ml-1">Örnek Excel Tablosu</button>
        </form>
    </div>
    <form class="my-3" method="POST" action="{{  route('store-excel',['company' => $company]) }}"
        enctype="multipart/form-data">
        @csrf
        Çalışan Listesi Yükle->
        <input type="file" class="btn btn-light btn-sm" name="employee-list" />
        <input type="submit" class="btn btn-primary" name="calisan_yukle" value="Yükle" />
    </form>
    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover" id="example">
            <thead class="thead-dark">
                <tr>
                    <th>Çalışan Adı Soyadı</th>
                    <th>T.C Kimlik No</th>
                    <th>Telefon No</th>
                    <th>E-mail</th>
                    <th>İşe Giriş Tarihi</th>
                    <th>Çalışan Detay</th>
                    <th>Sil</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>