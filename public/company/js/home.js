$(document).ready(function () {
    document.querySelector('input[type="date"]').max = new Date().toISOString().split("T")[0];

    $('.custom-file-input').on('change', function (e) {
        $(this).next('.custom-file-label').html($(this).val());
        if (this.files[0].size > 47185920)
            alert("Maksimum 45 Mb");
    });
});
