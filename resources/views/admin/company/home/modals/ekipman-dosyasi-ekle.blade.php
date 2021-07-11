<div class="modal fade" id="addEquipmentFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Ekipman için Bakım Dosyası Yükle</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post"
                    enctype="multipart/form-data">
                    <h3 class="text-center mb-5">{{ Str::title($company->name) }} işletmesinin ekipmanları için bakım dosya yükle</h3>
                    @csrf
                    <div class="row my-2">
                        <div class="col-6">
                            <label for="equipment"><b>Ekipman</b></label>
                            <select class="form-control" name="equipment" id="equipment" required>
                                <option selected disabled>Ekipmanı Seçiniz</option>
                                @foreach ($equipments as $equipment)
                                    <option value="{{ $equipment->id }}">{{ $equipment->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="file_maintained_at"><b>Bakım Tarihi</b></label>
                            <input class="form-control" type="date" name="maintained_at" id="file_maintained_at">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12">
                            <div class="custom-file my-4">
                                <input type="file" name="file" class="custom-file-input" id="chooseEquipmentMaintainFile"
                                    required>
                                <label class="custom-file-label" for="chooseEquipmentMaintainFile"><b>Dosya Seç</b></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block mt-4 submitFile">
                            Yükle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>