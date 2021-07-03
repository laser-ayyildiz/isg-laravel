<div class="tab-pane fade show" id="osgb_calisanlar" role="tabpanel" aria-labelledby="oc-tab">
    <div class="text-center">
        @forelse ($employees['osgbEmployees'] as $employee)
        <h3>
            <b>{{ Str::title($employee->user->name ) }}</b> -> {{  $employee->user->job->name }}
        </h3>
        @empty
        <h3><b>Henüz bu işletme için bir çalışan atanmadı!</b></h3>
        @endforelse
    </div>
</div>