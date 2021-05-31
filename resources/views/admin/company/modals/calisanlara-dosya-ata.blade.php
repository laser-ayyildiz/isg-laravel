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
                    <h3 class="text-center">{{ Str::title($company->name) }} işletmesinin çalışanları için toplu şekilde dosya yükle</h3>
                    @csrf
                    <div class="custom-file my-4">
                        <input type="file" name="file" class="custom-file-input" id="chooseBatchFile" required>
                        <label class="custom-file-label" for="chooseFile"><b>Dosya Seç</b></label>
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
<script>
    $('#chooseBatchFile').on('change',function(){
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })
</script>