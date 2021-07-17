<div class="modal fade" id="changeGroup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Grup Bilgilerini Düzenle</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.company.change-group-informations', ['company' => $company]) }}"
                method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h5><b>Bu işletme bir grup şirketi mi?<a style="color:red">*</a></b></h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="isGroup" id="gc-true" value="true"
                                    required>
                                <label class="form-check-label" for="gc-true">Evet</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="isGroup" id="gc-false" value="false"
                                    checked>
                                <label class="form-check-label" for="gc-false">Hayır</label>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-6" id="company-status-div"></div>
                        <div class="col-6" id="sube-kodu-div"></div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-12" id="leader-company-div"></div>
                    </div>
                    {{--
                        <div class="col-md-8">
                            <h5>Bu işletme bir grup şirketi mi?</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="isGroup"
                                    id="true">
                                <label class="form-check-label" for="true">
                                    Evet
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="isGroup"
                                    id="false" checked>
                                <label class="form-check-label" for="false">
                                    Hayır
                                </label>
                            </div>
                        </div>
                        --}}

                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Kaydet</button>
                </div>

        </div>
        </form>

    </div>
</div>
