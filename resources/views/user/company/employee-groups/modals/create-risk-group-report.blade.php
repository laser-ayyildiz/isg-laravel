<div class="modal fade" id="createRiskGroupFileModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><b>Yeni Rapor Oluştur</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('create-report', ['company' => $company, 'type' => 'risk-group']) }}"
                    method="post">
                    @csrf
                    <div class="row my-2">
                        <div class="col-12">
                            <legend>{{ $company->name }} işletmesi için Risk Değerlendirme Ekibi Raporu yükle</legend>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-6">
                            <label for="yayin_tarihi"><b>Yayınlanma Tarihi</b></label>
                            <input type="date" class="form-control" id="yayin_tarihi" name="published_at"
                                placeholder="İşveren Adı" required>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-12 my-2">
                            <label for="report_text"><b>Kanun Metni</b></label>
                            <textarea class="form-control" name="report_text" id="report_text" rows="7"
                                required>6331 sayılı İŞ SAĞLIĞI VE GÜVENLİĞİ KANUNU Resmi Gazete Tarihi: 30.06.2012 Sayısı: 28339 ile İŞ SAĞLIĞI VE GÜVENLİĞİ RİSK DEĞERLENDİRMESİ YÖNETMELİĞİ Resmi Gazete Tarihi:29.12.2012 Resmi Gazete Sayısı: 28512 Madde 6 ya göre Risk değerlendirmesi, işverenin oluşturduğu bir ekip tarafından gerçekleştirilir. Buna dayanarak Risk değerlendirmesi ekibine görevleriniz doğrultusunda altta yer alan şekliyle atanmış bulunmaktasınız.</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block mt-4">
                            Rapor Oluştur
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
