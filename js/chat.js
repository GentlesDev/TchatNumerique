// $('.chat-history').scrollTop($('.chat-history')[0].scrollHeight);
$('#history').scrollTop($('#history')[0].scrollHeight);
var scrollValue = $("#history").scrollTop();
$(document).ready(function () {
    $('#send').click(function () {
        var msg = $('#message').val();
        if ($.trim(msg) != '') {
            $.ajax({
                url: "send.php",
                method: "POST",
                data: { message: msg },
                dataType: "text",
                success: function (data) {
                    $('#message').val();
                }
            });
        }
    });

    setInterval(function () {
        $('#tchat').load(location.href + ' #tchat').fadeIn("slow");
        console.log($("#history").scrollTop());
        console.log(scrollValue);
        console.log($('#history').scroll());
    }, 100);

    setInterval(function () {
        scrollValue+=100;
    }, 30000);
});



function goDown(){
    $('#history').scrollTop($('#history')[0].scrollHeight);
}
jQuery(function () {
    $(function () {
        $(document).scroll(function () {
            if ($("#history").scrollTop() >= scrollValue + 40) {
                $('#down').css('display', 'none');
            } else{
                $("#down").css("display", "block");
            }
        });
    });
});

console.log($("#tchat").scrollTop());