<div class="tab-pane fade show" id="genel_bilgiler" role="tabpanel"
    aria-labelledby="gb-tab">
    <div class="form-row">
        <div class="form-group col-lg-3">
            <label for="comp_type_show">
                <h5><b>Sektör</b></h5>
            </label>
            <input class="form-control" id="comp_type_show" name="comp_type_show" required value="{{$company->type}}">
            </select>
        </div>
        <div class="form-group col-lg-4">
            <label for="is_veren_show">
                <h5><b>İşveren Ad Soyad</b></h5>
            </label>
            <input class="form-control" id="is_veren_show" name="is_veren_show" required value="{{$company->employer}}">
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-lg-4">
            <label for="mail">
                <h5><b>Mail Adresi</b></h5>
            </label>
            <input type="text" class="form-control" name="mail" id="mail" value="{{$company->email}}" required>
        </div>
        <div class="form-group col-lg-4">
            <label for="phone">
                <h5><b>Telefon No</b></h5>
            </label>
            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Tel: 0XXXXXXXXXX"
                pattern="(\d{4})(\d{3})(\d{2})(\d{2})" maxlength="11" required value="{{$company->phone}}"></label>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-lg-12">
            <label for="address">
                <h5><b>Fatura Adresi</b></h5>
            </label>
            <textarea class="form-control" id="bill_address" name="bill_address" rows="3" style="max-width: 100%;"
                maxlength="2500" required>{{$company->bill_address}}</textarea>
        </div>
    </div>
    @isset($company->address)
    <div class="form-row">
        <div class="form-group col-lg-12">
            <label for="address">
                <h5><b>İş Yeri Adresi</b></h5>
            </label>
            <textarea class="form-control" id="address" name="address" rows="3" style="max-width: 100%;"
                maxlength="2500" required>{{$company->address}}</textarea>
        </div>
    </div>
    @endisset
    <div class="form-row">
        <div class="form-group col-lg-4">
            <label for="contract_at">
                <h5><b>Anlaşma Tarihi</b></h5>
            </label>
            <input type="date" class="form-control" name="contract_at" id="contract_at"
                value="{{$company->contract_at}}" required>
        </div>
        <div class="form-group col-lg-4">
            <label for="countrySelect">
                <h5><b>Şehir</b></h5>
            </label>
            <input class="form-control" required value="{{$company->city}}">
        </div>
        <div class="form-group col-lg-4">
            <label for="citySelect">
                <h5><b>İlçe</b></h5>
            </label>
            <input class="form-control" required value="{{$company->town}}">
        </div>
    </div>
</div>