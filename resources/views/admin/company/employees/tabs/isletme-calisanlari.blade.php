<div class="tab-pane fade show" id="isletme_calisanlar" role="tabpanel" aria-labelledby="ic-tab">
    <div class="float-sm-left mb-3">
        <button class="btn btn-primary m-1" data-toggle="modal" data-target="#addEmployee"
            data-whatever="@getbootstrap">Yeni
            Çalışan Ekle</button>
        <button class="btn btn-info m-1" id="empListBtn" data-toggle="modal" data-target="#empList"
            data-whatever="@getbootstrap">Çalışan Listesi Yükle</button>
    </div>
    <div class="float-sm-right mb-3">
        <button class="btn btn-secondary m-1 d-none" id="batchFileBtn" data-toggle="modal" data-target="#addBatchFile"
            data-whatever="@getbootstrap">Toplu Eğitim Dosyası Atama</button>

        <button class="btn btn-warning m-1" data-toggle="modal" data-target="#addEmployerAcc"
            data-whatever="@getbootstrap">İşveren/vekili için hesap oluştur</button>
    </div>
    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover data-table" id="allEmps">
            <thead class="thead-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Adı Soyadı</th>
                    <th>T.C.</th>
                    <th>Telefon</th>
                    <th>Giriş Tarihi</th>
                    <th scope="col" colspan="1">İSG Eğitimi 1</th>
                    <th scope="col" colspan="1">İSG Eğitimi 2</th>
                    <th>Sağlık Muayenesi</th>
                    <th>İşten Çıkart</th>
                    <th>Dosya Ekle</th>
                    <th>Özlük Dosyası</th>
                </tr>
            </thead>
            <tbody style="cursor: pointer">
            </tbody>
        </table>
    </div>
    <div class="float-sm-left">
        <form action="{{ route('export-coop-employees',['company' => $company]) }}" method="post">
            @csrf
            <button class="btn btn-warning m-1">Çalışan Excel Tablosu Oluştur</button>
        </form>
    </div>
</div>