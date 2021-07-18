<div class="modal fade" id="newAssignment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Yeni Atama</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add-employee-group', ['company' => $company]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row my-2">
                        <div class="col-6">
                            <label for="employee_type"><b>Çalışan Tipi</b></label>
                            <select class="form-control" name="employee_type" id="employee_type" required>
                                <option selected disabled>Çalışan Tipini Seçiniz</option>
                                <option value="1">İSG Uzmanı</option>
                                <option value="2">İş Yeri Hekimi</option>
                                <option value="3">İşveren</option>
                                <option value="4">Çalışan Temsilcisi</option>
                                <optgroup label="Acil Durum Ekibi">
                                    <option value="Ekipler Şefi">Ekipler Şefi</option>
                                    <option value="Arama, Kurtarma, Tahliye Ekibi">Arama, Kurtarma, Tahliye Ekibi
                                    </option>
                                    <option value="Yangın Söndürme Ekibi">Yangın Söndürme Ekibi</option>
                                    <option value="İlk Yardım Ekibi">İlk Yardım Ekibi</option>
                                </optgroup>
                                <optgroup label="Risk Değerlendirme Ekibi">
                                    <option value="Destek Elemanı">Destek Elemanı</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="employee"><b>Çalışan</b></label>
                            <select class="form-control" name="employee" id="employee" required>
                                <option selected disabled>Çalışan Seçiniz</option>
                            </select>
                        </div>
                    </div>
                    <div class="row my-3 d-none" id="isveren-div">
                        <div class="col-md-6">
                            <label for="isveren"><b>İşveren/Vekili Ad Soyad</b></label>
                            <input class="form-control" type="text" name="isveren" id="isveren">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-12">
                            <div class="custom-file my-2">
                                <input type="file" name="file" class="custom-file-input" id="chooseAssignmentFile">
                                <label class="custom-file-label" for="chooseAssignmentFile"><b>Atama Dosyası
                                        Seç</b></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block mt-4">
                            Atama
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
