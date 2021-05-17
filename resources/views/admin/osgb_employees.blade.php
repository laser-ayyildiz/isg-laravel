@extends('layouts.admin')
@section('title')OSGB Çalışanları - @endsection
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
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Çalışanlar</b></h1>
    </div>

    <div class="card-body">
        <div id="dataTable_filter">
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                    data-whatever="@getbootstrap">Yeni Çalışan Ekle</button>
                <button type="button" class="btn btn-danger"
                    onclick="window.location.href='{{ route('admin.deleted_employees') }}'">Arşiv
                </button>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Çalışan Bilgileri</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.osgb_employees.create') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="job_id"><strong>Kullanıcı türünü seçin</strong></label>
                                        <select class="form-control" list="job_id" name="job_id" required>
                                            <option value="" disabled selected>Kullanıcı Türü</option>
                                            <optgroup label="İsg Uzmanı">
                                                <option value="1">İsg Uzmanı 1</option>
                                                <option value="2">İsg Uzmanı 2</option>
                                                <option value="3">İsg Uzmanı 3</option>
                                            </optgroup>
                                            <option value="4">Doktor</option>
                                            <option value="5">Sağlık Personeli</option>
                                            <option value="6">Ofis Personeli</option>
                                            <option value="7">Muhasebeci</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="name"><strong>Ad Soyad</strong></label>
                                        <input type="text" class="form-control" placeholder="Ad Soyad" name="name"
                                            required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-10">
                                        <label for="email"><strong>E-mail </strong></label>
                                        <input type="email" class="form-control" placeholder="E-mail" name="email"
                                            required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="phone"><strong>Telefon No </strong></label>
                                        <input type="tel" class="form-control" name="phone"
                                            placeholder="Tel: 05XXXXXXXXX" pattern="(\d{4})(\d{3})(\d{2})(\d{2})"
                                            maxlength="11" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="rec_date"><strong>İşe Giriş Tarihi </strong></label>
                                        <input type="date" class="form-control" name="rec_date" id="rec_date" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="tc"><strong>T.C Kimlik No </strong></label>
                                        <input type="tel" class="form-control" placeholder="T.C Kimlik No" name="tc"
                                            minlength="11" maxlength="11" required>
                                    </div>
                                </div>
                                <br>
                                <div style="float: right;">
                                    <button name="saveRequest" type="submit" class="btn btn-success">Kaydet</button>
                                    <button type="reset" class="btn btn-danger">Sıfırla</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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

    </div>
    <div class="modal fade" id="düzenle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.osgb_employees.handle') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <label><strong>Kullanıcı türünü seçin</strong></label>
                                <select class="form-control" placeholder="Kullanıcı Türünü seçin" list="job_id"
                                    name="job_id" id="job_id" required>
                                    <option disabled selected>
                                    </option>
                                    <optgroup label="İsg Uzmanı">
                                        <option value="1">İsg Uzmanı 1</option>
                                        <option value="2">İsg Uzmanı 2</option>
                                        <option value="3">İsg Uzmanı 3</option>
                                    </optgroup>
                                    <option value="4">Doktor</option>
                                    <option value="5">Sağlık Personeli</option>
                                    <option value="6">Ofis Personeli</option>
                                    <option value="7">Muhasebeci</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name"><strong>Adı</strong></label>
                                <input type="text" class="form-control" placeholder="Adı" name="name" id="name"
                                    required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-10">
                                <label for="email"><strong>E-mail </strong></label>
                                <input type="email" class="form-control" placeholder="E-mail" name="email" id="email"
                                    required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="phone"><strong>Telefon No </strong></label>
                                <input type="tel" class="form-control" name="phone" placeholder="Tel: 05XXXXXXXXX"
                                    maxlength="11" value="" id="phone" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="recruitment_date"><strong>İşe Giriş Tarihi </strong></label>
                                <input type="date" class="form-control" placeholder="İşe giriş" name="recruitment_date"
                                    id="recruitment_date" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="tc"><strong>T.C Kimlik No </strong></label>
                                <input type="number" class="form-control" placeholder="T.C Kimlik No" name="tc" min="11"
                                    maxlength="11" id="tc" required>
                            </div>
                        </div>
                        <br>
                        <label for="delete_not"><strong>Çalışan hakkında not </strong></label>
                        <textarea class="form-control" id="delete_not" name="delete_not" rows="5" cols="120"
                            style="max-width: 100%;"></textarea>
                        <br>
                        <div style="float: right;">
                            <input type="hidden" name="userId" id="userId" value="">
                            <button type="submit" class="btn btn-success" name="changeRequest">Kaydet</button>
                            <button type="submit" class="btn btn-danger" name="deleteRequest">Sil</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
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
                  autoWidth: false,
                  responsive: true,
                  ajax: "{{ route('admin.osgb_employees') }}",
                  columns: [
                      {data: 'name', name: 'name'},
                      {data: 'job.name', name: 'job.name'},
                      {data: 'email', name: 'email'},
                      {data: 'phone', name: 'phone'},
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
                $('#düzenle').modal('show');
                $("#userId").val(data['id']);
                $("#name").val(data['name']);
                $("#email").val(data['email']);
                $("#phone").val(data['phone']);
                $("#tc").val(data['tc']);
                $("#recruitment_date").val(data['recruitment_date']);
                $("#delete_not").val(data['delete_not']);
                $("#job_id").val(job.id);
            });
        });
</script>
@endpush