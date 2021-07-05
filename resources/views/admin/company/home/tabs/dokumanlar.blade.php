<div class="card-header">
    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="zd-tab" data-toggle="tab" href="#zorunlu_dokumanlar" role="tab"
                aria-controls="Zorunlu Dokümanlar" aria-selected="true"><b>Zorunlu Dokümanlar</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="ac-tab" data-toggle="tab" href="#aylik_calismalar" role="tab"
                aria-controls="Aylık Çalışmalar" aria-selected="false"><b>Aylık Çalışmalar</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="ycp-tab" data-toggle="tab" href="#yillik_calisma_plani" role="tab"
                aria-controls="Yıllık Çalışma Planı" aria-selected="false"><b>Yıllık Çalışma Planı</b></a>
        </li>
    </ul>
</div>
<div class="card-body">
    <div class="tab-content" id="myTabContent">

        @include('admin.company.home.tabs.zorunlu-dokumanlar')

        @include('admin.company.home.tabs.aylik-calismalar')

        @include('admin.company.home.tabs.yillik-calisma-plani')
        
    </div>
</div>