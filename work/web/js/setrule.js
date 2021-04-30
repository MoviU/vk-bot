$('#rules2').hide()
$('.var select').change(function () {
    switch ($('.var select').val()) {
        case 'var':
            $('#variable').css('display', 'block');
            $('#value').toggleClass('col-sm-6 col-sm-3');
            break;
        case 'user_id':
            $('#variable').hide();
            $('#value').toggleClass('col-sm-3 col-sm-6');
            break;
        case 'like':
            $('#rules').hide();
            $('#variable').hide();
            $('#rules2').show();
            break;
    }
}); 