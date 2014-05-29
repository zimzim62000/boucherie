var ZimZim = function () {

    this.init = function () {
        var _self = this;

        _self.initautocomplete();
    };

    this.initautocomplete = function () {
        $('input.autocomplete').each(function (i, input) {
            var $input = $(input);
            $input.attr('onKeyUp', 'autocompletecity(event, this);');
        });
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

function scroolTo(ancre, delay)
{
    $(document.body).animate({
        'scrollTop':   $(ancre).offset().top
    }, delay);
}


/*******************\
 Function autocomplete city
 \*******************/

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
        if (!$form.hasClass('form-ajax')) {
            $form.addClass('form-ajax');
            $form.submit(function () {
                $data = $form.serialize();
                $.ajax({
                    type: $form[0].method,
                    url: $form[0].action,
                    data: $data,
                    success: function (feedback) {
                        ajaxSuccess(feedback);
                    }
                });
                return false;
            });
        }

            $form.submit();

    } else {
        $('#container-autocompletecity').empty();
    }
}


