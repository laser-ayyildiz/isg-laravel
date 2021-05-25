@extends('layouts.admin')
@section('title')İşletmeler - @endsection
@section('content')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
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
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>İşletmeler</b></h1>
    </div>
    @include('admin.companies.card-body')
</div>

@include('admin.companies.add-modal.index')

@push('styles')
{{-- dataTable --}}
<link href="/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endpush

@push('scripts')
<script>
    contract_at.max = new Date().toISOString().split("T")[0];
</script>
<script src="/js/core/admin/companies/group-comp.js"></script>
<script src="/js/core/city-town.js"></script>
{{-- dataTable --}}
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap5.min.js"></script>
<script src="/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(function () {
          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              DT_RowId: true,
              responsive: true,
              autoWidth: false,
              ajax: "{{ route('admin.companies.index') }}",
              "order": [[ 6, "asc" ]],
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'type', name: 'type'},
                  {data: 'phone', name: 'phone'},
                  {data: 'email', name: 'email'},
                  {data: 'city', name: 'city'},
                  {data: 'town', name: 'town'},
                  {data: 'contract_at', name: 'contract_at'}
              ],
              "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
                }
          });
          $('#example tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            window.location.href="company/"+data['id'];

            });
    });
</script>
<script>
    function populateList() {
        var data = @json($companies->get());
        for( var i = 0; i<data.length; i++){
            var id = data[i]['id'];
            var name = data[i]['name'];
            $("#leader-company-select").append("<option value='"+id+"'>"+name+"</option>");
        }
    }
</script>

@endpush

@endsection