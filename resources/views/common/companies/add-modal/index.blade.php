<div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    @if (auth()->user()->hasRole('Admin'))
    <form action="{{ route('admin.companies.store') }}" id="addCompanyForm" method="POST">

        @elseif (auth()->user()->hasRole('User'))
        <form action="{{ route('user.companies.store') }}" id="addCompanyForm" method="POST">
            @endif
            @csrf
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-c-tabs">
                        @include('common.companies.add-modal.tabs')

                        <div class="tab-content">
                            @include('common.companies.add-modal.link1')

                            @include('common.companies.add-modal.link2')

                            @include('common.companies.add-modal.link3')

                            @include('common.companies.add-modal.link4')

                            @include('common.companies.add-modal.link5')

                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>