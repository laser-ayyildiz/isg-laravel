<div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <form action="{{ route('admin.companies.store') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-c-tabs">
                    @include('admin.companies.add-modal.tabs')
                    
                    <div class="tab-content">
                        @include('admin.companies.add-modal.link1')

                        @include('admin.companies.add-modal.link2')

                        @include('admin.companies.add-modal.link3')

                        @include('admin.companies.add-modal.link4')

                        @include('admin.companies.add-modal.link5')
                        
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>