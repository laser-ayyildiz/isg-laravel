<div class="tab-pane fade show {{ session('tab') == 'silinen_calisanlar' ? 'active' : '' }}" id="silinen_calisanlar"
    role="tabpanel" aria-labelledby="tr-tab">
    <b>Çalışana ait dosyalara erişmek için çalışanın isminin yazılı olduğu kutucuğa
        tıklayabilirsiniz</b>
    <input type="text" class="form-control" style="float:right;max-width:600px; margin-bottom:15px;" id="myInput"
        onkeyup="myFunction()" placeholder="Çalışan Adı ile ara...">
    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
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
                    <td data-toggle="modal" data-target="#c" data-whatever="@getbootstrap" style="cursor: pointer;">
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <form action="" method="POST">
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
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <a href="" target="blank"></a><br>

                                <form method="POST" action="" enctype="multipart/form-data">
                                    <fieldset id="ic_form3">
                                        <label for="calisan_dosya"><b>Yeni Dosya Yükle-></b></label>
                                        <input name="cdir_name" type="tel" value="" hidden>
                                        <input type="file" class="btn btn-light btn-sm" name="calisan_dosya" />
                                        <input type="submit" class="btn btn-primary" name="calisan_dosya_yukle"
                                            value="Yükle" />
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