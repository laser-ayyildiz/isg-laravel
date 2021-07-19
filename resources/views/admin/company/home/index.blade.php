@extends('layouts.company')
@section('company'){{ Str::of($company->name)->upper()->limit(20) }} @endsection
@section('content')
@php
$month = date('m');
$monthList = ['01' => 'Ocak','02' => 'Şubat','03' => 'Mart','04' => 'Nisan','05' => 'Mayıs','06' => 'Haziran','07'
=> 'Temmuz','08' => 'Ağustos','09' => 'Eylül','10' => 'Ekim','11' => 'Kasım','12' => 'Aralık'];
@endphp
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
<div class="row">
    {{-- ///////////////////////////Left Side/////////////////////////////////////////// --}}
    <div class="col-lg-8 pr-3">
        <div class="row" style="height: 780px">
            <div class="card w-100">
                @include('admin.company.home.tabs.dokumanlar')
            </div>
        </div>
    </div>

    {{-- ///////////////////////////Right Side/////////////////////////////////////////// --}}
    <div class="col-lg-4">
        <div class="row" style="height: 550px">
            <div class="card w-100">
                @include('admin.company.home.tabs.bildirimler')
            </div>
        </div>
        <div class="row my-3">
            <div class="card w-100">
                @include('admin.company.home.tabs.bilgiler')
            </div>
        </div>
    </div>
</div>

<div name="modals">
    @include('admin.company.home.modals.zorunlu-dokuman-ekle')
    @include('admin.company.home.modals.aylik-dokuman-ekle')
    @include('admin.company.home.modals.ekipman-ekle')

    @if ($equipments !== null)
        @include('admin.company.home.modals.ekipman-dosyasi-ekle')
    @endif
</div>
@push('scripts')
<script src="/company/js/home.js"></script>
<script>
    const selectElement = (valueToSelect) => document.getElementById('file_type').value = valueToSelect;

    const selectMonthly = (valueToSelect) => document.getElementById('monthly_file_type').value = valueToSelect;
</script>
@endpush

@endsection
