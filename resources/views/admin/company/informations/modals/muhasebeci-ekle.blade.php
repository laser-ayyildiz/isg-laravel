<div class="modal fade" id="addAcc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Muhasebeci Ekle</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.company.add-accountant', ['company' => $company]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <h3 style="text-align: center;"><u><b>Ön Muhasebe</b></u></h3>
                    <div class="row my-3">
                        <div class="col-6">
                            <label for="front_acc_name">
                                <h5><b>Ön Muhasebe Ad Soyad</h5></b>
                            </label>
                            <input class="form-control" type="text" name="front_acc_name"
                                value="{{ old('front_acc_name') }}" placeholder="Ad Soyad">
                        </div>
                        <div class="col-6">
                            <label for="front_acc_email">
                                <h5><b>Ön Muhasebe Email</h5></b>
                            </label>
                            <input class="form-control" type="email" name="front_acc_email"
                                value="{{ old('front_acc_email') }}" placeholder="Email">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-6">
                            <label for="front_acc_phone">
                                <h5><b>Ön Muhasebe Telefon No</h5></b>
                            </label>
                            <input class="form-control" type="text" name="front_acc_phone"
                                value="{{ old('front_acc_phone') }}" placeholder="05XXXXXXXXX" maxlength="11">
                        </div>
                    </div>
                    <hr style="border-top: 1px dashed red;">
                    <h3 style="text-align: center;"><u><b>Dış Muhasebe</b></u></h3>
                    <div class="row my-3">
                        <div class="col-6">
                            <label for="out_acc_name">
                                <h5><b>Dış Muhasebe Ad Soyad</h5></b>
                            </label>
                            <input class="form-control" type="text" name="out_acc_name"
                                value="{{ old('out_acc_name') }}" placeholder="Ad Soyad">
                        </div>
                        <div class="col-6">
                            <label for="out_acc_email">
                                <h5><b>Dış Muhasebe Email</h5></b>
                            </label>
                            <input class="form-control" type="email" name="out_acc_email"
                                value="{{ old('out_acc_email') }}" placeholder="Email">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-6">
                            <label for="out_acc_phone">
                                <h5><b>Dış Muhasebe Telefon No</h5></b>
                            </label>
                            <input class="form-control" type="phone" name="out_acc_phone"
                                value="{{ old('out_acc_phone') }}" placeholder="05XXXXXXXXX" maxlength="11">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="saveBtn" type="submit">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>