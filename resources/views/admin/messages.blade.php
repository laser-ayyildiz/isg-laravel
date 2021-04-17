@extends('layouts.admin')
@section('title')Mesajlar - @endsection
@section('content')

<div class="card shadow-lg">
    <div class="card-header bg-light">
        <h1 class="text-dark mb-1" style="text-align: center;"><b>Mesajlar</b></h1>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                data-whatever="@getbootstrap">Yeni Mesaj</button>
            <button type="submit" class="btn btn-danger" name="hepsini_sil">Hepsini Sil</button>
            <div class="form-group col-md-4" style="float:right;">
                <input type="text" class="form-control" id="myInput" onkeyup="myFunction()"
                    placeholder="Mesajlarda Ara...">
            </div>
        </form>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Mesaj Oluştur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="messages.php" method="POST">
                            <label><strong>Kime:</strong>
                                <select class="form-control" id="kime" name="kime" size="1" required>

                                    <option value=""></option>

                                </select>
                                <br>
                                <label><strong>Mesajınızın Konusu:</strong>
                                    <input type="text" class="form-control" placeholder="Konu" name="konu"
                                        required></label>
                                <br>
                                <label for="mesaj"><b>Mesajınız:</b></label>
                                <textarea class="form-control" id="mesaj" name="mesaj" rows="5" cols="120"
                                    style="max-width: 100%;"></textarea>
                                <div class="modal-footer">
                                    <button id="gönder" name="gönder" type="submit"
                                        class="btn btn-success">Gönder</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive table table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
            <table class="table-bordered table-striped table-hover" style="width:99%" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <div style="text-align:center">
                            <h3><b>Gelen Kutusu</b>
                                <h3>
                        </div>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td data-toggle="modal" data-target="#a" data-whatever="@getbootstrap">
                            <div class="media">

                                <img class="a" src="assets/users/" class="media-object">

                                <div class="media-body">
                                    <h4 class="text-primary"><b>&emsp;Konu: </b></h4>
                                    <h5 class="text-success"><span class="media-meta"><b>&emsp;&emsp;<b>Kimden:
                                                </b></span></h5>
                                    <h6 class="text-secondary">&emsp;&emsp;</h6> &emsp;<b>Tarih:
                                    </b>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <div class="modal fade" id="a" tabindex="-1" aria-labelledby="exampleModalLabel2"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel2">Gelen Mesaj</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="" action="messages.php" method="POST">
                                        <label for"kimden"><strong>Kimden:</strong>
                                            <input readonly name="kimden" class="form-control" id="kimden"
                                                value=""></label>
                                        <br>
                                        <label for="konu"><strong>Konu:</strong>
                                            <input readonly class="form-control" name="konu" id="konu" value=""></label>
                                        <br>
                                        <label for="texta"><b>Mesaj:</b></label>
                                        <textarea readonly form="" class="form-control" id="mesaj" name="mesaj" rows="5"
                                            cols="120" style="max-width: 100%;"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button id="sil" name="sil" type="submit" class="btn btn-danger">Sil</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
