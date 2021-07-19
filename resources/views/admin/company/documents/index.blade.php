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
        @include('admin.company.documents.tabs.list')
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            @include('admin.company.documents.tabs.zorunlu-dokumanlar')
            @include('admin.company.documents.tabs.defter-nushalari')
            @include('admin.company.documents.tabs.gozlem-raporlari')
        </div>
    </div>
</div>
<div name="modals">
    @include('admin.company.documents.modals.zorunlu-dokuman-ekle')
    @include('admin.company.documents.modals.aylik-dokuman-ekle')
</div>
<script src="/company/js/documents.js"></script>
<script>
    const selectMonthly = (valueToSelect) => document.getElementById('monthly_file_type').value = valueToSelect;
</script>
@endsection
