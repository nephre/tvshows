$(function() {
    $('a.deleteShow').click(function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var title = $(this).closest('tr').find('td:eq(1)').text();
        var userConfig = {
            captionOk: 'Yes',
            captionCancel: 'No',
            title: 'Confirmation',
            onOk: function() {
                location.href = url;
            }
        };
        var cd = new ConfirmationDialog('Really delete "' + title +'"?', userConfig);
        cd.show();
    });

    $('a.searchShow').click(function(e) {
        e.preventDefault();
        var provider = $('#searchProvider').val();
        var url = $(this).attr('href') + provider;

        location.href = url;
    });
});
