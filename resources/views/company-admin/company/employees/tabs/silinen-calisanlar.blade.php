<div class="tab-pane fade show" id="silinen_calisanlar" role="tabpanel" aria-labelledby="tr-tab">
    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover" id="deletedEmpTable">
            <thead class="thead-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Çalışan Adı Soyadı</th>
                    <th>Pozisyonu</th>
                    <th>T.C.</th>
                    <th>Telefon</th>
                    <th>Pozisyon</th>
                    <th>Çıkış Tarihi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($employees->whereNotNull('deleted_at')->paginate(15) as $key=>$employee)
                <tr id="{{ $employee->id }}" style="cursor: pointer">
                    <td>{{ $key+1 }}</td>
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
