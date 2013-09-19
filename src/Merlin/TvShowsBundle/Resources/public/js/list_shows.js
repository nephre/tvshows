$(function() {
    $('button.editShow').click(function() {
        var url = $(this).attr('data-url');
        location.href = url;
    });
});
