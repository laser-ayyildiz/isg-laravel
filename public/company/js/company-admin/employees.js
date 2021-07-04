$(document).ready(function () {
    ///////////////////////////ROUTING///////////////////////////////////
    const pathArray = window.location.pathname.split('/');
    if (pathArray[pathArray.length - 1] === "deleted") {
        $("#sc-tab").addClass("active");
        $("#silinen_calisanlar").addClass("active");
    } else if (pathArray[pathArray.length - 1] === "with-missing-documents") {
        $("#evraklari_eksik_calisanlar").addClass("active");
        $("#eec-tab").addClass("active");
    }
    else {
        $("#isletme_calisanlar").addClass("active");
        $("#ic-tab").addClass("active");
    }

    $("#emp_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#isletme_calisanlar"]').click();
    });
    $("#emp_del_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#silinen_calisanlar"]').click();
    });
    $("#emp_miss_docs_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#evraklari_eksik_calisanlar"]').click();
    });

    /////////////////////////////////////////////////////////////

    const dates = document.querySelectorAll('input[type="date"]');
    if (dates.length > 0) {
        dates.forEach(function (date) {
            date.max = new Date().toISOString().split("T")[0];
        });
    }

    /////////////////////////////////////////////////////////////

    $('#example tbody').on('click', 'tr', function (e) {
        var tr = $(this).closest('tr');
        if (e.target.nodeName !== 'BUTTON' && e.target.nodeName !== 'I') window.location.href = "/company-admin/employee/" + tr.attr('id') + "/company/" + pathArray[3];
        else {
            var name = tr.find('td').first().text();
            $('#empName').html("<b>" + name + '</b> isimli çalışan için dosya yükle');

            $('#addEmpIdentifyFileRequest').on('click', function () {
                $('#addEmpIdentifyFileForm').attr('action', "/upload-file/" + tr.attr('id'));
            });
        }
    });

    $('#deletedEmpTable tbody').on('click', 'tr', function (e) {
        var tr = $(this).closest('tr');
        window.location.href = "/company-admin/employee/" + tr.attr('id') + "/company/" + pathArray[3];
    });

    /////////////////////////////////////////////////////////////

    $('.custom-file-input').on('change', function () {
        $(this).next('.custom-file-label').html($(this).val());
        if (this.files[0].size > 47185920)
            alert("Maksimum 45 Mb");
    });
});
