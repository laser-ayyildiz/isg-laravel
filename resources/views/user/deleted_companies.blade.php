@extends('layouts.user')
@section('title')Silinen İşletmeler - @endsection
@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@elseif (session('fail'))
<div class="alert alert-danger">
    {{ session('fail') }}
</div>
@endif

<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Silinen İşletmeler</b></h1>
    </div>
    <div class="card-body">
        <div class="table table-responsive mt-2">
            <table class="table table-striped table-bordered table-hover data-table" id="example">
                <thead class="thead-dark">
                    <tr>
                        <th>İşletme Adı</a></th>
                        <th>Sektör</th>
                        <th>Telefon</th>
                        <th>E-mail</th>
                        <th>Şehir</th>
                        <th>İlçe</th>
                        <th>Silinme Tarihi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('styles')

<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endpush

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
    $(function () {
          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              DT_RowId: true,
              responsive: true,
              autoWidth: false,
              ajax: "{{ route('user.deleted_companies') }}",
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'type', name: 'type'},
                  {data: 'phone', name: 'phone'},
                  {data: 'email', name: 'email'},
                  {data: 'city', name: 'city'},
                  {data: 'town', name: 'town'},
                  {data: 'deleted_at', render: function (data, type, row) {
                      let date = data.toString().match(/([0-9]{4}-[0-9]{2}-[0-9]{2})T(.*)/);
                        return type === 'export' ? data : date[1]
                    }
                }
              ],
              "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
                }
          });
          $('#example tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            window.location.href="/user/company/deleted/"+data['id'];
            });
        });
</script>
@endpush
@endsection