$('input[type=radio][name=isGroup]').change(function() {
    if (this.value == 'true') {
        $("#company-status-div").empty();
        $("#company-status-div")
        .append(
            '<h5><b>Şirketin Statüsü<a style="color:red">*</a></b></h5>'+
            '<div class="form-check">'+
                '<input class="form-check-input" type="radio" name="company_status" id="member-company" value="member">'+
                '<label class="form-check-label" for="member-company">Üye İş Yeri</label></div>'+
            '<div class="form-check">'+
                '<input class="form-check-input" type="radio" name="company_status" id="leader-company" value="leader" checked>'+
                '<label class="form-check-label" for="leader-company">Grup Şirketlerin Başındaki İş Yeri</label></div>'
            );
        $("#leader-company").prop("checked", true);
    }
    if (this.value == 'false') {
        $("#company-status-div").empty();
        $("#leader-company-div").empty();
    }
});

$(document).on('change', 'input[type=radio][name=company_status]', function() {
    if (this.value == 'member') {
        $("#leader-company-div")
        .append(
            '<label for="leader-company-select">'+
            '<h5><b>Üst Şirketi Seçiniz<a style="color:red">*</a></b></h5></label>'+
            '<select class="form-control" name="leader_company_select" id="leader-company-select">'+
            '<option value="" disabled selected>İş Yeri Seç</option></select>'
            );
        populateList();
        $('#sube-kodu-div').append(
            '<label for="sube-kodu">'+
            '<h5><b>Şube Kodunu giriniz<a style="color:red">*</a></b></h5></label>'+
            '<input class="form-control" name="sube_kodu" id="sube-kodu">'+
            '</input>'
        )
    }
    if (this.value == 'leader') {
        $("#leader-company-div").empty();
        $("#sube-kodu-div").empty();
    }
});
