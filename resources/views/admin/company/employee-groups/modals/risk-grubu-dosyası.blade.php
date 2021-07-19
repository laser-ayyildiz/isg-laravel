<div class="modal fade" id="riskGroupFileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Yeni Atama</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('risk-group-file-add', ['company' => $company]) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row my-2">
                        <div class="col-12">
                            <legend>{{ $company->name }} işletmesi için Risk Değerlendirme Ekibi Raporu yükle</legend>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-12">
                            <div class="custom-file my-4">
                                <input type="file" name="file" class="custom-file-input" required>
                                <label class="custom-file-label"><b>Risk Değerlendirme Raporu Seç</b></label>
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
