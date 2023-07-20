$(document).ready(function(){
  /* Trigger when indiual project attribute is checked */
  var all_selected_filter = [];
  if ($('.project-posts-container').length) {
    project_list_refresh(all_selected_filter.toString(), 0);
  }
  $(document).on('click', '.project-attribute-input', function(e) {
    var option_value = $(this).data('value');

    if ($(this).is(':checked')) {
      $(this).parents('.mn-custom-checkbox').addClass('active');
      if ($.inArray(option_value,all_selected_filter) == -1) {
        register_vars.current_page = 1;
        all_selected_filter.push(option_value);
      }
    } else {
      $(this).parents('.mn-custom-checkbox').removeClass('active');
      if ($.inArray(option_value,all_selected_filter) != -1) {
        $('.fo_'+option_value).remove();
        register_vars.current_page = 1;
        all_selected_filter = $.grep(all_selected_filter, function(value) {
          return value != option_value;
        });
      }
    }
    $('.project-posts-container').html('');
    project_list_refresh(all_selected_filter, 0);
  });

  /**
   * Ajax function to refresh lisf of gallery item
   * @return void
   */
  function project_list_refresh(data_query, loadmore) {
    $.ajax({
      url: register_vars.ajax_url,
      type: 'post',
      data: {
        page: register_vars.current_page,
        action: register_vars.project_list_refresh,
        loadmore: loadmore,
        project_option: JSON.stringify(data_query),
      },
      success: function(response) {
        var $response = $(response);
        register_vars.current_page++;
        $('.project-load-more').prop('disabled', false);
        $('.project-posts-container').append($response).masonry('appended', $response);
        $('.project-posts-container').imagesLoaded().progress(function() {
          $('.project-posts-container').masonry('layout');
        });
        
        var max_page = $('.project-post').last().data('maxpage');

        if (register_vars.current_page > max_page) {
          $('.project-load-more').prop('disabled', true);
          $('.section-project-list__load-more').hide();
        } else {
          $('.project-load-more').prop('disabled', false);
          $('.section-project-list__load-more').show();
        }
      }
    });
  }
  /* End of function */

  /* Triggered when Load More Button is clicked */
  $(document).on('click', '.project-load-more', function(e) {
    e.preventDefault();
    project_list_refresh(all_selected_filter.toString(), 1);
  });
  /* End of function */

  /* Triggered when clear all is clicked */
  $(document).on('click', '.project-filter-clear', function(e) {
    e.preventDefault();
    $('.project-filter-list').empty();
    $('.project-attribute-input').prop('checked', false);
    $('.project-attribute-label').removeClass('active');
    $('.section-product__sidebar-title').addClass('collapsed');
    $('.section-product__sidebar-acc-content').removeClass('show');
    $('.project-posts-container').html('');
    register_vars.current_page = 1;
    all_selected_filter.length = 0;
    project_list_refresh('', 0);
  });
  /* End of function */

  /* function to remove array index by value */
  Array.prototype.remove = function() {
    var what, a = arguments,
      L = a.length,
      ax;
    while (L && this.length) {
      what = a[--L];
      while ((ax = this.indexOf(what)) !== -1) {
        this.splice(ax, 1);
      }
    }
    return this;
  };
  /* End of function */
  if ($('.project-load-more').length) {
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > ($('.project-load-more').offset().top) - $(window).height()) {
        setTimeout(function() {
          $('.project-load-more').trigger('click');
          $('.project-load-more').prop('disabled', true);
        }, 1500);
      }
    }).scroll();
  }

  /* Gallery Image Popup JS */
  $('.section-gallery .mn-project-pop-btn').magnificPopup({
    type: 'image',
    mainClass: 'mfp-img-mobile',
    gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    }
  });
  /* End of Gallery Image Popup JS */

});