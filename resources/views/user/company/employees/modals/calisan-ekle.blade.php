<div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Yeni Çalışan Ata</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.company.addEmployee',['company' => $company]) }}" method="POST">
                    @csrf

                    <div class="row my-2">
                        <div class="col-sm-6">
                            <label for="empName"><b>Çalışan Adı Soyadı</b></label>
                            <input class="form-control" type="text" name="name" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="empPosition"><b>Görevi</b></label>
                            <input class="form-control" type="text" name="position">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-sm-6">
                            <label for="empTC"><b>T.C. Kimlik Numarası</b></label>
                            <input class="form-control" type="phone" minlength="11" maxlength="11" name="tc" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="empPhone"><b>Telefon Numarası</b></label>
                            <input class="form-control" type="phone" minlength="11" maxlength="11" name="phone">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-sm-8">
                            <label for="empEmail"><b>E-mail</b></label>
                            <input class="form-control" type="email" name="email">
                        </div>
                        <div class="col-sm-4">
                            <label for="empRecDate"><b>İşe Giriş Tarihi</b></label>
                            <input class="form-control" type="date" name="recruitment_date" id="empRecDate">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">Çalışan Ekle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
