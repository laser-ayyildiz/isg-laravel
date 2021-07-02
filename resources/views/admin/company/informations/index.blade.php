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

<div class="card shadow-lg">
    <div class="card-header tab-card-header text-center bg-light text-dark border">
        @include('admin.company.informations.tabs.list')
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            @include('admin.company.informations.tabs.genel-bilgiler')

            @include('admin.company.informations.tabs.osgb-calisanlari')

            @include('admin.company.informations.tabs.devlet-bilgileri')

            @include('admin.company.informations.tabs.muhasebe-bilgileri')
        </div>
    </div>
</div>
<div name="modals">

    @include('admin.company.informations.modals.isletme-silme-talebi')

    @include('admin.company.informations.modals.isletme-degistir')

    @include('admin.company.informations.modals.yeni-calisan-ata')

    @include('admin.company.informations.modals.muhasebeci-ekle')

</div>
@push('scripts')
<script src="/company/js/admin/informations.js"></script>
@endpush

@endsection