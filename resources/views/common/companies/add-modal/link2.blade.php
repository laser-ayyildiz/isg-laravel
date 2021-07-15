<div class="tab-pane fade" id="link2" role="tabpanel" aria-labelledby="link2-tab">
    <fieldset id="field2">
        <div class="modal-body">
            <div class="row">
                <div class="col-4">
                    <label for="danger_type">
                        <h5><b>Tehlike Sınıfı<a style="color:red">*</a></b></h5>
                    </label>
                    <select class="form-control mb-3" name="danger_type" required>
                        @if (old('danger_type'))
                        <option value="{{ old('danger_type') }}" selected>{{ old('danger_type') }}</option>
                        @else
                        <option value="" disabled selected>Tehlike Sınıfı</option>
                        @endif
                        <option value="1">Az Tehlikeli</option>
                        <option value="2">Tehlikeli</option>
                        <option value="3">Çok Tehlikeli</option>
                    </select>
                </div>
                <div class="col-4" id="sube-kodu-div"></div>

            </div>
            <div class="row">
                <div class="col-4">
                    <h5><b>Bu işletme bir grup şirketi mi?<a style="color:red">*</a></b></h5>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isGroup" id="gc-true" value="true" required>
                        <label class="form-check-label" for="gc-true">Evet</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isGroup" id="gc-false" value="false" checked>
                        <label class="form-check-label" for="gc-false">Hayır</label>
                    </div>
                </div>

                <div class="col-4" id="company-status-div"></div>

                <div class="col-4" id="leader-company-div"></div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-12">
                    <label for="bill_address">
                        <h5><b>Fatura Adresi<a style="color:red">*</a></b></h5>
                    </label>
                    <textarea class="form-control" id="bill_address" name="bill_address" rows="3"
                        style="max-width: 100%;" maxlength="2500" required>{{ old('bill_address') }}</textarea>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12">
                    <label for="address">
                        <h5><b>İş Yeri Adresi</a></b></h5>
                    </label>
                    <textarea class="form-control" id="address" name="address" rows="3" style="max-width: 100%;"
                        maxlength="2500">{{ old('address') }}</textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="float-left">Lütfen (*) bulunan alanları doldurmayı unutmayınız</div>
            <button type="button" class="btn btn-primary next" id="next2" name="next">Devam Et</button>
        </div>
    </fieldset>
</div>
