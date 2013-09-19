$(function() {
    $('button.editShow').click(function() {
        var url = $(this).attr('data-url');
        location.href = url;
    });

    $('button.deleteShow').click(function() {
        var url = $(this).attr('data-url');
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

