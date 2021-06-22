<div class="modal fade" id="addEmployerAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>İşveren/vekili için hesap oluştur</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('assign-company-admin',['company' => $company]) }}" method="POST">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <label for="name"><b>İşveren/vekili Adı Soyadı<a style="color:red">*</a></b></label>
                            <input class="form-control" type="text" name="name" value="{{ $company->employer }}" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="email"><b>Email<a style="color:red">*</a></b></label>
                            <input class="form-control" type="email" name="email" value="{{ $company->email }}" required>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-6">
                            <label for="tc"><b>T.C. Kimlik Numarası</b></label>
                            <input class="form-control" type="phone" minlength="11" maxlength="11" name="tc">
                        </div>
                        <div class="col-sm-6">
                            <label for="phone"><b>Telefon Numarası</b></label>
                            <input class="form-control" type="phone" minlength="11" maxlength="11" name="phone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">Hesap Oluştur</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>