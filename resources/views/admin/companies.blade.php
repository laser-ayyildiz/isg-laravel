@extends('layouts.admin')
@section('title')İşletmeler - @endsection
@section('content')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<div class="card shadow-lg">
    <div class="card-header">
        <h1 class="text-dark mb-1 text-center"><b>İşletmeler</b></h1>
    </div>

    <div class="card-body">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addCompany" data-whatever="@getbootstrap">Yeni
            İşletme Ekle</a>

        <button type="button" onclick="window.location.href='{{ route('change_validate') }}'"
            class="btn btn-success ml-1">Onay Bekleyenler</button>

        <button type="button" onclick="window.location.href='{{ route('deleted_companies') }}'"
            class="btn btn-danger ml-1">Arşiv</button>

        <div class="table table-responsive mt-2">
            <table class="table table-striped table-bordered table-hover data-table" id="example">
                <thead class="thead-dark">
                    <tr>
                        <th>İşletme Adı</a></th>
                        <th>Sektör</th>
                        <th>Telefon</th>
                        <th>E-mail</th>
                        <th>Şehir</th>
                        <th>İlçe</th>
                        <th>Anlaşma Tarihi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form action="{{ route('companies') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-c-tabs">
                    <ul class="nav nav-tabs justify-content-center bg-light" style="padding-top: 10px" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-dark" id="link1-tab" data-toggle="tab" href="#link1"
                                role="tab" aria-selected="true" aria-controls="link1">
                                <h5><b>İşletme Genel Bilgileri</b></h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" id="link2-tab" data-toggle="tab" role="tab" href="#link2"
                                aria-selected="false" aria-controls="link2">
                                <h5><b>OSGB Çalışanları</b></h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" id="link3-tab" data-toggle="tab" role="tab" href="#link3"
                                aria-selected="false" aria-controls="link3">
                                <h5><b>Devlet Bilgileri</b></h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" type="nav-link" class="nav-link" data-dismiss="modal" aria-label="Close"
                                style="color:red;">
                                <h5><b>Kapat</b></h5>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in show active" id="link1" role="tabpanel"
                            aria-labelledby="link1-tab">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <br>
                                        <label class="input-group mb-3" for="type">
                                            <h5><strong>İşletmenin çalıştığı sektörü seçiniz<a
                                                        style="color:red">*</a></strong></h5>
                                        </label>
                                        <select class="form-control" name="type" id="type" autocomplete="off"
                                            required />
                                        <option value="" disabled selected>Sektör</option>
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
                                            <h5><strong>İşletme Adı<a style="color:red">*</a></strong></h5>
                                        </label>
                                        <input class="form-control" type="text" placeholder="Adı" name="name" id="name"
                                            maxlength="250" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="email">
                                            <h5><strong>İşletme Mail Adresi<a style="color:red">*</a></strong></h5>
                                        </label>
                                        <input class="form-control" type="email" placeholder="E-mail" name="email"
                                            id="email" maxlength="125" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="phone">
                                            <h5><strong>İşletme Telefon No<a style="color:red">*</a></strong></h5>
                                        </label>
                                        <input class="form-control" type="tel" name="phone" id="phone"
                                            placeholder="Tel: 0XXXXXXXXXX" pattern="(\d{4})(\d{3})(\d{2})(\d{2})"
                                            maxlength="11" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="employer">
                                            <h5><strong>İşveren Ad Soyad<a style="color:red">*</a></strong></h5>
                                        </label>
                                        <input class="form-control" type="text" name="employer" id="employer"
                                            placeholder="İşveren Ad Soyad" maxlength="50" required>
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
                                            <option value="">Şehir</option>
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
                                            <option value="" disabled selected>İlçe</option>
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="contract_at">
                                            <h5><strong>İşletme Anlaşma Tarihi<a style="color:red">*</a></strong>
                                            </h5>
                                        </label>
                                        <input class="form-control" type="date" placeholder="Anlaşma Tarihi"
                                            name="contract_at" id="contract_at" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="address">
                                            <h5><b>Adres<a style="color:red">*</a></b></h5>
                                        </label>
                                        <textarea class="form-control" id="address" name="address" rows="3"
                                            style="max-width: 100%;" maxlength="2500" required></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="remi_freq">
                                            <h5><b>Periyodik Muayene Aralığı</b></h5>
                                        </label>
                                        <select class="form-control" id="remi_freq" name="remi_freq" size="1">
                                            <option value="">Periyodik Muayene Aralığı</option>
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
                            <div class="modal-footer">
                                <button class="btn btn-primary next" id="next1" name="next1">Devam Et</button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="link2" role="tabpanel" aria-labelledby="link2-tab">
                            <div class="modal-body">
                                <h3 style="text-align: center;"><u><b>İsg Uzmanı Seç</b></u></h3>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="uzman_id">
                                            <h6><b>1. İsg Uzmanı</b></h6>
                                        </label>
                                        <select class="form-control" name="uzman_id" id="uzman_id" autocomplete="off"
                                            size="1">
                                            <option value="" disabled selected><b>1. İsg Uzmanı</b></option>


                                            </option>

                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="uzman_id_2">
                                            <h6><b>2. İsg Uzmanı</b></h6>
                                        </label>
                                        <select class="form-control" name="uzman_id_2" id="uzman_id_2"
                                            autocomplete="off" size="1">
                                            <option value="" disabled selected>2. İsg Uzmanı</option>

                                            </option>

                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="uzman_id_3">
                                            <h6><b>3. İsg Uzmanı</b></h6>
                                        </label>
                                        <select class="form-control" name="uzman_id_3" id="uzman_id_3"
                                            autocomplete="off" size="1">
                                            <option value="" disabled selected>3. İsg Uzmanı</option>

                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <hr style="border-top: 1px dashed red;">

                                <h3 style="text-align: center;"><u><b>İş Yeri Hekimi Seç</b></u></h3>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="hekim_id">
                                            <h6><strong>1.İş Yeri Hekimi</strong></h6>
                                        </label>
                                        <select class="form-control" name="hekim_id" id="hekim_id" autocomplete="off"
                                            size="1">
                                            <option value="" disabled selected>İş Yeri Hekimi</option>

                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="hekim_id_2">
                                            <h6><strong>2.İş Yeri Hekimi</strong></h6>
                                        </label>
                                        <select class="form-control" name="hekim_id_2" id="hekim_id_2"
                                            autocomplete="off" size="1">
                                            <option value="" disabled selected>İş Yeri Hekimi</option>

                                            <option value=""></option>

                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="hekim_id_3">
                                            <h6><strong>3.İş Yeri Hekimi</strong></h6>
                                        </label>
                                        <select class="form-control" name="hekim_id_3" id="hekim_id_3"
                                            autocomplete="off" size="1">
                                            <option value="" disabled selected>İş Yeri Hekimi</option>

                                        </select>
                                    </div>
                                </div>
                                <hr style="border-top: 1px dashed red;">

                                <h3 style="text-align: center;"><u><b>Personel Seç</b></u></h3>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="saglık_p_id"><strong>Diğer Sağlık Personeli</strong></label>
                                        <select class="form-control" name="saglık_p_id" id="saglık_p_id"
                                            autocomplete="off" size="1">
                                            <option value="" disabled selected>Diğer Sağlık Personeli</option>

                                            <option value=""></option>

                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="ofis_p_id"><strong>Ofis Personeli</strong></label>
                                        <select class="form-control" name="ofis_p_id" id="ofis_p_id" autocomplete="off"
                                            size="1">
                                            <option value="" disabled selected>Ofis Personeli</option>

                                            <option value=""></option>

                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="muhasebe_p_id"><strong>Muhasebe Personeli</strong></label>
                                        <select class="form-control" name="muhasebe_p_id" id="muhasebe_p_id"
                                            autocomplete="off" size="1">
                                            <option value="" disabled selected>Muhasebe Personeli</option>

                                            <option value=""></option>

                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="saglık_p_id_2"><strong>2.Diğer Sağlık Personeli</strong></label>
                                        <select class="form-control" name="saglık_p_id_2" id="saglık_p_id_2"
                                            autocomplete="off" size="1">
                                            <option value="" disabled selected>2.Diğer Sağlık Personeli</option>

                                            <option value=""></option>

                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="ofis_p_id_2"><strong>2.Ofis Personeli</strong></label>
                                        <select class="form-control" name="ofis_p_id_2" id="ofis_p_id_2"
                                            autocomplete="off" size="1">
                                            <option value="" disabled selected>2.Ofis Personeli</option>

                                            <option value=""></option>

                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="muhasebe_p_id_2"><strong>2.Muhasebe Personeli</strong></label>
                                        <select class="form-control" name="muhasebe_p_id_2" id="muhasebe_p_id_2"
                                            autocomplete="off" size="1">
                                            <option value="" disabled selected>2.Muhasebe Personeli</option>

                                            <option value=""></option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger previous">Geri Git</button>
                                <button class="btn btn-primary next" id="next2" name="next2">Devam Et</button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="link3" role="tabpanel" aria-labelledby="home-tab">
                            <div class="modal-body">
                                <div class="row col-12">
                                    <label for="nace_kodu">
                                        <h4><b>NACE Kodunu Seçiniz</b></h4>
                                    </label>
                                    <select name="nace_kodu" class="form-control" required>
                                        <option value="" disabled selected>NACE Kodunu Seçiniz</option>
                                        <option value="81.22.03">Nesne veya binaların (ameliyathaneler vb.)
                                            sterilizasyonu faaliyetleri.Binalar ile ilgili hizmetler ve çevre
                                            düzenlemesi faaliyetleri 3</option>
                                        <option value="82.20.01">Çağrı merkezlerinin faaliyetleri 2</option>
                                        <option value="86.90.17">İnsan sağlığı hizmetleri 3</option>
                                        <option value="85.59.16">Çocuk kulüplerinin faaliyetleri (6 yaş ve üzeri
                                            çocuklar için) 1</option>
                                        <option value="71.12.14">Yapı denetim kuruluşları 1</option>
                                        <option value="56.10.21">Oturacak yeri olmayan fast-food (hamburger,
                                            sandviç, tost vb.) satış yerleri (büfeler dahil), al götür tesisleri
                                            (içli pide ve lahmacun fırınları hariç) ve benzerleri tarafından
                                            sağlanan diğer yemek hazırlama ve sunum faaliyetleri 1</option>
                                        <option value="56.10.20">Oturacak yeri olmayan içli pide ve lahmacun
                                            fırınlarının faaliyetleri (al götür tesisi olarak hizmet verenler) 1
                                        </option>
                                        <option value="47.89.19">Seyyar olarak ve motorlu araçlarla diğer malların
                                            perakende ticareti 1</option>
                                        <option value="47.82.03">Seyyar olarak ve motorlu araçlarla tekstil, giyim
                                            eşyası ve ayakkabı perakende ticareti 1</option>
                                        <option value="47.81.12">Seyyar olarak ve motorlu araçlarla gıda ürünleri ve
                                            içeceklerin (alkollü içecekler hariç) perakende ticareti 1</option>
                                        <option value="47.79.06">Belirli bir mala tahsis edilmiş mağazalarda
                                            kullanılmış giysiler ve aksesuarlarının perakende ticareti 1/option>
                                        <option value="45.20.09">Motorlu kara taşıtlarının sadece boyanması
                                            faaliyetleri 3</option>
                                        <option value="25.99.90">Başka yerde sınıflandırılmamış diğer fabrikasyon
                                            metal ürünlerin imalatı 2</option>
                                        <option value="08.99.01">Aşındırıcı (törpüleyici) materyaller (zımpara),
                                            amyant, silisli fosil artıklar, arsenik cevherleri, sabuntaşı (talk) ve
                                            feldispat madenciliği (kuartz, mika, şist, talk, silis, sünger taşı,
                                            asbest, doğal korindon vb.) 3</option>
                                        <option value="08.93.02">Deniz, göl ve kaynak tuzu üretimi (tuzun yemeklik
                                            tuza dönüştürülmesi hariç) 2</option>
                                        <option value="23.99.07">Amyantlı kağıt imalatı 3</option>
                                    </select>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="mersis_no">
                                            <h4><b>Kurum Mersis No Giriniz</b></h4>
                                        </label>
                                        <input class="form-control" id="mersis_no" name="mersis_no" type="tel" min="16"
                                            maxlength="16" placeholder="Mersis No" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="sgk_sicil">
                                            <h4><b>SGK Sicil No Giriniz</b></h4>
                                        </label>
                                        <input class="form-control" id="sgk_sicil" name="sgk_sicil" type="tel" min="12"
                                            maxlength="12" placeholder="SGK Sicil No" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="vergi_no">
                                            <h4><b>Vergi No Giriniz</b></h4>
                                        </label>
                                        <input class="form-control" id="vergi_no" name="vergi_no" type="tel" min="10"
                                            maxlength="10" placeholder="Vergi No" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="vergi_dairesi">
                                            <h4><b>Vergi Dairesi Giriniz</b></h4>
                                        </label>
                                        <input class="form-control" id="vergi_dairesi" name="vergi_dairesi" type="text"
                                            maxlength="500" placeholder="Vergi Dairesi" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="katip_is_yeri_id">
                                            <h4><b>İSG-KATİP İş Yeri ID</b></h4>
                                        </label>
                                        <input class="form-control" id="katip_is_yeri_id" name="katip_is_yeri_id"
                                            type="tel" maxlength="30" placeholder="İSG-KATİP İş Yeri ID" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="katip_kurum_id">
                                            <h4><b>İSG-KATİP Kurum ID</b></h4>
                                        </label>
                                        <input class="form-control" id="katip_kurum_id" name="katip_kurum_id" type="tel"
                                            maxlength="30" placeholder="İSG-KATİP Kurum ID" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger previous">Geri Git</button>
                                <button class="btn btn-success" type="submit" name="kaydet" id="kaydet">Kaydet</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


