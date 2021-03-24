@extends('layouts.admin')
@section('title')Auth - @endsection
@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header border bg-light">
            <h1 class="text-dark mb-1" style="text-align: center;"><b>Çalışan Yetkilendir</b></h1>
        </div>
        <div class="card-body border">
            <div class="row col-md-4">
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()"
                    placeholder="Çalışan ismi ile ara...">
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
                            <th>Yetkilendir</th>
                            <th>Yetkisini Kaldır</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#a"
                                    data-whatever="@getbootstrap">Yetkilendir</button></td>
                            <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#b"
                                    data-whatever="@getbootstrap">Yetkisini Kaldır</button></td>
                        </tr>
                        <div class="modal fade" id="a" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Yetkilendir</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="authentication.php" method="POST">
                                            <div class="row col-sm-10">
                                                <label><b>Kullanıcı adı</b></label>
                                                <input class="form-control" name="username" value="" readonly>
                                            </div>
                                            <br>
                                            <div class="row col-sm-10">
                                                <label><b>Yetkilendirileceği işletmeyi seçin</b></label>
                                                <select class="form-control" name="comp_name" required>
                                                    <option value="" disabled>İş Yeri Seç</option>

                                                </select>
                                            </div>
                                            <br>
                                            <div style="float: right;">
                                                <button id="yetkilendir" name="yetkilendir" type="submit"
                                                    class="btn btn-success">Yetkilendir</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="b" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Yetkisini Kaldır</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="authentication.php" method="POST">
                                            <div class="row col-sm-10">
                                                <label><b>Kullanıcı adı</b></label>
                                                <input class="form-control" name="username" value="" readonly>
                                            </div>
                                            <br>
                                            <div class="row col-sm-10">
                                                <label><b>Yetkilendirildiği işletmeler</b></label>
                                                <select class="form-control" name="comp_name" required>
                                                    <option value="" disabled>İş Yeri Seç</option>

                                                </select>
                                            </div>
                                            <br>
                                            <div style="float:left;">
                                                <button id="hepsini_kaldır" name="hepsini_kaldır" type="submit"
                                                    class="btn btn-warning">Bütün Yetkilerini Kaldır</button>
                                            </div>
                                            <div style="float: right;">
                                                <button id="yetki_kaldır" name="yetki_kaldır" type="submit"
                                                    class="btn btn-danger">Seçili Yetkisini Kaldır</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>

            </tbody>
            <tfoot>
                <tr>
                    <td><strong>Ad</strong></td>
                    <td><strong>Soyad</strong></td>
                    <td><strong>Çalışma Alanı</strong></td>
                    <td><strong>T.C Kimlik No</strong></td>
                    <td><strong>İşe Giriş Tarihi</strong></td>
                    <td><strong>Yetkilendir</strong></td>
                    <td><strong>Yetkisini Kaldır</strong></td>
                </tr>
            </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
