$(document).ready(function () {
  $("#close-sidebar").click(function() {
    $('#menu-mobile').removeClass('open');
    $('#bg_header').removeClass('bg_header');
    $("#menu-mobile").stop().css("left", "0").animate({
      left: "-=100%"
        }, 500);
    event.stopPropagation();
  });
  $("#open-menu").click(function() {

    $('#menu-mobile').addClass('open');
    $('#bg_header').addClass('bg_header');
    $("#menu-mobile").stop().animate({
      left: "0%"
        }, 500);
    event.stopPropagation();
  });
});
$('#bg_header').not("#menu-mobile").click(function(e) {
  if ($('#menu-mobile').hasClass('open') && !$(event.target).is('#menu-mobile')) {
    $('#menu-mobile').removeClass('open');
    $('#bg_header').removeClass('bg_header');
    $("#menu-mobile").stop().css("left", "0").animate({
      left: "-=100%"
        }, 500);
    event.stopPropagation();
  }
});
$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 20,
    nav: true,
    navText: [
      "<i class='fa fa-caret-left'></i>",
      "<i class='fa fa-caret-right'></i>"
    ],
    autoplay: true,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 3
      },
      1000: {
        items: 4
      }
    }
  })