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

            @include('admin.company.informations.tabs.grup-bilgileri')
        </div>
    </div>
</div>
<div name="modals">

    @include('admin.company.informations.modals.isletme-silme-talebi')

    @include('admin.company.informations.modals.isletme-degistir')

    @include('admin.company.informations.modals.muhasebeci-ekle')

    @include('admin.company.informations.modals.grup-duzenle')
</div>
@push('scripts')
<script src="/company/js/informations.js"></script>
<script src="/js/core/city-town.js"></script>
<script src="/js/core/common/companies/group-comp.js"></script>
<script>
    function populateList() {
        $.ajax({
            url: "{{ route('getGroupLeaders') }}",
            type: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            dataType: 'json',
            data: "{}",
            success: function (data) {
            data.forEach(element => {
            $("#leader-company-select").append("<option value='"+element.id+"'>"+element.name+"</option>");
                });
            }
        });
    }
    $(document).ready(function (){
        $('#groups tbody').on('click', 'tr', function (e) {
            if ($(this).closest('tr').attr('id') !== null && typeof $(this).closest('tr').attr('id') !== "undefined")
                window.location.href = "/admin/company/" + $(this).closest('tr').attr('id');
        });
    });
</script>
@endpush

@endsection