@push('styles')
<!--  -->
<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">

@endpush

@push('scripts')


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
    var citiesByState = {
        Adana: ["Aladağ", "Ceyhan", "Çukurova", "Feke", "İmamoğlu", "Karaisalı", "Karataş", "Kozan", "Pozantı", "Saimbeyli", "Sarıçam", "Seyhan", "Tufanbeyli", "Yumurtalık", "Yüreğir"],
        Adıyaman: ["Besni", "Çelikhan", "Gerger", "Gölbaşı", "Kahta", "Merkez", "Samsat", "Sincik", "Tut"],
        Afyonkarahisar: ["Başmakçı", "Bayat", "Bolvadin", "Çay", "Çobanlar", "Dazkırı", "Dinar", "Emirdağ", "Evciler", "Hocalar", "İhsaniye", "İscehisar", "Kızılören", "Merkez", "Sandıklı", "Sinanpaşa", "Sultandağı", "Şuhut"],
        Ağrı: ["Diyadin", "Doğubayazıt", "Eleşkirt", "Hamur", "Merkez", "Patnos", "Taşlıçay", "Tutak"],
        Amasya: ["Göynücek", "Gümüşhacıköy", "Hamamözü", "Merkez", "Merzifon", "Suluova", "Taşova"],
        Ankara: ["Altındağ", "Ayaş", "Bala", "Beypazarı", "Çamlıdere", "Çankaya", "Çubuk", "Elmadağ", "Güdül", "Haymana", "Kalecik", "Kızılcahamam", "Nallıhan", "Polatlı", "Şereflikoçhisar", "Yenimahalle", "Gölbaşı", "Keçiören", "Mamak", "Sincan",
          "Kazan", "Akyurt", "Etimesgut", "Evren", "Pursaklar"
        ],
        Antalya: ["Akseki", "Alanya", "Elmalı", "Finike", "Gazipaşa", "Gündoğmuş", "Kaş", "Korkuteli", "Kumluca", "Manavgat", "Serik", "Demre", "İbradı", "Kemer", "Aksu", "Döşemealtı", "Kepez", "Konyaaltı", "Muratpaşa"],
        Artvin: ["Ardanuç", "Arhavi", "Merkez", "Borçka", "Hopa", "Şavşat", "Yusufeli", "Murgul"],
        Aydın: ["Merkez", "Bozdoğan", "Efeler", "Çine", "Germencik", "Karacasu", "Koçarlı", "Kuşadası", "Kuyucak", "Nazilli", "Söke", "Sultanhisar", "Yenipazar", "Buharkent", "İncirliova", "Karpuzlu", "Köşk", "Didim"],
        Balıkesir: ["Altıeylül", "Ayvalık", "Merkez", "Balya", "Bandırma", "Bigadiç", "Burhaniye", "Dursunbey", "Edremit", "Erdek", "Gönen", "Havran", "İvrindi", "Karesi", "Kepsut", "Manyas", "Savaştepe", "Sındırgı", "Gömeç", "Susurluk", "Marmara"],
        Bilecik: ["Merkez", "Bozüyük", "Gölpazarı", "Osmaneli", "Pazaryeri", "Söğüt", "Yenipazar", "İnhisar"],
        Bingöl: ["Merkez", "Genç", "Karlıova", "Kiğı", "Solhan", "Adaklı", "Yayladere", "Yedisu"],
        Bitlis: ["Adilcevaz", "Ahlat", "Merkez", "Hizan", "Mutki", "Tatvan", "Güroymak"],
        Bolu: ["Merkez", "Gerede", "Göynük", "Kıbrıscık", "Mengen", "Mudurnu", "Seben", "Dörtdivan", "Yeniçağa"],
        Burdur: ["Ağlasun", "Bucak", "Merkez", "Gölhisar", "Tefenni", "Yeşilova", "Karamanlı", "Kemer", "Altınyayla", "Çavdır", "Çeltikçi"],
        Bursa: ["Gemlik", "İnegöl", "İznik", "Karacabey", "Keles", "Mudanya", "Mustafakemalpaşa", "Orhaneli", "Orhangazi", "Yenişehir", "Büyükorhan", "Harmancık", "Nilüfer", "Osmangazi", "Yıldırım", "Gürsu", "Kestel"],
        Çanakkale: ["Ayvacık", "Bayramiç", "Biga", "Bozcaada", "Çan", "Merkez", "Eceabat", "Ezine", "Gelibolu", "Gökçeada", "Lapseki", "Yenice"],
        Çankırı: ["Merkez", "Çerkeş", "Eldivan", "Ilgaz", "Kurşunlu", "Orta", "Şabanözü", "Yapraklı", "Atkaracalar", "Kızılırmak", "Bayramören", "Korgun"],
        Çorum: ["Alaca", "Bayat", "Merkez", "İskilip", "Kargı", "Mecitözü", "Ortaköy", "Osmancık", "Sungurlu", "Boğazkale", "Uğurludağ", "Dodurga", "Laçin", "Oğuzlar"],
        Denizli: ["Acıpayam", "Buldan", "Çal", "Çameli", "Çardak", "Çivril", "Merkez", "Merkezefendi", "Pamukkale", "Güney", "Kale", "Sarayköy", "Tavas", "Babadağ", "Bekilli", "Honaz", "Serinhisar", "Baklan", "Beyağaç", "Bozkurt"],
        Diyarbakır: ["Kocaköy", "Çermik", "Çınar", "Çüngüş", "Dicle", "Ergani", "Hani", "Hazro", "Kulp", "Lice", "Silvan", "Eğil", "Bağlar", "Kayapınar", "Sur", "Yenişehir", "Bismil"],
        Edirne: ["Merkez", "Enez", "Havsa", "İpsala", "Keşan", "Lalapaşa", "Meriç", "Uzunköprü", "Süloğlu"],
        Elazığ: ["Ağın", "Baskil", "Merkez", "Karakoçan", "Keban", "Maden", "Palu", "Sivrice", "Arıcak", "Kovancılar", "Alacakaya"],
        Erzincan: ["Çayırlı", "Merkez", "İliç", "Kemah", "Kemaliye", "Refahiye", "Tercan", "Üzümlü", "Otlukbeli"],
        Erzurum: ["Aşkale", "Çat", "Hınıs", "Horasan", "İspir", "Karayazı", "Narman", "Oltu", "Olur", "Pasinler", "Şenkaya", "Tekman", "Tortum", "Karaçoban", "Uzundere", "Pazaryolu", "Köprüköy", "Palandöken", "Yakutiye", "Aziziye"],
        Eskişehir: ["Çifteler", "Mahmudiye", "Mihalıççık", "Sarıcakaya", "Seyitgazi", "Sivrihisar", "Alpu", "Beylikova", "İnönü", "Günyüzü", "Han", "Mihalgazi", "Odunpazarı", "Tepebaşı"],
        Gaziantep: ["Araban", "İslahiye", "Nizip", "Oğuzeli", "Yavuzeli", "Şahinbey", "Şehitkamil", "Karkamış", "Nurdağı"],
        Giresun: ["Alucra", "Bulancak", "Dereli", "Espiye", "Eynesil", "Merkez", "Görele", "Keşap", "Şebinkarahisar", "Tirebolu", "Piraziz", "Yağlıdere", "Çamoluk", "Çanakçı", "Doğankent", "Güce"],
        Gümüşhane: ["Merkez", "Kelkit", "Şiran", "Torul", "Köse", "Kürtün"],
        Hakkari: ["Çukurca", "Merkez", "Şemdinli", "Yüksekova"],
        Hatay: ["Altınözü", "Arsuz", "Defne", "Dörtyol", "Hassa", "Antakya", "İskenderun", "Kırıkhan", "Payas", "Reyhanlı", "Samandağ", "Yayladağı", "Erzin", "Belen", "Kumlu"],
        Isparta: ["Atabey", "Eğirdir", "Gelendost", "Merkez", "Keçiborlu", "Senirkent", "Sütçüler", "Şarkikaraağaç", "Uluborlu", "Yalvaç", "Aksu", "Gönen", "Yenişarbademli"],
        Mersin: ["Anamur", "Erdemli", "Gülnar", "Mut", "Silifke", "Tarsus", "Aydıncık", "Bozyazı", "Çamlıyayla", "Akdeniz", "Mezitli", "Toroslar", "Yenişehir"],
        İstanbul: ["Adalar", "Bakırköy", "Beşiktaş", "Beykoz", "Beyoğlu", "Çatalca", "Eyüp", "Fatih", "Gaziosmanpaşa", "Kadıköy", "Kartal", "Sarıyer", "Silivri", "Şile", "Şişli", "Üsküdar", "Zeytinburnu", "Büyükçekmece", "Kağıthane", "Küçükçekmece",
          "Pendik", "Ümraniye", "Bayrampaşa", "Avcılar", "Bağcılar", "Bahçelievler", "Güngören", "Maltepe", "Sultanbeyli", "Tuzla", "Esenler", "Arnavutköy", "Ataşehir", "Başakşehir", "Beylikdüzü", "Çekmeköy", "Esenyurt", "Sancaktepe", "Sultangazi"
        ],
        İzmir: ["Aliağa", "Bayındır", "Bergama", "Bornova", "Çeşme", "Dikili", "Foça", "Karaburun", "Karşıyaka", "Kemalpaşa", "Kınık", "Kiraz", "Menemen", "Ödemiş", "Seferihisar", "Selçuk", "Tire", "Torbalı", "Urla", "Beydağ", "Buca", "Konak",
          "Menderes", "Balçova", "Çiğli", "Gaziemir", "Narlıdere", "Güzelbahçe", "Bayraklı", "Karabağlar"
        ],
        Kars: ["Arpaçay", "Digor", "Kağızman", "Merkez", "Sarıkamış", "Selim", "Susuz", "Akyaka"],
        Kastamonu: ["Abana", "Araç", "Azdavay", "Bozkurt", "Cide", "Çatalzeytin", "Daday", "Devrekani", "İnebolu", "Merkez", "Küre", "Taşköprü", "Tosya", "İhsangazi", "Pınarbaşı", "Şenpazar", "Ağlı", "Doğanyurt", "Hanönü", "Seydiler"],
        Kayseri: ["Bünyan", "Develi", "Felahiye", "İncesu", "Pınarbaşı", "Sarıoğlan", "Sarız", "Tomarza", "Yahyalı", "Yeşilhisar", "Akkışla", "Talas", "Kocasinan", "Melikgazi", "Hacılar", "Özvatan"],
        Kırklareli: ["Babaeski", "Demirköy", "Merkez", "Kofçaz", "Lüleburgaz", "Pehlivanköy", "Pınarhisar", "Vize"],
        Kırşehir: ["Çiçekdağı", "Kaman", "Merkez", "Mucur", "Akpınar", "Akçakent", "Boztepe"],
        Kocaeli: ["Gebze", "Gölcük", "Kandıra", "Karamürsel", "Körfez", "Derince", "Başiskele", "Çayırova", "Darıca", "Dilovası", "İzmit", "Kartepe"],
        Konya: ["Akşehir", "Beyşehir", "Bozkır", "Cihanbeyli", "Çumra", "Doğanhisar", "Ereğli", "Hadim", "Ilgın", "Kadınhanı", "Karapınar", "Kulu", "Sarayönü", "Seydişehir", "Yunak", "Akören", "Altınekin", "Derebucak", "Hüyük", "Karatay", "Meram",
          "Selçuklu", "Taşkent", "Ahırlı", "Çeltik", "Derbent", "Emirgazi", "Güneysınır", "Halkapınar", "Tuzlukçu", "Yalıhüyük"
        ],
        Kütahya: ["Altıntaş", "Domaniç", "Emet", "Gediz", "Merkez", "Simav", "Tavşanlı", "Aslanapa", "Dumlupınar", "Hisarcık", "Şaphane", "Çavdarhisar", "Pazarlar"],
        Malatya: ["Akçadağ", "Arapgir", "Arguvan", "Darende", "Doğanşehir", "Hekimhan", "Merkez", "Pütürge", "Yeşilyurt", "Battalgazi", "Doğanyol", "Kale", "Kuluncak", "Yazıhan"],
        Manisa: ["Akhisar", "Alaşehir", "Demirci", "Gördes", "Kırkağaç", "Kula", "Merkez", "Salihli", "Sarıgöl", "Saruhanlı", "Selendi", "Soma", "Şehzadeler", "Yunusemre", "Turgutlu", "Ahmetli", "Gölmarmara", "Köprübaşı"],
        Kahramanmaraş: ["Afşin", "Andırın", "Dulkadiroğlu", "Onikişubat", "Elbistan", "Göksun", "Merkez", "Pazarcık", "Türkoğlu", "Çağlayancerit", "Ekinözü", "Nurhak"],
        Mardin: ["Derik", "Kızıltepe", "Artuklu", "Merkez", "Mazıdağı", "Midyat", "Nusaybin", "Ömerli", "Savur", "Dargeçit", "Yeşilli"],
        Muğla: ["Bodrum", "Datça", "Fethiye", "Köyceğiz", "Marmaris", "Menteşe", "Milas", "Ula", "Yatağan", "Dalaman", "Seydikemer", "Ortaca", "Kavaklıdere"],
        Muş: ["Bulanık", "Malazgirt", "Merkez", "Varto", "Hasköy", "Korkut"],
        Nevşehir: ["Avanos", "Derinkuyu", "Gülşehir", "Hacıbektaş", "Kozaklı", "Merkez", "Ürgüp", "Acıgöl"],
        Niğde: ["Bor", "Çamardı", "Merkez", "Ulukışla", "Altunhisar", "Çiftlik"],
        Ordu: ["Akkuş", "Altınordu", "Aybastı", "Fatsa", "Gölköy", "Korgan", "Kumru", "Mesudiye", "Perşembe", "Ulubey", "Ünye", "Gülyalı", "Gürgentepe", "Çamaş", "Çatalpınar", "Çaybaşı", "İkizce", "Kabadüz", "Kabataş"],
        Rize: ["Ardeşen", "Çamlıhemşin", "Çayeli", "Fındıklı", "İkizdere", "Kalkandere", "Pazar", "Merkez", "Güneysu", "Derepazarı", "Hemşin", "İyidere"],
        Sakarya: ["Akyazı", "Geyve", "Hendek", "Karasu", "Kaynarca", "Sapanca", "Kocaali", "Pamukova", "Taraklı", "Ferizli", "Karapürçek", "Söğütlü", "Adapazarı", "Arifiye", "Erenler", "Serdivan"],
        Samsun: ["Alaçam", "Bafra", "Çarşamba", "Havza", "Kavak", "Ladik", "Terme", "Vezirköprü", "Asarcık", "Ondokuzmayıs", "Salıpazarı", "Tekkeköy", "Ayvacık", "Yakakent", "Atakum", "Canik", "İlkadım"],
        Siirt: ["Baykan", "Eruh", "Kurtalan", "Pervari", "Merkez", "Şirvan", "Tillo"],
        Sinop: ["Ayancık", "Boyabat", "Durağan", "Erfelek", "Gerze", "Merkez", "Türkeli", "Dikmen", "Saraydüzü"],
        Sivas: ["Divriği", "Gemerek", "Gürün", "Hafik", "İmranlı", "Kangal", "Koyulhisar", "Merkez", "Suşehri", "Şarkışla", "Yıldızeli", "Zara", "Akıncılar", "Altınyayla", "Doğanşar", "Gölova", "Ulaş"],
        Tekirdağ: ["Çerkezköy", "Çorlu", "Ergene", "Hayrabolu", "Malkara", "Muratlı", "Saray", "Süleymanpaşa", "Kapaklı", "Şarköy", "Marmaraereğlisi"],
        Tokat: ["Almus", "Artova", "Erbaa", "Niksar", "Reşadiye", "Merkez", "Turhal", "Zile", "Pazar", "Yeşilyurt", "Başçiftlik", "Sulusaray"],
        Trabzon: ["Akçaabat", "Araklı", "Arsin", "Çaykara", "Maçka", "Of", "Ortahisar", "Sürmene", "Tonya", "Vakfıkebir", "Yomra", "Beşikdüzü", "Şalpazarı", "Çarşıbaşı", "Dernekpazarı", "Düzköy", "Hayrat", "Köprübaşı"],
        Tunceli: ["Çemişgezek", "Hozat", "Mazgirt", "Nazımiye", "Ovacık", "Pertek", "Pülümür", "Merkez"],
        Şanlıurfa: ["Akçakale", "Birecik", "Bozova", "Ceylanpınar", "Eyyübiye", "Halfeti", "Haliliye", "Hilvan", "Karaköprü", "Siverek", "Suruç", "Viranşehir", "Harran"],
        Uşak: ["Banaz", "Eşme", "Karahallı", "Sivaslı", "Ulubey", "Merkez"],
        Van: ["Başkale", "Çatak", "Erciş", "Gevaş", "Gürpınar", "İpekyolu", "Muradiye", "Özalp", "Tuşba", "Bahçesaray", "Çaldıran", "Edremit", "Saray"],
        Yozgat: ["Akdağmadeni", "Boğazlıyan", "Çayıralan", "Çekerek", "Sarıkaya", "Sorgun", "Şefaatli", "Yerköy", "Merkez", "Aydıncık", "Çandır", "Kadışehri", "Saraykent", "Yenifakılı"],
        Zonguldak: ["Çaycuma", "Devrek", "Ereğli", "Merkez", "Alaplı", "Gökçebey"],
        Aksaray: ["Ağaçören", "Eskil", "Gülağaç", "Güzelyurt", "Merkez", "Ortaköy", "Sarıyahşi"],
        Bayburt: ["Merkez", "Aydıntepe", "Demirözü"],
        Karaman: ["Ermenek", "Merkez", "Ayrancı", "Kazımkarabekir", "Başyayla", "Sarıveliler"],
        Kırıkkale: ["Delice", "Keskin", "Merkez", "Sulakyurt", "Bahşili", "Balışeyh", "Çelebi", "Karakeçili", "Yahşihan"],
        Batman: ["Merkez", "Beşiri", "Gercüş", "Kozluk", "Sason", "Hasankeyf"],
        Şırnak: ["Beytüşşebap", "Cizre", "İdil", "Silopi", "Merkez", "Uludere", "Güçlükonak"],
        Bartın: ["Merkez", "Kurucaşile", "Ulus", "Amasra"],
        Ardahan: ["Merkez", "Çıldır", "Göle", "Hanak", "Posof", "Damal"],
        Iğdır: ["Aralık", "Merkez", "Tuzluca", "Karakoyunlu"],
        Yalova: ["Merkez", "Altınova", "Armutlu", "Çınarcık", "Çiftlikköy", "Termal"],
        Karabük: ["Eflani", "Eskipazar", "Merkez", "Ovacık", "Safranbolu", "Yenice"],
        Kilis: ["Merkez", "Elbeyli", "Musabeyli", "Polateli"],
        Osmaniye: ["Bahçe", "Kadirli", "Merkez", "Düziçi", "Hasanbeyli", "Sumbas", "Toprakkale"],
        Düzce: ["Akçakoca", "Merkez", "Yığılca", "Cumayeri", "Gölyaka", "Çilimli", "Gümüşova", "Kaynaşlı"]
      }

      function makeSubmenu(value) {
        if (value.length == 0) document.getElementById("citySelect").innerHTML = "<option></option>";
        else {
          var citiesOptions = "";
          for (cityId in citiesByState[value]) {
            citiesOptions += "<option>" + citiesByState[value][cityId] + "</option>";
          }
          document.getElementById("citySelect").innerHTML = citiesOptions;
        }
      }

      function displaySelected() {
        var country = document.getElementById("countrySelect").value;
        var city = document.getElementById("citySelect").value;
        alert(country + "\n" + city);
      }

      function resetSelection() {
        document.getElementById("countrySelect").selectedIndex = 0;
        document.getElementById("citySelect").selectedIndex = 0;
      }
