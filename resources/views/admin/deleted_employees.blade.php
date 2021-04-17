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
                        <th>İşten Ayrılma Tarihi</th>
                    </tr>
                </thead>
                <tbody>

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
                        <form action="deleted_workers.php" method="POST">
                            <div class="col-sm-6">
                                <label><strong>Kullanıcı türü</strong>
                                    <select class="form-control" name="user_type" readonly id="user_type">
                                        <option value="" disabled selected>
                                        </option>
                                    </select>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="firstname"><strong>Adı</strong>
                                        <input type="text" class="form-control" placeholder="Adı" name="firstname"
                                            value="" readonly></label>
                                </div>
                                <div class="col-sm-6">
                                    <label for="lastname"><strong>Soy Adı </strong>
                                        <input type="text" class="form-control" placeholder="Soy Adı" name="lastname"
                                            value="" readonly></label>
                                </div>
                            </div>
                            <br>
                            <div class="col-sm-12">
                                <label for "email"><strong>E-mail </strong>
                                    <input type="email" class="form-control" placeholder="E-mail" name="email" value=""
                                        readonly></label>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="phone"><strong>Telefon No </strong>
                                        <input type="tel" class="form-control" name="phone"
                                            placeholder="Tel: 05XXXXXXXXX" pattern="(\d{4})(\d{3})(\d{2})(\d{2})"
                                            maxlength="11" value="" readonly></label>
                                </div>
                                <div class="col-sm-6">
                                    <label for="start_date"><strong>İşe Giriş Tarihi </strong>
                                        <input type="date" class="form-control" placeholder="İşe giriş"
                                            name="start_date" value="" readonly></label>
                                </div>
                            </div>
                            <br>
                            <label for="tc"><strong>T.C Kimlik No </strong>
                                <input type="number" class="form-control" placeholder="T.C Kimlik No" name="tc" min="11"
                                    maxlength="11" value="" readonly></label>
                            <br>
                            <label for="not"><strong>Çalışan hakkında not </strong>
                                <textarea class="form-control" id="not" name="not" rows="5" cols="120"
                                    style="max-width: 100%;"></textarea></label>
                            <br>
                            <div style="float: right;">
                                <button id="kaydet" name="kaydet" type="submit" class="btn btn-success">Notu
                                    Kaydet</button>
                                <button id="tamamen_sil" name="tamamen_sil" type="submit" class="btn btn-danger">Tamamen
                                    Sil</button>
                                <button id="tekrar" name="tekrar" type="submit" class="btn btn-warning">Tekrar
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
              serverSide: true,
              DT_RowId: true,
              ajax: "{{ route('admin.deleted_employees') }}",
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'job.name', name: 'job.name'},
                  {data: 'phone', name: 'phone'},
                  {data: 'email', name: 'email'},
                  {data: 'tc', name: 'tc'},
                  {data: 'deleted_at', name: 'deleted_at'}
              ],
              "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
                }
          });

          $('#example tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            var job = data['job'];

            $('#düzenle').modal('show');
            $("#userId").val(data['id']);
            $("#name").val(data['name']);
            $("#email").val(data['email']);
            $("#phone").val(data['phone']);
            $("#tc").val(data['tc']);
            $("#recruitment_date").val(data['recruitment_date']);
            $("#job_id").val(job.id);


        });
    });
</script>
@endpush
@endsection
