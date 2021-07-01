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

    document.querySelector('input[type="date"]').max = new Date().toISOString().split("T")[0];

    /////////////////////////////////////////////////////////////

    $('#example tbody').on('click', 'tr', function (e) {
        var tr = $(this).closest('tr');
        if (e.target.nodeName !== 'BUTTON' && e.target.nodeName !== 'I') window.location.href = "/admin/employee/" + tr.attr('id');
        else {
            var name = tr.find('td').first().text();
            $('#deleteEmpName').html("<b>" + name + '</b> isimli çalışanı silmek istediğinize emin misiniz?');
            $('#empName').html("<b>" + name + '</b> isimli çalışan için dosya yükle');

            $('#deleteEmpRequest').click(function () {
                let action = $('#deleteEmpForm').attr('action');
                $('#deleteEmpForm').attr('action', action + pathArray[3] + "/deleteEmployee/" + tr.attr('id'));
            });

            $('#addEmpFileRequest').click(function () {
                let action = $('#addEmpFileForm').attr('action');
                $('#addEmpFileForm').attr('action', action + tr.attr('id'));
            });

            $('#addEmpIdentifyFileRequest').click(function () {
                let action = $('#addEmpIdentifyFileForm').attr('action');
                $('#addEmpIdentifyFileForm').attr('action', action + tr.attr('id'));
            });
        }
    });

    $('#deletedEmpTable tbody').on('click', 'tr', function (e) {
        var tr = $(this).closest('tr');
        if (e.target.nodeName !== 'BUTTON' && e.target.nodeName !== 'I') window.location.href = "/admin/employee/" + tr.attr('id');

        else {
            var name = tr.find('td').first().text();
            $('#restoreEmpName').html("<b>" + name + '</b> isimli çalışanı işe geri almak istediğinize emin misiniz?');

            $('#restoreEmpRequest').on('click', function () {
                let action = $('#restoreEmpForm').attr('action');
                $('#restoreEmpForm').attr('action', action + tr.attr('id'));
            });
        }
    });

    /////////////////////////////////////////////////////////////

    $("#selectAll").on('click', function () {
        if ($("#selectAll").is(':checked'))
            $('#boxes').addClass('d-none');
        else
            $('#boxes').removeClass('d-none');
    });

    $('#file_type').on('change', function () {
        if ($('#file_type').val() == 12)
            $('#empFileDiv').removeClass('d-none');
        else
            $('#empFileDiv').addClass('d-none');
    });

    $('#batch_file_type').on('change', function () {
        if ($('#batch_file_type').val() == 12)
            $('#empBatchFileDiv').removeClass('d-none');
        else
            $('#empBatchFileDiv').addClass('d-none');
    });

    $('.custom-file-input').on('change', function () {
        $(this).next('.custom-file-label').html($(this).val());
    });

    $('#exampleFile').on('click', function (e) {
        window.location.href = "/files/company-employee-lists/employee-table.xlsx"
    });
});