</script>
<script type="text/javascript" src="/js/hashids.min.js"></script>
<script type="text/javascript">
    $(function () {
          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              DT_RowId: true,
              ajax: "{{ route('companies') }}",
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'type', name: 'type'},
                  {data: 'phone', name: 'phone'},
                  {data: 'email', name: 'email'},
                  {data: 'city', name: 'city'},
                  {data: 'town', name: 'town'},
                  {data: 'contract_at', name: 'contract_at'}
              ]
          });

          $('#example tbody').on('click', 'tr', function () {
            var data = table.row( this ).data();
            var hashids = new Hashids();
            id = hashids.encode(data['id'],1, 2, 3);
            window.location.href="company/"+id

        });

    } );
</script>
<script>
    $('#next1').click(function () {
        	if($('#type').val() && $('#name').val() && $('#contract_at').val()&& $('#address').val()
          && $('#email').val()  && $('#phone').val()  && $('#citySelect').val()
           && $('#countrySelect').val() && $('#employer').val()) {
         		$('.nav-tabs > .nav-item > .active').parent().next('li').find('a').trigger('click');
      	}else {
          window.alert("Lütfen zorunlu(*) alanları doldurun");
        }
        });
      $('#kaydet').click(function () {
        if(!$('#type').val() && !$('#name').val() && !$('#contract_at').val()
        && !$('#address').val() && !$('#email').val()  && !$('#phone').val()
        && !$('#citySelect').val() && !$('#countrySelect').val() && !$('#employer').val()) {
          window.alert("Lütfen zorunlu(*) alanları doldurun");
          return false;
        }
      });
        $('#next2').click(function () {
           		$('.nav-tabs > .nav-item > .active').parent().next('li').find('a').trigger('click');
          });
        $('.previous').click(function () {
          $('.nav-tabs > .nav-item > .active').parent().prev('li').find('a').trigger('click');
        });

        $('#link2-tab').click(function () {
          if(!$('#type').val() && !$('#name').val() && !$('#contract_at').val()
          && !$('#address').val() && !$('#email').val()  && !$('#phone').val()
          && !$('#citySelect').val() && !$('#countrySelect').val() && !$('#employer').val()) {
            window.alert("Lütfen zorunlu(*) alanları doldurun");
            return false;
          }
        });
        $('#link3-tab').click(function () {
          if(!$('#type').val() && !$('#name').val() && !$('#contract_at').val()
          && !$('#address').val() && !$('#email').val()  && !$('#phone').val()
           && !$('#citySelect').val() && !$('#countrySelect').val() && !$('#employer').val()) {
            window.alert("Lütfen zorunlu(*) alanları doldurun");
            return false;
          }
        });

</script>
@endpush

@endsection
