<div class="tab-pane fade show" id="acil_durum_ekibi" aria-labelledby="ade-tab">
    <div class=" table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover mt-2" id="dataTable">
            <thead class="thead-dark">
                <th>Görev</th>
                <th>Ad Soyad</th>
                <th class="text-center">Atama Dosyası</th>
                <th style="width: 5%">Sil</th>
            </thead>
            <tbody>
                @php
                $colors = [
                'Ekipler Şefi' => "table-success",
                'Arama, Kurtarma, Tahliye Ekibi' => 'table-warning',
                'Yangın Söndürme Ekibi' => 'table-danger',
                'İlk Yardım Ekibi' => 'table-primary'
                ];
                @endphp
                @forelse ($relations->where('group', 'Acil Durum Ekibi')->sortBy('sub_group') as $emergency_employee)
                @if($emergency_employee->employee !== null)
                <tr id="{{ $emergency_employee->id }}" class="{{ $colors[$emergency_employee->sub_group] }}">
                    <td>{{ $emergency_employee->sub_group }}</td>
                    <td>{{ $emergency_employee->employee->name}}</td>
                    @if($emergency_employee->file !== null)
                    <td>
                        <button class="btn btn-warning btn-sm float-sm-left mr-1"
                            onclick="window.open('{{ url('/files/assignment-files/' . $emergency_employee->file->name) }}','_blank')">
                            <i class="fas fa-eye"></i></button>

                        <form class="float-sm-left mr-1"
                            action="{{ route('download-file',['folder' => 'assignment-files', 'file_name' => $emergency_employee->file->name]) }}"
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
                    <td class="text-center">
                        <button class="btn btn-primary btn-sm float-sm-center" data-toggle="modal"
                            data-target="#addFileModal" data-whatever="@getbootstrap" id="addFileBtn">
                            <i class="fas fa-plus"></i></button>
                        <span class="text-danger">Atama Dosyası Eksik</span>
                    </td>
                    @endif
                    <td>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                            data-whatever="@getbootstrap" id="deleteBtn">
                            <i class="fas fa-times"></i></button>
                    </td>
                </tr>
                @else
                <tr>
                    <td class="text-center" colspan="4">Ataması Yapılan Çalışan Silinmiş Olabilir. Lütfen Kontrol
                        Ediniz!</td>
                </tr>
                @endif
                @empty
                <tr>
                    <td class="text-center" colspan="4">Acil Durum Ekibi için atama yapılmadı</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
