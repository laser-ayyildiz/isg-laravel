<div class="modal fade" id="addBatchFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Dosya Yükle</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('batch-file-upload',['company' => $company]) }}" method="post"
                    enctype="multipart/form-data">
                    <h3 class="text-center">
                        {{ Str::title($company->name) }} işletmesinin çalışanları için toplu şekilde
                        dosya yükle
                    </h3>
                    @csrf
                    <div class="row mt-3">
                        <div class="col-12">
                            <select name="batch_file_type" id="batch_file_type" class="form-control" required>
                                <option value="1">İSG Eğitimi 1</option>
                                <option value="2">İSG Eğitimi 2</option>
                                <option value="9">Yüksekte Çalışma Eğitimi</option>
                                <option value="10">Yangın Eğitimi</option>
                                <option value="11">Acil Durum Ekip Eğitimi</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="name"><b>Dosya Adı</b></label>
                            <input class="form-control" type="text" name="name" id="name" placeholder="Dosya Adı" required>
                        </div>
                        <div class="col-6">
                            <label for="file_date"><b>Dosya Tarihi</b></label>
                            <input class="form-control" type="date" name="file_date" id="file_date">
                        </div>
                    </div>
                    <div class="custom-file my-4">
                        <input type="file" name="file" class="custom-file-input" id="chooseBatchFile" required>
                        <label class="custom-file-label" for="chooseFile"><b>Dosya Seç</b></label>
                    </div>
                    <div class="form-check form-check m-2">
                        <input class="form-check-input" type="checkbox" name="selectAll" id="selectAll"
                            value="selectAll">
                        <label class="form-check-label" for="selectAll"><b>Bütün Çalışanlara Ata</b></label>
                    </div>
                    <div class="row px-3 my-3" id="boxes">
                        @foreach ($employees->whereNull('deleted_at') as $key=>$employee)
                        <div class="form-check form-check-inline m-2">
                            <input class="form-check-input" type="checkbox" name="box{{ $key }}"
                                id="inlineCheckbox{{ $key }}" value="{{ $employee->id }}">
                            <label class="form-check-label" for="inlineCheckbox{{ $key }}">{{ $employee->name }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block mt-4">
                            Yükle
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>