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
            <h1><b>{{ Str::upper($company->name) }}</b></h1>
            @include('admin.company.employees.tabs.list')
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                @include('admin.company.employees.tabs.isletme-calisanlari')

                @include('admin.company.employees.tabs.silinen-calisanlar')
            </div>
        </div>
    </div>
</div>
<div name="modals">

    @include('admin.company.employees.modals.calisan-ekle')

    @include('admin.company.employees.modals.calisan-sil')

    @include('admin.company.employees.modals.calisanlara-dosya-ata')

</div>

@push('styles')

<link href="/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endpush

@push('scripts')
<script>
    empRecDate.max = new Date().toISOString().split("T")[0];
</script>
<script src="/js/core/city-town.js"></script>
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap5.min.js"></script>
<script src="/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(function () {
          var table = $('#example').DataTable({
              processing: true,
              serverSide: true,
              DT_RowId: true,
              autoWidth: false,
              responsive: true,
              ajax: "{{ route('admin.company.employees',['id' => $company->id,'tab' => 'isletme-calisanlari']) }}",
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'tc', name: 'tc'},
                  {data: 'phone', name: 'phone'},
                  {data: 'email', name: 'email'},
                  {data: 'recruitment_date', name: 'recruitment_date'},
                  {
                    data: null,
                    render: function ( data, type, row ) {
                        return '<button type="button" id="deleteEmpBtn" class="btn btn-danger" data-toggle="modal" data-target="#deleteEmpModal">Sil</button>';
                    }
                  },
              ],
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
                }
          });
          $('#example tbody').on('click', 'tr', function (e) {
            if (e.target.nodeName !== 'BUTTON') {
                var data = table.row( this ).data();
                window.location.href = "/admin/employee/"+data['id'];       
            }     
        });
        $('#example tbody').on('click', '#deleteEmpBtn', function (e) {
            var data = table.row( $(this).parents('tr') ).data();
            $('#deleteEmpName').html("<b>" + data['name'] + '</b> isimli çalışanı silmek istediğinize emin misiniz?');

            $('#deleteEmpRequest').click(function(){
                let action = $('#deleteEmpForm').attr('action');
                $('#deleteEmpForm').attr('action', action+"{{ $company->id }}"+"/deleteEmployee/"+data['id']);
            });
        });

    });
</script>

<script>
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