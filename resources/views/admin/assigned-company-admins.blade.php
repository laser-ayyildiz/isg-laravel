@extends('layouts.admin')
@section('title')Yetkilendirilen İşveren/vekilleri - @endsection
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
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Yetkilendirilen İşveren/vekilleri</b></h1>
    </div>
    <div class="card-body">
        <div class="float-sm-right mb-2">
            <button class="btn btn-danger" id="deleteBtn" data-toggle="modal" data-target="#deleteModal"
                data-whatever="@getbootstrap">Kullanıcı Sil</button>
        </div>
        <div class="table table-responsive mt-2">
            <table class="table table-striped table-bordered table-hover data-table" id="example">
                <thead class="thead-dark">
                    <tr>
                        <th>Ad Soyad</th>
                        <th>İşletme</th>
                        <th>E-mail</th>
                        <th>Telefon Numarası</th>
                        <th>İlişkiyi Kaldır</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($companyAdmins as $admin)
                    <tr>
                        <td>{{ $admin->user->name }}</td>
                        <td>{{ $admin->company->name }}</td>
                        <td>{{ $admin->user->email }}</td>
                        <td>{{ $admin->user->phone }}</td>
                        <td>
                            <form action="{{ route('admin.delete-company-admin-relation', ['relation' => $admin]) }}"
                                method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-sm btn-danger">İlişkiyi Kaldır</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Hiçbir İşveren/Vekili Yetkilendirilmesi Yapılmadı!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Kullanıcı Sil</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="deleteForm">
                    @method('DELETE')
                    @csrf
                    <div class="row my-2">
                        <div class="col-md-6">
                            <label for="list"><b>Silinecek kullanıcıyı seçiniz</b></label>
                            <select class="form-control" name="list" id="list" required>
                                <option disabled selected>Kullanıcı Seçiniz</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="float-right">
                            <button id="deleteRequestBtn" type="submit" class="btn btn-danger">Sil</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    var userData = null;
    $("#deleteBtn").on('click', function () {
        if (userData === null) {
            $.ajax({
                url: "/admin/get-all-company-admins",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dataType: 'json',
                data: "{}",
                success: function (data) {
                    data.forEach(element => {
                        $("#list").append("<option value='" + element.id + "'>" + element.name + " - " + element.email + "</option>");
                    });
                    userData = data;
                }
            });
        }
        $('#deleteRequestBtn').on('click', function () {
            $('#deleteForm').attr('action', "/admin/delete-company-admin/" + $('#list').val());
        });
    });
</script>
@endpush
@endsection
