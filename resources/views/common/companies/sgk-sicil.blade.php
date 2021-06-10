<div class="modal mt-5" id="fill_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">SGK Sicil No</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="sgk_fill_form">
          <div class="row">
            <div class="col-sm-3 mx-3">
              <label class="label mt-3" for="fill_input_1">
                <h5><b>Mahiyet</b></h5>
              </label>
              <input type="text" class="form-control" id="fill_input_1" placeholder="1 Karakter" maxlength="1" required>
            </div>
            <div class="col-sm-3 mx-3">
              <label class="label mt-3" for="fill_input_2">
                <h5><b>İş Kolu</b></h5>
              </label>
              <input type="text" class="form-control" id="fill_input_2" placeholder="4 Karakter" maxlength="4" required>
            </div>
            <div class="col-sm-3 mx-3">
              <label class="label mt-3" for="fill_input_3">
                <h5><b>Yeni Şube</b></h5>
              </label>
              <input type="text" class="form-control" id="fill_input_3" placeholder="2 Karakter" maxlength="2" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3 mx-3">
              <label class="label mt-3" for="fill_input_4">
                <h5><b>Eski Şube</b></h5>
              </label>
              <input type="text" class="form-control" id="fill_input_4" placeholder="1 Karakter" maxlength="1" required>
            </div>
            <div class="col-sm-3 mx-3">
              <label class="label mt-3" for="fill_input_5">
                <h5><b>Sıra No</b></h5>
              </label>
              <input type="text" class="form-control" id="fill_input_5" placeholder="7 Karakter" maxlength="7" required>
            </div>
            <div class="col-sm-3 mx-3">
              <label class="label mt-3" for="fill_input_6">
                <h5><b>İl Kodu</b></h5>
              </label>
              <input type="text" class="form-control" id="fill_input_6" placeholder="2 Karakter" maxlength="2" required>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3 mx-3">
              <label class="label mt-3" for="fill_input_7">
                <h5><b>İlçe Kodu</b></h5>
              </label>
              <input type="text" class="form-control" id="fill_input_7" placeholder="2 Karakter" maxlength="2" required>
            </div>
            <div class="col-sm-3 mx-3">
              <label class="label mt-3" for="fill_input_8">
                <h5><b>Kontrol No</b></h5>
              </label>
              <input type="text" class="form-control" id="fill_input_8" placeholder="2 Karakter" maxlength="2" required>
            </div>
            <div class="col-sm-3 mx-3">
              <label class="label mt-3" for="fill_input_9">
                <h5><b>Aracı No</b></h5>
              </label>
              <input type="text" class="form-control" id="fill_input_9" placeholder="3 Karakter" maxlength="3" required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success disabled" id="sgk_fill_btn">Hazır</button>
      </div>
    </div>
  </div>
</div>