$('.unhide-offer').on('click', function(){
    $('.add-offer').css("position", "relative");
    $('.add-offer').css("right", "0");
    $('.hide-offer').removeClass('hide-p');
    $('.unhide-offer').addClass('hide-p');
});

$('.hide-offer').on('click', function () {
    $('.add-offer').css("position", "fixed");
    $('.add-offer').css("right", "-580px");
    $('.hide-offer').addClass('hide-p');
    $('.unhide-offer').removeClass('hide-p');
});