<div class="modal fade" id="addEmpIdentifyFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Dosya Yükle</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" id="addEmpIdentifyFileForm">
                    <h5 class="mx-2" id="empName">
                    </h5>
                    @csrf
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="name"><b>Dosya Adı</b></label>
                            <input class="form-control" type="text" name="name" placeholder="Dosya Adı" required>
                        </div>
                        <div class="col-6">
                            <label for="file_date"><b>Dosya Tarihi</b></label>
                            <input class="form-control" type="date" name="file_date">
                        </div>
                    </div>
                    <div class="custom-file my-4">
                        <input type="file" name="file" class="custom-file-input" id="chooseEmpIdentifyFile" required>
                        <label class="custom-file-label" for="chooseFile"><b>Dosya Seç</b></label>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="file_type" value="8">
                        <button type="submit" class="btn btn-primary btn-block mt-4" id="addEmpIdentifyFileRequest">
                            Yükle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>