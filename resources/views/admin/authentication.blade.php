@extends('layouts.admin')
@section('title')Yetkilendirme - @endsection
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
        <div class="modal fade" id="employeeAuthentication" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yetkilendir</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/admin/authentication/update/" id="authenticateForm" method="POST">
                            @csrf
                            <div class="row col-sm-10">
                                <label><b>Kullanıcı adı</b></label>
                                <input class="form-control" name="userName" id="userName" value="" readonly>
                            </div>
                            <br>
                            <div class="row col-sm-10">
                                <label><b>Yetkilendirileceği işletmeyi seçin</b></label>
                                <select class="form-control" name="company" required>
                                    <option value="" disabled>İş Yeri Seç</option>
                                    @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div style="float: right;">
                                <button id="authenticate" name="yetkilendir" type="submit"
                                    class="btn btn-success">Yetkilendir</button>
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
                  ajax: "{{ route('admin.authentication') }}",
                  columns: [
                      {data: 'name', name: 'name'},
                      {data: 'job.name', name: 'job.name'},
                      {data: 'phone', name: 'phone'},
                      {data: 'email', name: 'email'},
                      {data: 'tc', name: 'tc'},
                      {data: 'recruitment_date', name: 'recruitment_date'},
                  ],
                  "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
                    }
              });

              $('#example tbody').on('click', 'tr', function () {

                var data = table.row( this ).data();
                var job = data['job'];

                $('#employeeAuthentication').modal('show');
                $("#userId").val(data['id']);
                $("#name").val(data['name']);
                $("#email").val(data['email']);
                $("#phone").val(data['phone']);
                $("#tc").val(data['tc']);
                $("#recruitment_date").val(data['recruitment_date']);
                $("#job_id").val(job.id);
                $("#userName").val(data['name']);

                $('#authenticate').click(function(){
                    let action = $('#authenticateForm').attr('action');
                    $('#authenticateForm').attr('action', action+data['id']);
                });


            });
        });
</script>
@endpush
@endsection