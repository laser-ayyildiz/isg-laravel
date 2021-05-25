<div class="card-body">
    <button class="btn btn-primary" data-toggle="modal" data-target="#addCompany" data-whatever="@getbootstrap">Yeni
        İşletme Ekle</a>

        <button type="button" onclick="window.location.href='{{ route('admin.change_validate') }}'"
            class="btn btn-success ml-1">Onay Bekleyenler</button>

        <button type="button" onclick="window.location.href='{{ route('admin.deleted_companies') }}'"
            class="btn btn-danger ml-1">Arşiv</button>

        <div class="table table-responsive mt-2">
            <table class="table table-striped table-bordered table-hover data-table" id="example">
                <thead class="thead-dark">
                    <tr>
                        <th>İşletme Adı</a></th>
                        <th>Sektör</th>
                        <th>Telefon</th>
                        <th>E-mail</th>
                        <th>Şehir</th>
                        <th>İlçe</th>
                        <th>Anlaşma Tarihi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
</div>