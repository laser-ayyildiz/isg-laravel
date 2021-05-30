<div class="modal fade" id="changeCompany" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form action="{{ route('user.company.updateRequest',['company' => $company, 'user' => auth()->user()]) }}"
                method="POST">
                @csrf
                <div class="modal-c-tabs">
                    @include('user.company.modals.isletme-degistir.tabs')
                    <div class="tab-content">
                        @include('user.company.modals.isletme-degistir.link1')
                        @include('user.company.modals.isletme-degistir.link2')
                        @include('user.company.modals.isletme-degistir.link3')
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="companyId" value="{{ $company->id }}">
                    <button class="btn btn-primary btn-lg" type='submit' name='changeRequest'>Kaydet</button>
                </div>
            </form>
        </div>
    </div>

</div>