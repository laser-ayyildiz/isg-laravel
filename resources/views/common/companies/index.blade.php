@extends('layouts.common')
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
    @include('common.companies.card-body')
</div>

@include('common.companies.add-modal.index')
@include('common.companies.sgk-sicil')

@push('styles')
{{-- dataTable --}}
<link href="/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endpush

@push('scripts')
<script>
    contract_at.max = new Date().toISOString().split("T")[0];
</script>
<script src="/js/core/common/companies/modal-validation.js"></script>
<script src="/js/core/common/companies/group-comp.js"></script>
<script src="/js/core/city-town.js"></script>
{{-- dataTable --}}
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap5.min.js"></script>
<script src="/js/jquery.validate.js"></script>

@php
if (auth()->user()->hasRole('Admin'))
$ajax = route('admin.companies.index');
else
$ajax = route('user.companies.index');
@endphp

<script type="text/javascript">
    $(function () {
          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              DT_RowId: true,
              responsive: true,
              autoWidth: false,
              ajax: "{{ $ajax }}",
              "order": [[ 6, "asc" ]],
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'sube_kodu', name: 'sube_kodu'},
                  {data: 'type', name: 'type'},
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
</script>
@endpush

@endsection
