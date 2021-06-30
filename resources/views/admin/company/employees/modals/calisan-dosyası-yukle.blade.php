<div class="modal fade" id="addEmpFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Dosya Yükle</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/upload-file/" method="POST" enctype="multipart/form-data" id="addEmpFileForm">
                    <h5 class="mx-2" id="empName">
                    </h5>
                    @csrf

                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="file_type"><b>Dosya Tipi</b></label>
                            <select class="form-control" name="file_type" id="file_type" required>
                                <option selected disabled>Dosya Tipini Seçiniz...</option>
                                <option value="1">İSG Eğitimi 1</option>
                                <option value="2">İSG Eğitimi 2</option>
                                <option value="3">Sağlık Muayenesi</option>
                                <option value="4">İlk Yardım Sertifikası</option>
                                <option value="5">Yangın Eğitim Sertifikası</option>
                                <option value="6">Mesleki Yeterlilik Sertifikası</option>
                                <option value="7">Hijyen Eğitim Sertifikası</option>
                                <option value="8">Özlük Dosyası Evrakları</option>
                                <option value="12">Diğer</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 d-none" id="empFileDiv">
                            <label for="name"><b>Dosya Adı</b></label>
                            <input class="form-control" type="text" name="name" placeholder="Dosya Adı">
                        </div>
                        <div class="col-6">
                            <label for="file_date"><b>Dosya Tarihi</b></label>
                            <input class="form-control" type="date" name="file_date">
                        </div>
                    </div>
                    <div class="custom-file my-4">
                        <input type="file" name="file" class="custom-file-input" id="chooseEmpFile" required>
                        <label class="custom-file-label" for="chooseFile"><b>Dosya Seç</b></label>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block mt-4" id="addEmpFileRequest">
                            Yükle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>