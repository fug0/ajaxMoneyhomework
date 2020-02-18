$(document).ready(function () {
    $('#post_button').on("click", function (e) {
        e.preventDefault();
        $.ajax(
            'php/request_ajax_data.php',
            {
                type: "POST",
                dataType: "html",
                data: $('#form').serialize(),
                success: function(data) {
                    result = $.parseJSON(data);
                    $("#result").html(result.money);
                }
            }
        );
        return false;
    });
});