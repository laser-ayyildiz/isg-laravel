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

<div class="card shadow-lg">
    <div class="card-header tab-card-header text-center bg-light text-dark border">
        @include('company-admin.company.employee-groups.tabs.list')
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            @include('company-admin.company.employee-groups.tabs.isg-gorevlendirme-tablosu')

            @include('company-admin.company.employee-groups.tabs.acil-durum-ekibi')

            @include('company-admin.company.employee-groups.tabs.risk-degerlendirme-ekibi')
        </div>
    </div>
</div>
@push('scripts')
<script src='/company/js/employee-groups.js'></script>
@endpush
@endsection
