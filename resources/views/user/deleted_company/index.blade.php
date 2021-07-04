@extends('layouts.user')
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
        @include('user.deleted_company.tabs.list')
    </div>
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            @include('user.deleted_company.tabs.genel-bilgiler')

            @include('user.deleted_company.tabs.devlet-bilgileri')

            @include('user.deleted_company.tabs.muhasebe-bilgileri')

            @include('user.deleted_company.tabs.isletme-calisanlari')

            @include('user.deleted_company.tabs.isletme-raporlari')
        </div><!-- tab content end -->
    </div><!-- card body end -->
</div>
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
              ajax: "{{ route('user.deleted_company',['id' => $company->id,'tab' => 'isletme-calisanlari']) }}",
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'tc', name: 'tc'},
                  {data: 'phone', name: 'phone'},
                  {data: 'email', name: 'email'},
                  {data: 'recruitment_date', name: 'recruitment_date'},
              ],
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
                }
          });
          $('#example tbody').on('click', 'tr', function (e) {
                var data = table.row( this ).data();
                window.location.href = "/user/employee/" + data['id']+ "/company/" + {{ $company->id }};
        });
    });
</script>
@endpush

@endsection