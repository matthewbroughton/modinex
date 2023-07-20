$(document).ready(function() {
  if ($('.section-gallery-page').length) {
    register_vars.current_page = 2;
    /* Triggered when Load More Button is clicked */
    let all_selected_filter = [];
    
    $('.section-gallery-page__form-check .mn-custom-checkbox .form-check-input').change(function() {
      let option_value = $(this).val();
      register_vars.current_page = 1;
      if ($(this).is(':checked')) {
        if ($.inArray(option_value, all_selected_filter) == -1) {
          all_selected_filter.push(option_value);
        }
      } else {
        if ($.inArray(option_value, all_selected_filter) != -1) {
          all_selected_filter = $.grep(all_selected_filter, function(value) {
            return value != option_value;
          });
        }
      }
      $('.gallery-list-container').html('');
      gallery_refresh(all_selected_filter.toString());
    });

    $('.gallery__tab-clearall .gallery-filter-clear').on('click', function(e) {
      e.preventDefault();
      all_selected_filter.length = 0;
      $('.gallery-list-container').html('');
      $('.mn-custom-checkbox').removeClass('active');
      $('.form-check-input').prop('checked', false);
      register_vars.current_page = 1;
      gallery_refresh('');
    });
    
    $(document).on('click', '.gallery-load-more', function(e) {
      e.preventDefault();
      let max_page = $('.section-gallery-list__masonry-item').last().data('maxpage');
      if (register_vars.current_page <= max_page) {
        gallery_refresh(all_selected_filter.toString());
      } else {
        $('.section-gallery-list__load-more').hide();
      }
    });
    
    /**
    * Ajax function to refresh lisf of gallery item
    * @returns void
    */
    function gallery_refresh(data_query) {
      $.ajax({
        url: register_vars.ajax_url,
        type: 'post',
        data: {
          page: register_vars.current_page,
          action: register_vars.gallery_refresh,
          gallery_option: data_query,
        },
        success: function(response) {
          let $response = $(response);
          $('.gallery-load-more').prop('disabled', false);
          if (response == '') {
            register_vars.current_page = 1;
            $('.gallery-list-container').html('<p class="gallery_no_result">Appears there are no results for the combination of filters you have selected. Try reducing the number of selections</p>');
            $('.section-gallery-list__load-more').hide();
          } else {
            $('.gallery_no_result').html('');
            $('.gallery-list-container').append($response).masonry('appended', $response);
            $('.gallery-list-container').imagesLoaded().progress(function() {
              $('.gallery-list-container').masonry('layout');
            });
            let max_page = $('.section-gallery-list__masonry-item').last().data('maxpage');
            if (register_vars.current_page >= max_page) {
              $('.gallery-load-more').prop('disabled', true);
              $('.section-gallery-list__load-more').hide();
            } else {
              $('.section-gallery-list__load-more').show();
              $('.gallery-load-more').prop('disabled', false);
              register_vars.current_page++;
            }
          }
        }
      });
    }
    
    if ($('.gallery-load-more').length) {
      $(window).on('scroll', function() {
        if ($(window).scrollTop() > ($('.gallery-load-more').offset().top) - $(window).height()) {
          if ($('.gallery-load-more').is(':visible')) {
            $('.gallery-load-more').trigger('click');
            $('.gallery-load-more').prop('disabled', true);
          }
        }
      });
    }

    //Add lightbox for existing elements and on load more
    galleryLightbox();
    $('body').on('DOMNodeInserted', '.section-gallery-list__masonry-item', function(e) {
      galleryLightbox();
    });
  }

  /* Gallery Image Popup JS */
  function galleryLightbox() {
    $('.section-gallery-list__masonry-item ').magnificPopup({
      type: 'image',
      delegate: '.mn-product-pop-btn',
      mainClass: 'mfp-img-mobile',
      gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
      }
    });
    /* End of Gallery Image Popup JS */
  }
});