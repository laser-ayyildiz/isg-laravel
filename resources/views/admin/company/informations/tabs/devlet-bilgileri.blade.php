<div class="tab-pane fade show" id="devlet_bilgileri"
    role="tabpanel" aria-labelledby="db-tab">
    <div class="row col-lg-6">
        <label for="nace_kodu">
            <h4><b>NACE Kodu</b></h4>
        </label>
        <input type="text" name="nace_kodu" id="nace_kodu" class="form-control" value="{{ $company->nace_kodu ?? ''}}">
    </div>
    <br>
    <div class="row">
        <div class="col-6">
            <label for="mersis_no">
                <h4><b>Kurum Mersis No</b></h4>
            </label>
            <input class="form-control" id="mersis_no" name="mersis_no" type="tel" min="16" maxlength="16"
                placeholder="Mersis No" value="{{ $company->mersis_no }}">
        </div>
        <div class="col-6">
            <label for="sgk_sicil">
                <h4><b>SGK Sicil No</b></h4>
            </label>
            <input class="form-control" id="sgk_sicil" name="sgk_sicil" type="tel" min="12" maxlength="12"
                placeholder="SGK Sicil No" value="{{ $company->sgk_sicil }}">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-6">
            <label for="vergi_no">
                <h4><b>Vergi No</b></h4>
            </label>
            <input class="form-control" id="vergi_no" name="vergi_no" type="tel" min="10" maxlength="10"
                placeholder="Vergi No" value="{{ $company->vergi_no }}">
        </div>
        <div class="col-6">
            <label for="vergi_dairesi">
                <h4><b>Vergi Dairesi</b></h4>
            </label>
            <input class="form-control" id="vergi_dairesi" name="vergi_dairesi" type="text" maxlength="500"
                placeholder="Vergi Dairesi" value="{{ $company->vergi_dairesi }}">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-6">
            <label for="katip_is_yeri_id">
                <h4><b>İSG-KATİP İş Yeri ID</b></h4>
            </label>
            <input class="form-control" id="katip_is_yeri_id" name="katip_is_yeri_id" type="tel" maxlength="30"
                placeholder="İSG-KATİP İş Yeri ID" value="{{ $company->katip_is_yeri_id }}">
        </div>
        <div class="col-6">
            <label for="katip_kurum_id">
                <h4><b>İSG-KATİP Kurum ID</b></h4>
            </label>
            <input class="form-control" id="katip_kurum_id" name="katip_kurum_id" type="tel" maxlength="30"
                placeholder="İSG-KATİP Kurum ID" value="{{ $company->katip_kurum_id }}">
        </div>
    </div>
</div>