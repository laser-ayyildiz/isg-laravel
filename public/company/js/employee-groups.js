$(document).ready(function () {
    const dates = document.querySelectorAll('input[type="date"]');
    if (dates.length > 0) {
        dates.forEach(function (date) {
            date.max = new Date().toISOString().split("T")[0];
        });
    }

    if ($('.custom-file-input').length > 0) {
        $('.custom-file-input').on('change', function (e) {
            $(this).next('.custom-file-label').html($(this).val());
            if (this.files[0].size > 47185920)
                alert("Maksimum 45 Mb");
        });
    }

    const pathArray = window.location.pathname.split('/');
    if (pathArray.includes("risk-group")) {
        $("#rde-tab").addClass("active");
        $("#risk_degerlendirme_ekibi").addClass("active");
    } else if (pathArray.includes("emergency-group")) {
        $("#ade-tab").addClass("active");
        $("#acil_durum_ekibi").addClass("active");
    } else if (pathArray.includes("isg-duties")) {
        $("#igt-tab").addClass("active");
        $("#isg_gorevlendirme_tablosu").addClass("active");
    } else {
        $("#igt-tab").addClass("active");
        $("#isg_gorevlendirme_tablosu").addClass("active");
    }

    $("#duty_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#isg_gorevlendirme_tablosu"]').click();
    });
    $("#emergency_group_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#acil_durum_ekibi"]').click();
    });
    $("#risk_group_item").on('click', function (event) {
        event.preventDefault();
        $('#myTab a[href="#risk_degerlendirme_ekibi"]').click();
    });

    if (pathArray.includes("company-admin")) {
        return false;
    }
    const empSelects =
        [
            '4',
            'Ekipler Şefi',
            'Arama, Kurtarma, Tahliye Ekibi',
            'Yangın Söndürme Ekibi',
            'İlk Yardım Ekibi',
            'Destek Elemanı'
        ];
    const osgbSelects = ["1", "2"];
    var compEmpData = null;
    var expertData = null;
    var doctorData = null;
    $("#employee_type").on('change', function () {
        $("#employee").empty();
        $("#employee").append("<option selected disabled>Çalışan Seçiniz</option>");
        $("#isveren-div").addClass('d-none');

        if (empSelects.includes($("#employee_type").val())) {
            if (compEmpData === null) {
                $.ajax({
                    url: "/get-company-employees/" + pathArray[3],
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    data: "{}",
                    success: function (data) {
                        data.forEach(element => {
                            $("#employee").append("<option value='" + element.id + "'>" + element.name + "</option>");
                        });
                        compEmpData = data;
                    }
                });
            }
            else
                compEmpData.forEach(element => {
                    $("#employee").append("<option value='" + element.id + "'>" + element.name + "</option>");
                });
        }
        if (osgbSelects.includes($("#employee_type").val())) {
            if ($("#employee_type").val() === "1") {
                if (expertData === null) {
                    $.ajax({
                        url: "/get-osgb-employees/" + 1,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        data: "{}",
                        success: function (data) {
                            data.forEach(element => {
                                $("#employee").append("<option value='" + element.id + "'>" + element.name + "</option>");
                            });
                            expertData = data;
                        }
                    });
                }
                else
                    expertData.forEach(element => {
                        $("#employee").append("<option value='" + element.id + "'>" + element.name + "</option>");
                    });
            } else if ($("#employee_type").val() === "2") {
                if (doctorData === null) {
                    $.ajax({
                        url: "/get-osgb-employees/" + 4,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        data: "{}",
                        success: function (data) {
                            data.forEach(element => {
                                $("#employee").append("<option value='" + element.id + "'>" + element.name + "</option>");
                            });
                            doctorData = data;
                        }
                    });
                }
                else
                    doctorData.forEach(element => {
                        $("#employee").append("<option value='" + element.id + "'>" + element.name + "</option>");
                    });
            }
        }
        if ($("#employee_type").val() === "3") {
            $("#isveren-div").removeClass('d-none');
        }
    });

    $('#dataTable tbody').on('click', 'tr', function (e) {
        var tr = $(this).closest('tr');
        var name = tr.find('td').eq(1).text();
        $('#selected_employee_name').html("<b>" + name + '</b> isimli çalışan için atama dosyası yükle');
        $('#selected_employee_name_delete_file').html("<b>" + name + '</b> isimli çalışanın atama dosyasını sil');
        $('#selected_employee_name_delete').html("<b>" + name + '</b> isimli çalışanı silmek istediğinize emin misiniz?');
        if (tr.attr('id') !== null && typeof tr.attr('id') !== "undefined") {
            $('#addFileForm').attr('action', "/company/" + pathArray[3] + "/add-assignment-file/" + tr.attr('id'));

            $('#deleteFileForm').attr('action', "/company/" + pathArray[3] + "/delete-assignment-file/" + tr.attr('id'));

            $('#deleteForm').attr('action', "/company/" + pathArray[3] + "/delete-employee-group/" + tr.attr('id'));
        }
    });
});



