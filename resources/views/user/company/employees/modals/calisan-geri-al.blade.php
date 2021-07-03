<div class="modal fade" id="restoreEmpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Çalışanı Sil</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/user/employee/restore/" method="POST" id="restoreEmpForm">
                    @csrf
                    <div class="row my-2">
                        <h5 id="restoreEmpName" class="mx-2"></h5>
                    </div>
                    <div class="modal-footer">
                        <div class="float-right">
                            <button id="restoreEmpRequest" type="submit" class="btn btn-success">İşe Geri Al</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>