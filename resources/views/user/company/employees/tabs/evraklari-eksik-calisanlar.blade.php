<div class="tab-pane fade show" id="evraklari_eksik_calisanlar" role="tabpanel" aria-labelledby="eec-tab">
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
                    <th>İşten Çıkart</th>
                    <th>Dosya Ekle</th>
                    <th>Özlük Dosyası</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($employees->whereNull('deleted_at')->filter(function ($item) {
                return $item->first_edu == 0 || $item->second_edu == 0 || $item->examination == 0;
                })->paginate(15) as $key=>$employee)
                <tr id="{{ $employee->id }}" style="cursor: pointer">
                    <td>{{ $key+1 }}</td>
                    <td class="name">{{ $employee->name }}</td>
                    <td>{{ $employee->tc }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->recruitment_date }}</td>
                    @php
                    if ($employee->files->where('file_type', 1)->last() !== null) {
                    $date = new DateTime($employee->files->where('file_type', 1)->last()->valid_date);
                    $valid_date_1 = $date->modify('-1 month')->format('Y-m-d') > date("Y-m-d");
                    }
                    if ($employee->files->where('file_type', 2)->last() !== null) {
                    $date = new DateTime($employee->files->where('file_type', 2)->last()->valid_date);
                    $valid_date_2 = $date->modify('-1 month')->format('Y-m-d') > date("Y-m-d");
                    }
                    if ($employee->files->where('file_type', 3)->last() !== null) {
                    $date = new DateTime($employee->files->where('file_type', 3)->last()->valid_date);
                    $valid_date_3 = $date->modify('-1 month')->format('Y-m-d') > date("Y-m-d");
                    }
                    @endphp
                    <td colspan="1">
                        <span>
                            <i class="{{ $employee->first_edu && ($valid_date_1 ?? true) ? 'fas fa-check mx-3' : 'fas fa-times mx-3' }}"
                                style="{{ $employee->first_edu && ($valid_date_1 ?? true) ? 'color: green' : 'color: red' }}"></i>
                        </span></td>
                    <td colspan="1"><span>
                            <i class="{{ $employee->second_edu && ($valid_date_2 ?? true) ? 'fas fa-check mx-3' : 'fas fa-times mx-3' }}"
                                style="{{ $employee->second_edu && ($valid_date_2 ?? true) ? 'color: green' : 'color: red' }}"></i>
                        </span></td>
                    <td colspan="1"><span>
                            <i class="{{ $employee->examination && ($valid_date_3 ?? true) ? 'fas fa-check mx-3' : 'fas fa-times mx-3' }}"
                                style="{{ $employee->examination && ($valid_date_3 ?? true) ? 'color: green' : 'color: red' }}"></i>
                        </span></td>
                    <td class="table-danger"><button class="btn btn-sm btn-danger" data-toggle="modal"
                            data-target="#deleteEmpModal" data-whatever="@getbootstrap"><i
                                class="fas fa-trash"></i></button>
                    </td>
                    <td class="table-primary"><button class="btn btn-sm btn-primary" data-toggle="modal"
                            data-target="#addEmpFile" data-whatever="@getbootstrap"><i class="fas fa-plus"></i></button>
                    </td>
                    <td class="table-warning"><button class="btn btn-sm btn-warning" data-toggle="modal"
                            data-target="#addEmpIdentifyFile" data-whatever="@getbootstrap"><i
                                class="fas fa-folder-plus"></i></button>
                    </td>
                </tr>
                @empty
                <td colspan="11">
                    <h4 class="text-center">
                        <b>
                            {{ $employees->whereNull('deleted_at')->count() > 0 ? 'Bütün çalışanların evrakları tam!' : 'Bu işletmeye henüz hiçbir çalışan eklenmedi!' }}

                        </b>
                    </h4>
                </td>
                @endforelse
            </tbody>
        </table>
        <div class="float-right">{{ $employees->whereNull('deleted_at')->filter(function ($item) {
            return $item->first_edu == 0 || $item->second_edu == 0 || $item->examination == 0;
        })->paginate(15)->links() }}</div>
    </div>
</div>
