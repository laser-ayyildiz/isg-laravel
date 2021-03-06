<div class="tab-pane fade" id="link4" role="tabpanel" aria-labelledby="link4-tab">
    <fieldset id="field4">
        <div class="modal-body">
            <div class="row col-6">
                <label for="nace_kodu">
                    <h4><b>NACE Kodu<a style="color:red">*</a></b></h4>
                </label>
                <input name="nace_kodu" class="form-control" type="text" value="{{ old('nace_kodu') }}"
                    placeholder="Nace Kodu" required maxlength="255">
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <label for="mersis_no">
                        <h4><b>Kurum Mersis No</b></h4>
                    </label>
                    <input class="form-control" id="mersis_no" name="mersis_no" type="tel"
                        value="{{ old('mersis_no') }}" maxlength="16" placeholder="Mersis No">
                </div>
                <div class="col-6">
                    <label for="sgk_sicil">
                        <h4><b>SGK Sicil No<a style="color:red">*</a></b></h4>
                    </label>
                    <input class="form-control" id="sgk_sicil" name="sgk_sicil" type="tel"
                        value="{{ old('sgk_sicil') }}" minlength="9" maxlength="26" placeholder="SGK Sicil No"
                        data-toggle="modal" data-target="#fill_modal" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <label for="vergi_no">
                        <h4><b>Vergi No<a style="color:red">*</a></b></h4>
                    </label>
                    <input class="form-control" id="vergi_no" name="vergi_no" type="tel" value="{{ old('vergi_no') }}"
                        maxlength="35" placeholder="Vergi No" required>
                </div>
                <div class="col-6">
                    <label for="vergi_dairesi">
                        <h4><b>Vergi Dairesi<a style="color:red">*</a></b></h4>
                    </label>
                    <input class="form-control" id="vergi_dairesi" name="vergi_dairesi" type="text"
                        value="{{ old('vergi_dairesi') }}" maxlength="255" placeholder="Vergi Dairesi" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    <label for="katip_is_yeri_id">
                        <h4><b>??SG-KAT??P ???? Yeri ID</b></h4>
                    </label>
                    <input class="form-control" id="katip_is_yeri_id" name="katip_is_yeri_id"
                        value="{{ old('katip_is_yeri_id') }}" type="tel" maxlength="30"
                        placeholder="??SG-KAT??P ???? Yeri ID">
                </div>
                <div class="col-6">
                    <label for="katip_kurum_id">
                        <h4><b>??SG-KAT??P Kurum ID</b></h4>
                    </label>
                    <input class="form-control" id="katip_kurum_id" name="katip_kurum_id" type="tel"
                        value="{{ old('katip_kurum_id') }}" maxlength="30" placeholder="??SG-KAT??P Kurum ID">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="float-left">L??tfen (*) bulunan alanlar?? doldurmay?? unutmay??n??z</div>
            <button type="button" class="btn btn-primary next" id="next4" name="next">Devam Et</button>
        </div>
    </fieldset>
</div>
