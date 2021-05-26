$('#next1').click(function () {
    if ($('#comp_type').val() && $('#name').val() && $('#contract_date').val() && $('#address').val()
        && $('#email').val() && $('#phone').val() && $('#citySelect').val()
        && $('#countrySelect').val() && $('#is_veren').val()) {
        $('.nav-tabs > .nav-item > .active').parent().next('li').find('a').trigger('click');
    } else {
        window.alert("Lütfen zorunlu(*) alanları doldurun");
    }
});
$('#kaydet').click(function () {
    if (!$('#comp_type').val() && !$('#name').val() && !$('#contract_date').val()
        && !$('#address').val() && !$('#email').val() && !$('#phone').val()
        && !$('#citySelect').val() && !$('#countrySelect').val() && !$('#is_veren').val()) {
        window.alert("Lütfen zorunlu(*) alanları doldurun");
        return false;
    }
});
$('#next2').click(function () {
    $('.nav-tabs > .nav-item > .active').parent().next('li').find('a').trigger('click');
});
$('.previous').click(function () {
    $('.nav-tabs > .nav-item > .active').parent().prev('li').find('a').trigger('click');
});

$('#link2-tab').click(function () {
    if (!$('#comp_type').val() && !$('#name').val() && !$('#contract_date').val()
        && !$('#address').val() && !$('#email').val() && !$('#phone').val()
        && !$('#citySelect').val() && !$('#countrySelect').val() && !$('#is_veren').val()) {
        window.alert("Lütfen zorunlu(*) alanları doldurun");
        return false;
    }
});
$('#link3-tab').click(function () {
    if (!$('#comp_type').val() && !$('#name').val() && !$('#contract_date').val()
        && !$('#address').val() && !$('#email').val() && !$('#phone').val()
        && !$('#citySelect').val() && !$('#countrySelect').val() && !$('#is_veren').val()) {
        window.alert("Lütfen zorunlu(*) alanları doldurun");
        return false;
    }
});
