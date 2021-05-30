<div class="tab-pane fade" id="link2" role="tabpanel" aria-labelledby="link2-tab">
    <div class="modal-body">
        <div class="row">
            <div class="col-4">
                <label for="danger_type">
                    <h5><b>Tehlike Sınıfı<a style="color:red">*</a></b></h5>
                </label>
                <select class="form-control mb-3" name="danger_type" required>
                    <option value="{{ $company->danger_type }}" selected>
                        @if ($company->danger_type == 1)Az Tehlikeli
                        @elseif ($company->danger_type == 2)Tehlikeli
                        @elseif ($company->danger_type == 3)Çok Tehlikeli
                        @endif
                    </option>

                    <option value="1">Az Tehlikeli</option>
                    <option value="2">Tehlikeli</option>
                    <option value="3">Çok Tehlikeli</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <label for="bill_address">
                    <h5><b>Fatura Adresi<a style="color:red">*</a></b></h5>
                </label>
                <textarea class="form-control" name="bill_address" rows="3" style="max-width: 100%;"
                    maxlength="2500" required>{{ $company->bill_address }}</textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <label for="address">
                    <h5><b>İş Yeri Adresi</a></b></h5>
                </label>
                <textarea class="form-control" name="address" rows="3" style="max-width: 100%;"
                    maxlength="2500">{{ $company->address }}</textarea>
            </div>
        </div>
    </div>
</div>