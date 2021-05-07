@extends('layouts.admin')
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
                        <th>Telefon</th>
                        <th>E-mail</th>
                        <th>Silinme Tarihi</th>
                        <th>Sil/Aktifleştir</th>
                        <th>Görüntüle</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="sil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Durumunu Değiştir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="deleteForm" action="/admin/deleted_companies/delete/" method="POST">
                    @csrf
                    <button id="deleteRequest" name="deleteRequest" type="submit"
                        class="btn btn-danger float-left">Tamamen
                        Sil</button>
                </form>
                <form id="activateForm" action="/admin/deleted_companies/update/" method="POST">
                    @csrf
                    <button id="activateRequest" name="activateRequest" type="submit"
                        class="btn btn-warning float-right">Tekrar
                        Aktifleştir</button>
                </form>

            </div>
        </div>
    </div>
</div>

@push('styles')
<!--  -->
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
              ajax: "{{ route('admin.deleted_companies') }}",
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'phone', name: 'phone'},
                  {data: 'email', name: 'email'},
                  {data: 'deleted_at', render: function (data, type, row) {
                      let date = data.toString().match(/([0-9]{4}-[0-9]{2}-[0-9]{2})T(.*)/);
                        return type === 'export' ? data : date[1]
                    }
                  },
                  {
                    data: null,
                    render: function ( data, type, row ) {
                        return '<button type="button" id="requestButton" class="btn btn-warning" data-toggle="modal" data-target="#sil">Sil/Aktifleştir</button>';
                    }
                  },
                  {
                    data: null,
                    render: function ( data, type, row ) {
                        return '<button type="button" id="showButton" class="btn btn-primary">Şirketi Görüntüle</button>';
                    }
                  },
              ],
              "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
                }
          });

          $('#example tbody').on( 'click', '#requestButton', function () {
            var data = table.row( $(this).parents('tr') ).data();

            $('#activateRequest').click(function(){
                let action = $('#activateForm').attr('action');
                $('#activateForm').attr('action', action+data['id']);
            });

            $('#deleteRequest').click(function(){
                let action = $('#deleteForm').attr('action');
                $('#deleteForm').attr('action', action+data['id']);
            });
        });
        
        $('#example tbody').on( 'click', '#showButton', function () {
            var data = table.row( $(this).parents('tr') ).data();
            window.location.href="/admin/company/deleted/"+data['id'];
        }); 
    });
</script>
@endpush
@endsection