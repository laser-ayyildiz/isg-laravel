<div class="card-header">
    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="zd-tab" data-toggle="tab" href="#zorunlu_dokumanlar" role="tab"
                aria-controls="Zorunlu Dokümanlar" aria-selected="true"><b>Zorunlu Dokümanlar</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="ac-tab" data-toggle="tab" href="#aylik_calismalar" role="tab"
                aria-controls="Aylık Çalışmalar" aria-selected="false"><b>Aylık Çalışmalar</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="ycp-tab" data-toggle="tab" href="#yillik_calisma_plani" role="tab"
                aria-controls="Yıllık Çalışma Planı" aria-selected="false"><b>Yıllık Çalışma Planı</b></a>
        </li>
    </ul>
</div>
<div class="card-body">
    <div class="tab-content" id="myTabContent">

        {{-- ///////////////////////////////////////////////////////////////////////////// --}}
        <div class="tab-pane fade show active" id="zorunlu_dokumanlar" role="tabpanel" aria-labelledby="zd-tab">
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMandatoryFile"
                                data-whatever="@getbootstrap" onclick="selectElement('1')">
                                <i class="fas fa-plus"></i></button>
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMandatoryFile"
                                data-whatever="@getbootstrap" onclick="selectElement('2')">
                                <i class="fas fa-plus"></i></button>
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMandatoryFile"
                                data-whatever="@getbootstrap" onclick="selectElement('3')">
                                <i class="fas fa-plus"></i></button>
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMandatoryFile"
                                data-whatever="@getbootstrap" onclick="selectElement('4')">
                                <i class="fas fa-plus"></i></button>
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMandatoryFile"
                                data-whatever="@getbootstrap" onclick="selectElement('5')">
                                <i class="fas fa-plus"></i></button>
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMandatoryFile"
                                data-whatever="@getbootstrap" onclick="selectElement('6')">
                                <i class="fas fa-plus"></i></button>
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMandatoryFile"
                                data-whatever="@getbootstrap" onclick="selectElement('7')">
                                <i class="fas fa-plus"></i></button>
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
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMandatoryFile"
                                data-whatever="@getbootstrap" onclick="selectElement('8')">
                                <i class="fas fa-plus"></i></button>
                            @endif
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        {{-- ///////////////////////////////////////////////////////////////////////////// --}}
        <div class="tab-pane fade show" id="aylik_calismalar" role="tabpanel" aria-labelledby="ac-tab">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                Defter Nüshaları
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                            squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                            nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                            single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                            beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice
                            lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you
                            probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Saha Gözlem Raporu
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                            squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                            nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                            single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                            beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice
                            lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you
                            probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ///////////////////////////////////////////////////////////////////////////// --}}
        <div class="tab-pane fade show" id="yillik_calisma_plani" role="tabpanel" aria-labelledby="ycp-tab">
            <h1>Yıllık Çalışma Planı Oluşturulmadı</h1>
        </div>
    </div>
</div>