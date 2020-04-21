$( function() {
    $('.table-hover > tbody > tr[data-href]').click( function () {
        window.location = $(this).data('href');
    });
});
