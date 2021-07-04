@extends('layouts.company-admin')
@section('title')İşletmelerim - @endsection
@section('content')

<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>İşletmelerim</b></h1>
    </div>
    <div class="card-body">
        <div class="table table-responsive mt-2">
            <table class="table table-striped table-bordered table-hover data-table" id="companies-table">
                <thead class="thead-dark">
                    <tr>
                        <th>İşletme Adı</th>
                        <th>Sektör</th>
                        <th>Telefon</th>
                        <th>E-mail</th>
                        <th>Şehir</th>
                        <th>İlçe</th>
                    </tr>
                </thead>
                <tbody style="cursor: pointer">
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('styles')
{{-- dataTable --}}
<link href="/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endpush

@push('scripts')
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
              ajax: "{{ route('company-admin.companies') }}",
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'type', name: 'type'},
                  {data: 'phone', name: 'phone'},
                  {data: 'email', name: 'email'},
                  {data: 'city', name: 'city'},
                  {data: 'town', name: 'town'}
              ],
              "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
                }
          });
          $('#companies-table tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            window.location.href="company/"+data['id'];
            });
    });
</script>

@endpush

@endsection