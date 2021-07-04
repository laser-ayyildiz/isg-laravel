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
});
