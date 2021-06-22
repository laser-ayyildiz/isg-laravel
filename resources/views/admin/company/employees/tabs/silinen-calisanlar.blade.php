<div class="tab-pane fade show" id="silinen_calisanlar" role="tabpanel" aria-labelledby="tr-tab">
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
                </tr>
            </thead>
            <tbody>
                @forelse ($employees->whereNotNull('deleted_at')->paginate(15) as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ $employee->tc }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->deleted_at }}</td>
                </tr>
                @empty
                <tr>
                    <td valign="top" colspan="7" class="dataTables_empty text-center">
                        Tabloda herhangi bir veri mevcut değil</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="float-right">{{ $employees->whereNotNull('deleted_at')->paginate(15)->links() }}</div>

</div>