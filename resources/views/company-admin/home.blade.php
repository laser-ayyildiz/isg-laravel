@extends('layouts.company-admin')

@section('content')

<div class="row mt-5">
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
                        50
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
                        50
                        <div class="text-dark font-weight-bold h5 mb-0"><span></span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-pencil-alt fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-lg mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Aylara Göre Anlaşılan İşletme Sayıları</h6>
            </div>
            <div class="card-body">
                <div id="lineChart"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow-lg mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary font-weight-bold m-0">Türlerine Göre İşletmeler</h6>
            </div>
            <div class="card-body">
                <div id="pieChart"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow-lg mb-4">
            <div class="card-header py-3">
                <h6 class="text-primary font-weight-bold m-0">Tehlikesine Göre İşletmeler</h6>
            </div>
            <div class="card-body">

                <h4 class="small font-weight-bold">Çok Tehlikeli<span class="float-right">%{{ number_format($dangers['very']/$comp_count*100, 1) }}</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" aria-valuenow=""
                        aria-valuemin="0" aria-valuemax="100" style="width: {{ $dangers['very']/$comp_count*100 }}%;"><span class="sr-only"></span></div>
                </div>
                <h4 class="small font-weight-bold">Orta Tehlikeli<span class="float-right">%{{ number_format($dangers['medium']/$comp_count*100, 1) }}</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow=""
                        aria-valuemin="0" aria-valuemax="100" style="width:{{ $dangers['medium']/$comp_count*100 }}%;"><span class="sr-only"></span></div>
                </div>
                <h4 class="small font-weight-bold">Az Tehlikeli<span class="float-right"></span><span
                        class="float-right">%{{ number_format($dangers['less']/$comp_count*100, 1) }}</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" aria-valuenow=""
                        aria-valuemin="0" aria-valuemax="100" style="width:{{ $dangers['less']/$comp_count*100 }}%;"><span class="sr-only"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    var options = {
        chart: {
            type: 'line',
            height: 390,
            toolbar: {
                show: true,
                tools: {
                    download: true,
                    selection: false,
                    zoom: false,
                    zoomin: false,
                    zoomout: false,
                    pan: false,
                    reset: false,
                }
            },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
                animateGradually: {
                    enabled: true,
                    delay: 150
                },
                dynamicAnimation: {
                    enabled: true,
                    speed: 350
                }
            }
        },
        fill: {
            type: 'gradient'
        },

        markers: {
            size: 5,
        },
        theme: {
            palette: 'palette7'
        },
        series: [{
            name: 'işletme sayısı',
            data: @json($month_counts)
        }],
        xaxis: {
            categories: ["Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık"]
        }
    }

    var chart = new ApexCharts(document.querySelector("#lineChart"), options);
    chart.render();
</script>

<script>
    var options = {
          series: @json($values),
          labels: @json($labels),
          chart: {
            height: 400,
          type: 'donut',
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

    var chart = new ApexCharts(document.querySelector("#pieChart"), options);
    chart.render();
</script>

@endpush

@endsection