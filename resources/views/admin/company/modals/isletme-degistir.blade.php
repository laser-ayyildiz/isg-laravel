<div class="modal fade" id="changeCompany" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.company.update',['company' => $company]) }}" method="POST">
                @csrf
                <div class="modal-c-tabs">
                    <ul class="nav nav-tabs justify-content-center bg-light" style="padding-top: 10px"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-dark" id="link1-tab" data-toggle="tab" href="#link1"
                                role="tab" aria-selected="true" aria-controls="link1">
                                <h5><b>İşletme Genel Bilgileri</b></h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" id="link2-tab" data-toggle="tab" role="tab" href="#link2"
                                aria-selected="false" aria-controls="link2">
                                <h5><b>Devlet Bilgileri</b></h5>
                            </a>
                        </li>
                        <div class="ml-auto">
                            <li>
                                <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </a>
                            </li>
                        </div>

                    </ul>


                    <div class="tab-content">
                        <div class="tab-pane fade in show active" id="link1" role="tabpanel"
                            aria-labelledby="link1-tab">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label for="comp_type">
                                            <h5><b>Sektör</b></h5>
                                        </label>
                                        <select class="form-control" id="type" name="type" required>
                                            <option value="{{ $company->type }}" selected>{{ $company->type }}
                                            </option>
                                            <option value="Hizmet">Hizmet</option>
                                            <option value="Sağlık">Sağlık</option>
                                            <option value="Sanayi">Sanayi</option>
                                            <option value="Tarım">Tarım</option>
                                            <option value="Diğer">Diğer</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="name">
                                            <h5><strong>İşletme Adı</strong></h5>
                                        </label>
                                        <input class="form-control" type="text" placeholder="Adı" name="name"
                                            id="name" maxlength="250" required value="{{ $company->name }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="mail">
                                            <h5><strong>İşletme Mail Adresi</strong></h5>
                                        </label>
                                        <input class="form-control" type="email" placeholder="E-mail" name="email"
                                            id="email" maxlength="125" required value="{{ $company->email }}">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="phone">
                                            <h5><strong>İşletme Telefon No</strong></h5>
                                        </label>
                                        <input class="form-control" type="tel" name="phone" id="phone"
                                            placeholder="Tel: 0XXXXXXXXXX" pattern="(\d{4})(\d{3})(\d{2})(\d{2})"
                                            maxlength="11" required value="{{ $company->phone }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="is_veren">
                                            <h5><strong>İşveren Ad Soyad</strong></h5>
                                        </label>
                                        <input class="form-control" type="tel" name="employer" id="employer"
                                            maxlength="50" required value="{{ $company->employer }}">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="countrySelect">
                                            <h5><strong>Bulunduğu Şehir<a style="color:red">*</a></strong></h5>
                                        </label>
                                        <select class="form-control" id="countrySelect" name="countrySelect"
                                            size="1" onchange="makeSubmenu(this.value)" required>
                                            <option value="{{ $company->city }}" selected>{{ $company->city }}
                                            </option>
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
                                            required>
                                            <option value="{{ $company->town }}" selected>{{ $company->town }}
                                            </option>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="contract_at">
                                            <h5><strong>İşletme Anlaşma Tarihi<a style="color:red">*</a></strong>
                                            </h5>
                                        </label>
                                        <input class="form-control" type="date" placeholder="Anlaşma Tarihi"
                                            name="contract_at" id="contract_at" required
                                            value="{{ $company->contract_at }}">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="address">
                                            <h5><b>Adres<a style="color:red">*</a></b></h5>
                                        </label>
                                        <textarea class="form-control" id="address" name="address" rows="3"
                                            style="max-width: 100%;" maxlength="2500"
                                            required>{{ $company->address }}</textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label for="remi_freq">
                                            <h5><b>Ziyaret Sıklığı</b></h5>
                                        </label>
                                        <select class="form-control" id="remi_freq" name="remi_freq" size="1"
                                            required>
                                            <option value="" disabled>Ziyaret Sıklığı Ayarla</option>
                                            <option value="{{ $company->remi_freq }}" selected>
                                                {{ $company->remi_freq }} Ay</option>
                                            <option value=1>1 Ay</option>
                                            <option value=2>2 Ay</option>
                                            <option value=3>3 Ay</option>
                                            <option value=4>4 Ay</option>
                                            <option value=5>5 Ay</option>
                                            <option value=6>6 Ay</option>
                                            <option value=7>7 Ay</option>
                                            <option value=8>8 Ay</option>
                                            <option value=9>9 Ay</option>
                                            <option value=10>10 Ay</option>
                                            <option value=11>11 Ay</option>
                                            <option value=12>12 Ay</option>
                                            <option value=18>18 Ay</option>
                                            <option value=24>24 Ay</option>
                                            <option value=36>36 Ay</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="link2" role="tabpanel" aria-labelledby="home-tab">
                            <div class="modal-body">
                                <div class="row col-3">
                                    <label for="nace_kodu">
                                        <h4><b>Kurum NACE Kodu</b></h4>
                                    </label>
                                    <input class="form-control" type="text" name="nace_kodu" required
                                        value="{{ $company->nace_kodu }}">
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="mersis_no">
                                            <h4><b>Kurum Mersis No Giriniz</b></h4>
                                        </label>
                                        <input class="form-control" id="mersis_no" name="mersis_no" type="tel"
                                            min="16" maxlength="16" required value="{{ $company->mersis_no }}">
                                    </div>
                                    <div class="col-6">
                                        <label for="sgk_sicil">
                                            <h4><b>SGK Sicil No Giriniz</b></h4>
                                        </label>
                                        <input class="form-control" id="sgk_sicil" name="sgk_sicil" type="tel"
                                            min="12" maxlength="12" required value="{{ $company->sgk_sicil }}">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="vergi_no">
                                            <h4><b>Vergi No Giriniz</b></h4>
                                        </label>
                                        <input class="form-control" id="vergi_no" name="vergi_no" type="tel"
                                            min="10" maxlength="10" required value="{{ $company->vergi_no }}">
                                    </div>
                                    <div class="col-6">
                                        <label for="vergi_dairesi">
                                            <h4><b>Vergi Dairesi Giriniz</b></h4>
                                        </label>
                                        <input class="form-control" id="vergi_dairesi" name="vergi_dairesi"
                                            type="text" required value="{{ $company->vergi_dairesi }}">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="katip_is_yeri_id">
                                            <h4><b>İSG-KATİP İş Yeri ID</b></h4>
                                        </label>
                                        <input class="form-control" id="katip_is_yeri_id" name="katip_is_yeri_id"
                                            type="tel" maxlength="30" required
                                            value="{{ $company->katip_is_yeri_id }}">
                                    </div>
                                    <div class="col-6">
                                        <label for="katip_kurum_id">
                                            <h4><b>İSG-KATİP Kurum ID</b></h4>
                                        </label>
                                        <input class="form-control" id="katip_kurum_id" name="katip_kurum_id"
                                            type="tel" maxlength="30" required
                                            value="{{ $company->katip_kurum_id }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-lg" type='submit' name='changeRequest'>Kaydet</button>
                </div>
            </form>
        </div>
    </div>

</div>