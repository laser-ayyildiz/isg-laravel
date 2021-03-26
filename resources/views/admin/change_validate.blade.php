@extends('layouts.admin')
@section('title')Onay Bekleyenler - @endsection
@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Onay Bekleyen Değişiklikler</b></h1>
    </div>
    <div class="card-body">
        <div class="form-group col-md-4">
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()"
                placeholder="İşletme Adı ile ara...">
        </div>
        <div>
            <div id="dataTable_filter">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table table-striped table-bordered" id="dataTable">
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
                                <th>Düzenle</th>
                                <th>Sil</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($companies ?? '' as $company)
                            <tr>
                                <td> <a href="/admin/{{ $company -> id }}/company">{{ $company -> name }}</a> </td>
                                <td> {{ $company -> type }} </td>
                                <td> {{ $company -> phone }} </td>
                                <td> {{ $company -> email }} </td>
                                <td> {{ $company -> city }} </td>
                                <td> {{ $company -> town }} </td>
                                <td> {{ $company -> contract_at }} </td>
                                <td> {{ $company -> changer }} </td>
                                <td> {{ $company -> updated_at }} </td>



                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a"
                                        data-whatever="@getbootstrap">Düzenle</button></td>

                                <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#a"
                                        data-whatever="@getbootstrap">Sil</button></td>

                                <div class="modal fade" id="a" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">

                                                <h5 class="modal-title" id="exampleModalLabel">Düzenle</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                                <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                            </div>
                                            <div class="modal-body">
                                                <form action="change_validate.php" method="POST">


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
                                                                name="name" value="" </div> </div> <br>
                                                            <div class=" row">

                                                                <div class="col-sm-4">
                                                                    <label for="eski_mail"><strong>Eski Mail
                                                                            Adresi</strong></label>
                                                                    <input class="form-control" type="email"
                                                                        name="eski_mail" value="" readonly>
                                                                    <br>
                                                                    <label for="email" style="color:red"><strong>Yeni
                                                                            Mail Adresi:&emsp;</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="email"
                                                                        placeholder="E-mail" name="email" value=""
                                                                        required>
                                                                    <br>
                                                                </div>

                                                            </div>
                                                            <div class="row">

                                                                <div class="col-sm-6">
                                                                    <label for="eski_type"><strong>Eski
                                                                            Sektör</strong></label>
                                                                    <input class="form-control" type="text"
                                                                        placeholder="E-mail" name="eski_type" value=""
                                                                        readonly>
                                                                    <br>
                                                                    <label for="comp_type"
                                                                        style="color:red"><strong>Yeni
                                                                            Sektör</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;"
                                                                        placeholder="İşletmenin çalıştığı sektör:"
                                                                        list="comp_type" name="comp_type"
                                                                        autocomplete="off" value="" reqiured />
                                                                </div>

                                                                <div class="col-sm-6">

                                                                    <label for="eski_phone"><strong>Eski Telefon
                                                                            No</strong></label>
                                                                    <input class="form-control" type="tel"
                                                                        name="eski_phone" value="" readonly>
                                                                    <br>
                                                                    <label for="phone" style="color:red"><strong>Yeni
                                                                            Telefon No</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="tel"
                                                                        name="phone" placeholder="Tel: 0XXXXXXXXXX"
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
                                                                    <input class="form-control" type="text"
                                                                        name="eski_town" value="" readonly>
                                                                    <br>
                                                                    <label for="city" style="color:red"><strong>Yeni
                                                                            Şehir</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="text"
                                                                        placeholder="Şehir" name="city" value=""
                                                                        required>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <br>
                                                                    <label for="eski_town"><strong>Eski
                                                                            İlçe</strong></label>
                                                                    <input class="form-control" type="text"
                                                                        placeholder="E-mail" name="eski_city" value=""
                                                                        readonly>
                                                                    <br>
                                                                    <label for="town" style="color:red"><strong>Yeni
                                                                            İlçe</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="text"
                                                                        placeholder="İlçe" name="town" value=""
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
                                                                    <label for="contract_date"
                                                                        style="color:red"><strong>Yeni Anlaşma
                                                                            Tarihi:&emsp;</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="date"
                                                                        placeholder="Anlaşma Tarihi"
                                                                        name="contract_date" value="" required>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <br>
                                                                    <label for="eski_address"><strong>Eski
                                                                            Adres</strong></label>
                                                                    <input class="form-control" type="text"
                                                                        name="eski_address" value="" readonly>
                                                                    <br>
                                                                    <label for="address" style="color:red"><strong>Yeni
                                                                            Adres:&emsp;</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="text"
                                                                        placeholder="Adres" name="address" value=""
                                                                        required>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <br>
                                                                    <label for="eski_remi_freq"><strong>Eski Ziyaret
                                                                            Sıklığı(Ay)</strong></label>
                                                                    <input class="form-control" type="text"
                                                                        name="eski_remi_freq" value="" readonly>
                                                                    <br>
                                                                    <label for="remi_freq"
                                                                        style="color:red"><strong>Yeni
                                                                            Ziyaret
                                                                            Sıklığı(Ay):&emsp;</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="text"
                                                                        placeholder="Ziyaret Sıklığı" name="remi_freq"
                                                                        value="" required>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <br>
                                                                    <label for="eski_is_veren"><strong>Eski İşveren
                                                                            Ad
                                                                            Soyad</strong></label>
                                                                    <input class="form-control" type="text"
                                                                        name="eski_is_veren" value="" readonly>
                                                                    <br>
                                                                    <label for="is_veren" style="color:red"><strong>Yeni
                                                                            İşveren Ad Soayd:&emsp;</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="text"
                                                                        placeholder="İşveren Ad Soyad" name="is_veren"
                                                                        value="" required>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <br>
                                                                    <label for="eski_mersis_no"><strong>Eski Mersis
                                                                            No</strong></label>
                                                                    <input class="form-control" type="text"
                                                                        name="eski_mersis_no" value="" readonly>
                                                                    <br>
                                                                    <label for="mersis_no"
                                                                        style="color:red"><strong>Yeni
                                                                            Mersis
                                                                            No:&emsp;</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="text"
                                                                        placeholder="Mersis No" name="mersis_no"
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
                                                                    <label for="sgk_sicil"
                                                                        style="color:red"><strong>Yeni
                                                                            SGK Sicil
                                                                            No:&emsp;</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="text"
                                                                        name="sgk_sicil" value="" required>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <br>
                                                                    <label for="eski_vergi_no"><strong>Eski Vergi
                                                                            No</strong></label>
                                                                    <input class="form-control" type="text"
                                                                        name="eski_vergi_no" value="" readonly>
                                                                    <br>
                                                                    <label for="vergi_no" style="color:red"><strong>Yeni
                                                                            Vergi No:&emsp;</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="text"
                                                                        name="vergi_no" value="" required>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <br>
                                                                    <label for="eski_vergi_dairesi"><strong>Eski
                                                                            Vergi
                                                                            Dairesi</strong></label>
                                                                    <input class="form-control" type="text"
                                                                        name="eski_vergi_dairesi" value="" readonly>
                                                                    <br>
                                                                    <label for="vergi_dairesi"
                                                                        style="color:red"><strong>Yeni Vergi
                                                                            Dairesi:&emsp;</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="text"
                                                                        name="vergi_dairesi" value="" required>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <br>
                                                                    <label for="eski_katip_is_yeri_id"><strong>Eski
                                                                            Katip İş Yeri ID</strong></label>
                                                                    <input class="form-control" type="text"
                                                                        name="eski_katip_is_yeri_id" value="" readonly>
                                                                    <br>
                                                                    <label for="katip_is_yeri_id"
                                                                        style="color:red"><strong>Yeni Katip İş Yeri
                                                                            ID:&emsp;</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="text"
                                                                        name="katip_is_yeri_id" value="" required>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <br>
                                                                    <label for="eski_katip_kurum_id"><strong>Eski
                                                                            Katip
                                                                            Kurum ID</strong></label>
                                                                    <input class="form-control" type="text"
                                                                        name="eski_katip_kurum_id" value="" readonly>
                                                                    <br>
                                                                    <label for="katip_kurum_id"
                                                                        style="color:red"><strong>Yeni Katip Kurum
                                                                            ID:&emsp;</strong></label>
                                                                    <input class="form-control"
                                                                        style="border: 2px solid red;" type="text"
                                                                        name="katip_kurum_id" value="" required>
                                                                </div>

                                                            </div>
                                                            <br>
                                                            <div style="float: right;">

                                                                <button name="onay" id="onay" type="submit"
                                                                    class="btn btn-success">Düzenlemeyi
                                                                    Onayla</button>
                                                                <button name="düzenleme_iptal" id="düzenleme_iptal"
                                                                    type="submit" class="btn btn-danger">Düzenlemeleri
                                                                    İptal Et</button>

                                                                <button type="submit" class="btn btn-danger" name="sil"
                                                                    id="sil">İşletmeyi Sil</button>
                                                                <button name="düzenleme_iptal" id="düzenleme_iptal"
                                                                    type="submit" class="btn btn-danger">Düzenlemeleri
                                                                    İptal Et</button>

                                                            </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><strong>İşletme Adı</strong></td>
                                <td><strong>Sektör</strong></td>
                                <td><strong>Telefon</strong></td>
                                <td><strong>E-mail</strong></td>
                                <td><strong>Şehir</strong></td>
                                <td><strong>İlçe</strong></td>
                                <td><strong>Anlaşma Tarihi</strong></td>
                                <td><strong>Düzenleyen</strong></td>
                                <td><strong>Düzenlenme Tarihi</strong></td>
                                <td><strong>Düzenle</strong></td>
                                <td><strong>Sil</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="float-right my-3">
            {{ $companies ?? '' -> links() }}
        </div>
    </div>
</div>
<script>
    $('#exampleModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('New message to ' + recipient)
      modal.find('.modal-body input').val(recipient)
    })

</script>
@endsection
