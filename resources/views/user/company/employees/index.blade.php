@extends('layouts.company')
@section('company'){{ Str::of($company->name)->upper()->limit(20) }} @endsection
@section('content')

@if (session('fail'))
<div class="alert alert-danger">
    {{ session('fail') }}
</div>
@elseif (session('success'))
<div class="alert alert-success">
    {!! session('success') !!}
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

<div class="container-fluid mt-2">
    <div class="card shadow-lg">
        <div class="card-header tab-card-header text-center bg-light text-dark border">
            @include('user.company.employees.tabs.list')
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                @include('user.company.employees.tabs.isletme-calisanlari')

                @include('user.company.employees.tabs.evraklari-eksik-calisanlar')

                @include('user.company.employees.tabs.silinen-calisanlar')
            </div>
        </div>
    </div>
</div>
<div name="modals">

    @include('user.company.employees.modals.calisan-ekle')

    @include('user.company.employees.modals.calisan-sil')

    @include('user.company.employees.modals.calisanlara-dosya-ata')

    @include('user.company.employees.modals.calisan-listesi-yukle')

    @include('user.company.employees.modals.calisan-dosyası-yukle')

    @include('user.company.employees.modals.calisan-ozluk-dosyası-yukle')

    @include('user.company.employees.modals.calisan-geri-al')

</div>

@push('styles')
{{-- dataTable --}}
<link href="/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('scripts')
{{-- dataTable --}}
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap5.min.js"></script>
<script src="/js/jquery.validate.js"></script>
<script type="module" src="/company/js/user/employees.js"></script>
@endpush

@endsection