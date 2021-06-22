@extends('layouts.company')
@section('title'){{ Str::title($company->name) }} - @endsection
@section('home'){{ route('admin.home') }} @endsection
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
<div class="text-center mb-1">
    <h2><b>{{ Str::upper($company->name) }}</h2></b>
</div>
<div class="row">
    {{-- ///////////////////////////Left Side/////////////////////////////////////////// --}}
    <div class="col-lg-7 pr-3">
        <div class="row">
            <div class="card w-100">
                @include('admin.company.home.tabs.zorunlu-dokumanlar')
            </div>
        </div>
        <div class="row mt-3 mb-5" style="height: 272px">
            <div class="card w-100">
                @include('admin.company.home.tabs.yillik-calisma-plani')
            </div>
        </div>
    </div>

    {{-- ///////////////////////////Right Side/////////////////////////////////////////// --}}
    <div class="col-lg-5">
        <div class="row" style="height: 560px">
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

@endsection