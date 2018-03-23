var InputCounter = function($field) {
    var self = this;
    var $counter = $('<div class="input-counter text-muted small"></div>');
    var minLength = $field.data('min-length');
    var maxLength = $field.data('max-length');
    var optimalMinLength = $field.data('optimal-min-length');
    var optimalMaxLength = $field.data('optimal-max-length');

    $counter.insertBefore($field);
    refresh();

    $field.on('input', refresh);
    $(document).on('click', '[data-switch-locale]', refresh);

    function refresh()
    {
        var length = $field.val().length;
        var max = optimalMaxLength || maxLength;
        var min = optimalMinLength || minLength;

        if (!max && !min) {
            $counter.text(length);
            return;
        }

        if (max) {
            $counter.text(length + ' / ' + max);
        }
        else {
            $counter.text(length + ' > ' + min);
        }

        $counter.removeClass('text-danger text-warning text-success');

        if (length > maxLength || length < minLength) {
            $counter.addClass('text-danger');
            return;
        }

        if (length > optimalMaxLength || length < optimalMinLength) {
            $counter.addClass('text-warning');
            return;
        }

        $counter.addClass('text-success');
    }

    self.refresh = refresh;
};


$(document).render(function() {
    $('[data-counter]').each(function(index, element) {
        if (element.hasOwnProperty('inputCounter')) {
            return;
        }

        if (element.type === 'hidden') {
            return;
        }

        element.inputCounter = new InputCounter($(element));
    });
});
