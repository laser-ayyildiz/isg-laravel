<div class="tab-pane fade show" id="aylik_calismalar" role="tabpanel" aria-labelledby="ac-tab">
    @if ($defter_nushasi === null || $gozlem_raporu === null)
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addMonthlyFile"
        data-whatever="@getbootstrap">Yeni Dosya Yükle</button>
    @endif
    <table class="table table-bordered table-striped mb-5">
        <thead class="table-dark text-center">
            <th>Son Yüklenen Defter Nüshası</th>
            <th>Oluşturulma Tarihi</th>
            <th>Geçerlilik</th>
            <th>Yeni Dosya Yükle</th>
        </thead>
        <tbody class="text-center">
            @if ($defter_nushasi !== null)
            <tr>
                <td>{{ $defter_nushasi->file->name }}</td>
                <td>{{ Str::remove(' 00:00:00', $defter_nushasi->assigned_at) }}</td>
                <td>
                    @if ($defter_nushasi->valid_date <= date('Y-m-d'))
                    <i class="fas fa-times text-danger"></i>
                    @else
                    <i class="fas fa-check text-success"></i>
                    @endif
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMonthlyFile"
                        data-whatever="@getbootstrap" onclick="selectMonthly('9')">
                        <i class="fas fa-plus text-white"></i></button>
                </td>
            </tr>
            @else
            <tr>
                <td class="table-secondary" colspan="4">
                    <b>Defter nüshası eklenmedi</b>
                </td>
            </tr>
            @endif

        </tbody>
    </table>

    <table class="table table-bordered table-striped mt-5">
        <thead class="table-dark text-center">
            <th>Son Yüklenen Saha Gözlem Raporu</th>
            <th>Oluşturulma Tarihi</th>
            <th>Geçerlilik</th>
            <th>Yeni Dosya Yükle</th>
        </thead>
        <tbody class="text-center">
            @if ($gozlem_raporu !== null)
            <tr>
                <td>{{ $gozlem_raporu->file->name }}</td>
                <td>{{ Str::remove(' 00:00:00', $gozlem_raporu->assigned_at) }}</td>
                <td>
                    @if ($gozlem_raporu->valid_date <= date('Y-m-d'))
                    <i class="fas fa-times text-danger"></i>
                    @else
                    <i class="fas fa-check text-success"></i>
                    @endif
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addMonthlyFile"
                        data-whatever="@getbootstrap" onclick="selectMonthly('10')">
                        <i class="fas fa-plus text-white"></i></button>
                </td>
            </tr>
            @else
            <tr>
                <td class="table-secondary" colspan="4">
                    <b>Saha gözlem raporu eklenmedi</b>
                </td>
            </tr>
            @endif

        </tbody>
    </table>
</div>