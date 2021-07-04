<div class="card-header">
    <h4><b> Bilgiler </b></h4>
</div>
<div class="card-body">
    <ul>
        <div class="row">
            <div class="col-6">
                @php
                $dangers = ['Az Tehlikeli', 'Tehlikeli', 'Çok Tehlikeli'];
                $colors = ['Az Tehlikeli' => 'success', 'Tehlikeli' => 'warning', 'Çok Tehlikeli' =>
                'danger'];
                @endphp
                <li><b>İşveren/Vekili:</b> {{ Str::title($company->employer) }}</li>
                <li class="text-{{ $colors[$dangers[$company->danger_type-1]] }}">
                    <b>{{ $dangers[$company->danger_type-1] }}</b></li>
                <li><b>{{ $employees['coopEmployees'] }}</b> Çalışan</li>
            </div>
            <div class="col-6">
                <li><b>Hekim:</b>
                    {{$employees['doctor'] === '' ? '' : Str::title($employees['doctor']->user->name)  }}
                </li>
                <li><b>Uzman:</b>
                    {{$employees['expert'] === '' ? '' : Str::title($employees['expert']->user->name)  }}
                </li>
            </div>
        </div>
    </ul>
</div>