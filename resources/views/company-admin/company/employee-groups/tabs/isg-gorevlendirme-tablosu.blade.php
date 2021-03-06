<div class="tab-pane fade show" id="isg_gorevlendirme_tablosu" aria-labelledby="igt-tab">
    <legend class="float-left mt-2">İSG Görevlendirmesi</legend>
    <div class=" table-responsive table" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover mt-1" id="dataTable">
            <thead class="thead-dark">
                <th>Görev</th>
                <th>Ad Soyad</th>
                <th class="text-center">Atama Dosyası</th>
            </thead>
            <tbody>
                @forelse ($relations->whereNotNull('osgb_employee_id') as $user)
                <tr id="{{ $user->id }}">
                    <td>{{ $user->osgbEmployee->job_id == 1 ? 'İSG Uzmanı' : 'İş Yeri Hekimi' }}</td>
                    <td>{{ $user->osgbEmployee->name }}</td>
                    @if($user->file !== null)
                    <td>
                        <button class="btn btn-warning btn-sm float-left mr-1"
                            onclick="window.open('{{ url('/files/assignment-files/' . $user->file->name) }}','_blank')">
                            <i class="fas fa-eye"></i></button>

                        <form class="float-left mr-1"
                            action="{{ route('download-file',['folder' => 'assignment-files', 'file_name' => $user->file->name]) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-success btn-sm" type="submit">
                                <i class="fas fa-download"></i></button>
                        </form>
                    </td>
                    @else
                    <td class="text-center">
                        <span class="text-danger">Atama Dosyası Eksik</span>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="3">Hekim veya Uzman ataması yapılmadı</td>
                </tr>
                @endforelse

                {{-- /////////////////////////////////////////////////////////////////////// --}}

                @if($relations->whereNotNull('isveren')->last() !== null)
                <tr id="{{$relations->whereNotNull('isveren')->last()->id }}">
                    <td>İşveren/Vekili</td>
                    <td>{{ $relations->whereNotNull('isveren')->last()->isveren }}</td>
                    @if($relations->whereNotNull('isveren')->last()->file !== null)
                    <td>
                        <button class="btn btn-warning btn-sm float-left mr-1"
                            onclick="window.open('{{ url('/files/assignment-files/' . $relations->whereNotNull('isveren')->last()->file->name) }}','_blank')">
                            <i class="fas fa-eye"></i></button>

                        <form class="float-left mr-1"
                            action="{{ route('download-file',['folder' => 'assignment-files', 'file_name' => $relations->whereNotNull('isveren')->last()->file->name]) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-success btn-sm" type="submit">
                                <i class="fas fa-download"></i></button>
                        </form>
                    </td>
                    @else
                    <td class="text-center">
                        <span class="text-danger">Atama Dosyası Eksik</span>
                    </td>
                    @endif
                </tr>
                @else
                <tr>
                    <td class="text-center" colspan="3">İşveren bulunamadı!</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- /////////////////////////////////////////////////////////////////////// --}}

    <legend class="float-left mt-2">Çalışan Temsilcileri</legend>
    <div class=" table-responsive table" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover mt-1" id="dataTable">
            <thead class="thead-dark">
                <th>Görev</th>
                <th>Ad Soyad</th>
                <th class="text-center">Atama Dosyası</th>
            </thead>
            <tbody>
                @forelse ($relations->where('group', 'Çalışan Temsilcisi') as $employee)
                @if($employee->employee !== null)
                <tr id="{{ $employee->id }}">
                    <td>Çalışan Temsilcisi</td>
                    <td>{{ $employee->employee->name }}</td>
                    @if($employee->file !== null)
                    <td>
                        <button class="btn btn-warning btn-sm float-left mr-1"
                            onclick="window.open('{{ url('/files/assignment-files/' . $employee->file->name) }}','_blank')">
                            <i class="fas fa-eye"></i></button>

                        <form class="float-left mr-1"
                            action="{{ route('download-file',['folder' => 'assignment-files', 'file_name' => $employee->file->name]) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-success btn-sm" type="submit">
                                <i class="fas fa-download"></i></button>
                        </form>
                    </td>
                    @else
                    <td class="text-center">
                        <span class="text-danger">Atama Dosyası Eksik</span>
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
                    <td class="text-center" colspan="3">Çalışan Temsilcisi atanmadı</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
