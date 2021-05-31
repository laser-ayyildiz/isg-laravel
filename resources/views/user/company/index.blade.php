@extends('layouts.user')
@section('title'){{ Str::title($company->name) }} - @endsection
@section('content')

@if (session('existRequest'))
<div class="alert alert-warning">
    {{ session('existRequest') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {!! session('success') !!}
</div>
@elseif (session('fail'))
<div class="alert alert-danger">
    {{ session('fail') }}
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
        <h1><b>{{ Str::title($company->name) }}</b></h1>
        @include('user.company.tabs.list')
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            @include('user.company.tabs.genel-bilgiler')

            @if ($deleted == false)
            @include('user.company.tabs.osgb-calisanlari')
            @endif

            @include('user.company.tabs.devlet-bilgileri')

            @include('user.company.tabs.muhasebe-bilgileri')

            @include('user.company.tabs.isletme-calisanlari')

            @include('user.company.tabs.isletme-raporlari')

            @if ($deleted == false)
            @include('user.company.tabs.silinen-calisanlar')
            @endif
        </div><!-- tab content end -->
    </div><!-- card body end -->
</div>
<!--card end-->

<div name="modals">
    @if ($deleted == false)
    @include('user.company.modals.isletme-silme-talebi')
    @include('user.company.modals.isletme-degistir')
    @include('user.company.modals.yeni-calisan-ata')
    @include('user.company.modals.calisan-ekle')
    @include('user.company.modals.calisan-sil')
    @include('user.company.modals.zorunlu-dokuman-ekle')
    @include('user.company.modals.muhasebeci-ekle')
    @include('admin.company.modals.calisanlara-dosya-ata')
    @endif
</div>
@push('styles')

<link href="/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endpush

@push('scripts')
<script>
    empRecDate.max = new Date().toISOString().split("T")[0];
    assigned_at.max = new Date().toISOString().split("T")[0];
</script>
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
              ajax: "{{ route('user.company',['id' => $company->id ]) }}",
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'tc', name: 'tc'},
                  {data: 'phone', name: 'phone'},
                  {data: 'email', name: 'email'},
                  {data: 'recruitment_date', name: 'recruitment_date'},
                  {
                    data: null,
                    render: function ( data, type, row ) {
                        return '<button type="button" id="empDetail" class="btn btn-primary"">Detaylar</button>';
                    }
                  },
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
          $('#example tbody').on( 'click', '#deleteEmpBtn', function () {
            var data = table.row( $(this).parents('tr') ).data();
            $('#deleteEmpName').html("<b>" + data['name'] + '</b> isimli çalışanı silmek istediğinize emin misiniz?');

            $('#deleteEmpRequest').click(function(){
                let action = $('#deleteEmpForm').attr('action');
                $('#deleteEmpForm').attr('action', action+"{{ $company->id }}"+"/deleteEmployee/"+data['id']);
            });
        });
        $('#example tbody').on( 'click', '#empDetail', function () {
            var data = table.row( $(this).parents('tr') ).data();
            window.location.href = "/user/employee/"+data['id']+"/company/{{ $company->id }}";
        });
    });
</script>
<script>
    $('#chooseBatchFile').on('change',function(){
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })
</script>
@endpush
@if ($deleted == false)
@push('scripts')
<script src="/js/core/city-town.js"></script>
@endpush
@endif

@endsection