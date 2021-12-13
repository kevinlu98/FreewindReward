$(function () {
    $('.reward-cover').on('click',function () {
        $(this).fadeOut()
    })

    $(".reward-bg").on('click',function (event){
        event.stopPropagation()
    })

    $(".reward-btn-group a").on('click',function () {
        $('.reward-btn-group a').removeClass('current')
        $(this).addClass('current');
        let img = $(this).data('target');
        $(".reward-img img").fadeOut();
        $(`#${img}`).fadeIn()
    })

    $("#close-btn").on('click',function () {
        $('.reward-cover').fadeOut()
    })
})