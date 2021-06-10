<div class="tab-pane fade show" id="silinen_calisanlar"
    role="tabpanel" aria-labelledby="tr-tab">
    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover" id="dataTable">
            <thead class="thead-dark">
                <tr>
                    <th>Çalışan Adı Soyadı</th>
                    <th>Pozisyonu</th>
                    <th>T.C Kimlik No</th>
                    <th>Telefon No</th>
                    <th>E-mail</th>
                    <th>İşten Çıkış Tarihi</th>
                    <th>Geri Al</th>
                </tr>
            </thead>
            <tbody>
                @isset($deletedEmployees)
                @forelse ($deletedEmployees as $employee )
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @empty
                <tr>
                    <td valign="top" colspan="7" class="dataTables_empty text-center">Tabloda herhangi bir veri mevcut değil</td>
                </tr>
                @endforelse
                @endisset
            </tbody>
        </table>
    </div>
</div>