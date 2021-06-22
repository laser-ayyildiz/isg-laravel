<div class="modal fade" id="addMandatoryFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Dosya Yükle</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('mandatory-file-upload',['company' => $company]) }}" method="post"
                    enctype="multipart/form-data">
                    <h3 class="text-center mb-5">{{ Str::title($company->name) }} işletmesi için dosya yükle</h3>
                    @csrf
                    <div class="row my-2">
                        <div class="col-6">
                            <label for="file_type"><b>Dosya Tipi</b></label>
                            <select class="form-control" name="file_type" required>
                                <option selected disabled>Seç...</option>
                                <option value="1">İş Yeri Uzman Sözleşmesi</option>
                                <option value="2">İş Yeri Hekim Sözleşmesi</option>
                                <option value="3">Acil Durum Eylem Planı</option>
                                <option value="4">Risk Analizi Dosyası</option>
                                <option value="5">Yıllık Çalışma Planı</option>
                                <option value="6">Yıllık Eğitim Programı</option>
                                <option value="7">Dsp Sözleşmesi</option>
                                <option value="8">Yıl Sonu Değerlendirme Raporu</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="assigned_at"><b>Dosya Oluşturulma Tarihi</b></label>
                            <input class="form-control" type="date" name="assigned_at" id="assigned_at">
                        </div>
                    </div>
                    <div class="custom-file my-4">
                        <input type="file" name="file" class="custom-file-input" id="chooseFile" required>
                        <label class="custom-file-label" for="chooseFile"><b>Dosya Seç</b></label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block mt-4">
                            Yükle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>