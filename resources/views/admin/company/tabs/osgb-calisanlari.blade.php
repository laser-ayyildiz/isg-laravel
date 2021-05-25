<div class="tab-pane fade show {{ session('tab') == 'osgb_calisanlar' ? 'active' : '' }}"" id="osgb_calisanlar" role="tabpanel" aria-labelledby="oc-tab">
    <div class="text-center">
        @if (!empty($employees['osgbEmployees']))
        @foreach ($employees['osgbEmployees'] as $employee )
        <h3>
            <b>{{ Str::title($employee->user->name ) }}</b> -> {{  $employee->user->job->name }}
        </h3>
        @endforeach
        @else
        <h1>Henüz bu işletme için bir çalışan atanmadı</h1>
        @endif
    </div>
</div>