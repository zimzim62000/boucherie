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


/*******************\
 Function autocomplete city
 \*******************/
var rechercheKeyGlobal = 0;

function autocompletecity(e, input) {

    var $input = $(input);
    var rechercheKey = rechercheKeyGlobal;
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

    var submit = true;
    if (e.keyCode == 38) {
        submit = false;
        rechercheKey--;
    }
    if (e.keyCode == 40) {
        submit = false;
        rechercheKey++;
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
                        $('.container-autocompletecity').remove();
                        var entities = JSON.parse(feedback);
                        var $parent = $input.parent();
                        $parent.css('position', 'relative');
                        $parent.append('<div class="container-autocompletecity"></div>');
                        $container = $('div.container-autocompletecity', $parent);
                        $input.css('margin', '0');
                        var height = $input.css('height');
                        for (var i in entities) {
                            var entity = entities[i];
                            var name = entity.city + ' :' + entity.cp;
                            var barre = '<div onClick="$(' + $input.attr('id') + ').val($(this).attr(\'dataref\')); $(\'.container-autocompletecity\').remove();" dataref="ref :' + name + '" class="autocompletecity text-center" style="line-height: ' + height + '; height: ' + height + '  ">' + name + '</div>';
                            $container.append(barre);
                        }
                    }
                });
                return false;
            });
        }
        if (submit) {
            $form.submit();
        } else {
            $container = $('div.container-autocompletecity');
            $container.find('div').each(function (i, div) {
                $(div).removeClass('current');
                if (rechercheKey == i) {
                    $(div).addClass('current');
                }
            });
        }
    } else {
        $('.container-autocompletecity').remove();
    }
    rechercheKeyGlobal = rechercheKey;
}


