<div class="card-body">
    <button class="btn btn-primary" data-toggle="modal" data-target="#addCompany" data-whatever="@getbootstrap">Yeni
        İşletme Ekle</button>
    @if (auth()->user()->hasRole('Admin'))
    <button type="button" onclick="window.location.href='{{ route('admin.change_validate') }}'"
        class="btn btn-success ml-1">Onay Bekleyenler</button>

    <button type="button" onclick="window.location.href='{{ route('admin.deleted_companies') }}'"
        class="btn btn-danger ml-1">Arşiv</button>
    @endif

    <div class="table table-responsive mt-2">
        <table class="table table-striped table-bordered table-hover data-table" id="example">
            <thead class="thead-dark">
                <tr>
                    <th>İşletme Adı</th>
                    <th>Şube</th>
                    <th>Sektör</th>
                    <th>E-mail</th>
                    <th>Şehir</th>
                    <th>İlçe</th>
                    <th>Anlaşma Tarihi</th>
                </tr>
            </thead>
            <tbody style="cursor: pointer">
            </tbody>
        </table>
    </div>
</div>
