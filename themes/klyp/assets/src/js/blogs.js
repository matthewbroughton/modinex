$ = jQuery;
$(document).ready(function() {

  if ($('.blogs-load-more').length) {
    /* Triggered when Load More Button is clicked */
    $(document).on('click', '.blogs-load-more', function(e) {
      e.preventDefault();
      
      $.ajax({
        url: register_vars.ajax_url,
        type: 'post',
        data: {
          page: register_vars.current_page,
          action: register_vars.blogs_load_more,
        },
        success: function(response) {
          register_vars.current_page++;
          $('.blogs-load-more').prop('disabled', false);
          $('.blog_posts_container').append(response);
          var max_page = $('.blogs-load-more').data('maxpage');
          if (register_vars.current_page > max_page) {
            $('.blogs-load-more').prop('disabled', true);
            $('.section-blog-list__load-more').hide();
          }
        }
      });
    });
  
    $(window).on('scroll', function() {
      if ($(window).scrollTop() > ($('.blogs-load-more').offset().top) - $(window).height()) {
        setTimeout(function() {
          $('.blogs-load-more').trigger('click');
          $('.blogs-load-more').prop('disabled', true);
        }, 1500);
      }
    }).scroll();
  }

});