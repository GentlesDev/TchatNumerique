//Getting value from "ajax.php".
function fill(Value) {
    //Assigning value to "search" div in "search.php" file.
    $('#search').val(Value);

}
$(document).ready(function () {
    //On pressing a key on "Search box" in "search.php" file. This function will be called.
    $("#search").keyup(function () {
        //Assigning search box value to javascript variable named as "name".
        var name = $('#search').val();

            //AJAX is called.
            $.ajax({
                //AJAX type is "Post".
                type: "POST",
                //Data will be sent to "ajax.php".
                url: "callToAjax.php",
                //Data, that will be sent to "ajax.php".
                data: {
                    //Assigning value of "name" into "search" variable.
                    search: name
                },
                //If result found, this funtion will be called.
                success: function (html) {
                    //Assigning result to "display" div in "search.php" file.
                    $("#display").html(html).show();
                }
            });

    });
});

function removeInfo(Val) {
    console.log("J'ai cliqué sur la div");
}

$('.regroup').on('click', function () {
    console.log($(this).children().last());
    
    $('.infos').addClass("hide");
    $(this).parent().closest('div').children().last().removeClass("hide"); 
    $(this).parent().closest('div').children().last().css("z-index", "3");
});

$('.button-close').on('click', function () {
    console.log($(this).parent().closest('div.infos'));
    $(this).parent().closest('div').addClass("hide");
    $(this).parent().closest('div').css("z-index", "0");
});

setInterval(function () {
    $('#users').load(location.href + ' #users').fadeIn("slow");
}, 100);
