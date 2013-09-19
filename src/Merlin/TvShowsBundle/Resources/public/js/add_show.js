$(function() {
    $('#cancelButton').click(function(e) {
        e.preventDefault();
        location.href = $(this).attr('data-url');
//        $(this).closest('form').find('input[type=text],input[type=number]').each(function() {
//            $(this).val('')
//        });
    });
});
