

jQuery(document).ready(function() {

    var $form = $('#parse-form');

    var contentType;

    function changeType($button) {
        contentType = $button.data('utype');

        var $textField = $form.find('input[name=text]').parent();

        if('text' === contentType) {
            $textField.removeClass('hidden transition');
        } else {
            $textField.addClass('hidden transition');
        }

        $('.button', $button.parents('.buttons:first')).removeClass('blue active');

        $button.addClass('blue active');
    }


    function validateForm(url, contentType, searchText) {
        var errors = '';

        if( undefined === url || !url || "" === url) {
            $form.find('input[name=url]').parent().addClass('error');
            errors += "<li>Урла не должна быть пустой</li>";
        }

        if( "text" === contentType && (undefined === searchText || !searchText || "" === searchText)) {
            $form.find('input[name=text]').parent().addClass('error');
            errors += "<li>Так что искать то будем?</li>";
        }

        if('' !== errors) {
            $form.addClass('error').find('.error ul').html(errors);
            return false;
        }

        return true;
    }

    function parse() {
        $form.removeClass('error').find('.input.error').removeClass('error');

        var url = $form.find('input[name=url]').val();
        var searchText = $form.find('input[name=text]').val();

        if(validateForm(url, contentType, searchText)) {
            $form.addClass('loading');
            $.ajax({
                'url': '/parser/' + contentType,
                'data': {
                    'url': url,
                    'text': searchText
                }
            }).success(function(data) {
                var errors = '';

                if(undefined === data.status) {
                    errors += "<li>Неверный ответ сервера</li>";
                } else if('error' === data.status) {
                    for(var index in data.errors) {
                        var err = data.errors[index];

                        var $field = $form.find('input[name=' + err.field + ']');
                        if($field.length) {
                            $field.parent().addClass('error');
                        }

                        errors += "<li>" + err.message + "</li>";
                    }
                }

                if('' !== errors) {
                    $form.addClass('error').find('.error ul').html(errors);
                    $('#result').removeClass('success').addClass('error');
                } else {
                    $('#result').removeClass('error').addClass('success');
                }

                var body = undefined === data._body_ ? data : data._body_;

                    console.log(body);
                if((undefined !== body) && (body) && ('' !== body)) {
                    $('#result').removeClass('hidden').html(body);
                } else {
                    $('#result').addClass('hidden').html('');
                }

                $form.removeClass('loading');

            }).error(function() {
                $form.addClass('error').find('.error ul').html("Ошибка в запросе");
                $form.removeClass('loading');
            });
        }
    }

    changeType($form.find('.buttons .button.active'));


    $form.find('.buttons .button').on("click", function() {
        changeType($(this));
    });

    $('.button', $form.find('input[name=url]').parent()).on("click", function() {
        parse();
    })

});

jQuery(document).ready(function() {
    var $table = $('#results');

    $table.find('tbody tr td').css('cursor', 'pointer').on('click', function() {
        $.ajax({
            'url': '/result/' + $(this).parent().data('id')
        }).success(function(data) {
                $('.ui.modal').html(data).modal('show');
            })

    })
});