(function ($, root, undefined) {
  $(function () {
    "use strict";

    $(".slider-container").slick({
      dots: true,
      slidesToShow: 2,
      slidesToScroll: 1,
      draggable: true,
      arrows: true,
      autoplay: true,
      autoplaySpeed: 2000,
      responsive: [
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });

   
  });
})(jQuery, this);
