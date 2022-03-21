/*dropdown2 Menu*/
$('.dropdown2').click(function () {
    $(this).attr('tabindex', 1).focus();
    $(this).toggleClass('active');
    $(this).find('.dropdown2-menu').slideToggle(300);
});
$('.dropdown2').focusout(function () {
    $(this).removeClass('active');
    $(this).find('.dropdown2-menu').slideUp(300);
});
$('.dropdown2 .dropdown2-menu li').click(function () {
    $(this).parents('.dropdown2').find('span').text($(this).text());
    $(this).parents('.dropdown2').find('input').attr('value', $(this).attr('id'));
});
/*End dropdown2 Menu*/


$('.dropdown2-menu li').click(function () {
var input = '<strong>' + $(this).parents('.dropdown2').find('input').val() + '</strong>',
  msg = '<span class="msg">Hidden input value: ';
$('.msg').html(msg + input + '</span>');
}); 