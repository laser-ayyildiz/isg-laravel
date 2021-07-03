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
        @include('user.company.informations.tabs.list')
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            @include('user.company.informations.tabs.genel-bilgiler')

            @include('user.company.informations.tabs.osgb-calisanlari')

            @include('user.company.informations.tabs.devlet-bilgileri')

            @include('user.company.informations.tabs.muhasebe-bilgileri')
        </div>
    </div>
</div>
<div name="modals">

    @include('user.company.informations.modals.isletme-silme-talebi')

    @include('user.company.informations.modals.isletme-degistir')

    @include('user.company.informations.modals.muhasebeci-ekle')

</div>
@push('scripts')
<script src="/company/js/informations.js"></script>
@endpush

@endsection