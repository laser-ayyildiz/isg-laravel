<div class="card-header">
    <h4><b> Zorunlu Dokümanlar </b></h4>
</div>
<div class="card-body">
    <table class="table table-striped table-borderless">
        <tbody>
            <tr>
                <td>
                    İş Yeri Uzman Sözleşmesi
                </td>

                <td>
                    @if (in_array(1,$file_types))
                    <span><i class="fas fa-check mx-3" style="color: green"></i></span>
                    @else
                    <span><span><i class="fas fa-times mx-3" style="color: red"></i></span></i></span>
                    @endif

                </td>
                <td>
                    @if (in_array(1,$file_types))
                    @php
                    $file_name = $mandatory_files->where('file_type',1)->count() > 0 ?
                    $mandatory_files->where('file_type',1)[$count]->file->name : '';
                    @endphp
                    <button class="btn btn-warning btn-sm float-left mr-1"
                        onclick="window.open('{{ url('/files/company-mandatory-files/' . $file_name) }}','_blank')">
                        <i class="fas fa-eye"></i></button>

                    <form class="float-left mr-1"
                        action="{{ route('download-file',['folder' => 'company-mandatory-files', 'file_name' => $file_name]) }}"
                        method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">
                            <i class="fas fa-download"></i></button>
                    </form>
                    @php
                    $count = $count + 1;
                    @endphp
                    @else
                    <a class="btn btn-primary btn-sm"
                        href="{{ route('admin.company.documents.mandatoryFiles',['id' => request()->segment(3)]) }}">
                        <i class="fas fa-plus"></i></a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    İş Yeri Hekim Sözleşmesi
                </td>
                <td>
                    @if (in_array(2,$file_types))
                    <span><i class="fas fa-check mx-3" style="color: green"></i></span>
                    @else
                    <span><span><i class="fas fa-times mx-3" style="color: red"></i></span></i></span>
                    @endif
                </td>
                <td>
                    @if (in_array(2,$file_types))
                    @php
                    $file_name = $mandatory_files->where('file_type',2)->count() > 0 ?
                    $mandatory_files->where('file_type',2)[$count]->file->name : '';
                    @endphp
                    <button class="btn btn-warning btn-sm float-left mr-1"
                        onclick="window.open('{{ url('/files/company-mandatory-files/' . $file_name) }}','_blank')">
                        <i class="fas fa-eye"></i></button>
                    <form class="float-left mr-1"
                        action="{{ route('download-file',['folder' => 'company-mandatory-files', 'file_name' => $file_name]) }}"
                        method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">
                            <i class="fas fa-download"></i></button>
                    </form>
                    @php
                    $count = $count + 1;
                    @endphp
                    @else
                    <a class="btn btn-primary btn-sm"
                        href="{{ route('admin.company.documents.mandatoryFiles',['id' => request()->segment(3)]) }}">
                        <i class="fas fa-plus"></i></a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    Acil Durum Eylem Planı
                </td>
                <td>
                    @if (in_array(3,$file_types))
                    <span><i class="fas fa-check mx-3" style="color: green"></i></span>
                    @else
                    <span><span><i class="fas fa-times mx-3" style="color: red"></i></span></i></span>
                    @endif
                </td>
                <td>
                    @if (in_array(3,$file_types))
                    @php
                    $file_name = $mandatory_files->where('file_type',3)->count() > 0 ?
                    $mandatory_files->where('file_type',3)[$count]->file->name : '';
                    @endphp
                    <button class="btn btn-warning btn-sm float-left mr-1"
                        onclick="window.open('{{ url('/files/company-mandatory-files/' . $file_name) }}','_blank')">
                        <i class="fas fa-eye"></i></button>

                    <form class="float-left mr-1"
                        action="{{ route('download-file',['folder' => 'company-mandatory-files', 'file_name' => $file_name]) }}"
                        method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">
                            <i class="fas fa-download"></i></button>
                    </form>
                    @php
                    $count = $count + 1;
                    @endphp
                    @else
                    <a class="btn btn-primary btn-sm"
                        href="{{ route('admin.company.documents.mandatoryFiles',['id' => request()->segment(3)]) }}">
                        <i class="fas fa-plus"></i></a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    Risk Analizi Dosyası
                </td>
                <td>
                    @if (in_array(4,$file_types))
                    <span><i class="fas fa-check mx-3" style="color: green"></i></span>
                    @else
                    <span><span><i class="fas fa-times mx-3" style="color: red"></i></span></i></span>
                    @endif
                </td>
                <td>
                    @if (in_array(4,$file_types))
                    @php
                    $file_name = $mandatory_files->where('file_type',4)->count() > 0 ?
                    $mandatory_files->where('file_type',4)[$count]->file->name : '';
                    @endphp
                    <button class="btn btn-warning btn-sm float-left mr-1"
                        onclick="window.open('{{ url('/files/company-mandatory-files/' . $file_name) }}','_blank')">
                        <i class="fas fa-eye"></i></button>

                    <form class="float-left mr-1"
                        action="{{ route('download-file',['folder' => 'company-mandatory-files', 'file_name' => $file_name]) }}"
                        method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">
                            <i class="fas fa-download"></i></button>
                    </form>
                    @php
                    $count = $count + 1;
                    @endphp
                    @else
                    <a class="btn btn-primary btn-sm"
                        href="{{ route('admin.company.documents.mandatoryFiles',['id' => request()->segment(3)]) }}">
                        <i class="fas fa-plus"></i></a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    Yıllık Çalışma Planı
                </td>
                <td>
                    @if (in_array(5,$file_types))
                    <span><i class="fas fa-check mx-3" style="color: green"></i></span>
                    @else
                    <span><span><i class="fas fa-times mx-3" style="color: red"></i></span></i></span>
                    @endif
                </td>
                <td>
                    @if (in_array(5,$file_types))
                    @php
                    $file_name = $mandatory_files->where('file_type',5)->count() > 0 ?
                    $mandatory_files->where('file_type',5)[$count]->file->name : '';
                    @endphp
                    <button class="btn btn-warning btn-sm float-left mr-1"
                        onclick="window.open('{{ url('/files/company-mandatory-files/' . $file_name) }}','_blank')">
                        <i class="fas fa-eye"></i></button>

                    <form class="float-left mr-1"
                        action="{{ route('download-file',['folder' => 'company-mandatory-files', 'file_name' => $file_name]) }}"
                        method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">
                            <i class="fas fa-download"></i></button>
                    </form>
                    @php
                    $count = $count + 1;
                    @endphp
                    @else
                    <a class="btn btn-primary btn-sm"
                        href="{{ route('admin.company.documents.mandatoryFiles',['id' => request()->segment(3)]) }}">
                        <i class="fas fa-plus"></i></a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    Yıllık Eğitim Programı
                </td>
                <td>
                    @if (in_array(6,$file_types))
                    <span><i class="fas fa-check mx-3" style="color: green"></i></span>
                    @else
                    <span><span><i class="fas fa-times mx-3" style="color: red"></i></span></i></span>
                    @endif
                </td>
                <td>
                    @if (in_array(6,$file_types))
                    @php
                    $file_name = $mandatory_files->where('file_type',6)->count() > 0 ?
                    $mandatory_files->where('file_type',6)[$count]->file->name : '';
                    @endphp
                    <button class="btn btn-warning btn-sm float-left mr-1"
                        onclick="window.open('{{ url('/files/company-mandatory-files/' . $file_name) }}','_blank')">
                        <i class="fas fa-eye"></i></button>

                    <form class="float-left mr-1"
                        action="{{ route('download-file',['folder' => 'company-mandatory-files', 'file_name' => $file_name]) }}"
                        method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">
                            <i class="fas fa-download"></i></button>
                    </form>
                    @php
                    $count = $count + 1;
                    @endphp
                    @else
                    <a class="btn btn-primary btn-sm"
                        href="{{ route('admin.company.documents.mandatoryFiles',['id' => request()->segment(3)]) }}">
                        <i class="fas fa-plus"></i></a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    DSP Sözleşmesi
                </td>
                <td>
                    @if (in_array(7,$file_types))
                    <span><i class="fas fa-check mx-3" style="color: green"></i></span>
                    @else
                    <span><span><i class="fas fa-times mx-3" style="color: red"></i></span></i></span>
                    @endif
                </td>
                <td>
                    @if (in_array(7,$file_types))
                    @php
                    $file_name = $mandatory_files->where('file_type',7)->count() > 0 ?
                    $mandatory_files->where('file_type',7)[$count]->file->name : '';
                    @endphp
                    <button class="btn btn-warning btn-sm float-left mr-1"
                        onclick="window.open('{{ url('/files/company-mandatory-files/' . $file_name) }}','_blank')">
                        <i class="fas fa-eye"></i></button>

                    <form class="float-left mr-1"
                        action="{{ route('download-file',['folder' => 'company-mandatory-files', 'file_name' => $file_name]) }}"
                        method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">
                            <i class="fas fa-download"></i></button>
                    </form>
                    @php
                    $count = $count + 1;
                    @endphp
                    @else
                    <a class="btn btn-primary btn-sm"
                        href="{{ route('admin.company.documents.mandatoryFiles',['id' => request()->segment(3)]) }}">
                        <i class="fas fa-plus"></i></a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    Yıl Sonu Değerlendirme Raporu
                </td>
                <td>
                    @if (in_array(8,$file_types))
                    <span><i class="fas fa-check mx-3" style="color: green"></i></span>
                    @else
                    <span><span><i class="fas fa-times mx-3" style="color: red"></i></span></i></span>
                    @endif
                </td>
                <td>
                    @if (in_array(8,$file_types))
                    @php
                    $file_name = $mandatory_files->where('file_type',8)->count() > 0 ?
                    $mandatory_files->where('file_type',8)[$count]->file->name : '';
                    @endphp
                    <button class="btn btn-warning btn-sm float-left mr-1"
                        onclick="window.open('{{ url('/files/company-mandatory-files/' . $mandatory_files->where('file_type',8)->count() > 0 ? $mandatory_files->where('file_type',8)[$count]->file->name : '') }}','_blank')">
                        <i class="fas fa-eye"></i></button>

                    <form class="float-left mr-1"
                        action="{{ route('download-file',['folder' => 'company-mandatory-files', 'file_name' => $mandatory_files->where('file_type',8)->count() > 0 ? $mandatory_files->where('file_type',8)[$count]->file->name : '']) }}"
                        method="post">
                        @csrf
                        <button class="btn btn-success btn-sm" type="submit">
                            <i class="fas fa-download"></i></button>
                    </form>
                    @php
                    $count = $count + 1;
                    @endphp
                    @else
                    <a class="btn btn-primary btn-sm"
                        href="{{ route('admin.company.documents.mandatoryFiles',['id' => request()->segment(3)]) }}">
                        <i class="fas fa-plus"></i></a>
                    @endif
                </td>
            </tr>

        </tbody>
    </table>
</div>