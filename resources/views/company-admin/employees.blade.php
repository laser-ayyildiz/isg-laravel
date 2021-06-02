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
        <h1><b>{{ Str::title($employee->name) }}</b></h1>
        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="gb-tab" data-toggle="tab" href="#genel_bilgiler" role="tab"
                    aria-controls="Genel Bilgiler" aria-selected="true"><b>Bilgiler</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="files-tab" data-toggle="tab" href="#files" role="tab" aria-controls="Dosyalar"
                    aria-selected="true"><b>Dosyalar</b></a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <!--Genel Bilgiler -->
            <div class="tab-pane fade show active" id="genel_bilgiler" role="tabpanel" aria-labelledby="gb-tab">
                <div class="row">
                    <div class="col-5">
                        <label for="compName"><b>Çalıştığı İşletme</b></label>
                        <input class="form-control" name="compName" type="text"
                            value="{{ Str::title($employee->company->name) }}">
                        </label>
                    </div>
                    <div class="ml-auto">
                        <button name="goToComp" type="button" class="btn btn-primary" onclick="goToCompany()"><i
                                class="fas fa-building"></i> Çalıştığı İşletmeye Git </button>
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
                        <input class="form-control" name="recruitment_date" id="recruitment_date" type="date"
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

            <div class="tab-pane fade show" id="files" role="tabpanel" aria-labelledby="files-tab">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="bg-dark text-light">
                            <th>Dosya Adı</th>
                            <th style="width:  20%">Yüklenme Tarihi</th>
                            <th style="width:  20%">İndir</th>
                        </thead>
                        <tbody>
                            @forelse ($files as $file)
                            <tr>
                                <td>{{ $file->file->name }}</td>
                                <td>{{ $file->file->created_at }}</td>
                                <form
                                    action="{{ route('download-file',['folder' => 'employee-files', 'file_name' => $file->file->name]) }}"
                                    method="post">
                                    @csrf
                                    <td><button type="submit" class="btn btn-success btn-sm">İndir</button> </td>
                                </form>
                            </tr>
                            @empty
                            <tr>
                                <td valign="top" colspan="3" class="dataTables_empty text-center">Tabloda herhangi bir
                                    veri
                                    mevcut değil</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="float-right">
                        {{ $files->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div name="modals">
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
                            <h3 class="text-center mb-5">{{ Str::title($employee->name) }} çalışanı için dosya yükle
                            </h3>
                            @csrf
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                                <label class="custom-file-label" for="chooseFile">Dosya Seç</label>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                                    Yükle
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        function goToCompany() {
        window.location = "/company-admin/company/{{ $employee->company->id }}";
    }
    </script>
    @endpush
    @endsection