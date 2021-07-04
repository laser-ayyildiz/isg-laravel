@extends('layouts.company-admin')
@section('title'){{ Str::title($employee->name) }} - @endsection
@section('content')

@if (session('fail'))
<div class="alert alert-danger">
    {{ session('fail') }}
</div>
@elseif(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card shadow-lg">
    <div class="card-header tab-card-header text-center bg-light text-dark border">
        <h1><b>{{ $deleted ? 'Silinen Çalışan - ' : null }} {{ Str::title($employee->name) }}</b></h1>
        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="files-tab" data-toggle="tab" href="#files" role="tab"
                    aria-controls="Dosyalar" aria-selected="true">Dosyalar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="gb-tab" data-toggle="tab" href="#genel_bilgiler" role="tab"
                    aria-controls="Genel Bilgiler" aria-selected="true">Bilgiler</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="files" role="tabpanel" aria-labelledby="files-tab">
                @if(!$deleted)
                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addFile"
                    data-whatever="@getbootstrap">Yeni Özlük Dosyası Ekle</a></button>
                @endif
                <table class="table table-bordered table-striped table-responsive">
                    <thead class="bg-dark text-light">
                        <th>Dosya Adı</th>
                        <th>Dosya Oluşturulma Tarihi</th>
                        <th>Son Geçerlilik Tarihi</th>
                        <th style="width: 5%">İndir/Görüntüle</th>
                    </thead>
                    <tbody>
                        @forelse ($files as $file)
                        @isset($file->file)
                        <tr>
                            <td>{{ $file->file->name }}</td>
                            <td>{{ $file->assigned_at }}</td>
                            @if ($file->valid_date !== null)
                            <td class="{{ $file->valid_date >= date('Y-m-d') ? 'table-success' : 'table-danger'}}">
                                {{ $file->valid_date }}
                            </td>
                            @else
                            <td class="table-success">
                                {{ $file->valid_date }}
                            </td>
                            @endif

                            <td class="text-center">
                                <button class="btn btn-warning btn-sm float-left mr-1"
                                    onclick="window.open('{{ url('/files/employee-files/' . $file->file->name) }}','_blank')"><i
                                        class="fas fa-eye"></i></button>
                                <form
                                    action="{{ route('download-file',['folder' => 'employee-files', 'file_name' => $file->file->name]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm float-left">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </form>
                                @if ($file->file_type == 8)
                                <form action="{{ route('delete-employee-file',['file' => $file->file]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm float-left ml-1">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endisset
                        @empty
                        <tr>
                            <td valign="top" colspan="4" class="text-center">Tabloda herhangi bir veri
                                mevcut değil</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @if(!$deleted)
                <div class="float-right">
                    {{ $files->links() }}
                </div>
                @endif

            </div>

            <!--Genel Bilgiler -->
            <div class="tab-pane fade show" id="genel_bilgiler" role="tabpanel" aria-labelledby="gb-tab">
                <div class="row">
                    <div class="col-5">
                        <label for="compName"><b>Çalıştığı Şirket</b></label>
                        <input class="form-control" name="compName" type="text"
                            value="{{ Str::title($employee->company->name) }}" readonly>
                        </label>
                    </div>
                    <div class="ml-auto">
                        <a name="goToComp" type="button" class="btn btn-primary"
                            href="/company-admin/company/{{ $employee->company->id }}"><i
                                class="fas fa-building text-white"></i>Çalıştığı İşletmeye Git</a>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-4">
                        <label for="name"><b>Ad Soyad</b></label>
                        <input class="form-control" type="text" name="name" value="{{ $employee->name }}" required>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-2">
                        <label for="position"><b>Pozisyon</b></label>
                        <input class="form-control" name="position" type="text" value="{{ $employee->position }}">
                        </label>
                    </div>
                    <div class="col-2">
                        <label for="recruitment_date"><b>İşe Giriş Tarihi</b></label>
                        <input class="form-control" name="recruitment_date" type="date"
                            value="{{ $employee->recruitment_date }}" required>
                        </label>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-2">
                        <label for="phone"><b>Telefon Numarası</b></label>
                        <input class="form-control" name="phone" type="phone" maxlength="11" minlength="11"
                            value="{{ $employee->phone }}">
                        </label>
                    </div>
                    <div class="col-2">
                        <label for="tc"><b>T.C. Kimik Numarası</b></label>
                        <input class="form-control" name="tc" type="phone" maxlength="11" minlength="11"
                            value="{{ $employee->tc }}" required>
                        </label>
                    </div>
                    <div class="col-3">
                        <label for="email"><b>E-mail</b></label>
                        <input class="form-control" name="email" type="email" value="{{ $employee->email }}">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div name="modals">
    @if(!$deleted)
    <div class="modal fade" id="addFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Dosya Yükle</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employee-file-upload',['employee' => $employee]) }}" method="post"
                        enctype="multipart/form-data">
                        <h3 class="text-center mb-5">{{ Str::title($employee->name) }} çalışanı için dosya yükle</h3>
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="name"><b>Dosya Adı</b></label>
                                <input class="form-control" type="text" name="name" placeholder="Dosya Adı">
                            </div>
                            <div class="col-6">
                                <label for="file_date"><b>Dosya Tarihi</b></label>
                                <input class="form-control" type="date" name="file_date" id="file_date">
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12">
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="chooseFile">
                                    <label class="custom-file-label" for="chooseFile">Dosya Seç</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="file_type" value="8">
                            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                                Yükle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@push('scripts')

<script>

</script>
<script>
    @if(!$deleted)
    file_date.max = new Date().toISOString().split("T")[0];
    @endif
    const goToCompany = (id) => window.location = "/company-admin/company/" + id;

    $('.custom-file-input').on('change', function () {
        $(this).next('.custom-file-label').html($(this).val());
        if (this.files[0].size > 47185920)
            alert("Maksimum 45 Mb");
    });
</script>
@endpush
@endsection