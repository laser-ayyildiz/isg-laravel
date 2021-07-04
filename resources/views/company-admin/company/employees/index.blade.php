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
            @include('company-admin.company.employees.tabs.list')
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                @include('company-admin.company.employees.tabs.isletme-calisanlari')

                @include('company-admin.company.employees.tabs.silinen-calisanlar')
            </div>
        </div>
    </div>
</div>
<div name="modals">
    @include('company-admin.company.employees.modals.calisan-ozluk-dosyası-yukle')
</div>

@push('scripts')
<script src="/company/js/company-admin/employees.js"></script>
@endpush

@endsection