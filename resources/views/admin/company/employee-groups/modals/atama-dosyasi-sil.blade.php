<div class="modal fade" id="deleteFileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Dosya Sil</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" enctype="multipart/form-data" id="deleteFileForm">
                    @csrf
                    <div class="row my-2">
                        <div class="col-12">
                            <legend id="selected_employee_name_delete_file"></legend>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-secondary mr-auto" data-dismiss="modal"
                            aria-label="Close">İptal</button>
                        <button type="submit" class="btn btn-lg btn-danger ml-auto">Sil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
