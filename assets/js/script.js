$(document).ready(function() {
  $('.navbar-nav .nav-item').on('click', function() {
      $('.navbar-nav .nav-item').removeClass('active');
      $(this).addClass('active');
  });
});

$(document).ready(function(){
    // Initialize the carousel with a smoother transition
    $('#carouselFacilities').carousel({
        interval: 1000 // Adjust the interval for automatic sliding (in milliseconds)
    });

    // Handle the scaling of items during transitions
    $('#carouselFacilities').on('slide.bs.carousel', function () {
        // Reset all facility items to their original scale
        $('.facility-item').css('transform', 'scale(1)');
    });

    $('#carouselFacilities').on('slid.bs.carousel', function () {
        // Scale up the active facility item
        $('.carousel-item.active .facility-item').css('transform', 'scale(1.2)');
    });
});

