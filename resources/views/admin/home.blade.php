@extends('layouts.admin')
@section('content')

@if (session('fail'))
<div class="alert alert-danger">
    {{ session('fail') }}
</div>
@elseif (session('success'))
<div class="alert alert-success">
    {!! session('success') !!}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
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
                        {{ $equipment_count ?? '0' }}
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
                        <button class="btn btn-warning mb-1" data-toggle="modal" data-target="#authenticate"
                            data-whatever="@getbootstrap" id="authenticate-button">İşveren/vekili
                            Yetkilendir</a></button>
                    </div>
                    <div class="col-auto"><i class="fas fa-user-plus fa-2x text-gray-300"></i></div>
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
    <div class="col-lg-8 mb-4">
        <div class="card shadow-lg mb-4">
            <div class="card-header py-3">
                <h6 class="text-primary font-weight-bold m-0">Tehlikesine Göre İşletmeler</h6>
            </div>
            <div class="card-body">

                <h4 class="small font-weight-bold">Çok Tehlikeli<span
                        class="float-right">%{{$dangers['very'] != 0 ? number_format($dangers['very']/$comp_count*100, 1) : 0}}</span>
                </h4>
                <div class="progress mb-4">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" aria-valuenow=""
                        aria-valuemin="0" aria-valuemax="100"
                        style="width: {{ $dangers['very'] != 0 ? $dangers['very']/$comp_count*100 : 0}}%;">
                        <span class="sr-only"></span></div>
                </div>
                <h4 class="small font-weight-bold">Tehlikeli<span
                        class="float-right">%{{ $dangers['medium'] != 0 ? number_format($dangers['medium']/$comp_count*100, 1) : 0}}</span>
                </h4>
                <div class="progress mb-4">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" aria-valuenow=""
                        aria-valuemin="0" aria-valuemax="100"
                        style="width:{{ $dangers['medium'] ? $dangers['medium']/$comp_count*100 : 0}}%;">
                        <span class="sr-only"></span></div>
                </div>
                <h4 class="small font-weight-bold">Az Tehlikeli<span class="float-right"></span><span
                        class="float-right">%{{ $dangers['less'] != 0 ? number_format($dangers['less']/$comp_count*100, 1) : 0 }}</span>
                </h4>
                <div class="progress mb-4">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" aria-valuenow=""
                        aria-valuemin="0" aria-valuemax="100"
                        style="width:{{ $dangers['less'] != 0 ? $dangers['less']/$comp_count*100  : 0}}%;">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="authenticate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>İşveren/vekili için hesap oluştur</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="authenticateForm">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-12">
                            <label for="company-select"><b>İşletme</b></label>
                            <select name="company" id="company-select" class="form-control">
                                <option value="0" selected>Seçiniz...</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <label for="name"><b>İşveren/vekili Adı Soyadı<a style="color:red">*</a></b></label>
                            <input class="form-control" type="text" name="name" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="email"><b>Email<a style="color:red">*</a></b></label>
                            <input class="form-control" type="email" name="email" required>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-6">
                            <label for="tc"><b>T.C. Kimlik Numarası</b></label>
                            <input class="form-control" type="phone" minlength="11" maxlength="11" name="tc">
                        </div>
                        <div class="col-sm-6">
                            <label for="phone"><b>Telefon Numarası</b></label>
                            <input class="form-control" type="phone" minlength="11" maxlength="11" name="phone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary" id="submit">Hesap Oluştur</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
$(document).ready(function(){
    var bool = false;
    $("#authenticate-button").on('click' ,function(){
        if (!bool) {
            $.ajax({
                url: "{{ route('getAllCompanies') }}",
                type: 'POST',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                dataType: 'json',
                data: "{}",
                success: function (data) {
                    data.forEach(element => {
                        $("#company-select").append("<option value='"+element.id+"'>"+element.name+"</option>");
                    });
                    bool = true;
                }
            });
        }
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    $('#submit').on('click', function(e) {
        let action = "";
        action = 'assign-company-admin/' + $('#company-select').val();
        $('#authenticateForm').attr('action', action);
    });
</script>
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
