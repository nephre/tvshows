$(function() {
    $('button#cancel').click(function(e) {
        e.preventDefault();
        location.href = $(this).attr('data-url');
    });
});
