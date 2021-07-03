<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link  {{ !session('tab') ? 'active' : '' }}" id="gb-tab" data-toggle="tab" href="#genel_bilgiler" role="tab"
            aria-controls="Genel Bilgiler" aria-selected="true"><b>Bilgiler</b></a>
    </li>
    @if ($deleted == false)
    <li class="nav-item">
        <a class="nav-link {{ session('tab') == 'osgb_calisanlar' ? 'active' : '' }}" id="oc-tab" data-toggle="tab" href="#osgb_calisanlar" role="tab"
            aria-controls="OSGB Çalışanları" aria-selected="false"><b>OSGB Çalışanları</b></a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link {{ session('tab') == 'devlet_bilgileri' ? 'active' : '' }}" id="db-tab" data-toggle="tab" href="#devlet_bilgileri" role="tab"
            aria-controls="Devlet Bilgileri" aria-selected="false"><b>Devlet Bilgileri</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ session('tab') == 'muhasebe_bilgileri' ? 'active' : '' }}" id="db-tab" data-toggle="tab" href="#muhasebe_bilgileri" role="tab"
            aria-controls="Muhasebe Bilgileri" aria-selected="false"><b>Muhasebe Bilgileri</b></a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ session('tab') == 'isletme_calisanlar' ? 'active' : '' }}" id="ic-tab" data-toggle="tab" href="#isletme_calisanlar" role="tab"
            aria-controls="İşletme Çalışanları" aria-selected="false"><b>Çalışanlar</b></a>
    </li>
    <li class="nav-item {{ session('tab') == 'isletme_rapor' ? 'active' : '' }}">
        <a class="nav-link " id="zr-tab" data-toggle="tab" href="#isletme_rapor" role="tab"
            aria-controls="Zorunlu Dökümanlar" aria-selected="false"><b>Zorunlu Dökümanlar</b></a>
    </li>
    @if ($deleted == false)
    <li class="nav-item">
        <a class="nav-link {{ session('tab') == 'silinen_calisanlar' ? 'active' : '' }}" id="sc-tab" data-toggle="tab" href="#silinen_calisanlar" role="tab"
            aria-controls="Silinen Çalışanlar"><b>Arşiv</b></a>
    </li>
    @endif
</ul>