@extends('layouts.admin')
@section('title')Silinen Çalışanlar - @endsection
@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Çalışan Arşivi</b></h1>
    </div>
    <div class="card-body">
        <div class="table table-responsive mt-2">
            <table class="table table-striped table-bordered table-hover data-table" id="example">
                <thead class="thead-dark">
                    <tr>
                        <th>Ad Soyad</th>
                        <th>Çalışma Alanı</th>
                        <th>E-mail</th>
                        <th>Telefon Numarası</th>
                        <th>T.C Kimlik No</th>
                        <th>İşten Çıkış Tarihi</th>
                    </tr>
                </thead>
                <tbody class="body">
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="düzenle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Bilgiler</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.deleted_employees.handle') }}" method="POST">
                            @csrf
                            <div class="mt-1 mx-1">
                                <label for="job_id" class="mt-1"><strong>Kullanıcı türü</strong></label>
                                <input class="form-control" name="job_id" id="job_id" value="" readonly />
                            </div>
                            <div class="row">
                                <div class="mt-1 ml-3">
                                    <label class="mt-1" for="name"><strong>Adı</strong></label>
                                    <input type="text" class="form-control" name="name" id="name" value="" readonly>
                                </div>
                            </div>
                            <div class="mt-1  mx-1">
                                <label class="mt-1" for="email"><strong>E-mail </strong></label>
                                <input type="email" class="form-control" name="email" id="email" value="" readonly>
                            </div>
                            <div class="row">
                                <div class="mt-1 mx-3">
                                    <label class="mt-1" for="phone"><strong>Telefon No </strong></label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="" readonly>
                                </div>
                                <div class="mt-1">
                                    <label class="mt-1" for="recruitment_date"><strong>İşten Çıkış
                                            Tarihi</strong></label>
                                    <input class="form-control" name="deleted_at" id="deleted_at" value="" readonly>
                                </div>
                            </div>
                            <label class="mt-1 ml-1" for="tc"><strong>T.C Kimlik No </strong></label>
                            <input class="form-control mt-1  mx-1" value="" name="tc" id="tc" readonly>
                            <label class="mt-2  ml-1" for="delete_not"><strong>Çalışan hakkında not</strong></label>
                            <textarea class="form-control mt-1" id="delete_not" name="delete_not" rows="5" cols="120"
                                style="max-width: 100%;"></textarea>
                                <input type="hidden" name="userId" id="userId" value=""/>
                            <div class="float-right my-2">
                                <button id="deleteRequest" name="deleteRequest" type="submit" class="btn btn-danger">Tamamen
                                    Sil</button>
                                <button id="activateRequest" name="activateRequest" type="submit" class="btn btn-warning">Tekrar
                                    Aktifleştir</button>
                            </div>
                        </form>
                    </div>
                </div>
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
              responsive: true,
              serverSide: true,
              autoWidth: false,
              DT_RowId: true,
              ajax: "{{ route('admin.deleted_employees') }}",
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'job.name', name: 'job.name'},
                  {data: 'phone', name: 'phone'},
                  {data: 'email', name: 'email'},
                  {data: 'tc', name: 'tc'},
                  {data: 'deleted_at', render: function (data, type, row) {
                      let date = data.toString().match(/([0-9]{4}-[0-9]{2}-[0-9]{2})T(.*)/);
                        return type === 'export' ?
                        data : date[1]
                }
            }
              ],
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
                }
          });

          $('#example tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            var job = data['job'];
            var date = data['deleted_at'];
            date = date.toString().match(/([0-9]{4}-[0-9]{2}-[0-9]{2})T(.*)/);

            $('#düzenle').modal('show');
            $("#userId").val(data['id']);
            $("#name").val(data['name']);
            $("#email").val(data['email']);
            $("#phone").val(data['phone']);
            $("#tc").val(data['tc']);
            $("#deleted_at").val(date[1]);
            $("#delete_not").val(data['delete_not']);
            $("#job_id").val(job.name);
        });
    });
</script>

@endpush
@endsection
