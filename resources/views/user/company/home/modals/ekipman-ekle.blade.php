<div class="modal fade" id="addEquipment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Ekipman Ekle</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add-equipment', ['company' => $company]) }}" method="post"
                    enctype="multipart/form-data">
                    <h3 class="text-center mb-5">{{ Str::title($company->name) }} işletmesi için ekipman ekle</h3>
                    @csrf
                    <div class="row my-2">
                        <div class="col-6">
                            <label for="eqName"><b>Ekipman Adı</b></label>
                            <input class="form-control" type="text" name="name" id="eqName" placeholder="Adı" required>
                        </div>
                        <div class="col-6">
                            <label for="period"><b>Bakım Sıklığı</b></label>
                            <select class="form-control" name="period" id="period" required>
                                <option selected disabled>Bakım Sıklığı Seçiniz</option>
                                <option value="1">1 Ay</option>
                                <option value="2">2 Ay</option>
                                <option value="3">3 Ay</option>
                                <option value="6">6 Ay</option>
                                <option value="9">9 Ay</option>
                                <option value="12">1 Yıl</option>
                                <option value="18">1,5 Yıl</option>
                                <option value="24">2 Yıl</option>
                                <option value="36">3 Yıl</option>
                                <option value="48">4 Yıl</option>
                                <option value="60">5 Yıl</option>
                                <option value="84">7 Yıl</option>
                                <option value="120">10 Yıl</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                                <label for="maintained_at"><b>Son Bakım Tarihi</b></label>
                                <input class="form-control" type="date" name="maintained_at" id="maintained_at">
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-12">
                            <div class="custom-file my-2">
                                <input type="file" name="file" class="custom-file-input" id="chooseEqFile">
                                <label class="custom-file-label" for="chooseEqFile"><b>Dosya Seç</b></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block mt-4 submitFile">
                            Ekle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>