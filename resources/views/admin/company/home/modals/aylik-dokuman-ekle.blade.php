<div class="modal fade" id="addMonthlyFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Dosya Yükle</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('monthly-file-upload',['company' => $company]) }}" method="post"
                    enctype="multipart/form-data">
                    <h3 class="text-center mb-5">{{ Str::title($company->name) }} işletmesi için dosya yükle</h3>
                    @csrf
                    <div class="row my-2">
                        <div class="col-6">
                            <label for="monthly_file_type"><b>Dosya Tipi</b></label>
                            <select class="form-control" name="file_type" id="monthly_file_type" required>
                                <option selected disabled>Seç...</option>
                                <option value="9">Defter Nüshası</option>
                                <option value="10">Saha Gözlem Raporu</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="monthly_assigned_at"><b>Dosya Oluşturulma Tarihi</b></label>
                            <input class="form-control" type="date" name="assigned_at" id="monthly_assigned_at">
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-12">
                            <div class="custom-file my-4">
                                <input type="file" name="file" class="custom-file-input" id="chooseMonthlyFile"
                                    required>
                                <label class="custom-file-label" for="chooseMonthlyFile"><b>Dosya Seç</b></label>
                            </div>
                        </div>
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