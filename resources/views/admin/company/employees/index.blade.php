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

@push('scripts')
<script>
    empRecDate.max = new Date().toISOString().split("T")[0];
    file_date.max = new Date().toISOString().split("T")[0];

    $('#example tbody').on('click', 'tr', function(e) {
        var tr = $(this).closest('tr');
        if (e.target.nodeName !== 'BUTTON' && e.target.nodeName !== 'I') window.location.href = "/admin/employee/"+ tr.attr('id');
        else{
            var name = tr.find('td').first().text();
            $('#deleteEmpName').html("<b>" + name + '</b> isimli çalışanı silmek istediğinize emin misiniz?');
            $('#empName').html("<b>" + name + '</b> isimli çalışan için dosya yükle');

            $('#deleteEmpRequest').click(function(){
                let action = $('#deleteEmpForm').attr('action');
                $('#deleteEmpForm').attr('action', action+"{{ $company->id }}"+"/deleteEmployee/"+tr.attr('id'));
            });

            $('#addEmpFileRequest').click(function(){
                let action = $('#addEmpFileForm').attr('action');
                $('#addEmpFileForm').attr('action', action + tr.attr('id'));
            });

            $('#addEmpIdentifyFileRequest').click(function(){
                let action = $('#addEmpIdentifyFileForm').attr('action');
                $('#addEmpIdentifyFileForm').attr('action', action + tr.attr('id'));
            });
        }
    });


    $('#deletedEmpTable tbody').on('click', 'tr', function(e) {
        var tr = $(this).closest('tr');
        if (e.target.nodeName !== 'BUTTON' && e.target.nodeName !== 'I') window.location.href = "/admin/employee/"+ tr.attr('id');

        else{
            var name = tr.find('td').first().text();
            $('#restoreEmpName').html("<b>" + name + '</b> isimli çalışanı işe geri almak istediğinize emin misiniz?');

            $('#restoreEmpRequest').click(function(){
                let action = $('#restoreEmpForm').attr('action');
                $('#restoreEmpForm').attr('action', action + tr.attr('id'));
            });
        }
    });

    $("#selectAll").on('click',function(){
        if ($("#selectAll").is(':checked'))
            $('#boxes').addClass('d-none');
        else
            $('#boxes').removeClass('d-none');
    });

    $('#file_type').on('change', function(){
        if ($('#file_type').val() == 12)
            $('#empFileDiv').removeClass('d-none');
        else
            $('#empFileDiv').addClass('d-none');
    });

    $('#batch_file_type').on('change', function(){
        if ($('#batch_file_type').val() == 12)
            $('#empBatchFileDiv').removeClass('d-none');
        else
            $('#empBatchFileDiv').addClass('d-none');
    });

    $('.custom-file-input').on('change',function(){
        $(this).next('.custom-file-label').html($(this).val());
    });
    
    $('#exampleFile').on('click', function(e) {
        window.location.href = "/files/company-employee-lists/employee-table.xlsx"
    });

    $(document).ready(function(){
        $("#searchBar").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#example tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    var pathArray = window.location.pathname.split('/');
    if (pathArray[pathArray.length-1] === "deleted"){
        $("#sc-tab").addClass("active");
        $("#silinen_calisanlar").addClass("active");
    }
    else{
        $("#isletme_calisanlar").addClass("active");
        $("#ic-tab").addClass("active");
    }
    
    $("#emp_item").on('click', function(event){
        event.preventDefault();
        $('#myTab a[href="#isletme_calisanlar"]').click();
    });
    $("#emp_del_item").on('click', function(event){
        event.preventDefault();
        $('#myTab a[href="#silinen_calisanlar"]').click();
    });

</script>
@endpush

@endsection