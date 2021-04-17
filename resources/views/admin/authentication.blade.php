@extends('layouts.admin')
@section('title')Yetkilendirme - @endsection
@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Çalışan Yetkilendir</b></h1>
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
                        <th>İşe Giriş Tarihi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="yetkilendir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yetkilendir</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="authentication.php" method="POST">
                            <div class="row col-sm-10">
                                <label><b>Kullanıcı adı</b></label>
                                <input class="form-control" name="username" value="" readonly>
                            </div>
                            <br>
                            <div class="row col-sm-10">
                                <label><b>Yetkilendirileceği işletmeyi seçin</b></label>
                                <select class="form-control" name="comp_name" required>
                                    <option value="" disabled>İş Yeri Seç</option>

                                </select>
                            </div>
                            <br>
                            <div style="float: right;">
                                <button id="yetkilendir" name="yetkilendir" type="submit"
                                    class="btn btn-success">Yetkilendir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="b" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yetkisini Kaldır</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="authentication.php" method="POST">
                            <div class="row col-sm-10">
                                <label><b>Kullanıcı adı</b></label>
                                <input class="form-control" name="username" value="" readonly>
                            </div>
                            <br>
                            <div class="row col-sm-10">
                                <label><b>Yetkilendirildiği işletmeler</b></label>
                                <select class="form-control" name="comp_name" required>
                                    <option value="" disabled>İş Yeri Seç</option>

                                </select>
                            </div>
                            <br>
                            <div style="float:left;">
                                <button id="hepsini_kaldır" name="hepsini_kaldır" type="submit"
                                    class="btn btn-warning">Bütün Yetkilerini Kaldır</button>
                            </div>
                            <div style="float: right;">
                                <button id="yetki_kaldır" name="yetki_kaldır" type="submit"
                                    class="btn btn-danger">Seçili Yetkisini Kaldır</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')

<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endpush

@push('scripts')
<script>
    rec_date.max = new Date().toISOString().split("T")[0];
        recruitment_date.max = new Date().toISOString().split("T")[0];
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    $(function () {
              var table = $('.data-table').DataTable({
                  processing: true,
                  serverSide: true,
                  DT_RowId: true,
                  ajax: "{{ route('admin.authentication') }}",
                  columns: [
                      {data: 'name', name: 'name'},
                      {data: 'job.name', name: 'job.name'},
                      {data: 'phone', name: 'phone'},
                      {data: 'email', name: 'email'},
                      {data: 'tc', name: 'tc'},
                      {data: 'recruitment_date', name: 'recruitment_date'}
                  ],
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
                    }
              });

              $('#example tbody').on('click', 'tr', function () {
                var data = table.row( this ).data();
                var job = data['job'];

                $('#yetkilendir').modal('show');
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
