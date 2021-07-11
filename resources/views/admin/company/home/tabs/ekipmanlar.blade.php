<div class="tab-pane fade show" id="ekipmanlar" role="tabpanel" aria-labelledby="e-tab">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addEquipment"
        data-whatever="@getbootstrap">Yeni Ekipman Ekle</button>
    @if ($equipments !== null)
    <button class="btn btn-success mb-3 float-sm-right" data-toggle="modal" data-target="#addEquipmentFile"
        data-whatever="@getbootstrap">Bakım Dosyası Yükle</button>
    @endif
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <th>Ekipman Adı</th>
                <th>Periyot</th>
                <th>Son Bakım Tarihi</th>
                <th>Geçerlilik</th>
                <th style="width: 19%">Dosya</th>
                <th>Sil</th>
            </thead>
            <tbody>
                @forelse ($equipments as $equipment )
                @php
                $date = new DateTime($equipment->valid_date);
                $valid_date = $date->modify('-1 month')->format('Y-m-d') > date("Y-m-d");
                @endphp
                <tr>
                    <td>{{ $equipment->name }}</td>
                    <td>{{ $equipment->period }} Ay</td>
                    <td>{{ $equipment->maintained_at }}</td>
                    <td class="{{ $valid_date ? 'table-success' : 'table-danger' }}">
                        {{ $equipment->valid_date }}
                    </td>
                    @if($equipment->file !== null)
                    <td class="text-center">
                        <button class="btn btn-warning btn-sm float-left mx-1"
                            onclick="window.open('{{ url('/files/equipment-files/' . $equipment->file->name) }}','_blank')">
                            <i class="fas fa-eye"></i></button>

                        <form class="float-left mx-1"
                            action="{{ route('download-file',['folder' => 'equipment-files', 'file_name' => $equipment->file->name]) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-success btn-sm" type="submit">
                                <i class="fas fa-download"></i></button>
                        </form>
                        <form
                            action="{{ route('delete-equipment-file', ['equipment' => $equipment,'file' => $equipment->file]) }}"
                            method="delete">
                            <button class="btn btn-danger btn-sm float-left mx-1">
                                <i class="fas fa-times text-white"></i>
                            </button>
                        </form>
                    </td>
                    @else
                    <td>Dosya Yok</td>
                    @endisset
                    <td class="text-center">
                        <form action="{{ route('delete-equipment', ['equipment' => $equipment]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm float-left mx-1">
                                Sil</i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <td class="text-center" colspan="6">
                    <b>Henüz ekipman eklenmedi</b>
                </td>
                @endempty
            </tbody>
        </table>
    </div>

</div>