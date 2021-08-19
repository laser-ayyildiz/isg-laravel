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
    let activeTabId = $('#myTab').find('.active').attr('id');
    let allEmployees = null, empsWithMissDocs = null, empsDeleted = null;
    getEmps(activeTabId);
    $('#myTab').on("click", "li", function (event) {
        activeTabId = $(this).find('a').attr('id');
        getEmps(activeTabId);
    });

    function getEmps(tab) {
        if (tab === "ic-tab") {
            if (allEmployees === null) {
                allEmployees = $('#allEmps').DataTable({
                    "columnDefs": [{
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    },
                    {
                        "searchable": false,
                        "orderable": false,
                        "className": "text-center",
                        "targets":  [5, 6, 7, 8, 9, 10]
                    }],
                    "order": [[1, 'asc']],
                    processing: true,
                    DT_RowId: true,
                    responsive: true,
                    autoWidth: false,
                    ajax: { url: "/get-company-employees-with-files/" + pathArray[3], dataSrc: '' },
                    rowId: 'id',
                    columns: [
                        { data: null, name: 'numb' },
                        { data: 'name', name: 'name' },
                        { data: 'tc', name: 'tc' },
                        { data: 'phone', name: 'phone' },
                        { data: 'recruitment_date', name: 'recruitment_date' },
                        {
                            data: "first_edu", name: 'first_edu', render: function (data, type, row, meta) {
                                return data === 1
                                    ? '<span><i class="fas fa-check mx-3" style="color: green"></i></span>'
                                    : '<span><i class="fas fa-times mx-3" style="color: red"></i></span>';
                            }

                        },
                        {
                            data: "second_edu", name: 'second_edu', render: function (data, type, row, meta) {
                                return data === 1
                                    ? '<span><i class="fas fa-check mx-3" style="color: green"></i></span>'
                                    : '<span><i class="fas fa-times mx-3" style="color: red"></i></span>';
                            }

                        },
                        {
                            data: "examination", name: 'examination', render: function (data, type, row, meta) {
                                return data === 1
                                    ? '<span><i class="fas fa-check mx-3" style="color: green"></i></span>'
                                    : '<span><i class="fas fa-times mx-3" style="color: red"></i></span>';
                            }

                        },
                        {
                            data: "id", render: function (data, type, row, meta) {
                                return type === 'display' ?
                                    '<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteEmpModal" data-whatever="@getbootstrap"><i class="fas fa-trash"></i></button>' :
                                    data;
                            }
                        },
                        {
                            data: "id", render: function (data, type, row, meta) {
                                return type === 'display' ?
                                    '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addEmpFile" data-whatever="@getbootstrap"><i class="fas fa-plus"></i></button>' :
                                    data;
                            }
                        },
                        {
                            data: "id", render: function (data, type, row, meta) {
                                return type === 'display' ?
                                    '<button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#addEmpIdentifyFile" data-whatever="@getbootstrap"><i class="fas fa-folder-plus"></i></button>' :
                                    data;
                            }
                        },
                    ],
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
                    }
                });
                allEmployees.on('order.dt search.dt', function () {
                    allEmployees.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }).draw();
            }
        }
        if (tab === "eec-tab") {
            empsWithMissDocs = "2";
        }
        if (tab === "sc-tab") {
            empsDeleted = "3";
        }
    }



    /////////////////////////////////////////////////////////////

    $('#allEmps tbody').on('click', 'tr', function (e) {
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
                console.log(tr.attr('id'));
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
