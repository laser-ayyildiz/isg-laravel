@extends('layouts.company')
@section('title'){{ Str::title($company->name) }} - @endsection
@section('home'){{ route('admin.home') }} @endsection
@section('company'){{ Str::of($company->name)->upper()->limit(20) }} @endsection
@section('content')

@if (session('fail'))
<div class="alert alert-danger">
    {{ session('fail') }}
</div>
@elseif (session('success'))
<div class="alert alert-success">
    {!! session('success') !!}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-lg-7 pr-3">
        <div class="row">
            <div class="card w-100">
                <div class="card-header">
                    zorunlu dokümanlar
                </div>
                <div class="card-body">
                    <ul>
                        <li>asdasd</li>
                        <li>dfgdfgfdg</li>
                        <li>dfhlşdfkhlşdkfşh</li>
                        <li>dfhjdfjhkşldfkhlşd</li>
                        <li>dsgslşdgsşldgk</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="card w-100">
                <div class="card-header">
                    zorunlu dokümanlar
                </div>
                <div class="card-body">
                    <ul>
                        <li>asdasd</li>
                        <li>dfgdfgfdg</li>
                        <li>asdasd</li>
                        <li>dfhjdfjhkşldfkhlşd</li>
                        <li>dsgslşdgsşldgk</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="row" style="height: 600px">
            <div class="card w-100">
                <div class="card-header">
                    <h3> <b> Bildirimler </b> </h3>
                </div>
                <div class="card-body">
                    <div id="accordion">
                        <h5>
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                Collapsible Group Item #1
                            </button>
                        </h5>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>

                        <h5>
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                Collapsible Group Item #2
                            </button>
                        </h5>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>

                        <h5>
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                Collapsible Group Item #3
                            </button>
                        </h5>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <ul>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="card w-100">
                <div class="card-header">
                    zorunlu dokümanlar
                </div>
                <div class="card-body">
                    <ul>
                        <li>asdasd</li>
                        <li>dfgdfgfdg</li>
                        <li>dfhlşdfkhlşdkfşh</li>
                        <li>dfhjdfjhkşldfkhlşd</li>
                        <li>dsgslşdgsşldgk</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{--  
<div ng-controller="FirmaDetayController" class="col-md-12 col-xs-12 col-sm-12 pt-5 yukseklikAyarla ng-scope"
    data-h-fark="50" style="height: 802px;">
    
    <div class="col-md-7 col-sm-12 col-xs-12 no-padding" id="yapilacaklar">
        <md-content class="_md">
            <div class="col-md-12 col-sm-12 col-xs-12 no-padding no-margin mt-10" id="tabButtons">
                <button class="col-md-6 col-xs-6 col-sm-6 btn active font-robotomed font-size-15"
                    onclick="clickContinue(0)" ng-click="SelectTab(0)"><i
                        class="fa fa-check-square-o mr-10"></i>Planlanmış Çalışmalar</button>
                <button class="col-md-6 col-xs-6 col-sm-6 btn  font-robotomed font-size-15" onclick="clickContinue(1)"
                    ng-click="SelectTab(1)"><i class="fa fa-bell mr-10"></i>Zorunlu Dökümanlar</button>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 no-padding no-margin">
                <md-tabs md-dynamic-height="" md-border-bottom="" class="ng-isolate-scope md-dynamic-height">
                    <md-tabs-wrapper>
                        <md-tab-data>
                            <md-tab label="Planlanmış Çalışmalar" class="ng-scope ng-isolate-scope"></md-tab>
                            <md-tab label="Zorunlu Evraklar" class="fa fa-bell ng-scope ng-isolate-scope"></md-tab>
                        </md-tab-data> <!-- ngIf: $mdTabsCtrl.shouldPaginate -->
                        <!-- ngIf: $mdTabsCtrl.shouldPaginate -->
                        <md-tabs-canvas tabindex="0" ng-focus="$mdTabsCtrl.redirectFocus()"
                            ng-class="{ 'md-paginated': $mdTabsCtrl.shouldPaginate, 'md-center-tabs': $mdTabsCtrl.shouldCenterTabs }"
                            ng-keydown="$mdTabsCtrl.keydown($event)">
                            <md-pagination-wrapper ng-class="{ 'md-center-tabs': $mdTabsCtrl.shouldCenterTabs }"
                                md-tab-scroll="$mdTabsCtrl.scroll($event)" role="tablist"
                                aria-label="Use the left and right arrow keys to navigate between tabs"
                                style="transform: translate(0px, 0px);">
                                <!-- ngRepeat: tab in $mdTabsCtrl.tabs -->
                                <md-tab-item tabindex="0" class="md-tab  md-active" ng-repeat="tab in $mdTabsCtrl.tabs"
                                    role="tab" id="tab-item-0" md-tab-id="0" aria-selected="true" aria-disabled="false"
                                    ng-click="$mdTabsCtrl.select(tab.getIndex())" ng-focus="$mdTabsCtrl.hasFocus = true"
                                    ng-blur="$mdTabsCtrl.hasFocus = false"
                                    ng-class="{ 'md-active':    tab.isActive(), 'md-focused':   tab.hasFocus(), 'md-disabled':  tab.scope.disabled }"
                                    ng-disabled="tab.scope.disabled" md-swipe-left="$mdTabsCtrl.nextPage()"
                                    md-swipe-right="$mdTabsCtrl.previousPage()" md-tabs-template="::tab.label"
                                    md-scope="::tab.parent" aria-controls="tab-content-0"><span
                                        class="ng-scope">Planlanmış Çalışmalar</span></md-tab-item>
                                <!-- end ngRepeat: tab in $mdTabsCtrl.tabs -->
                                <md-tab-item tabindex="-1" class="md-tab " ng-repeat="tab in $mdTabsCtrl.tabs"
                                    role="tab" id="tab-item-1" md-tab-id="1" aria-selected="false" aria-disabled="false"
                                    ng-click="$mdTabsCtrl.select(tab.getIndex())" ng-focus="$mdTabsCtrl.hasFocus = true"
                                    ng-blur="$mdTabsCtrl.hasFocus = false"
                                    ng-class="{ 'md-active':    tab.isActive(), 'md-focused':   tab.hasFocus(), 'md-disabled':  tab.scope.disabled }"
                                    ng-disabled="tab.scope.disabled" md-swipe-left="$mdTabsCtrl.nextPage()"
                                    md-swipe-right="$mdTabsCtrl.previousPage()" md-tabs-template="::tab.label"
                                    md-scope="::tab.parent" aria-controls="tab-content-1"><span class="ng-scope">Zorunlu
                                        Evraklar</span></md-tab-item><!-- end ngRepeat: tab in $mdTabsCtrl.tabs -->
                                <md-ink-bar style="left: 0px; right: 0px;"></md-ink-bar>
                            </md-pagination-wrapper>
                            <md-tabs-dummy-wrapper aria-hidden="true" class="md-visually-hidden md-dummy-wrapper">
                                <!-- ngRepeat: tab in $mdTabsCtrl.tabs -->
                                <md-dummy-tab class="md-tab ng-scope ng-isolate-scope" tabindex="-1"
                                    ng-focus="$mdTabsCtrl.hasFocus = true" ng-blur="$mdTabsCtrl.hasFocus = false"
                                    ng-repeat="tab in $mdTabsCtrl.tabs" md-tabs-template="::tab.label"
                                    md-scope="::tab.parent"><span class="ng-scope">Planlanmış Çalışmalar</span>
                                </md-dummy-tab><!-- end ngRepeat: tab in $mdTabsCtrl.tabs -->
                                <md-dummy-tab class="md-tab ng-scope ng-isolate-scope" tabindex="-1"
                                    ng-focus="$mdTabsCtrl.hasFocus = true" ng-blur="$mdTabsCtrl.hasFocus = false"
                                    ng-repeat="tab in $mdTabsCtrl.tabs" md-tabs-template="::tab.label"
                                    md-scope="::tab.parent"><span class="ng-scope">Zorunlu Evraklar</span>
                                </md-dummy-tab><!-- end ngRepeat: tab in $mdTabsCtrl.tabs -->
                            </md-tabs-dummy-wrapper>
                        </md-tabs-canvas>
                    </md-tabs-wrapper>
                    <md-tabs-content-wrapper ng-show="$mdTabsCtrl.hasContent &amp;&amp; $mdTabsCtrl.selectedIndex >= 0"
                        class="_md" aria-hidden="false">
                        <!-- ngRepeat: (index, tab) in $mdTabsCtrl.tabs -->
                        <!-- ngIf: tab.hasContent -->
                        <md-tab-content id="tab-content-0" class="_md ng-scope md-active md-no-scroll" role="tabpanel"
                            aria-labelledby="tab-item-0"
                            md-swipe-left="$mdTabsCtrl.swipeContent &amp;&amp; $mdTabsCtrl.incrementIndex(1)"
                            md-swipe-right="$mdTabsCtrl.swipeContent &amp;&amp; $mdTabsCtrl.incrementIndex(-1)"
                            ng-if="tab.hasContent" ng-repeat="(index, tab) in $mdTabsCtrl.tabs"
                            ng-class="{ 'md-no-transition': $mdTabsCtrl.lastSelectedIndex == null, 'md-active':        tab.isActive(), 'md-left':          tab.isLeft(), 'md-right':         tab.isRight(), 'md-no-scroll':     $mdTabsCtrl.dynamicHeight }"
                            style="">
                            <!-- ngIf: $mdTabsCtrl.enableDisconnect || tab.shouldRender() -->
                            <div md-tabs-template="::tab.template" md-connected-if="tab.isActive()"
                                md-scope="::tab.parent" ng-if="$mdTabsCtrl.enableDisconnect || tab.shouldRender()"
                                class="ng-scope ng-isolate-scope">
                                <md-content class="no-padding ng-scope _md">
                                    <div class="col-md-12 col-xs-12 col-sm-12 no-padding no-margin yukseklikAyarla"
                                        data-h-fark="100" style="height: 752px;">
                                        <div class="col-md-12 col-xs-12 col-sm-12 font-size-14 border-gray pb-10 bg-white yukseklikAyarla no-padding"
                                            data-mhoran="32" data-h-mn="200px" data-hparent="true"
                                            style="height: 240.64px; min-height: 200px;">
                                            <b
                                                class="col-md-12 col-xs-12 col-sm-12  p-3 pl-15 no-margin color-ensablue bg-satirGrisi2 mb-5 font-robotobold">Yıllık
                                                Çalışma Planı <b
                                                    class="badge bg-red  ml-15 font-size-10 ng-binding">Haziran
                                                    2021</b></b>
                                            <div class="col-md-12 col-xs-12 col-sm-12 no-margin no-padding mr-5 pull-left font-size-11 overflow-y-auto overflow-x-hidden yukseklikAyarla"
                                                data-h-fark="30" data-hparent="true"
                                                style="min-height: 160px; height: 199.011px;">
                                                <!-- ngRepeat: calisma in Calismalar -->
                                                <div class="col-md-12 col-xs-12 col-sm-12 no-padding p-5 bg-acikGri ng-scope"
                                                    ng-repeat="calisma in Calismalar" ng-mouseenter="calisma.Mouse=true"
                                                    ng-mouseleave="calisma.Mouse=false" ng-click="AktiviteSec(calisma)"
                                                    role="button" tabindex="0" style="">
                                                    <span class="col-md-6 col-sm-6 col-xs-12 ng-binding"><i
                                                            class="font-size-12 fa fa-briefcase bg-white p-5 mr-10 "></i>GÜRÜLTÜ
                                                        ÖLÇÜMÜ</span>
                                                    <div class="col-md-2 col-sm-2"><i
                                                            class="ml-10 font-size-15  fa fa-times"
                                                            style="color:red"></i></div>
                                                    <div class="col-md-3 col-sm-4 hidden-xs text-left ng-hide"
                                                        ng-show="calisma.Mouse" aria-hidden="true" style="">
                                                        <button class="btn btn-warning btn-xs pull-left mr-5"
                                                            ng-click="DokumanEkle(calisma)"><i
                                                                class=" fa fa-plus"></i></button>
                                                        <!-- ngIf: Dosya(calisma,'v') -->
                                                        <!-- ngIf: Dosya(calisma,'v') -->
                                                    </div>
                                                </div><!-- end ngRepeat: calisma in Calismalar -->
                                                <div class="col-md-12 col-xs-12 col-sm-12 no-padding p-5 bg-acikGri ng-scope"
                                                    ng-repeat="calisma in Calismalar" ng-mouseenter="calisma.Mouse=true"
                                                    ng-mouseleave="calisma.Mouse=false" ng-click="AktiviteSec(calisma)"
                                                    role="button" tabindex="0">
                                                    <span class="col-md-6 col-sm-6 col-xs-12 ng-binding"><i
                                                            class="font-size-12 fa fa-briefcase bg-white p-5 mr-10 "></i>İSG
                                                        TESPIT VE ÖNERI DEFTERININ DOLD...</span>
                                                    <div class="col-md-2 col-sm-2"><i
                                                            class="ml-10 font-size-15  fa fa-times"
                                                            style="color:red"></i></div>
                                                    <div class="col-md-3 col-sm-4 hidden-xs text-left ng-hide"
                                                        ng-show="calisma.Mouse" aria-hidden="true" style="">
                                                        <button class="btn btn-warning btn-xs pull-left mr-5"
                                                            ng-click="DokumanEkle(calisma)"><i
                                                                class=" fa fa-plus"></i></button>
                                                        <!-- ngIf: Dosya(calisma,'v') -->
                                                        <!-- ngIf: Dosya(calisma,'v') -->
                                                    </div>
                                                </div><!-- end ngRepeat: calisma in Calismalar -->
                                                <div class="col-md-12 col-xs-12 col-sm-12 no-padding p-5 bg-acikGri ng-scope"
                                                    ng-repeat="calisma in Calismalar" ng-mouseenter="calisma.Mouse=true"
                                                    ng-mouseleave="calisma.Mouse=false" ng-click="AktiviteSec(calisma)"
                                                    role="button" tabindex="0">
                                                    <span class="col-md-6 col-sm-6 col-xs-12 ng-binding"><i
                                                            class="font-size-12 fa fa-briefcase bg-white p-5 mr-10 "></i>TITREŞIM
                                                        ÖLÇÜMÜ</span>
                                                    <div class="col-md-2 col-sm-2"><i
                                                            class="ml-10 font-size-15  fa fa-times"
                                                            style="color:red"></i></div>
                                                    <div class="col-md-3 col-sm-4 hidden-xs text-left ng-hide"
                                                        ng-show="calisma.Mouse" aria-hidden="true" style="">
                                                        <button class="btn btn-warning btn-xs pull-left mr-5"
                                                            ng-click="DokumanEkle(calisma)"><i
                                                                class=" fa fa-plus"></i></button>
                                                        <!-- ngIf: Dosya(calisma,'v') -->
                                                        <!-- ngIf: Dosya(calisma,'v') -->
                                                    </div>
                                                </div><!-- end ngRepeat: calisma in Calismalar -->
                                                <div class="col-md-12 col-xs-12 col-sm-12 no-padding p-5 bg-acikGri ng-scope"
                                                    ng-repeat="calisma in Calismalar" ng-mouseenter="calisma.Mouse=true"
                                                    ng-mouseleave="calisma.Mouse=false" ng-click="AktiviteSec(calisma)"
                                                    role="button" tabindex="0">
                                                    <span class="col-md-6 col-sm-6 col-xs-12 ng-binding"><i
                                                            class="font-size-12 fa fa-briefcase bg-white p-5 mr-10 "></i>TOPRAKLAMA
                                                        TESISATI </span>
                                                    <div class="col-md-2 col-sm-2"><i
                                                            class="ml-10 font-size-15  fa fa-times"
                                                            style="color:red"></i></div>
                                                    <div class="col-md-3 col-sm-4 hidden-xs text-left ng-hide"
                                                        ng-show="calisma.Mouse" aria-hidden="true" style="">
                                                        <button class="btn btn-warning btn-xs pull-left mr-5"
                                                            ng-click="DokumanEkle(calisma)"><i
                                                                class=" fa fa-plus"></i></button>
                                                        <!-- ngIf: Dosya(calisma,'v') -->
                                                        <!-- ngIf: Dosya(calisma,'v') -->
                                                    </div>
                                                </div><!-- end ngRepeat: calisma in Calismalar -->
                                            </div>
                                        </div>
                                        <div class="col-md-12 font-size-14 border-gray mt-5 pb-10 bg-white yukseklikAyarla no-padding"
                                            data-mhoran="32" data-h-mn="200px" data-hparent="true"
                                            style="height: 240.64px; min-height: 200px;">
                                            <b class="col-md-12 p-3 pl-15 no-margin color-ensablue mb-5 bg-satirGrisi2">Yıllık
                                                Eğitim Planı <b
                                                    class="badge bg-red  ml-15 font-size-10 ng-binding">Haziran
                                                    2021</b></b>
                                            <div class="col-md-12 col-xs-12 col-sm-12 no-margin no-padding mr-5 pull-left font-size-11 overflow-y-auto overflow-x-hidden yukseklikAyarla"
                                                data-h-fark="30" data-hparent="true"
                                                style="min-height: 160px; height: 199.011px;">
                                                <!-- ngRepeat: egitim in Egitimler -->
                                                <div class="col-md-12 col-xs-12 col-sm-12 no-padding p-5 bg-acikGri ng-scope"
                                                    ng-repeat="egitim in Egitimler" ng-mouseenter="egitim.Mouse=true"
                                                    ng-mouseleave="egitim.Mouse=false" ng-click="AktiviteSec(egitim)"
                                                    data-h-fark="5" data-hparent="true" role="button" tabindex="0"
                                                    style="">
                                                    <span class="col-md-6 col-sm-6 col-xs-12 ng-binding"><i
                                                            class="font-size-12 fa fa-briefcase bg-white p-5 mr-10  "></i>TEMEL
                                                        İSG EGITIMLERI</span>
                                                    <div class="col-md-2 col-sm-2">
                                                        <i class="ml-10 font-size-15 fa fa-times" style="color:red"></i>
                                                    </div>
                                                    <div class="col-md-3 col-sm-4 hidden-xs text-left ng-hide"
                                                        ng-show="egitim.Mouse" aria-hidden="true" style="">
                                                        <button class="btn btn-warning btn-xs pull-left mr-5"
                                                            ng-click="DokumanEkle(egitim)"><i
                                                                class=" fa fa-plus"></i></button>
                                                        <!-- ngIf: Dosya(egitim,'v') -->
                                                        <!-- ngIf: Dosya(egitim,'v') -->
                                                    </div>
                                                </div><!-- end ngRepeat: egitim in Egitimler -->
                                            </div>
                                        </div>
                                        <div class="col-md-12 font-size-14 border-gray mt-5 pb-10 bg-white yukseklikAyarla no-padding"
                                            style="overflow-y: hidden; height: 240.64px; min-height: 200px;"
                                            data-mhoran="32" data-h-mn="200px" data-hparent="true"
                                            ng-init="Kontrol.Mouse=false" ng-mouseenter="Kontrol.Mouse=true;"
                                            ng-mouseleave="Kontrol.Mouse=false;">
                                            <input type="file" id="kontrolDosya" style="display: none;"
                                                onchange="angular.element(this).scope().KontrolfileChange(this)">
                                            <div class="col-md-12  p-3 pl-15 no-margin color-ensablue font-robotobold mb-5 bg-satirGrisi2"
                                                style="height:26px;">
                                                <div class="col-md-8 no-margin no-padding pull-left">
                                                    <b>Aylık Kontrol Listesi / Check List </b> <b
                                                        class="badge bg-red  ml-15 font-size-10 ng-binding">Haziran
                                                        2021</b>
                                                </div>
                                                <!-- ngIf: Kontrol.FirmaKontrolId!==undefined -->
                                            </div>
                                            <div class="col-md-12 col-xs-12 col-sm-12 no-margin no-padding mr-5 pull-left font-size-11 overflow-y-auto overflow-x-hidden yukseklikAyarla"
                                                data-h-fark="30" data-hparent="true"
                                                style="min-height: 160px; height: 198.011px;"
                                                ng-click="KontrolDetayGoster(Kontrol)" role="button" tabindex="0">
                                                <!-- ngRepeat: kont in KontrolListesi -->
                                            </div>
                                        </div>

                                    </div>
                                </md-content>
                            </div><!-- end ngIf: $mdTabsCtrl.enableDisconnect || tab.shouldRender() -->
                        </md-tab-content><!-- end ngIf: tab.hasContent -->
                        <!-- end ngRepeat: (index, tab) in $mdTabsCtrl.tabs -->
                        <!-- ngIf: tab.hasContent -->
                        <md-tab-content id="tab-content-1" class="_md ng-scope md-right md-no-scroll" role="tabpanel"
                            aria-labelledby="tab-item-1"
                            md-swipe-left="$mdTabsCtrl.swipeContent &amp;&amp; $mdTabsCtrl.incrementIndex(1)"
                            md-swipe-right="$mdTabsCtrl.swipeContent &amp;&amp; $mdTabsCtrl.incrementIndex(-1)"
                            ng-if="tab.hasContent" ng-repeat="(index, tab) in $mdTabsCtrl.tabs"
                            ng-class="{ 'md-no-transition': $mdTabsCtrl.lastSelectedIndex == null, 'md-active':        tab.isActive(), 'md-left':          tab.isLeft(), 'md-right':         tab.isRight(), 'md-no-scroll':     $mdTabsCtrl.dynamicHeight }"
                            style="">
                            <!-- ngIf: $mdTabsCtrl.enableDisconnect || tab.shouldRender() -->
                            <div md-tabs-template="::tab.template" md-connected-if="tab.isActive()"
                                md-scope="::tab.parent" ng-if="$mdTabsCtrl.enableDisconnect || tab.shouldRender()"
                                class="ng-scope ng-isolate-scope">
                                <md-content class="md-padding ng-scope _md">
                                    <div class="col-md-12 col-xs-12 col-sm-12 no-margin no-padding mr-5 pull-left font-size-11 overflow-y-auto overflow-x-hidden yukseklikAyarla"
                                        data-h-fark="120" style="min-height: 320px; height: 732px;">
                                        <!-- ngRepeat: zdok in ZorunluDokumanlar -->
                                    </div>
                                </md-content>
                            </div><!-- end ngIf: $mdTabsCtrl.enableDisconnect || tab.shouldRender() -->
                        </md-tab-content><!-- end ngIf: tab.hasContent -->
                        <!-- end ngRepeat: (index, tab) in $mdTabsCtrl.tabs -->
                    </md-tabs-content-wrapper>
                </md-tabs>
            </div>
        </md-content>
    </div>
    <div class="col-md-5 col-xs-12 pr-0 mt-10 yukseklikAyarla" data-hparent="true" data-mhoran="96" id="uyaribildiriler"
        style="height: 765.12px;">
        <div class="col-md-12 no-padding no-margin yukseklikAyarla bg-white border-gray" data-hparent="true"
            data-h-fark="164" data-mhoran="96" style="height: 570.4px;">
            <div
                class="col-md-12 no-padding pt-5 pb-5 no-margin bg-satirGrisi text-center color-black font-size-15 font-robotomed">
                <i class=" fa fa-warning mr-10 "></i>Uyarılar &amp; Bildiriler
            </div>
            <div class="col-md-12 no-padding no-margin yukseklikAyarla" data-hparent="true" data-mhoran="100"
                data-h-fark="50" style="min-height: 250px; height: 519.011px;">
                <div class="kayan-liste col-md-12 no-padding no-margin yukseklikAyarla" data-hparent="true"
                    data-mhoran="98" style="height: 508.62px;">
                    <table class="table table-responsive no-border">
                        <tbody>
                            <!-- ngIf: Uyarilar.GuvenlikEgitimi.YokOlanAdet>0 -->
                            <tr ng-if="Uyarilar.GuvenlikEgitimi.YokOlanAdet>0" class="ng-scope" style="">
                                <td class="col-md-12">
                                    <div class="dv-model-info">
                                        <div class="col-md-12 pt-5 pb-5"
                                            style="border-bottom:1px solid #ccc3c3; margin-bottom:10px;">
                                            <span class=" text-info col-md-12 no-padding">
                                                <i class="fa fa-exclamation font-size-25 mr-5"></i>
                                                <a y="" href="/FirmaPersonelList?firma-id=44204&amp;veri=isguvenligi"><b
                                                        class="ng-binding">13</b> adet personelin iş güvenliği eğitimi
                                                    yoktur.</a>
                                                <br>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr><!-- end ngIf: Uyarilar.GuvenlikEgitimi.YokOlanAdet>0 -->
                            <!-- ngIf: Uyarilar.GuvenlikEgitimi.EksikOlanAdet>0 -->
                            <!-- ngIf: Uyarilar.SaglikEgitimi.YokOlanAdet>0 -->
                            <tr ng-if="Uyarilar.SaglikEgitimi.YokOlanAdet>0" class="ng-scope">
                                <td class="col-md-12">
                                    <div class="dv-model-info">
                                        <div class="col-md-12 pt-5 pb-5"
                                            style="border-bottom:1px solid #ccc3c3; margin-bottom:10px;">
                                            <span class="text-info col-md-12 no-padding">
                                                <i class="fa fa-exclamation font-size-25 mr-5"></i>
                                                <a href="/FirmaPersonelList?firma-id=44204&amp;veri=issagligi"><b
                                                        class="ng-binding">13</b> adet personelin iş sağlığı eğitimi
                                                    yoktur.</a>
                                                <br>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr><!-- end ngIf: Uyarilar.SaglikEgitimi.YokOlanAdet>0 -->
                            <!-- ngIf: Uyarilar.SaglikEgitimi.EksikOlanAdet>0 -->
                            <!-- ngIf: Uyarilar.Muayene>0 -->
                            <tr ng-if="Uyarilar.Muayene>0" class="ng-scope">
                                <td class="col-md-12">
                                    <div class="dv-model-info">
                                        <div class="col-md-12 pt-5 pb-5"
                                            style="border-bottom:1px solid #ccc3c3; margin-bottom:10px;">

                                            <span class="text-info no-padding col-md-12">
                                                <a href="/FirmaPersonelList?firma-id=44204&amp;veri=muayene">
                                                    <i class="fa fa-exclamation font-size-25 mr-5"></i>
                                                    <b class="ng-binding">13</b> adet personelin işe giriş ve sağlık
                                                    muayenesi eksiktir.
                                                </a>
                                                <br>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr><!-- end ngIf: Uyarilar.Muayene>0 -->
                            <!-- ngIf: Uyarilar.Ekipman>0 -->
                            <!-- ngIf: Uyarilar.Dof>0 -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 no-padding no-margin bg-white border-gray mt-10 ">
            <div class="col-md-12 p-5 bg-satirGrisi color-black font-size-15 font-robotomed">
                <div class="col-md-6 pull-left no-margin">
                    <i class=" fa fa-home mr-10 font-size-16"></i>İşyeri Bilgileri
                </div>
                <div class="col-md-6 pull-right no-margin ng-binding">
                    A__z Mobi̇lya İnşaat Gida Elektri̇k Metal Ürünleri̇ İthalat İhra -
                </div>
            </div>
            <div class="col-md-12 pt-10">
                <div class="col-md-6 no-padding no-margin">
                    <!-- ngIf: fb.YetkiliKisi!==null && fb.YetkiliKisi!=='' -->
                    <div class="col-md-12 pt-5 no-padding ng-binding ng-scope"
                        ng-if="fb.YetkiliKisi!==null &amp;&amp; fb.YetkiliKisi!==''">
                        <i class="fa fa-user pr-10">
                        </i>MEHMET EMIN ZEYBEK
                    </div><!-- end ngIf: fb.YetkiliKisi!==null && fb.YetkiliKisi!=='' -->
                    <!-- ngIf: fb.TehlikeSinifi!==null && fb.TehlikeSinifi!=='' -->
                    <div class="col-md-12 pt-5 no-padding ng-binding ng-scope"
                        ng-if="fb.TehlikeSinifi!==null &amp;&amp; fb.TehlikeSinifi!==''">
                        <i class="fa fa-compress pr-10">
                        </i>TEHLİKELİ
                    </div><!-- end ngIf: fb.TehlikeSinifi!==null && fb.TehlikeSinifi!=='' -->
                    <!-- ngIf: fb.Telefon!==null && fb.Telefon!=='' -->
                    <!-- ngIf: fb.Faks!==null && fb.Faks!=='' -->
                    <!-- ngIf: fb.Adres!==null && fb.Adres!=='' -->
                    <div class="col-md-12 no-padding pt-5 ng-binding ng-scope"
                        ng-if="fb.Adres!==null &amp;&amp; fb.Adres!==''">
                        <i class="fa fa-location-arrow pr-10">
                        </i>MERKEZ
                    </div><!-- end ngIf: fb.Adres!==null && fb.Adres!=='' -->
                </div>
                <div class="col-md-6 no-padding no-margin">
                    <div class="col-md-12 no-padding pt-5 ng-binding">
                        <i class="fa fa-users pr-10">
                        </i>21 Çalışan
                    </div>
                    <!-- ngRepeat: pr in isgProflar | filter:{PersonelTuru:'Doktor'} -->
                    <div class="col-md-12 no-padding pt-5 ng-binding ng-scope"
                        ng-repeat="pr in isgProflar | filter:{PersonelTuru:'Doktor'}" style="">
                        <i class="fa fa-user-md pr-10">
                        </i>Dr. ABDULLAH AYYILDIZ
                    </div><!-- end ngRepeat: pr in isgProflar | filter:{PersonelTuru:'Doktor'} -->
                    <!-- ngRepeat: pr in isgProflar | filter:{PersonelTuru:'Uzman'} -->
                    <div class="col-md-12 no-padding pt-5 ng-binding ng-scope"
                        ng-repeat="pr in isgProflar | filter:{PersonelTuru:'Uzman'}">
                        <i class="fa fa-user-md pr-10">
                        </i>Uzm.HAYRİYE SELÇUK
                    </div><!-- end ngRepeat: pr in isgProflar | filter:{PersonelTuru:'Uzman'} -->
                    <!-- ngRepeat: pr in isgProflar | filter:{PersonelTuru:'Diğer Sağlık'} -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 hidden-sm hidden-lg hidden-md hidden-print no-padding no-margin bg-white border-gray yukseklikAyarla ng-hide"
        data-mhoran="25" style="position: fixed; bottom: 0px; left: 0px; height: 213px;" ng-show="seciliAkt"
        aria-hidden="true">
        <span class="pull-left col-xs-8 ng-binding"></span><button class="col-xs-3 btn btn-default btn-sm pull-right"
            ng-click="AktiviteSecimKaldir()">X</button>
        <div class="col-xs-12 no-padding no-margin p-10">
            <button class="btn btn-warning pull-left col-xs-4" ng-click="DokumanEkle(seciliAkt)"><i
                    class="fa fa-plus mr-10"></i>Ekle</button>
            <!-- ngIf: Dosya(seciliAkt,'v') -->
            <!-- ngIf: Dosya(seciliAkt,'v') -->
        </div>
    </div>
</div>
--}}
@endsection