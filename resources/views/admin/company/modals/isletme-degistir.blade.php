<div class="modal fade" id="changeCompany" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.company.update',['company' => $company, 'user' => auth()->user()]) }}"
                method="POST">
                @csrf
                <div class="modal-c-tabs">
                    @include('admin.company.modals.isletme-degistir.tabs')
                    <div class="tab-content">
                        @include('admin.company.modals.isletme-degistir.link1')
                        @include('admin.company.modals.isletme-degistir.link2')
                        @include('admin.company.modals.isletme-degistir.link3')
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