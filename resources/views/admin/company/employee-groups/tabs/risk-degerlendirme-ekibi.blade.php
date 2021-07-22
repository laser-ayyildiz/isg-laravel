<div class="tab-pane fade show" id="risk_degerlendirme_ekibi" aria-labelledby="rde-tab">
    @empty($riskFile)
    <button class="btn btn-primary float-md-left mb-2" data-toggle="modal" data-target="#riskGroupFileModal"
        data-whatever="@getbootstrap">Risk Değerlendirme Ekibi Dosyası Ekle</button>
    <button class="btn btn-success float-md-left mx-2 mb-2" data-toggle="modal" data-target="#createRiskGroupFileModal"
        data-whatever="@getbootstrap">Rapor Oluştur</button>
    @endempty
    @isset($riskFile)
    <button class="btn btn-success float-md-left mb-2"
        onclick="window.open('/files/assignment-files/{{ $riskFile->file->name }}', '_blank')">Dosyayı
        Görüntüle</button>
    <form class="float-md-left ml-1"
        action="{{ route('download-file',['folder' => 'assignment-files', 'file_name' => $riskFile->file->name]) }}"
        method="post">
        @csrf
        <button class="btn btn-warning" type="submit">Dosyayı İndir</button>
    </form>
    <form class="float-md-right mb-2"
        action="{{ route('risk-group-file-delete', ['company' => $company, 'file' => $riskFile->file]) }}" method="post"
        onSubmit="return confirm('Dosyayı Silmek İstediğinize Emin misiniz?')">
        @csrf
        <button class="btn btn-danger" type="submit">Dosyayı Sil</button>
    </form>
    @endisset

    <div class=" table-responsive table" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover mt-1" id="dataTable">
            <thead class="thead-dark">
                <th>Görev</th>
                <th>Ad Soyad</th>
                <th style="width: 5%">Sil</th>
            </thead>
            <tbody>
                {{-- /////////////////////////////İSG ELEMANLARI////////////////////////////////////////// --}}

                @forelse ($relations->whereNotNull('osgb_employee_id') as $user)
                <tr id="{{ $user->id }}" class="table-primary">
                    <td>{{ $user->osgbEmployee->job_id == 1 ? 'İSG Uzmanı' : 'İş Yeri Hekimi' }}</td>
                    <td>{{ $user->osgbEmployee->name }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                            data-whatever="@getbootstrap" id="deleteBtn">
                            <i class="fas fa-times"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="3">Hekim veya Uzman ataması yapılmadı</td>
                </tr>
                @endforelse

                {{-- /////////////////////////////İŞVEREN////////////////////////////////////////// --}}

                @if($relations->whereNotNull('isveren')->last() !== null)
                <tr id="{{$relations->whereNotNull('isveren')->last()->id }}" class="table-primary">
                    <td>İşveren/Vekili</td>
                    <td>{{ $relations->whereNotNull('isveren')->last()->isveren }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                            data-whatever="@getbootstrap" id="deleteBtn">
                            <i class="fas fa-times"></i></button>
                    </td>
                </tr>
                @else
                <tr>
                    <td class="text-center" colspan="3">İşveren bulunamadı!</td>
                </tr>
                @endif

                {{-- ////////////////////////////////ÇALIŞAN TEMSİLCİSİ/////////////////////////////////////// --}}

                @if ($relations->where('group', 'Çalışan Temsilcisi')->first() !== null)
                @php
                $employee = $relations->where('group', 'Çalışan Temsilcisi')->first();
                @endphp
                @if($employee->employee !== null)
                <tr id="{{ $employee->id }}" class="table-success">
                    <td>Çalışan Temsilcisi</td>
                    <td>{{ $employee->employee->name }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                            data-whatever="@getbootstrap" id="deleteBtn">
                            <i class="fas fa-times"></i></button>
                    </td>
                </tr>
                @else
                <tr>
                    <td class="text-center" colspan="3">Ataması Yapılan Çalışan Silinmiş Olabilir. Lütfen Kontrol
                        Ediniz!</td>
                </tr>
                @endif
                @else
                <tr>
                    <td class="text-center" colspan="3">Çalışan Temsilcisi Atanmadı!</td>
                </tr>
                @endif

                {{-- //////////////////////////////DESTEK ELEMANI///////////////////////////////////////// --}}

                @forelse ($relations->where('sub_group', 'Destek Elemanı') as $risk_employee)
                @if($risk_employee->employee !== null)
                <tr id="{{ $risk_employee->id }}" class="table-warning">
                    <td>{{ $risk_employee->sub_group }}</td>
                    <td>{{ $risk_employee->employee->name}}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"
                            data-whatever="@getbootstrap" id="deleteBtn">
                            <i class="fas fa-times"></i></button>
                    </td>
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
