<div class="modal fade" id="assignEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Yeni Kullanıcı Oluştur</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.company.assignEmployee',['company' => $company]) }}"
                    id="authenticateForm" method="POST">
                    @csrf
                    <div class="row col-sm-10">
                        <label><b>Şirket adı</b></label>
                        <input class="form-control" name="userName" id="userName"
                            value="{{ Str::title($company->name) }}" readonly>
                    </div>
                    <br>
                    <div class="row col-sm-10">
                        <label><b>Yetkilendirileceği işletmeyi seçin</b></label>
                        <select class="form-control" name="user" required>
                            <option value="" disabled>Çalışan</option>
                            @foreach ($allEmployees->get() as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
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