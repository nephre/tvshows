$(function() {
    var globalUrl;

    $('a.deleteShow').click(function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var title = $(this).closest('tr').find('td:eq(1)').text();
        globalUrl = url;

        $('span#confirmShowName').html(title);
        $('#confirmationModal').modal('show');
    });

    $('a.searchShow').click(function(e) {
        e.preventDefault();
        var provider = $('#searchProvider').val();
        var url = $(this).attr('href') + provider;

        location.href = url;
    });

    $('div#confirmationModal').modal({
        show: false
    });

    $('#buttonYes').click(function() {
        location.href = globalUrl;
    })
});
