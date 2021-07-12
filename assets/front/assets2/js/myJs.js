/*select-dropdown Menu*/
$('.select-dropdown').click(function () {
    $(this).attr('tabindex', 1).focus();
    $(this).toggleClass('active');
    $(this).find('.select-dropdown-menu').slideToggle(300);
});
$('.select-dropdown').focusout(function () {
    $(this).removeClass('active');
    $(this).find('.select-dropdown-menu').slideUp(300);
});
$('.select-dropdown .select-dropdown-menu li').click(function () {
    $(this).parents('.select-dropdown').find('span').text($(this).text());
    $(this).parents('.select-dropdown').find('input').attr('value', $(this).attr('id'));
});
/*End select-dropdown Menu*/


$('.select-dropdown-menu li').click(function () {
var input = '<strong>' + $(this).parents('.select-dropdown').find('input').val() + '</strong>',
  msg = '<span class="msg">Hidden input value: ';
$('.msg').html(msg + input + '</span>');
}); 