@extends('layouts.admin')
@section('title')Onay Bekleyenler - @endsection
@section('content')
@if (session('deleteStatus'))
<div class="alert alert-success">
    {{ session('deleteStatus') }}
</div>
@endif
<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Onay Bekleyen Değişiklikler</b></h1>
    </div>
    <div class="card-body">
        <div>
            <div class="table table-responsive mt-2">
                <table class="table table-striped table-bordered table-hover data-table" id="example">
                    <thead class="thead-dark">
                        <tr>
                            <th>İşletme Adı</th>
                            <th>Sektör</th>
                            <th>Telefon</th>
                            <th>E-mail</th>
                            <th>Şehir</th>
                            <th>İlçe</th>
                            <th>Anlaşma Tarihi</th>
                            <th>Düzenleyen</th>
                            <th>Düzenlenme Tarihi</th>
                            <th>Düzenle/Sil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Düzenleme Modal -->
                        <div class="modal fade" id="change" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Düzenle</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <p><b>Düzenlenme tarihi:&emsp;</b> </p>
                                            <p><b>Düzenlemeye gönderen kullanıcı:&emsp;</b> </p>
                                            <p><b>İsg Uzmanı</b>:&emsp;</p>
                                            <p><b>İş Yeri Hekimi</b>:&emsp;</p>

                                            <br>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="name"><strong>İşletme
                                                            Adı:&emsp;</strong></label>
                                                    <input class="form-control" type="text" placeholder="Adı"
                                                        name="name" value=""></div>
                                                <br>
                                                <div class=" row">

                                                    <div class="col-sm-4">
                                                        <label for="eski_mail"><strong>Eski Mail
                                                                Adresi</strong></label>
                                                        <input class="form-control" type="email" name="eski_mail"
                                                            value="" readonly>
                                                        <br>
                                                        <label for="email" style="color:red"><strong>Yeni
                                                                Mail Adresi:&emsp;</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="email" placeholder="E-mail" name="email" value=""
                                                            required>
                                                        <br>
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <label for="eski_type"><strong>Eski
                                                                Sektör</strong></label>
                                                        <input class="form-control" type="text" placeholder="E-mail"
                                                            name="eski_type" value="" readonly>
                                                        <br>
                                                        <label for="comp_type" style="color:red"><strong>Yeni
                                                                Sektör</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            placeholder="İşletmenin çalıştığı sektör:" list="comp_type"
                                                            name="comp_type" autocomplete="off" value="" reqiured />
                                                    </div>

                                                    <div class="col-sm-6">

                                                        <label for="eski_phone"><strong>Eski Telefon
                                                                No</strong></label>
                                                        <input class="form-control" type="tel" name="eski_phone"
                                                            value="" readonly>
                                                        <br>
                                                        <label for="phone" style="color:red"><strong>Yeni
                                                                Telefon No</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="tel" name="phone" placeholder="Tel: 0XXXXXXXXXX"
                                                            pattern="(\d{4})(\d{3})(\d{2})(\d{2})" value=""
                                                            maxlength="11" required>

                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <br>
                                                        <label for="eski_city"><strong>Eski
                                                                Şehir</strong></label>
                                                        <input class="form-control" type="text" name="eski_town"
                                                            value="" readonly>
                                                        <br>
                                                        <label for="city" style="color:red"><strong>Yeni
                                                                Şehir</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="text" placeholder="Şehir" name="city" value=""
                                                            required>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <br>
                                                        <label for="eski_town"><strong>Eski
                                                                İlçe</strong></label>
                                                        <input class="form-control" type="text" placeholder="E-mail"
                                                            name="eski_city" value="" readonly>
                                                        <br>
                                                        <label for="town" style="color:red"><strong>Yeni
                                                                İlçe</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="text" placeholder="İlçe" name="town" value=""
                                                            required>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <br>
                                                        <label for="eski_contract_date"><strong>Eski
                                                                Anlaşma
                                                                Tarihi</strong></label>
                                                        <input class="form-control" type="date"
                                                            name="eski_contract_date" value="" readonly>
                                                        <br>
                                                        <label for="contract_date" style="color:red"><strong>Yeni
                                                                Anlaşma
                                                                Tarihi:&emsp;</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="date" placeholder="Anlaşma Tarihi"
                                                            name="contract_date" value="" required>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <br>
                                                        <label for="eski_address"><strong>Eski
                                                                Adres</strong></label>
                                                        <input class="form-control" type="text" name="eski_address"
                                                            value="" readonly>
                                                        <br>
                                                        <label for="address" style="color:red"><strong>Yeni
                                                                Adres:&emsp;</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="text" placeholder="Adres" name="address" value=""
                                                            required>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <br>
                                                        <label for="eski_remi_freq"><strong>Eski Ziyaret
                                                                Sıklığı(Ay)</strong></label>
                                                        <input class="form-control" type="text" name="eski_remi_freq"
                                                            value="" readonly>
                                                        <br>
                                                        <label for="remi_freq" style="color:red"><strong>Yeni
                                                                Ziyaret
                                                                Sıklığı(Ay):&emsp;</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="text" placeholder="Ziyaret Sıklığı" name="remi_freq"
                                                            value="" required>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <br>
                                                        <label for="eski_is_veren"><strong>Eski İşveren
                                                                Ad
                                                                Soyad</strong></label>
                                                        <input class="form-control" type="text" name="eski_is_veren"
                                                            value="" readonly>
                                                        <br>
                                                        <label for="is_veren" style="color:red"><strong>Yeni
                                                                İşveren Ad Soayd:&emsp;</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="text" placeholder="İşveren Ad Soyad" name="is_veren"
                                                            value="" required>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <br>
                                                        <label for="eski_mersis_no"><strong>Eski Mersis
                                                                No</strong></label>
                                                        <input class="form-control" type="text" name="eski_mersis_no"
                                                            value="" readonly>
                                                        <br>
                                                        <label for="mersis_no" style="color:red"><strong>Yeni
                                                                Mersis
                                                                No:&emsp;</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="text" placeholder="Mersis No" name="mersis_no"
                                                            value="" required>
                                                    </div>


                                                    <div class="col-sm-4">
                                                        <br>
                                                        <label for="eski_sgk_sicil"><strong>Eski SGK
                                                                Sicil
                                                                No</strong></label>
                                                        <input class="form-control" type="text"
                                                            name="eski_contract_date" value="" readonly>
                                                        <br>
                                                        <label for="sgk_sicil" style="color:red"><strong>Yeni
                                                                SGK Sicil
                                                                No:&emsp;</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="text" name="sgk_sicil" value="" required>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <br>
                                                        <label for="eski_vergi_no"><strong>Eski Vergi
                                                                No</strong></label>
                                                        <input class="form-control" type="text" name="eski_vergi_no"
                                                            value="" readonly>
                                                        <br>
                                                        <label for="vergi_no" style="color:red"><strong>Yeni
                                                                Vergi No:&emsp;</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="text" name="vergi_no" value="" required>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <br>
                                                        <label for="eski_vergi_dairesi"><strong>Eski
                                                                Vergi
                                                                Dairesi</strong></label>
                                                        <input class="form-control" type="text"
                                                            name="eski_vergi_dairesi" value="" readonly>
                                                        <br>
                                                        <label for="vergi_dairesi" style="color:red"><strong>Yeni
                                                                Vergi
                                                                Dairesi:&emsp;</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="text" name="vergi_dairesi" value="" required>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <br>
                                                        <label for="eski_katip_is_yeri_id"><strong>Eski
                                                                Katip İş Yeri ID</strong></label>
                                                        <input class="form-control" type="text"
                                                            name="eski_katip_is_yeri_id" value="" readonly>
                                                        <br>
                                                        <label for="katip_is_yeri_id" style="color:red"><strong>Yeni
                                                                Katip İş Yeri
                                                                ID:&emsp;</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="text" name="katip_is_yeri_id" value="" required>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <br>
                                                        <label for="eski_katip_kurum_id"><strong>Eski
                                                                Katip
                                                                Kurum ID</strong></label>
                                                        <input class="form-control" type="text"
                                                            name="eski_katip_kurum_id" value="" readonly>
                                                        <br>
                                                        <label for="katip_kurum_id" style="color:red"><strong>Yeni
                                                                Katip Kurum
                                                                ID:&emsp;</strong></label>
                                                        <input class="form-control" style="border: 2px solid red;"
                                                            type="text" name="katip_kurum_id" value="" required>
                                                    </div>

                                                </div>
                                                <br>
                                                <div style="float: right;">

                                                    <button name="onay" id="onay" type="submit"
                                                        class="btn btn-success">Düzenlemeyi
                                                        Onayla</button>
                                                    <button name="düzenleme_iptal" id="düzenleme_iptal" type="submit"
                                                        class="btn btn-danger">Düzenlemeleri
                                                        İptal Et</button>

                                                    <button type="submit" class="btn btn-danger" name="sil"
                                                        id="sil">İşletmeyi Sil</button>
                                                    <button name="düzenleme_iptal" id="düzenleme_iptal" type="submit"
                                                        class="btn btn-danger">Düzenlemeleri
                                                        İptal Et</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Silme Modal -->
                        <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h3>
                                            işletmesini silmek istediğinizden emin misiniz?
                                        </h3>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('admin.validate.delete') }}" method="POST">
                                            @csrf
                                            <input name="id" type="hidden" value="">
                                            <button type="submit" class="btn btn-secondary mr-auto" name="rejectDelete"
                                                value="aaa">Düzenleme talebini
                                                reddet</button>
                                            <button type="submit" class="btn btn-danger ml-auto"
                                                name="acceptDelete">İşletmeyi Sil</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
    $(function () {
          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              DT_RowId: true,
              ajax: "{{ route('admin.change_validate') }}",
              columns: [
                  {data: 'name', name: 'name'},
                  {data: 'type', name: 'type'},
                  {data: 'phone', name: 'phone'},
                  {data: 'address', name: 'address'},
                  {data: 'email', name: 'email'},
                  {data: 'city', name: 'city'},
                  {data: 'town', name: 'town'},
                  {data: 'contract_at', name: 'contract_at'}
                  {data: 'changer', name: 'changer'},
                  {data: 'updated_at', name: 'updated_at'},
                  "defaultContent": "<button>Click!</button>"
              ],
              "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
                }
          });
          $('#example tbody').on('click', 'tr', function () {
            var data = table.row(this).data();
            window.location.href="company/"+data['id'];
          }

          $('#example tbody').on( 'click', 'button', function () {
            var data = table.row( $(this).parents('tr') ).data();
            if ('changer' == 1){
                $('#change').modal('show');
            }
            if ('changer' == 2){
                $('#delete').modal('show');
            }
           });

        });

    });
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
