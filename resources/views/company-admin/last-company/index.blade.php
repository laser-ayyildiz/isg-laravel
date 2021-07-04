@extends('layouts.company-admin')
@section('title'){{ Str::title($company->name) }} - @endsection
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
        <h1><b>{{ Str::title($company->name) }}</b></h1>
        @include('company-admin.company.tabs.list')
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            @include('company-admin.company.tabs.genel-bilgiler')

            @include('company-admin.company.tabs.osgb-calisanlari')

            @include('company-admin.company.tabs.devlet-bilgileri')

            @include('company-admin.company.tabs.muhasebe-bilgileri')

            @include('company-admin.company.tabs.isletme-calisanlari')

            @include('company-admin.company.tabs.isletme-raporlari')

            @include('company-admin.company.tabs.silinen-calisanlar')
        </div><!-- tab content end -->
    </div><!-- card body end -->
</div>
<!--card end-->
@push('styles')

<link href="/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endpush

@push('scripts')
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
              ajax: "{{ route('company-admin.company',['id' => $company->id]) }}",
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
              ],
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
                }
          });

        $('#example tbody').on( 'click', '#empDetail', function () {
            var data = table.row( $(this).parents('tr') ).data();
            window.location.href = "/company-admin/employee/"+data['id']+"/company/{{ $company->id }}";
        });
    });
</script>
@endpush

@endsection