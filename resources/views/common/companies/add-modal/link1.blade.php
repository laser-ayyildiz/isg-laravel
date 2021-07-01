<div class="tab-pane fade in show active" id="link1" role="tabpanel" aria-labelledby="link1-tab">
    <fieldset id="field1">
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <br>
                    <label class="input-group mb-3" for="type">
                        <h5><strong>İşletmenin çalıştığı sektörü seçiniz<a style="color:red">*</a></strong></h5>
                    </label>
                    <select class="form-control" name="type" id="type" autocomplete="off" required>
                        @if (old('type'))
                        <option value="{{ old('type') }}" selected>{{ old('type') }}</option>
                        @else
                        <option value="" disabled selected>Sektör</option>
                        @endif
                        <option value="Hizmet">Hizmet</option>
                        <option value="Sağlık">Sağlık</option>
                        <option value="Sanayi">Sanayi</option>
                        <option value="Tarım">Tarım</option>
                        <option value="Tekstil">Tekstil</option>
                        <option value="Altyapı">Altyapı</option>
                        <option value="Üstyapı">Üstyapı</option>
                        <option value="Mobilya İmalat">Mobilya İmalat</option>
                        <option value="Danışmanlık">Danışmanlık</option>
                        <option value="Eğitim">Eğitim</option>
                        <option value="Taşımacılık">Taşımacılık</option>
                        <option value="İnşaat">İnşaat</option>
                        <option value="Diğer">Diğer</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <label for="name">
                        <h5><strong>İşletme Adı<a style="color:red">*</a></strong></h5>
                    </label>
                    <input class="form-control" type="text" placeholder="Adı" name="name" id="name"
                        value="{{ old('name') }}" maxlength="250" required>
                </div>
                <div class="col-sm-6">
                    <label for="email">
                        <h5><strong>İşletme Mail Adresi<a style="color:red">*</a></strong></h5>
                    </label>
                    <input class="form-control" type="email" placeholder="E-mail" name="email" value="{{ old('email') }}"
                        id="email" maxlength="125" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <label for="phone">
                        <h5><strong>İşletme Telefon No<a style="color:red">*</a></strong></h5>
                    </label>
                    <input class="form-control" type="tel" name="phone" id="phone" placeholder="Tel: 0XXXXXXXXXX"
                        minlength="11" maxlength="11" value="{{ old('phone') }}" required>
                </div>
                <div class="col-sm-6">
                    <label for="employer">
                        <h5><strong>İşveren/Vekili Ad Soyad<a style="color:red">*</a></strong></h5>
                    </label>
                    <input class="form-control" type="text" name="employer" id="employer" placeholder="İşveren Ad Soyad"
                        value="{{ old('employer') }}" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="countrySelect">
                        <h5><strong>Bulunduğu Şehir<a style="color:red">*</a></strong></h5>
                    </label>
                    <select class="form-control" id="countrySelect" name="countrySelect" size="1"
                        onchange="makeSubmenu(this.value)" required>
                        @if (old('countrySelect'))
                        <option value="{{ old('countrySelect') }}" selected>
                            {{ old('countrySelect') }}</option>
                        @else
                        <option value="" disabled selected>Şehir</option>
                        @endif
                        <option>Adana</option>
                        <option>Adıyaman</option>
                        <option>Afyonkarahisar</option>
                        <option>Ağrı</option>
                        <option>Amasya</option>
                        <option>Ankara</option>
                        <option>Antalya</option>
                        <option>Artvin</option>
                        <option>Aydın</option>
                        <option>Balıkesir</option>
                        <option>Bilecik</option>
                        <option>Bingöl</option>
                        <option>Bitlis</option>
                        <option>Bolu</option>
                        <option>Burdur</option>
                        <option>Bursa</option>
                        <option>Çanakkale</option>
                        <option>Çankırı</option>
                        <option>Çorum</option>
                        <option>Denizli</option>
                        <option>Diyarbakır</option>
                        <option>Edirne</option>
                        <option>Elazığ</option>
                        <option>Erzincan</option>
                        <option>Erzurum</option>
                        <option>Eskişehir</option>
                        <option>Gaziantep</option>
                        <option>Giresun</option>
                        <option>Gümüşhane</option>
                        <option>Hakkâri</option>
                        <option>Hatay</option>
                        <option>Isparta</option>
                        <option>Mersin</option>
                        <option>İstanbul</option>
                        <option>İzmir</option>
                        <option>Kars</option>
                        <option>Kastamonu</option>
                        <option>Kayseri</option>
                        <option>Kırklareli</option>
                        <option>Kırşehir</option>
                        <option>Kocaeli</option>
                        <option>Konya</option>
                        <option>Kütahya</option>
                        <option>Malatya</option>
                        <option>Manisa</option>
                        <option>Kahramanmaraş</option>
                        <option>Mardin</option>
                        <option>Muğla</option>
                        <option>Muş</option>
                        <option>Nevşehir</option>
                        <option>Niğde</option>
                        <option>Ordu</option>
                        <option>Rize</option>
                        <option>Sakarya</option>
                        <option>Samsun</option>
                        <option>Siirt</option>
                        <option>Sinop</option>
                        <option>Sivas</option>
                        <option>Tekirdağ</option>
                        <option>Tokat</option>
                        <option>Trabzon</option>
                        <option>Tunceli</option>
                        <option>Şanlıurfa</option>
                        <option>Uşak</option>
                        <option>Van</option>
                        <option>Yozgat</option>
                        <option>Zonguldak</option>
                        <option>Aksaray</option>
                        <option>Bayburt</option>
                        <option>Karaman</option>
                        <option>Kırıkkale</option>
                        <option>Batman</option>
                        <option>Şırnak</option>
                        <option>Bartın</option>
                        <option>Ardahan</option>
                        <option>Iğdır</option>
                        <option>Yalova</option>
                        <option>Karabük</option>
                        <option>Kilis</option>
                        <option>Osmaniye</option>
                        <option>Düzce</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="citySelect">
                        <h5><strong>Bulunduğu İlçe<a style="color:red">*</a></strong></h5>
                    </label>
                    <select class="form-control" id="citySelect" name="citySelect" size="1"
                        value="{{ old('citySelect') }}" required>
                        @if (old('citySelect'))
                        <option value="{{ old('citySelect') }}" selected>{{ old('citySelect') }}
                        </option>
                        @else
                        <option value="" disabled selected>İlçe</option>
                        @endif
                        <option></option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="contract_at">
                        <h5><strong>İşletme Anlaşma Tarihi<a style="color:red">*</a></strong>
                        </h5>
                    </label>
                    <input class="form-control datepicker" type="date" placeholder="Anlaşma Tarihi" name="contract_at"
                        id="contract_at" value="{{ old('contract_at') }}" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="float-left">Lütfen (*) bulunan alanları doldurmayı unutmayınız</div>
            <button type="button" class="btn btn-primary next" id="next1" name="next">Devam Et</button>
        </div>
    </fieldset>
</div>