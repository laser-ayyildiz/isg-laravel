@extends('layouts.admin')
@section('title')OSGB Çalışanları - @endsection
@section('content')
<div class="card-header border text-dark bg-light">
    <h1 style="text-align:center;"><b>Çalışanlar</b></h1>
</div>
<div class="card shadow-lg">
    <div class="card-body border">
        <div class="form-group col-md-4" style="float:right;">
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()"
                placeholder="Çalışan ismi ile ara...">
        </div>
        <div id="dataTable_filter">
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                    data-whatever="@getbootstrap">Yeni Çalışan Ekle</button>
                <button type="button" class="btn btn-danger" onclick="window.location.href='deleted_workers.php'">Arşiv
                </button>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-lg">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Çalışan Bilgileri</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="osgb_users.php" method="POST">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="user_type"><strong>Kullanıcı türünü seçin</strong></label>
                                        <select class="form-control" placeholder="Kullanıcı Türünü seçin"
                                            list="user_type" name="user_type" required>
                                            <option value="" disabled selected>Kullanıcı Türü</option>
                                            <optgroup label="İsg Uzmanı">
                                                <option value="İsg Uzmanı 1">İsg Uzmanı 1</option>
                                                <option value="İsg Uzmanı 2">İsg Uzmanı 2</option>
                                                <option value="İsg Uzmanı 3">İsg Uzmanı 3</option>
                                            </optgroup>
                                            <option value="Yönetici">Yönetici</option>
                                            <option value="Hekim">Hekim</option>
                                            <option value="Ofis Personeli">Ofis Personeli</option>
                                            <option value="Diğer Sağlık Personeli">Diğer Sağlık Personeli</option>
                                            <option value="Muhasebe Personeli">Muhasebe Personeli</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="firstname"><strong>Adı</strong></label>
                                        <input type="text" class="form-control" placeholder="Adı" name="firstname"
                                            required>
                                    </div>
                                    <div class="col-sm">
                                        <label for="lastname"><strong>Soy Adı </strong></label>
                                        <input type="text" class="form-control" placeholder="Soy Adı" name="lastname"
                                            required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-10">
                                        <label for="email"><strong>E-mail </strong></label>
                                        <input type="email" class="form-control" placeholder="E-mail" name="email"
                                            required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="phone"><strong>Telefon No </strong></label>
                                        <input type="tel" class="form-control" name="phone"
                                            placeholder="Tel: 05XXXXXXXXX" pattern="(\d{4})(\d{3})(\d{2})(\d{2})"
                                            maxlength="11" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="start_date"><strong>İşe Giriş Tarihi </strong></label>
                                        <input type="date" class="form-control" placeholder="İşe giriş"
                                            name="start_date" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="tc"><strong>T.C Kimlik No </strong></label>
                                        <input type="tel" class="form-control" placeholder="T.C Kimlik No" name="tc"
                                            minlength="11" maxlength="11" required>
                                    </div>
                                </div>
                                <br>
                                <div style="float: right;">
                                    <button id="kayıt" name="kayıt" type="submit"
                                        class="btn btn-success">Kaydet</button>
                                    <button type="reset" class="btn btn-danger">Sıfırla</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
            <table class="table table-striped table-bordered table-hover" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Ad</th>
                        <th>Soyad</th>
                        <th>Çalışma Alanı</th>
                        <th>T.C Kimlik No</th>
                        <th>İşe Giriş Tarihi</th>
                        <th>Düzenle/Sil</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($osgb_employees ?? '' as $employee)
                    <tr>
                        <td> {{ $employee -> firstname }} </td>
                        <td> {{ $employee -> lastname }} </td>
                        <td> {{ $employee -> user_type }} </td>
                        <td> {{ $employee -> tc }} </td>
                        <td> {{ $employee -> start_at }} </td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a"
                                data-whatever="@getbootstrap">Düzenle</button>
                        </td>
                    <div class="modal fade" id="a" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Düzenle</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="osgb_users.php" method="POST">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label><strong>Kullanıcı türünü seçin</strong></label>
                                                <select class="form-control" placeholder="Kullanıcı Türünü seçin"
                                                    list="user_type" name="user_type" required>
                                                    <option value="" disabled selected>
                                                    </option>
                                                    <optgroup label="İsg Uzmanı">
                                                        <option value="İsg Uzmanı 1">İsg Uzmanı 1</option>
                                                        <option value="İsg Uzmanı 2">İsg Uzmanı 2</option>
                                                        <option value="İsg Uzmanı 3">İsg Uzmanı 3</option>
                                                    </optgroup>
                                                    <option value="Yönetici">Yönetici</option>
                                                    <option value="Hekim">Hekim</option>
                                                    <option value="Ofis Personeli">Ofis Personeli</option>
                                                    <option value="Diğer Sağlık Personeli">Diğer Sağlık Personeli
                                                    </option>
                                                    <option value="Muhasebe Personeli">Muhasebe Personeli</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="firstname"><strong>Adı</strong></label>
                                                <input type="text" class="form-control" placeholder="Adı"
                                                    name="firstname" value="" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="lastname"><strong>Soy Adı </strong></label>
                                                <input type="text" class="form-control" placeholder="Soy Adı"
                                                    name="lastname" value="" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <label for="email"><strong>E-mail </strong></label>
                                                <input type="email" class="form-control" placeholder="E-mail"
                                                    name="email" value="" readonly required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="phone"><strong>Telefon No </strong></label>
                                                <input type="tel" class="form-control" name="phone"
                                                    placeholder="Tel: 05XXXXXXXXX"
                                                    pattern="(\d{4})(\d{3})(\d{2})(\d{2})" maxlength="11" value=""
                                                    required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="start_date"><strong>İşe Giriş Tarihi </strong></label>
                                                <input type="date" class="form-control" placeholder="İşe giriş"
                                                    name="start_date" value="" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="tc"><strong>T.C Kimlik No </strong></label>
                                                <input type="number" class="form-control" placeholder="T.C Kimlik No"
                                                    name="tc" min="11" maxlength="11" value="" readonly required>
                                            </div>
                                        </div>
                                        <br>
                                        <label for="not"><strong>Çalışan hakkında not </strong></label>
                                        <textarea class="form-control" id="not" name="not" rows="5" cols="120"
                                            style="max-width: 100%;"></textarea>
                                        <br>
                                        <div style="float: right;">
                                            <button id="onay" name="onay" type="submit"
                                                class="btn btn-success">Kaydet</button>
                                            <button type="submit" class="btn btn-danger" name="sil"
                                                id="sil">Sil</button>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>Ad</strong></td>
                        <td><strong>Soyad</strong></td>
                        <td><strong>Çalışma Alanı</strong></td>
                        <td><strong>T.C Kimlik No</strong></td>
                        <td><strong>İşe Giriş Tarihi</strong></td>
                        <td><strong>Düzenle/Sil</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="float-right my-3">
            {{ $osgb_employees -> links() }}
        </div>
    </div>
    @endsection
