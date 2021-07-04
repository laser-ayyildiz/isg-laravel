<div class="tab-pane fade show" id="gozlem_raporlari" aria-labelledby="gr-tab">
    <div class=" table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table table-striped table-bordered table-hover mt-2" id="dataTable">
            <thead class="thead-dark">
                <th>Dosya Adı</th>
                <th>Oluşturulma Tarihi</th>
                <th>Son Geçerlilik Tarihi</th>
                <th style="width: 15%">Dosya</th>
            </thead>
            <tbody>
                @forelse ( $gozlem_raporlari as $gozlem_raporu )
                <tr>
                    <td>{{ $gozlem_raporu->file->name }}</td>
                    <td>{{ Str::remove(' 00:00:00', $gozlem_raporu->assigned_at) }}</td>
                    <td class="{{ $gozlem_raporu->valid_date <= date('Y-m-d') ? 'table-danger' : 'table-success' }}">
                        {{ $gozlem_raporu->valid_date }}
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm float-left mx-1"
                            onclick="window.open('{{ url('/files/monthly-files/' . $gozlem_raporu->file->name) }}','_blank')">
                            <i class="fas fa-eye"></i></button>

                        <form class="float-left mx-1"
                            action="{{ route('download-file',['folder' => 'monthly-files', 'file_name' => $gozlem_raporu->file->name]) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-success btn-sm" type="submit">
                                <i class="fas fa-download"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td valign="top" colspan="4" class="dataTables_empty text-center">Tabloda herhangi bir veri mevcut
                        değil</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>