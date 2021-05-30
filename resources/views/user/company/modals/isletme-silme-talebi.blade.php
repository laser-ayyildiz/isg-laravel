<div class="modal fade" id="areYouSure" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Emin misiniz?</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user.company.deleteRequest',['company' => $company, 'user' => auth()->user()]) }}"
                method="POST">
                @csrf
                <div class="modal-body">
                    <h3>
                        <b>
                            Silme talebiniz yöneticinize iletilecektir,
                            Emin misiniz?
                        </b>
                    </h3>
                </div>
                <div class="modal-footer">
                    <button class="btn btn btn-secondary mr-auto" data-dismiss="modal">İptal</button>
                    <button type="submit" name="deleteRequest" class="btn btn btn-danger float-right">SİL</button>
                </div>
            </form>
        </div>
    </div>
</div>