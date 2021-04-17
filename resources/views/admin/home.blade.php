@extends('layouts.admin')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark mb-0">Ana Sayfa</h3>
</div>
<div class="row">
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow-lg border-left-primary py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span
                                style="min-width: 0px;max-width: 0px;">Anlaşılan işletme sayısı</span></div>
                        {{ $comp_count ?? '0' }}
                        <div class="text-dark font-weight-bold h5 mb-0"></span></div>
                    </div>
                    <div class="col-auto"><i class="fa fa-group fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow-lg border-left-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">

                        <div class="text-uppercase text-success font-weight-bold text-xs mb-1"><span>Toplam çalışan
                                sayısı</span></div>
                        {{ $emp_count ?? '0' }}
                        <div class="text-dark font-weight-bold h5 mb-0"><span></span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-user fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow-lg border-left-info py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">

                        <div class="text-uppercase text-info font-weight-bold text-xs mb-1"><span>Toplam Ekipman
                                sayısı</span>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="text-dark font-weight-bold h5 mb-0 mr-3"><span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto"><i class="fas fa-truck-loading fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow-lg border-left-warning py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-uppercase text-warning font-weight-bold text-xs mb-1"><span>Toplam Etkinlik
                                Sayısı</span></div>

                        <div class="text-dark font-weight-bold h5 mb-0"><span></span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-pencil-alt fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-7 col-xl-8">
        <div class="card shadow-lg mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Aylara göre anlaşılan işletme sayıları</h6>
            </div>

            <div class="card-body">
                <div class="chart-area"><canvas
                        data-bs-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Ocak&quot;,&quot;Şubat&quot;,&quot;Mart&quot;,&quot;Nisan&quot;,&quot;Mayıs&quot;,&quot;Haziran&quot;,&quot;Temmuz&quot;,&quot;Ağustos&quot;,&quot;Eylül&quot;,&quot;Ekim&quot;,&quot;Kasım&quot;,&quot;Aralık&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;İşletme Sayısı&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;&quot;,&quot;&quot;,&quot;&quot;,&quot;&quot;,&quot;&quot;,&quot;&quot;,&quot;&quot;,&quot;&quot;,&quot;&quot;,&quot;&quot;,&quot;&quot;,&quot;&quot;],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;,&quot;borderWidth&quot;:&quot;3&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{&quot;display&quot;:false},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;10&quot;],&quot;zeroLineBorderDash&quot;:[&quot;10&quot;],&quot;drawOnChartArea&quot;:true},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;beginAtZero&quot;:false,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;10&quot;],&quot;zeroLineBorderDash&quot;:[&quot;10&quot;]},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;beginAtZero&quot;:false,&quot;padding&quot;:20}}]}}}"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-xl-4">
        <div class="card shadow-lg mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0"></h6>
                <h6 class="text-primary font-weight-bold m-0">Türlerine Göre işletmeler</h6>
                <p></p>
            </div>
            <div class="card-body">

                <div class="chart-area"><canvas
                        data-bs-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Hizmet&quot;,&quot;Sağlık&quot;,&quot;Sanayi&quot;,&quot;Tarım&quot;,&quot;Diğer&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;,&quot;rgba(255,0,0,0.7)&quot;,&quot;orange&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;&quot;,&quot;&quot;,&quot;&quot;,&quot;&quot;,&quot;&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{&quot;display&quot;:false}}}"></canvas>
                </div>
                <div class="text-center small mt-4"><span class="mr-2"><i
                            class="fas fa-circle text-primary"></i>Hizmet</span>
                    <span class="mr-2"><i class="fas fa-circle text-success"></i>Sağlık</span>
                    <span class="mr-2"><i class="fas fa-circle text-info"></i>Sanayi</span>
                    <span class="mr-2"><i class="fas fa-circle text-primary"
                            style="color: rgba(255,0,0,0.7);filter: brightness(103%) contrast(200%) grayscale(0%) hue-rotate(137deg) invert(0%);"></i>Tarım</span>
                    <span class="mr-2"><i class="fas fa-circle text" style="color: orange;"></i>Diğer</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow-lg mb-4">
            <div class="card-header py-3">
                <h6 class="text-primary font-weight-bold m-0">Tehlikesine göre işletmeler</h6>
            </div>
            <div class="card-body">

                <h4 class="small font-weight-bold">Çok Tehlikeli<span class="float-right">%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" aria-valuenow=""
                        aria-valuemin="0" aria-valuemax="100" style="width: %;"><span class="sr-only">%</span></div>
                </div>
                <h4 class="small font-weight-bold">Orta Tehlikeli<span class="float-right">%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow="40"
                        aria-valuemin="0" aria-valuemax="100" style="width:%;"><span class="sr-only">%</span></div>
                </div>
                <h4 class="small font-weight-bold">AzTehlikeli<span class="float-right"></span><span
                        class="float-right">%</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" aria-valuenow=""
                        aria-valuemin="0" aria-valuemax="100" style="width: %;"><span class="sr-only">%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="/js/chart.min.js"></script>
<script src="/js/bs-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="/js/theme.js"></script>
@endpush

@endsection
