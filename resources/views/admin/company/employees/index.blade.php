@extends('layouts.company')
@section('title'){{ Str::title($company->name) }} - @endsection
@section('home'){{ route('admin.home') }} @endsection
@section('company.href'){{ route('admin.company.informations.index',['id' => $company->id]) }} @endsection
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
            @include('admin.company.employees.tabs.list')
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                @include('admin.company.employees.tabs.isletme-calisanlari')

                @include('admin.company.employees.tabs.evraklari-eksik-calisanlar')

                @include('admin.company.employees.tabs.silinen-calisanlar')
            </div>
        </div>
    </div>
</div>
<div name="modals">

    @include('admin.company.employees.modals.calisan-ekle')

    @include('admin.company.employees.modals.calisan-sil')

    @include('admin.company.employees.modals.calisanlara-dosya-ata')

    @include('admin.company.employees.modals.isveren-hesap-ekle')

    @include('admin.company.employees.modals.calisan-listesi-yukle')

    @include('admin.company.employees.modals.calisan-dosyası-yukle')

    @include('admin.company.employees.modals.calisan-ozluk-dosyası-yukle')

    @include('admin.company.employees.modals.calisan-geri-al')

</div>
@push('styles')
{{-- dataTable --}}
<link href="/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endpush

@push('scripts')
<script src="/js/core/common/companies/modal-validation.js"></script>
<script src="/js/core/common/companies/group-comp.js"></script>
<script src="/js/core/city-town.js"></script>
{{-- dataTable --}}
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap5.min.js"></script>
<script src="/js/jquery.validate.js"></script>

<script type="module" src="/company/js/admin/employees.js"></script>
@endpush

@endsection