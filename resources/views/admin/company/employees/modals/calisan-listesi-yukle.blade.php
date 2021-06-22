<div class="modal fade" id="empList" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Excel Tablosu Yükle</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{  route('store-excel',['company' => $company]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row m-2">
                        <h3>
                            <b>{{ Str::title($company->name) }}</b> çalışanlarını excel tablosu olarak yükle
                        </h3>
                    </div>
                    <div class="custom-file my-4">
                        <input type="file" name="employee-list" class="custom-file-input" id="employee_list" required>
                        <label class="custom-file-label" for="employee_list"><b>Dosya Seç</b></label>
                    </div>
                    <div class="modal-footer">
                        <div class="mr-auto">
                            <button type="button" class="btn btn-success" id="exampleFile">Örnek Excel Tablosu</button>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary" name="empFileSubmit">Dosyayı Yükle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>