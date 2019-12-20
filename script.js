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


window.onload = function(){
    document.getElementById("checkbox").onclick = function(){
        if (this.checked) {
            document.getElementById("pw").style.display = "block";
            document.getElementById("pwlabel").style.display = "block";
        }else{
            document.getElementById("pw").style.display = "none";
            document.getElementById("pwlabel").style.display = "none";
        }
    }
}
