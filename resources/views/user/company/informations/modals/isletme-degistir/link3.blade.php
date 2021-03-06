<div class="tab-pane fade" id="link3" role="tabpanel" aria-labelledby="link3-tab">
    <div class="modal-body">
        <div class="row col-6">
            <label for="nace_kodu">
                <h4><b>NACE Kodu<a style="color:red">*</a></b></h4>
            </label>
            <input name="nace_kodu" class="form-control" type="text" value="{{  $company->nace_kodu }}"
                placeholder="Nace Kodu" required maxlength="255">
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <label for="mersis_no">
                    <h4><b>Kurum Mersis No</b></h4>
                </label>
                <input class="form-control" name="mersis_no" type="tel" value="{{  $company->mersis_no }}"
                     placeholder="Mersis No">
            </div>
            <div class="col-6">
                <label for="sgk_sicil">
                    <h4><b>SGK Sicil No<a style="color:red">*</a></b></h4>
                </label>
                <input class="form-control" name="sgk_sicil" type="tel" value="{{  $company->sgk_sicil }}"
                     placeholder="SGK Sicil No" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <label for="vergi_no">
                    <h4><b>Vergi No<a style="color:red">*</a></b></h4>
                </label>
                <input class="form-control" name="vergi_no" type="tel" value="{{  $company->vergi_no }}"  placeholder="Vergi No" required>
            </div>
            <div class="col-6">
                <label for="vergi_dairesi">
                    <h4><b>Vergi Dairesi<a style="color:red">*</a></b></h4>
                </label>
                <input class="form-control" name="vergi_dairesi" type="text" value="{{  $company->vergi_dairesi }}"
                    maxlength="255" placeholder="Vergi Dairesi" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6">
                <label for="katip_is_yeri_id">
                    <h4><b>??SG-KAT??P ???? Yeri ID</b></h4>
                </label>
                <input class="form-control" name="katip_is_yeri_id" value="{{  $company->katip_is_yeri_id }}" type="tel" placeholder="??SG-KAT??P ???? Yeri ID">
            </div>
            <div class="col-6">
                <label for="katip_kurum_id">
                    <h4><b>??SG-KAT??P Kurum ID</b></h4>
                </label>
                <input class="form-control" name="katip_kurum_id" type="tel" value="{{  $company->katip_kurum_id }}" placeholder="??SG-KAT??P Kurum ID">
            </div>
        </div>
    </div>
</div>
