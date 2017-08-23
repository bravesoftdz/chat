$(function () {

    $('.table-request .btn-decline-user').click(function (e) {
        var userId = $(this).data('user');
        $.ajax({
            url: "request/decline",
            cache: false,
            type: "POST",
            data: {id: userId},
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    $('.request-id-' + userId).remove();
                    var tmp =$('#request-list-count');
                    tmp.text(parseInt(tmp.html()) - 1);
                }
            }
        });
        e.preventDefault();
    });

});
