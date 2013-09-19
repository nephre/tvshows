$(function() {
    $('#clearSearch').click(function(e) {
        e.preventDefault();
        $(this).closest('form').find('input[type=text],input[type=number]').each(function() {
            $(this).val('')
        });
    });
});
