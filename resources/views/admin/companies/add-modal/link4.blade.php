<div class="tab-pane fade" id="link4" role="tabpanel" aria-labelledby="link4-tab">
    <div class="modal-body">
        <div class="row col-6">
            <label for="nace_kodu">
                <h4><b>NACE Kodu<a style="color:red">*</a></b></h4>
            </label>
            <input name="nace_kodu" class="form-control" type="text" value="{{ old('nace_kodu') }}"
                placeholder="Nace Kodu">
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <label for="mersis_no">
                    <h4><b>Kurum Mersis No<a style="color:red">*</a></b></h4>
                </label>
                <input class="form-control" id="mersis_no" name="mersis_no" type="tel" value="{{ old('mersis_no') }}"
                    maxlength="16" placeholder="Mersis No">
            </div>
            <div class="col-6">
                <label for="sgk_sicil">
                    <h4><b>SGK Sicil No<a style="color:red">*</a></b></h4>
                </label>
                <input class="form-control" id="sgk_sicil" name="sgk_sicil" type="tel" value="{{ old('sgk_sicil') }}"
                    maxlength="26" placeholder="SGK Sicil No">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <label for="vergi_no">
                    <h4><b>Vergi No<a style="color:red">*</a></b></h4>
                </label>
                <input class="form-control" id="vergi_no" name="vergi_no" type="tel" value="{{ old('vergi_no') }}"
                    maxlength="10" placeholder="Vergi No">
            </div>
            <div class="col-6">
                <label for="vergi_dairesi">
                    <h4><b>Vergi Dairesi<a style="color:red">*</a></b></h4>
                </label>
                <input class="form-control" id="vergi_dairesi" name="vergi_dairesi" type="text"
                    value="{{ old('vergi_dairesi') }}" maxlength="500" placeholder="Vergi Dairesi">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <label for="katip_is_yeri_id">
                    <h4><b>İSG-KATİP İş Yeri ID</b></h4>
                </label>
                <input class="form-control" id="katip_is_yeri_id" name="katip_is_yeri_id"
                    value="{{ old('katip_is_yeri_id') }}" type="tel" maxlength="30" placeholder="İSG-KATİP İş Yeri ID">
            </div>
            <div class="col-6">
                <label for="katip_kurum_id">
                    <h4><b>İSG-KATİP Kurum ID</b></h4>
                </label>
                <input class="form-control" id="katip_kurum_id" name="katip_kurum_id" type="tel"
                    value="{{ old('katip_kurum_id') }}" maxlength="30" placeholder="İSG-KATİP Kurum ID">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="float-left">Lütfen (*) bulunan alanları doldurmayı unutmayınız</div>
    </div>
</div>