var ZimZim = function () {

    this.init = function () {
        var _self = this;
    };

};
(function ($) {
    var zimzim = new ZimZim();
    $(document).ready(function () {
        zimzim.init();
    });
})(jQuery);

/*******************\
 Function global
 \*******************/

function ajaxSuccess(feedback) {
    var views = JSON.parse(feedback);
    for (var i in views) {
        var view = views[i];
        $('#' + view.id).replaceWith(view.template);
    }
}

function findForm($element) {
    if ($element[0].localName.match(/form/g)) {
        return $element;
    }
    return findForm($element.parent());
}

function scroolTo(ancre, delay) {
    $(document.body).animate({
        'scrollTop': $(ancre).offset().top
    }, delay);
}

/*******************\
 Function autocomplete city
 \*******************/

function searchIdAjax($element) {
    return $('input.form-input-ajax-autocomplete');
}

function autocompletecity(e, input) {

    var $input = $(input);
    var search = false;

    var regexNumber = new RegExp(/^[0-9]{1,99}$/g);

    if (regexNumber.test($input.val())) {
        if ($input.val().length >= 5) {
            search = true;
        }
    } else {
        if ($input.val().length > 3) {
            search = true;
        }
    }
    if (search) {
        $form = findForm($input);
        $inputajax = searchIdAjax($form);
        $data = $form.serialize();
        $action = $form[0].action;
        $.ajax({
            type: $form[0].method,
            url: $action,
            data: $data,
            success: function (feedback) {
                ajaxSuccess(feedback);
            }
        });
        return false;
    } else {
        $('#container-autocompletecity').empty();
    }
}


