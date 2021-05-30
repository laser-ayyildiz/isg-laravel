<div class="modal fade" id="deleteEmpModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Çalışanı Sil</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/user/company/" method="POST" id="deleteEmpForm">
                    @csrf
                    <div class="row my-2">
                        <h5 id="deleteEmpName" class="mx-2"></h5>
                    </div>
                    <div class="modal-footer">
                        <div class="float-right">
                            <button id="deleteEmpRequest" type="submit" class="btn btn-danger">Sil</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>