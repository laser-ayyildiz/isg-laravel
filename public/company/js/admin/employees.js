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
        let action = null;
        if (e.target.nodeName !== 'BUTTON' && e.target.nodeName !== 'I') {
            if (tr.attr('id') !== null && typeof tr.attr('id') !== "undefined") {
                window.location.href = "/admin/employee/" + tr.attr('id');
            }
        }
        else {
            var name = tr.find('td').eq(1).text();
            $('#deleteEmpName').html("<b>" + name + '</b> isimli çalışanı silmek istediğinize emin misiniz?');
            $('#empName').html("<b>" + name + '</b> isimli çalışan için dosya yükle');
            if (tr.attr('id') !== null && typeof tr.attr('id') !== "undefined") {
                $('#deleteEmpRequest').on('click', function () {
                    $('#deleteEmpForm').attr('action', "/admin/company/" + pathArray[3] + "/deleteEmployee/" + tr.attr('id'));
                });

                $('#addEmpFileRequest').on('click', function () {
                    $('#addEmpFileForm').attr('action', "/upload-file/" + tr.attr('id'));
                });

                $('#addEmpIdentifyFileRequest').on('click', function () {
                    $('#addEmpIdentifyFileForm').attr('action', "/upload-file/" + tr.attr('id'));
                });
            }
        }
    });

    $('#deletedEmpTable tbody').on('click', 'tr', function (e) {
        var tr = $(this).closest('tr');
        let action = "";
        if (e.target.nodeName !== 'BUTTON' && e.target.nodeName !== 'I') {
            if (tr.attr('id') !== null && typeof tr.attr('id') !== "undefined") {
                window.location.href = "/admin/employee/" + tr.attr('id');
            }
        }

        else {
            var name = tr.find('td').eq(1).text();
            $('#restoreEmpName').html("<b>" + name + '</b> isimli çalışanı işe geri almak istediğinize emin misiniz?');
            if (tr.attr('id') !== null && typeof tr.attr('id') !== "undefined") {
                $('#restoreEmpRequest').on('click', function () {
                    action = "";
                    action = $('#restoreEmpForm').attr('action');
                    $('#restoreEmpForm').attr('action', action + tr.attr('id'));
                });
            }
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
        if (this.files[0].size > 47185920)
            alert("Maksimum 45 Mb");
    });

    $('#exampleFile').on('click', function (e) {
        window.location.href = "/files/company-employee-lists/employee-table.xlsx"
    });
});
