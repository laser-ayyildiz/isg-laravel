let i = 2;
let check = false;

for (let index = 1; index < 5; index++) {
    $('#next' + index).on('click', function () {
        let field = document.getElementById("field" + index);
        let invalids = field.querySelectorAll("input:invalid, select:invalid, textarea:invalid");
        invalids.forEach(element => {
            $(element).addClass("is-invalid");
            $(element).on('keyup change DOMNodeInserted', function () {
                if (element.checkValidity()) {
                    $(element).removeClass("is-invalid");
                    $(element).addClass("is-valid");
                }
            });
        });

        check = invalids.length === 0 ? true : false;
        if (check) {
            $('#link' + i + '-tab').removeClass('disabled');
            i++;
            $('#saveBtn').removeClass('disabled');
            $('.nav-tabs > .nav-item > .active').parent().next('li').find('a').trigger('click');
        } else {
            $('#saveBtn').addClass('disabled');
        }
    });

    $('#addCompanyForm').on('click change', function () {
        if (addCompanyForm.checkValidity()) {
            $('#saveBtn').removeClass('disabled');
        } else {
            $('#saveBtn').addClass('disabled');
        }
    })
}


////////////////////////////////////////////////////////////////////////////////

var no = "";
var elm = document.getElementById("sgk_fill_form");

$("#sgk_fill_form").on('keyup', function () {
    console.log("a")
    if (elm.checkValidity()) {
        $('#sgk_fill_btn').removeClass('disabled');
        $('#sgk_fill_btn').attr('data-dismiss', 'modal');
    }
    else {
        $('#sgk_fill_btn').addClass('disabled');
        $('#sgk_fill_btn').removeAttr('data-dismiss');
    }
});

$('#sgk_fill_btn').on('click', function () {
    $("#fill_modal :input").each(function (e) {
        no += this.value;
    });
    $('#sgk_sicil').val(no);
});
