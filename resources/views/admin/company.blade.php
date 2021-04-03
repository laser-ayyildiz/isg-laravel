@extends('layouts.admin')
@section('title')Şirket - @endsection
@section('content')

<div class="container-fluid">
    <div class="card border">
        <div class="card-header tab-card-header text-center bg-light text-dark border">
            <h1><b>{{$company->name}}</b></h1>
            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link " id="gb-tab" data-toggle="tab" href="#genel_bilgiler" role="tab"
                        aria-controls="Genel Bilgiler" aria-selected="true"><b>Bilgiler</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="oc-tab" data-toggle="tab" href="#osgb_calisanlar" role="tab"
                        aria-controls="OSGB Çalışanları" aria-selected="false"><b>OSGB Çalışanları</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="db-tab" data-toggle="tab" href="#devlet_bilgileri" role="tab"
                        aria-controls="Devlet Bilgileri" aria-selected="false"><b>Devlet Bilgileri</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="ic-tab" data-toggle="tab" href="#isletme_calisanlar" role="tab"
                        aria-controls="İşletme Çalışanları" aria-selected="false"><b>Çalışanlar</b></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " id="it-tab" data-toggle="tab" href="#isletme_takvim" role="tab"
                        aria-controls="İşletme Takvimi" aria-selected="false"><b>Takvim</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="ie-tab" data-toggle="tab" href="#isletme_ekipman" role="tab"
                        aria-controls="İşletme Ekipmanları" aria-selected="false"><b>Ekipmanlar</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="ir-tab" data-toggle="tab" href="#isletme_rapor" role="tab"
                        aria-controls="İşletme Raporları" aria-selected="false"><b>Raporlar</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="zr-tab" data-toggle="tab" href="#ziyaret_rapor" role="tab"
                        aria-controls="Ziyaret Raporları" aria-selected="false"><b>Ziyaret Raporları</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="sc-tab" data-toggle="tab" href="#silinen_calisanlar" role="tab"
                        aria-controls="Silinen Çalışanlar"><b>Arşiv</b></a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <!--Genel Bilgiler -->
                <div class="tab-pane fade show active" id="genel_bilgiler" role="tabpanel" aria-labelledby="gb-tab">
                    <fieldset id="gb_form">
                        <button class="btn btn-danger mx-1 float-right" data-toggle="modal" data-target="#areYouSure"
                            id="changeCompanyBtn" data-whatever="@getbootstrap">İşletmeyi Sil</button>
                        <button class="btn btn-warning mx-1 float-right" data-toggle="modal"
                            data-target="#changeCompany" id="changeCompanyBtn" data-whatever="@getbootstrap">İşletme
                            Bilgilerini Değiştir</button>
                        <button class="btn btn-success mx-1 float-right" data-toggle="modal" data-target="#addUser"
                            id="addUserBtn" data-whatever="@getbootstrap">Kullanıcı
                            Oluştur</button>
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <label for="comp_type_show">
                                    <h5><b>Sektör</b></h5>
                                </label>
                                <input class="form-control" id="comp_type_show" name="comp_type_show" required
                                    value="{{$company->type}}">
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="is_veren_show">
                                    <h5><b>İşveren Ad Soyad</b></h5>
                                </label>
                                <input class="form-control" id="is_veren_show" name="is_veren_show" required
                                    value="{{$company->employer}}">
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="mail">
                                    <h5><b>Mail Adresi</b></h5>
                                </label>
                                <input type="text" class="form-control" name="mail" id="mail"
                                    value="{{$company->email}}" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="phone">
                                    <h5><b>Telefon No</b></h5>
                                </label>
                                <input type="tel" name="phone" id="phone" class="form-control"
                                    placeholder="Tel: 0XXXXXXXXXX" pattern="(\d{4})(\d{3})(\d{2})(\d{2})" maxlength="11"
                                    required value="{{$company->phone}}"></label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12">
                                <label for="address">
                                    <h5><b>Adres</b></h5>
                                </label>
                                <textarea class="form-control" id="address" name="address" rows="3"
                                    style="max-width: 100%;" maxlength="2500" required>{{$company->address}}</textarea>
                            </div>
                        </div>
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
                        <div class="form-row">
                            <div class="form-group col-lg-4">
                                <label for="remi_freq">
                                    <h5><b>Ziyaret Sıklığı</b></h5>
                                </label>
                                <select class="form-control" id="remi_freq" name="remi_freq" size="1" required>
                                    <option value="" disabled>Ziyaret Sıklığı Ayarla</option>
                                    <option value="{{$company->remi_freq}}" selected>{{$company->remi_freq}} Ay</option>
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
                    </fieldset>
                </div>

                <!--OSGB Çalışanları -->
                <div class="tab-pane fade show " id="osgb_calisanlar" role="tabpanel" aria-labelledby="oc-tab">
                    <div class="text-center">
                        @if (!empty($osgbEmployees))
                        @foreach ($osgbEmployees as $employee )
                        <h3>
                            {{ $employee }}
                        </h3>
                        @endforeach
                        @else
                        <h1>Henüz bu işletme için bir çalışan atanmadı</h1>
                        @endif
                    </div>
                </div>

                <!--Devlet Bilgileri -->
                <div class="tab-pane fade show " id="devlet_bilgileri" role="tabpanel" aria-labelledby="db-tab">
                    <form action="index.php" method="POST">
                        <fieldset id="db_form">
                            <div class="row col-lg-12">
                                <label for="nace_kodu">
                                    <h4><b>NACE Kodu</b></h4>
                                </label>
                                <select name="nace_kodu" id="nace_kodu" class="form-control" required>
                                    <option value="{{ $company->nace_kodu ?? ''}}" selected>
                                        {{ $company->nace_kodu ?? ''}}</option>
                                    <option value="81.22.03">81.22.03,Nesne veya binaların (ameliyathaneler vb.)
                                        sterilizasyonu faaliyetleri.Binalar ile ilgili hizmetler ve çevre düzenlemesi
                                        faaliyetleri 3</option>
                                    <option value="82.20.01">82.20.01,Çağrı merkezlerinin faaliyetleri 2</option>
                                    <option value="86.90.17">86.90.17,İnsan sağlığı hizmetleri 3</option>
                                    <option value="85.59.16">85.59.16,Çocuk kulüplerinin faaliyetleri (6 yaş ve üzeri
                                        çocuklar için) 1</option>
                                    <option value="71.12.14">71.12.14,Yapı denetim kuruluşları 1</option>
                                    <option value="56.10.21">56.10.21,Oturacak yeri olmayan fast-food (hamburger,
                                        sandviç, tost vb.) satış yerleri (büfeler dahil), al götür tesisleri (içli pide
                                        ve lahmacun fırınları hariç) ve benzerleri tarafından sağlanan diğer
                                        yemek hazırlama ve sunum faaliyetleri 1</option>
                                    <option value="56.10.20">56.10.20,Oturacak yeri olmayan içli pide ve lahmacun
                                        fırınlarının faaliyetleri (al götür tesisi olarak hizmet verenler) 1</option>
                                    <option value="47.89.19">47.89.19,Seyyar olarak ve motorlu araçlarla diğer malların
                                        perakende ticareti 1</option>
                                    <option value="47.82.03">47.82.03,Seyyar olarak ve motorlu araçlarla tekstil, giyim
                                        eşyası ve ayakkabı perakende ticareti 1</option>
                                    <option value="47.81.12">47.81.12,Seyyar olarak ve motorlu araçlarla gıda ürünleri
                                        ve içeceklerin (alkollü içecekler hariç) perakende ticareti 1</option>
                                    <option value="47.79.06">47.79.06,Belirli bir mala tahsis edilmiş mağazalarda
                                        kullanılmış giysiler ve aksesuarlarının perakende ticareti 1</option>
                                    <option value="45.20.09">45.20.09,Motorlu kara taşıtlarının sadece boyanması
                                        faaliyetleri 3</option>
                                    <option value="25.99.90">25.99.90,Başka yerde sınıflandırılmamış diğer fabrikasyon
                                        metal ürünlerin imalatı 2</option>
                                    <option value="08.99.01">08.99.01,Aşındırıcı (törpüleyici) materyaller (zımpara),
                                        amyant, silisli fosil artıklar, arsenik cevherleri, sabuntaşı (talk) ve
                                        feldispat madenciliği (kuartz, mika, şist, talk, silis, sünger taşı, asbest,
                                        doğal korindon vb.) 3</option>
                                    <option value="08.93.02">08.93.02,Deniz, göl ve kaynak tuzu üretimi (tuzun yemeklik
                                        tuza dönüştürülmesi hariç) 2</option>
                                    <option value="23.99.07">23.99.07,Amyantlı kağıt imalatı 3</option>
                                </select>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <label for="mersis_no">
                                        <h4><b>Kurum Mersis No</b></h4>
                                    </label>
                                    <input class="form-control" id="mersis_no" name="mersis_no" type="tel" min="16"
                                        maxlength="16" placeholder="Mersis No" value="{{ $company->mersis_no }}">
                                </div>
                                <div class="col-6">
                                    <label for="sgk_sicil">
                                        <h4><b>SGK Sicil No</b></h4>
                                    </label>
                                    <input class="form-control" id="sgk_sicil" name="sgk_sicil" type="tel" min="12"
                                        maxlength="12" placeholder="SGK Sicil No" value="{{ $company->sgk_sicil }}">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <label for="vergi_no">
                                        <h4><b>Vergi No</b></h4>
                                    </label>
                                    <input class="form-control" id="vergi_no" name="vergi_no" type="tel" min="10"
                                        maxlength="10" placeholder="Vergi No" value="{{ $company->vergi_no }}">
                                </div>
                                <div class="col-6">
                                    <label for="vergi_dairesi">
                                        <h4><b>Vergi Dairesi</b></h4>
                                    </label>
                                    <input class="form-control" id="vergi_dairesi" name="vergi_dairesi" type="text"
                                        maxlength="500" placeholder="Vergi Dairesi"
                                        value="{{ $company->vergi_dairesi }}">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <label for="katip_is_yeri_id">
                                        <h4><b>İSG-KATİP İş Yeri ID</b></h4>
                                    </label>
                                    <input class="form-control" id="katip_is_yeri_id" name="katip_is_yeri_id" type="tel"
                                        maxlength="30" placeholder="İSG-KATİP İş Yeri ID"
                                        value="{{ $company->katip_is_yeri_id }}">
                                </div>
                                <div class="col-6">
                                    <label for="katip_kurum_id">
                                        <h4><b>İSG-KATİP Kurum ID</b></h4>
                                    </label>
                                    <input class="form-control" id="katip_kurum_id" name="katip_kurum_id" type="tel"
                                        maxlength="30" placeholder="İSG-KATİP Kurum ID"
                                        value="{{ $company->katip_kurum_id }}">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>

                <!--İşletme Çalışanları -->
                <div class="tab-pane fade show " id="isletme_calisanlar" role="tabpanel" aria-labelledby="ic-tab">

                    <button class="btn btn-primary" id="ic_form2" data-toggle="modal" data-target="#addWorker"
                        data-whatever="@getbootstrap">Yeni Çalışan Ekle</button>
                    <br><b>Çalışana ait dosyalara erişmek için çalışanın isminin yazılı olduğu kutucuğa
                        tıklayabilirsiniz</b>


                    <form method="POST" action="" enctype="multipart/form-data">
                        <fieldset id="ic_form1">
                            <label for="calisan_list"><b>Çalışan Listesi Yükle-></b></label>
                            <input type="number" name="company_id" value="" hidden>
                            <input type="text" name="company_name" value="" hidden>
                            <input type="file" class="btn btn-light btn-sm" name="calisan_list" />
                            <input type="submit" class="btn btn-primary" name="calisan_yukle" value="Yükle" />
                        </fieldset>
                    </form>

                    <input type="text" class="form-control" style="float:right;max-width:600px; margin-bottom:15px;"
                        id="myInput" onkeyup="myFunction()" placeholder="Çalışan Adı ile ara...">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid"
                        aria-describedby="dataTable_info">
                        <table class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Çalışan Adı Soyadı</th>
                                    <th>T.C Kimlik No</th>
                                    <th>Telefon No</th>
                                    <th>E-mail</th>
                                    <th>İşe Giriş Tarihi</th>
                                    <th id="delete_header">Sil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($coopEmployees))
                                @foreach ($coopEmployees as $key => $employee )
                                <tr>
                                    <td data-toggle="modal" data-target="#b{{ $key }}" data-whatever="@getbootstrap"
                                        style="cursor: pointer;">{{ $employee->user->name }}</td>

                                    <td>{{ $employee->user->tc }}</td>
                                    <td>{{ $employee->user->phone }}</td>
                                    <td>{{ $employee->user->email }}</td>
                                    <td>{{ $employee->user->recruitment_date }}</td>
                                    <form action="../core/deleteWorker.php" method="POST">
                                        <input type="number" name="company_id" value="" hidden>
                                        <input type="text" name="company_name" value="" hidden>
                                        <input type="number" name="TCWillDelete" value="" hidden readonly>
                                        <td><button class="btn btn-danger" type="submit" name="deleteWorkerButton"
                                                id="deleteWorkerButton">Sil</button></td>
                                    </form>
                                </tr>

                                <!-- Çalışan Dosyaları -->
                                <div class="modal fade" id="b{{ $key }}" tabindex="-1" aria-labelledby="label"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title" id="label"><b></b></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <a href="" target="blank"></a><br>

                                            </div>
                                            <div class="modal-footer bg-light">
                                                <form method="POST" action="../core/addWorkerFile.php"
                                                    enctype="multipart/form-data">
                                                    <fieldset id="ic_form3">
                                                        <label for="calisan_dosya"><b>Yeni Dosya Yükle-></b></label>
                                                        <input name="coworker_tc" type="tel" value="" hidden>
                                                        <input type="number" name="company_id" value="" hidden>
                                                        <input type="text" name="company_name" value="" hidden>
                                                        <input type="file" class="btn btn-light btn-sm"
                                                            name="calisan_dosya" required />
                                                        <input type="submit" class="btn btn-primary"
                                                            name="calisan_dosya_yukle" value="Yükle" />
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <h1>Henüz bu işletme için çalışan atanmadı</h1>
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><strong>Çalışan Adı Soyadı</strong></td>
                                    <td><strong>T.C Kimlik No</strong></td>
                                    <td><strong>Telefon No</strong></td>
                                    <td><strong>E-mail</strong></td>
                                    <td><strong>İşe Giriş Tarihi</strong></td>
                                    <td id="delete_footer"><strong>Sil</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!--İşletme Takvimi -->
                <div class="tab-pane fade show " id="isletme_takvim" role="tabpanel" aria-labelledby="it-tab">
                    <div id="calendar" style="margin: auto;" class="col-centered"></div>
                </div>

                <!--İşletme Ekipmanları -->
                <div class="tab-pane fade show " id="isletme_ekipman" role="tabpanel" aria-labelledby="ie-tab">
                    <button class="btn btn-primary" id="ie_button" data-toggle="modal" data-target="#addEquipment"
                        data-whatever="@getbootstrap">Yeni Ekipman Ekle</button>
                    <input type="text" class="form-control" style="float:right;max-width:600px;" id="myInput"
                        onkeyup="myFunction()" placeholder="Ekipman Adı ile ara...">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid"
                        aria-describedby="dataTable_info">
                        <table class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Ekipman Adı</th>
                                    <th>Ekipmanın Kullanım Amacı</th>
                                    <th>Ekipman Kontrol Sıklığı</th>
                                    <th>Kayıt Tarihi</th>
                                </tr>
                            </thead>
                            <tbody>


                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td> Ay</td>
                                    <td></td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><strong>Ekipman Adı</strong></td>
                                    <td><strong>Ekipmanın Kullanım Amacı</strong></td>
                                    <td><strong>Ekipmaın Kontrol Sıklığı</strong></td>
                                    <td><strong>Kayıt Tarihi</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!--İşletme Raporları -->
                <div class="tab-pane fade show " id="isletme_rapor" role="tabpanel" aria-labelledby="ir-tab">
                    <button style="float: left;" class="btn btn-primary" id="ir_form" data-toggle="modal"
                        data-target="#addReport" data-whatever="@getbootstrap">Yeni Rapor Hazırla</button>
                    <button style="float: right;" class="btn btn-primary" id="ir_form2" data-toggle="modal"
                        data-target="#uploadReport" data-whatever="@getbootstrap">Rapor Yükle</button>
                    <div class="table-responsive table mt-2" id="dataTable" role="grid"
                        aria-describedby="dataTable_info">
                        <table class="table table-striped table-bordered table-hover table-sm mt-2" id="dataTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Dosya Adı</th>
                                    <th>Dosya Tarihi</th>
                                    <th>İndir</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><b></b></td>
                                    <td><b></b></td>
                                    <td><input class="btn btn-success btn-sm" style="width:80px" type="button"
                                            value="İndir" onclick="window.location.href='isletme_raporlari/';" /></td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><strong>Dosya Adı</strong></td>
                                    <td><strong>Dosya Tarihi</strong></td>
                                    <td><strong>İndir</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!--Ziyaret Raporları -->
                <div class="tab-pane fade show " id="ziyaret_rapor" role="tabpanel" aria-labelledby="zr-tab">
                    <button class="btn btn-primary" id="zr_form" data-toggle="modal" data-target="#addVisitReport"
                        data-whatever="@getbootstrap">Yeni Ziyaret Raporu Ekle</button>
                    <div class="table-responsive table mt-2" id="dataTable" role="grid"
                        aria-describedby="dataTable_info">
                        <table class="table table-striped table-bordered table-hover table-sm" id="dataTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Dosya Adı</th>
                                    <th>Dosya Tarihi</th>
                                    <th>İndir</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><b></b></td>
                                    <td><b></b></td>
                                    <td><input class="btn btn-success btn-sm" style="width:80px" type="button"
                                            value="İndir" onclick="window.location.href='ziyaret_raporlar" /></td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><strong>Dosya Adı</strong></td>
                                    <td><strong>Dosya Tarihi</strong></td>
                                    <td><strong>İndir</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!--Silinen Çalışanlar -->
                <div class="tab-pane fade show " id="silinen_calisanlar" role="tabpanel" aria-labelledby="tr-tab">
                    <b>Çalışana ait dosyalara erişmek için çalışanın isminin yazılı olduğu kutucuğa
                        tıklayabilirsiniz</b>
                    <input type="text" class="form-control" style="float:right;max-width:600px; margin-bottom:15px;"
                        id="myInput" onkeyup="myFunction()" placeholder="Çalışan Adı ile ara...">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid"
                        aria-describedby="dataTable_info">
                        <table class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Çalışan Adı Soyadı</th>
                                    <th>Pozisyonu</th>
                                    <th>Cinsiyeti</th>
                                    <th>T.C Kimlik No</th>
                                    <th>Telefon No</th>
                                    <th>E-mail</th>
                                    <th>İşe Giriş Tarihi</th>
                                    <th>Geri Al</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td data-toggle="modal" data-target="#c" data-whatever="@getbootstrap"
                                        style="cursor: pointer;"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <form action="../core/recruitAgain.php" method="POST">
                                        <td><button class="btn btn-success" type="submit" name="recruitAgain">Geri
                                                Al</button></td>
                                        <input type="number" name="company_id" value="" hidden>
                                        <input type="text" name="company_name" value="" hidden>
                                        <input type="number" name="TCWillRecruit" value="" hidden readonly>
                                    </form>
                                </tr>
                                <!-- Çalışan Dosyaları -->
                                <div class="modal fade" id="c" tabindex="-1" aria-labelledby="label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content modal-lg">
                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title" id="label"><b></b></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <a href="" target="blank"></a><br>

                                                <form method="POST" action="index.php" enctype="multipart/form-data">
                                                    <fieldset id="ic_form3">
                                                        <label for="calisan_dosya"><b>Yeni Dosya Yükle-></b></label>
                                                        <input name="cdir_name" type="tel" value="" hidden>
                                                        <input type="file" class="btn btn-light btn-sm"
                                                            name="calisan_dosya" />
                                                        <input type="submit" class="btn btn-primary"
                                                            name="calisan_dosya_yukle" value="Yükle" />
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><strong>Çalışan Adı Soyadı</strong></td>
                                    <td><strong>Pozisyonu</strong></td>
                                    <td><strong>Cinsiyeti</strong></td>
                                    <td><strong>T.C Kimlik No</strong></td>
                                    <td><strong>Telefon No</strong></td>
                                    <td><strong>E-mail</strong></td>
                                    <td><strong>İşe Giriş Tarihi</strong></td>
                                    <td><strong>Geri Al</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div><!-- tab content end -->
        </div><!-- card body end -->

        <!-- Silme Talebi -->
        <div class="modal fade" id="areYouSure" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Emin misiniz?</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('company.handle') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <h3>
                                <b>
                                    Silme talebiniz yöneticinize iletilecektir,
                                    Emin misiniz?
                                </b>
                            </h3>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="companyId"
                                value="{{ @Hashids::encode($company->id , 15, 298, 177) }}">
                            <button class="btn btn-lg btn-danger mr-auto" data-dismiss="modal">İptal</button>
                            <button type="submit" name="deleteRequest"
                                class="btn btn-lg btn-danger float-right">SİL</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Yeni çalışan ekleme modal -->
        <div class="modal fade" id="addWorker" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Yeni Çalışan Ekle</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-6">
                                    <label for="worker_name">
                                        <h5><b>Çalışanın Adını ve Soyadını Giriniz</b></h5>
                                    </label>
                                    <input name="worker_name" id="worker_name" class="form-control" type="text"
                                        maxlength="100" placeholder="Ad Soyad" required>
                                </div>
                                <div class="col-6">
                                    <label for="worker_tc">
                                        <h5><b>Çalışanın T.C Kimlik Numarasını Giriniz</b></h5>
                                    </label>
                                    <input name="worker_tc" id="worker_tc" class="form-control" type="tel"
                                        maxlength="11" minlength="11" placeholder="T.C Kimlik No" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <label for="worker_mail">
                                        <h5><b>Çalışanın E-mail adresini Giriniz</b></h5>
                                    </label>
                                    <input name="worker_mail" id="worker_mail" class="form-control" type="email"
                                        maxlength="100" placeholder="E-mail" required>
                                </div>
                                <div class="col-6">
                                    <label for="worker_phone">
                                        <h5><b>Çalışanın Telefon Numarasını Giriniz</b></h5>
                                    </label>
                                    <input name="worker_phone" id="worker_phone" class="form-control" type="tel"
                                        maxlength="11" minlength="11" placeholder="05XXXXXXXXX" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <label for="worker_position">
                                        <h5><b>Çalışanın Posizyonu Giriniz</b></h5>
                                    </label>
                                    <input name="worker_position" id="worker_position" class="form-control" type="text"
                                        maxlength="100" placeholder="Pozisyon" required>
                                </div>
                                <div class="col-6">
                                    <label for="worker_sex">
                                        <h5><b>Çalışanının Cinsiyetini Giriniz</b></h5>
                                    </label>
                                    <select name="worker_sex" id="worker_sex" class="form-control" required>
                                        <option value="" disabled selected>Çalışanın Cinsiyeti</option>
                                        <option value="Erkek">Erkek</option>
                                        <option value="Kadın">Kadın</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row col-6">
                                <label for="worker_contract_date">
                                    <h5><b>Çalışanın İşe Giriş Tarihi</b></h5>
                                </label>
                                <input name="worker_contract_date" id="worker_contract_date" class="form-control"
                                    type="date" required>
                            </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <input type="number" name="company_id" value="" hidden>
                        <input type="text" name="company_name" value="" hidden>
                        <button id="add_worker" name="add_worker" type="submit" style="float: right; width:150px;"
                            class="btn btn-primary btn-lg">Ekle</button>
                    </div>
                    </form>
                </div>
            </div>
        </div> <!-- addWorker end-->

        <!-- Yeni etkinlik ekleme modal-->
        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Etkinlik Ekle</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Başlık</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title"
                                        placeholder="Başlık">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-4 control-label">Açıklama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" class="form-control" id="description"
                                        placeholder="Açıklama">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Renk</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option style="color:#0071c5;" value="#0071c5">Lacivert</option>
                                        <option style="color:#40E0D0;" value="#40E0D0">Turkuaz</option>
                                        <option style="color:#008000;" value="#008000">Yeşil</option>
                                        <option style="color:#FFD700;" value="#FFD700">Sarı</option>
                                        <option style="color:#FF8C00;" value="#FF8C00">Turuncu</option>
                                        <option style="color:#FF0000;" value="#FF0000">Kırmızı</option>
                                        <option style="color:#000;" value="#000">Siyah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="start" class="col-sm-12 control-label">Başlangıç Tarihi</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="start" class="form-control" id="start" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="end" class="col-sm-12 control-label">Sonlanma Tarihi</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="end" class="form-control" id="end" readonly>
                                            <input type="number" name="company_id" id="company_id" value="" hidden
                                                readonly>
                                            <input type="number" name="user_id" id="user_id" value="" hidden readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- ModalAdd end -->

        <!-- Kayıtlı etkinliği düzenle modal -->
        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="../../calendar/core/editEventTitle.php">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Etkinliği Düzenle</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <input name="event_company_name" id="event_company_name" value="" hidden readonly>
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Başlık</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title"
                                        placeholder="Başlık">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-4 control-label">Açıklama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" class="form-control" id="description"
                                        placeholder="Açıklama">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Renk</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option style="color:#0071c5;" value="#0071c5">Lacivert</option>
                                        <option style="color:#40E0D0;" value="#40E0D0">Turkuaz</option>
                                        <option style="color:#008000;" value="#008000">Yeşil</option>
                                        <option style="color:#FFD700;" value="#FFD700">Sarı</option>
                                        <option style="color:#FF8C00;" value="#FF8C00">Turuncu</option>
                                        <option style="color:#FF0000;" value="#FF0000">Kırmızı</option>
                                        <option style="color:#000;" value="#000">Siyah</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label onclick="toggleCheck('check1');" class="label-off" for="check1"
                                        id="check1_label">
                                        Sil
                                    </label>
                                    <input class="nocheckbox" type="checkbox" id="check1" name="delete">
                                </div>
                            </div>
                            <script>
                                function toggleCheck(check) {
                    if ($('#' + check).is(':checked')) {
                      $('#' + check + '_label').removeClass('label-on');
                      $('#' + check + '_label').addClass('label-off');
                    } else {
                      $('#' + check + '_label').addClass('label-on');
                      $('#' + check + '_label').removeClass('label-off');
                    }
                  }
                            </script>
                            <input type="hidden" name="id" class="form-control" id="id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- ModalEdit end-->

        <!-- Yeni Ziyaret Raporu Ekleme modal-->
        <div class="modal fade" id="addVisitReport" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Yeni Ziyaret Raporu Ekle</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="../core/addVisitReport.php" method="POST" enctype="multipart/form-data">
                            <div class="row col-12">
                                <label for="visit_report_name">
                                    <h5><b>Raporun Adını Giriniz</b></h5>
                                    <a style="color:red">*Lütfen dosya isminde "_" (alt çizgi) karakteri
                                        kullanmayın!</a>
                                </label>
                                <input name="visit_report_name" id="visit_report_name" class="form-control" type="text"
                                    maxlength="20" placeholder="Rapor Adı" required>
                            </div>
                            <br>
                            <div class="row col-12">
                                <label for="visit_report_date">
                                    <h5><b>Raporun Tarihini Giriniz</b></h5>
                                </label>
                                <input name="visit_report_date" id="visit_report_date" class="form-control" type="date"
                                    required>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <input type="number" name="company_id" value="" hidden>
                                <input type="text" name="company_name" value="" hidden>
                                <input type="file" class="btn btn-sm" name="ziyaret_dosyası" id="ziyaret_dosyası"
                                    style="margin-right:auto;" required>
                                <button type="submit" class="btn btn-primary" name="ziyaret_dosyası_yukle"
                                    id="ziyaret_dosyası_yukle">Yükle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- addVisitReport end-->

        <!-- Yeni İşletme Raporu Yükleme modal-->
        <div class="modal fade" id="uploadReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel"><b>İşletmeye Ait Rapor Ekle</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="../core/uploadReport.php" method="POST" enctype="multipart/form-data">
                            <div class="row col-12">
                                <label for="upload_report_name">
                                    <h5><b>Raporun Adını Giriniz</b></h5>
                                    <a style="color:red">*Lütfen dosya isminde "_" (alt çizgi) karakteri
                                        kullanmayın!</a>
                                </label>
                                <input name="upload_report_name" id="upload_report_name" class="form-control"
                                    type="text" maxlength="40" placeholder="Rapor Adı" required>
                            </div>
                            <br>
                            <div class="row col-12">
                                <label for="visit_report_date">
                                    <h5><b>Raporun Tarihini Giriniz</b></h5>
                                </label>
                                <input name="upload_report_date" id="upload_report_date" class="form-control"
                                    type="date" required>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <input type="number" name="company_id" value="" hidden>
                                <input type="text" name="company_name" value="" hidden>
                                <input type="file" class="btn btn-sm" name="uploadReportFile" id="uploadReportFile"
                                    style="margin-right:auto;" required>
                                <button type="submit" class="btn btn-primary" name="uploadReportBtn"
                                    id="uploadReportBtn">Yükle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- addVisitReport end-->

        <!-- Yeni Ekipman Ekle-->
        <div class="modal fade" id="addEquipment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Yeni Ekipman Ekle</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../core/eqSave.php" method="POST">
                        <div class="modal-body">
                            <div class="row col-12">
                                <label for="eq_name">
                                    <h5><b>Ekipmanın Adını Giriniz</b></h5>
                                </label>
                                <input name="eq_name" id="eq_name" class="form-control" type="text" maxlength="100"
                                    placeholder="Ekipman Adı" required>
                            </div>
                            <br>
                            <div class="row col-12">
                                <label for="eq_purpose">
                                    <h5><b>Ekipmanın Kullanım Amacını Giriniz</b></h5>
                                </label>
                                <input name="eq_purpose" id="eq_purpose" class="form-control" type="text"
                                    placeholder="Kullanım Amacı" required>
                            </div>
                            <br>
                            <div class="row col-12">
                                <label for="eq_freq">
                                    <h5><b>Ekipmanın Düzenli Kontrol Aralığını Giriniz</b></h5>
                                </label>
                                <select name="eq_freq" id="eq_freq" class="form-control" required>
                                    <option value="" selected disabled>Kontrol Aralığı</option>
                                    <option value="1">1 Ay</option>
                                    <option value="2">2 Ay</option>
                                    <option value="3">3 Ay</option>
                                    <option value="4">4 Ay</option>
                                    <option value="5">5 Ay</option>
                                    <option value="6">6 Ay</option>
                                    <option value="7">7 Ay</option>
                                    <option value="8">8 Ay</option>
                                    <option value="9">9 Ay</option>
                                    <option value="10">10 Ay</option>
                                    <option value="11">11 Ay</option>
                                    <option value="12">12 Ay</option>
                                    <option value="18">18 Ay</option>
                                    <option value="24">24 Ay</option>
                                    <option value="36">36 Ay</option>
                                </select>
                            </div>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <input type="number" name="company_id" value="" hidden>
                            <button type="submit" class="btn btn-primary" name="eq_save" id="eq_save">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- addEquipment end-->

        <!-- Yeni Rapor Hazırla-->
        <div class="modal fade" id="addReport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Yeni Rapor Hazırla</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../core/addReport.php" method="POST">
                        <div class="modal-body">
                            <div class="row col-12">
                                <label for="new_report">
                                    <h5><b>Rapor Seç</b></h5>
                                </label>
                                <select name="new_report" id="new_report" class="form-control" required>
                                    <option value="" selected disabled>Rapor Seç</option>
                                    <option value="katip_sozlesme">İSG Katip Sözleşmeleri</option>
                                    <option value="yangın">Yangın Tatbikat Raporu</option>
                                    <option value="egitim_plan">Yıllık Eğitim Planı</option>
                                    <option value="calisma_plan">Yıllık Çalışma Planı(50 üstü)</option>
                                    <option value="takip_liste">Klasör Takip Listesi</option>
                                    <option value="tabela_liste">Tabela Listeleri</option>
                                    <optgroup label="Risk Analizi">
                                        <option value="ekip_atamasi">Ekip Ataması</option>
                                        <option value="risk_basla">Risk Değerlendirme Başlanması</option>
                                        <option value="ust_yonetim">Üst Yönetime Sunum</option>
                                        <option value="risk_tablo">Risk Analiz Tablosu</option>
                                        <option value="covid19">Covid 19 Risk Değerlendirme Raporu</option>
                                        <option value="sonuc">Sonuç Raporu</option>
                                    </optgroup>
                                    <optgroup label="Acil Durum Planı">
                                        <option value="acil_plan_kapak">Acil Durum Eylem Planı Kapak</option>
                                        <option value="acil_plan">Acil Durum Eylem Planı</option>
                                        <option value="acil_plan_sema">Acil Durum Şemları</option>
                                    </optgroup>
                                    <optgroup label="Sağlık Güvenlik Planı">
                                        <option value="sgp_kapak">SGP Kapak</option>
                                        <option value="sg_plan">Sağlık Güvenlik Planı</option>
                                        <option value="hazırlık">Hazırlık Koordinatörü</option>
                                        <option value="uygulama">Uygulama Koordinatörü</option>
                                    </optgroup>
                                    <option value="acil_ekip">Acil Durum Müdahale Ekipleri</option>
                                </select>
                            </div>
                            <br>
                        </div>
                        <div class="modal-footer">
                            <input type="number" name="company_id" id="company_id" value="" hidden>
                            <input type="text" name="company_name" value="" hidden>
                            <button type="submit" name="addReport_sub" class="btn btn-primary">Hazırla</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- addReport end-->

        <!-- İşletme bilgilerini değiştir-->
        <div class="modal fade" id="changeCompany" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <form action="{{ route('company.handle',['id' => @Hashids::encode($company->id , 15, 298, 177)]) }}"
                        method="POST">
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
                                    <a class="nav-link text-dark" id="link2-tab" data-toggle="tab" role="tab"
                                        href="#link2" aria-selected="false" aria-controls="link2">
                                        <h5><b>Çalışan Ata</b></h5>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" id="link3-tab" data-toggle="tab" role="tab"
                                        href="#link3" aria-selected="false" aria-controls="link3">
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
                                                    id="name" maxlength="250" readonly required
                                                    value="{{ $company->name }}">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="mail">
                                                    <h5><strong>İşletme Mail Adresi</strong></h5>
                                                </label>
                                                <input class="form-control" type="email" placeholder="E-mail"
                                                    name="email" id="email" maxlength="125" required
                                                    value="{{ $company->email }}">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="phone">
                                                    <h5><strong>İşletme Telefon No</strong></h5>
                                                </label>
                                                <input class="form-control" type="tel" name="phone" id="phone"
                                                    placeholder="Tel: 0XXXXXXXXXX"
                                                    pattern="(\d{4})(\d{3})(\d{2})(\d{2})" maxlength="11" required
                                                    value="{{ $company->phone }}">
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
                                                    <h5><strong>İşletme Anlaşma Tarihi<a
                                                                style="color:red">*</a></strong></h5>
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

                                <div class="tab-pane fade" id="link2" role="tabpanel" aria-labelledby="link2-tab">
                                    <div class="modal-body">
                                        <div class="row">
                                            <!--1. İsg Uzmanı -->
                                            <div class="col-lg-4">
                                                <label for="uzman">
                                                    <h5><b>1. İsg Uzmanı</b></h5>
                                                </label>

                                                <select class="form-control" id="uzman" name="uzman" size="1">
                                                    @foreach ($selectExperts[0] as $selectExpert)
                                                    <option value="{{ $selectExpert->id }}" >{{ $selectExpert->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!--2. İsg Uzmanı -->
                                            <div class="col-lg-4">
                                                <label for="uzman_2">
                                                    <h5><b>2.İsg Uzmanı</b></h5>
                                                </label>

                                                <select class="form-control" id="uzman_2" name="uzman_2" size="1">

                                                    @foreach ($selectExperts[0] as $selectExpert)
                                                    <option value="{{ $selectExpert->id }}" >{{ $selectExpert->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <!--3. İsg Uzmanı -->
                                            <div class="col-lg-4">
                                                <label for="uzman_3">
                                                    <h5><b>3.İsg Uzmanı</b></h5>
                                                </label>

                                                <select class="form-control" id="uzman_3" name="uzman_3" size="1">

                                                    @foreach ($selectExperts[0] as $selectExpert)
                                                    <option value="{{ $selectExpert->id }}" >{{ $selectExpert->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <hr style="border-top: 1px dashed red;">
                                        <br>

                                        <!--İş Yeri Hekimleri-->
                                        <div class="row">

                                            <!--1 İş Yeri Hekimi -->
                                            <div class="col-lg-4">
                                                <label for="hekim">
                                                    <h5><b>1. İş Yeri Hekimi</b></h5>
                                                </label>

                                                <select class="form-control" id="hekim" name="hekim" size="1">

                                                    @foreach ($selectExperts[1] as $selectExpert)
                                                    <option value="{{ $selectExpert->id }}" >{{ $selectExpert->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <!--2. İş Yeri Hekimi -->
                                            <div class="col-lg-4">
                                                <label for="hekim_2">
                                                    <h5><b>2. İş Yeri Hekimi</b></h5>
                                                </label>

                                                <select class="form-control" id="hekim_2" name="hekim_2" size="1">

                                                    @foreach ($selectExperts[1] as $selectExpert)
                                                    <option value="{{ $selectExpert->id }}" >{{ $selectExpert->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <!--3. İş Yeri Hekimi -->
                                            <div class="col-lg-4">
                                                <label for="hekim_3">
                                                    <h5><b>3. İş Yeri Hekimi</b></h5>
                                                </label>

                                                <select class="form-control" id="hekim_3" name="hekim_3" size="1">

                                                    @foreach ($selectExperts[1] as $selectExpert)
                                                    <option value="{{ $selectExpert->id }}" >{{ $selectExpert->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <hr style="border-top: 1px dashed red;">
                                        <br>

                                        <!--1. Personeller -->
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label for="saglık">
                                                    <h5><b>Sağlık Personeli</b></h5>
                                                </label>

                                                <select class="form-control" id="saglık" name="saglık" size="1">

                                                    @foreach ($selectExperts[2] as $selectExpert)
                                                    <option value="{{ $selectExpert->id }}" >{{ $selectExpert->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <div class="col-lg-4">
                                                <label for="ofis">
                                                    <h5><b>Ofis Personeli</b></h5>
                                                </label>

                                                <select class="form-control" id="ofis" name="ofis" size="1">

                                                    @foreach ($selectExperts[3] as $selectExpert)
                                                    <option value="{{ $selectExpert->id }}" >{{ $selectExpert->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <div class="col-lg-4">
                                                <label for="muhasebe">
                                                    <h5><b>Muhasebe Personeli</b></h5>
                                                </label>

                                                <select class="form-control" id="muhasebe" name="muhasebe" size="1">

                                                    @foreach ($selectExperts[4] as $selectExpert)
                                                    <option value="{{ $selectExpert->id }}" >{{ $selectExpert->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <br>

                                        <!--2. Personeller -->
                                        <div class="row">
                                            <!--2. Sağlık Personeli -->
                                            <div class="col-lg-4">
                                                <label for="saglık_2">
                                                    <h5><b>2.Sağlık Personeli</b></h5>
                                                </label>

                                                <select class="form-control" id="saglık_2" name="saglık_2" size="1">

                                                    @foreach ($selectExperts[2] as $selectExpert)
                                                    <option value="{{ $selectExpert->id }}" >{{ $selectExpert->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <!--2. Ofis Personeli -->
                                            <div class="col-lg-4">
                                                <label for="ofis_2">
                                                    <h5><b>2.Ofis Personeli</b></h5>
                                                </label>

                                                <select class="form-control" id="ofis_2" name="ofis_2" size="1">

                                                    @foreach ($selectExperts[3] as $selectExpert)
                                                    <option value="{{ $selectExpert->id }}" >{{ $selectExpert->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <!--2. Muhasebe Personeli -->
                                            <div class="col-lg-4">
                                                <label for="muhasebe_2">
                                                    <h5><b>2.Muhasebe Personeli</b></h5>
                                                </label>

                                                <select class="form-control" id="muhasebe_2" name="muhasebe_2" size="1">

                                                    @foreach ($selectExperts[4] as $selectExpert)
                                                    <option value="{{ $selectExpert->id }}" >{{ $selectExpert->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="link3" role="tabpanel" aria-labelledby="home-tab">
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
                                                <input class="form-control" id="katip_is_yeri_id"
                                                    name="katip_is_yeri_id" type="tel" maxlength="30" required
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
                            <input type="hidden" name="companyId"
                                value="{{ @Hashids::encode($company->id , 15, 298, 177) }}">
                            <button class="btn btn-primary btn-lg" type='submit' name='changeRequest'>Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <!-- Yeni Kullanıcı Oluştur-->
        <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Yeni Kullanıcı Oluştur</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-sm">
                                    <label for="firstname"><strong>Adı</strong></label>
                                    <input type="text" class="form-control" placeholder="Adı" name="cu_firstname"
                                        required>
                                </div>
                                <div class="col-sm">
                                    <label for="lastname"><strong>Soy Adı </strong></label>
                                    <input type="text" class="form-control" placeholder="Soy Adı" name="cu_lastname"
                                        required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-10">
                                    <label for="email"><strong>E-mail </strong></label>
                                    <input type="email" class="form-control" placeholder="E-mail" name="cu_username"
                                        required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="phone"><strong>Telefon No </strong></label>
                                    <input type="tel" class="form-control" name="cu_phone"
                                        placeholder="Tel: 05XXXXXXXXX" pattern="(\d{4})(\d{3})(\d{2})(\d{2})"
                                        maxlength="11" required>
                                </div>
                            </div>
                            <br>
                            <div style="float: right;">
                                <input type="number" name="company_id" value="" hidden>
                                <input type="text" name="company_name" value="" hidden>
                                <button id="kayıt" name="cu_kayıt" type="submit" class="btn btn-success">Kaydet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- addUser end-->
    </div>
    <!--card end-->
</div>
<!--container end-->
@push('styles')
<link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

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
            id = hashids.encode(data['id']);
            window.location.href="company/"+id
        });
    } );
</script>
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
@endpush

@endsection
