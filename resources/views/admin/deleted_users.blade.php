@extends('layouts.admin')
@section('title')Silinen Çalışanlar - @endsection
@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Çalışan Arşivi</b></h1>
    </div>
    <div class="card-body">
        <div class="form-group col-md-4">
            <input type="text" class="form-control" id="myInput" onkeyup="myFunction()"
                placeholder="Çalışan ismi ile ara...">
        </div>
        <div id="dataTable_filter">
        </div>
        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
            <table class="table table-striped table-bordered" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Ad</th>
                        <th>Soyad</th>
                        <th>Çalışma Alanı</th>
                        <th>T.C Kimlik No</th>
                        <th>İşe Giriş Tarihi</th>
                        <th>Bilgiler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deleted_users ?? '' as $employee)
                    <tr>
                        <td> {{ $employee -> firstname }} </td>
                        <td> {{ $employee -> lastname }} </td>
                        <td> {{ $employee -> user_type }} </td>
                        <td> {{ $employee -> tc }} </td>
                        <td> {{ $employee -> start_at }} </td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a"
                                data-whatever="@getbootstrap">Bilgiler</button></td>

                        <div class="modal fade" id="a" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Bilgiler</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="deleted_workers.php" method="POST">
                                            <div class="col-sm-6">
                                                <label><strong>Kullanıcı türü</strong>
                                                    <select class="form-control" name="user_type" readonly
                                                        id="user_type">
                                                        <option value="" disabled selected>
                                                        </option>
                                                    </select>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="firstname"><strong>Adı</strong>
                                                        <input type="text" class="form-control" placeholder="Adı"
                                                            name="firstname" value="" readonly></label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="lastname"><strong>Soy Adı </strong>
                                                        <input type="text" class="form-control" placeholder="Soy Adı"
                                                            name="lastname" value="" readonly></label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col-sm-12">
                                                <label for "email"><strong>E-mail </strong>
                                                    <input type="email" class="form-control" placeholder="E-mail"
                                                        name="email" value="" readonly></label>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="phone"><strong>Telefon No </strong>
                                                        <input type="tel" class="form-control" name="phone"
                                                            placeholder="Tel: 05XXXXXXXXX"
                                                            pattern="(\d{4})(\d{3})(\d{2})(\d{2})" maxlength="11"
                                                            value="" readonly></label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="start_date"><strong>İşe Giriş Tarihi </strong>
                                                        <input type="date" class="form-control" placeholder="İşe giriş"
                                                            name="start_date" value="" readonly></label>
                                                </div>
                                            </div>
                                            <br>
                                            <label for="tc"><strong>T.C Kimlik No </strong>
                                                <input type="number" class="form-control" placeholder="T.C Kimlik No"
                                                    name="tc" min="11" maxlength="11" value="" readonly></label>
                                            <br>
                                            <label for="not"><strong>Çalışan hakkında not </strong>
                                                <textarea class="form-control" id="not" name="not" rows="5" cols="120"
                                                    style="max-width: 100%;"></textarea></label>
                                            <br>
                                            <div style="float: right;">
                                                <button id="kaydet" name="kaydet" type="submit"
                                                    class="btn btn-success">Notu
                                                    Kaydet</button>
                                                <button id="tamamen_sil" name="tamamen_sil" type="submit"
                                                    class="btn btn-danger">Tamamen Sil</button>
                                                <button id="tekrar" name="tekrar" type="submit"
                                                    class="btn btn-warning">Tekrar Aktifleştir</button>
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
                        <td><strong>Ad</strong></td>
                        <td><strong>Soyad</strong></td>
                        <td><strong>Çalışma Alanı</strong></td>
                        <td><strong>T.C Kimlik No</strong></td>
                        <td><strong>İşe Giriş Tarihi</strong></td>
                        <td><strong>Bilgiler</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="float-right">
            {{ $deleted_users -> links()}}
        </div>

    </div>
</div>

@endsection
