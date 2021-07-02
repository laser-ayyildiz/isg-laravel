$(document).ready(function () {
    document.querySelector('input[type="date"]').max = new Date().toISOString().split("T")[0];

    $('.custom-file-input').on('change', function () {
        $(this).next('.custom-file-label').html($(this).val());
    });

    const pathArray = window.location.pathname.split('/');
    if (pathArray[pathArray.length-1] === "mandatory-files"){
        $("#zd-tab").addClass("active");
        $("#zorunlu_dokumanlar").addClass("active");
    }else if(pathArray[pathArray.length-1] === "notebook-copies"){
        $("#defter_nushalari").addClass("active");
        $("#dn-tab").addClass("active");
    }else{
        $("#gozlem_raporlari").addClass("active");
        $("#gr-tab").addClass("active");
    }

    $("#mandatory_files_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#zorunlu_dokumanlar"]').click();
    });
    $("#notebook_copies_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#defter_nushalari"]').click();
    });
    $("#observation_reports_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#gozlem_raporlari"]').click();
    });
});