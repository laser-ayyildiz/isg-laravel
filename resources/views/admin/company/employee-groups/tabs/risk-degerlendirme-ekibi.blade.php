<div class="tab-pane fade show" id="risk_degerlendirme_ekibi" aria-labelledby="rde-tab">
    <legend class="float-left mt-2">Destek Elemanları</legend>
    <div class=" table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover mt-2" id="dataTable">
            <thead class="thead-dark">
                <th>Görev</th>
                <th>Ad Soyad</th>
                <th>Atama Dosyası</th>
            </thead>
            <tbody>
                @forelse ($relations->where('group', 'Risk Değerlendirme Ekibi') as $risk_employee)
                @if($risk_employee->employee !== null)
                <tr id="{{ $risk_employee->id }}">
                    <td>{{ $risk_employee->sub_group }}</td>
                    <td>{{ $risk_employee->employee->name}}</td>
                    @if($risk_employee->file !== null)
                    <td>
                        <button class="btn btn-warning btn-sm float-left mr-1"
                            onclick="window.open('{{ url('/files/assignment-files/' . $risk_employee->file->name) }}','_blank')">
                            <i class="fas fa-eye"></i></button>

                        <form class="float-left mr-1"
                            action="{{ route('download-file',['folder' => 'assignment-files', 'file_name' => $risk_employee->file->name]) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-success btn-sm" type="submit">
                                <i class="fas fa-download"></i></button>
                        </form>

                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteFileModal"
                            data-whatever="@getbootstrap" id="deleteFileBtn">
                            <i class="fas fa-times"></i></button>
                    </td>
                    @else
                    <td>
                        <span class="text-danger">Atama Dosyası Eksik</span>
                        <button class="btn btn-primary btn-sm float-sm-right" data-toggle="modal"
                            data-target="#addFileModal" data-whatever="@getbootstrap" id="addFileBtn">
                            <i class="fas fa-plus"></i></button>
                    </td>
                    @endif
                </tr>
                @else
                <tr>
                    <td class="text-center" colspan="3">Ataması Yapılan Çalışan Silinmiş Olabilir. Lütfen Kontrol
                        Ediniz!</td>
                </tr>
                @endif
                @empty
                <tr>
                    <td class="text-center" colspan="3">Destek Elemanı atanmadı</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
