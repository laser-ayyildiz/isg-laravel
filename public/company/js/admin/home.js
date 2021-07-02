$(document).ready(function () {
    document.querySelector('input[type="date"]').max = new Date().toISOString().split("T")[0];

    $('.custom-file-input').on('change', function () {
        $(this).next('.custom-file-label').html($(this).val());
    });
});