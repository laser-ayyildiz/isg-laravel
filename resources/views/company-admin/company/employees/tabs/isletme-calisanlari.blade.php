<div class="tab-pane fade show" id="isletme_calisanlar" role="tabpanel" aria-labelledby="ic-tab">
    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover" id="example">
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
                    <th>Özlük Dosyası</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($employees->whereNull('deleted_at')->paginate(15) as $key=>$employee)
                <tr id="{{ $employee->id }}" style="cursor: pointer">
                    <td>{{ $key+1 }}</td>
                    <td class="name">{{ $employee->name }}</td>
                    <td>{{ $employee->tc }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->recruitment_date }}</td>
                    <td colspan="1">
                        <span>
                            <i class="{{ $employee->first_edu ? 'fas fa-check mx-3' : 'fas fa-times mx-3' }}"
                                style="{{ $employee->first_edu ? 'color: green' : 'color: red' }}"></i>
                        </span></td>
                    <td colspan="1"><span>
                            <i class="{{ $employee->second_edu ? 'fas fa-check mx-3' : 'fas fa-times mx-3' }}"
                                style="{{ $employee->second_edu ? 'color: green' : 'color: red' }}"></i>
                        </span></td>
                    <td colspan="1"><span>
                            <i class="{{ $employee->examination ? 'fas fa-check mx-3' : 'fas fa-times mx-3' }}"
                                style="{{ $employee->examination ? 'color: green' : 'color: red' }}"></i>
                        </span></td>
                    <td class="table-warning"><button class="btn btn-sm btn-warning" data-toggle="modal"
                            data-target="#addEmpIdentifyFile" data-whatever="@getbootstrap"><i
                                class="fas fa-folder-plus"></i></button>
                    </td>
                </tr>
                @empty
                <td colspan="9">
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
