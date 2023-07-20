$(document).ready(function() {
  /* Banner Animation JS */
  $('.section-hero__con-col').hover(function() {
    $('.section-hero__con-col').addClass('hover-off');
    $(this).removeClass('hover-off');
    $(this).addClass('hover-on');
    var tabID = $(this).data('content');
    $('.section-hero__col').each(function() {
      var bgID = $(this).data('bg');
      if (bgID == tabID) {
        $(this).addClass('active');
        var bg_link = $(this).data('bgsrc');
        $(this).css('background-image', 'url(' + bg_link + ')');
      }
    });
  }, function() {
    $('.section-hero__con-col').removeClass('hover-off');
    $(this).removeClass('hover-on');
    $('.section-hero__col').removeClass('active');
    $('.section-hero__col').css('background-image', 'none');
  });
  $('.section-hero__col').mouseleave(function() {
    var colObj = this;
    setTimeout(function() {
      $(colObj).removeClass('active');
    }, 490);
  });
  /* End of Banner Animation JS */

  /* Video Popup JS */
  $('.mn-video-pop-btn').magnificPopup({
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false
  });
  /* End of Video Popup JS */

  /* Testimonial Slider */
  $('.section-testimonial__slider').slick({
    arrows: false,
    autoplay: true,
    autoplaySpeed: 4000,
    dots: true,
  });
  /* End Testimonial Slider */

  /* Client Slider */
  $('.section-testimonial__client-slider').slick({
    infinite: true,
    margin: 0,
    nav: false,
    dots: false,
    slidesToShow: 7,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 5,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 3,
        }
      },
      {
        breakpoint: 400,
        settings: {
          slidesToShow: 2,
        }
      },
    ]
  });
  /* End Client Slider */
});