$(function() {
    $('a.deleteShow').click(function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var userConfig = {
            captionOk: 'Yes',
            captionCancel: 'No',
            title: 'Confirmation',
            onOk: function() {
                location.href = url;
            }
        };
        var cd = new ConfirmationDialog('Really delete this show?', userConfig);
        cd.show();
    })
});
