$(document).ready(function(){
    $('.container2').slick({
        autoplay: true,
        autoplaySpeed: 5000,
        slidesToShow: 5,
        infinite: true,
        centerMode: true,
    });
});


$('input').on('focusin', function() {
  $(this).parent().find('label').addClass('active');
});

$('input').on('focusout', function() {
  if (!this.value) {
    $(this).parent().find('label').removeClass('active');
  }
});


$(".outmes:not(:animated)").fadeIn("slow",function(){
    $(this).delay(5000).fadeOut("slow");
});
 
$(".close").click(function() {
    $(".outmes").stop().fadeOut("slow");
});   
