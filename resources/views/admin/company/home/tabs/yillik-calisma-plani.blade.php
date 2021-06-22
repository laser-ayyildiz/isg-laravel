<div class="card-header">
    @php
    $datetime = \Carbon\Carbon::now('Europe/Istanbul');
    setlocale(LC_TIME, 'tr.utf8');
    @endphp
    <h4><b> Yıllık Çalışma Planı <h4 class="float-right text-info">
                <b>{{ $datetime->formatLocalized('%B') }}</b></h4></b></h4>
</div>
<div class="card-body">
    <table class="table">
        <tbody>

        </tbody>
    </table>
</div>