$(document).ready(function () {
    const dates = document.querySelectorAll('input[type="date"]');
    if (dates.length > 0) {
        dates.forEach(function (date) {
            date.max = new Date().toISOString().split("T")[0];
        });
    }

    const pathArray = window.location.pathname.split('/');
    if (pathArray.includes("osgb")) {
        $("#oc-tab").addClass("active");
        $("#osgb_calisanlar").addClass("active");
    } else if (pathArray.includes("formal")) {
        $("#db-tab").addClass("active");
        $("#devlet_bilgileri").addClass("active");
    } else if (pathArray.includes("acc")) {
        $("#mb-tab").addClass("active");
        $("#muhasebe_bilgileri").addClass("active");
    } else if (pathArray.includes("group")) {
        $("#grb-tab").addClass("active");
        $("#grup_bilgileri").addClass("active");
    } else {
        $("#gb-tab").addClass("active");
        $("#genel_bilgiler").addClass("active");
    }

    $("#osgb_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#osgb_calisanlar"]').click();
    });
    $("#formal_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#devlet_bilgileri"]').click();
    });
    $("#acc_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#muhasebe_bilgileri"]').click();
    });
    $("#grb_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#grup_bilgileri"]').click();
    });
    $("#info_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#genel_bilgiler"]').click();
    });
});
