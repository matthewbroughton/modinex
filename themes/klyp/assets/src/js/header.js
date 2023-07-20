$(document).ready(function() {
  /* Navigation  JS */
  $('.mn-header__toggle').on('click', function (e) {
    e.preventDefault();
    $('body').toggleClass('mega-menu-open');
    $(this).toggleClass('mn-header__toggle-close');
  });
  headerClass();
  
  /* Assign class and background image based on window width */
  function headerClass() 
  {
    var curWidth = $(window).width();
    if (curWidth < 992) {
      $('.mn-header').addClass('mn-header--white');
      $('.section-hero__con-col').each(function () {
        var mobBg = $(this).data('mobilebg');
        $(this).css('background-image', 'url(' + mobBg + ')');
      });
    }
    else {
      $('.mn-header').removeClass('mn-header--white');
      $('.section-hero__con-col').css('background-image', 'none');
    }
  }
  /* End of function */
  $(window).resize(function() {
    headerClass();
  });

  //Toggle search window
  $('.mn-header__search').on('click', function (e) {
    e.preventDefault();
    $('body').toggleClass('search-open');
    setTimeout(function() {
      $(document).find('.mn-header__search-box').focus();
    }, '800');
    $(this).parents('.mn-header--home').toggleClass('mn-header--white');
    $('.mn-header__search-close').hide();
    
    if ($('body').hasClass('search-open')) {
      $('html, body').addClass('scroll_lock');
    } else {
      $('html, body').removeClass('scroll_lock');
    }
  });
  /* End of Navigation  JS */

  /* Live Search */

  //Hide previous search when there is no result
  $('.mns__previous_search').hide();

  //Disable form submission
  $('.mn-header__search-form').on('submit', function(e) {
    e.preventDefault();
  });

  //Append search result and previous search query
  var searchInterval  = 1500,
      searchTimer;
  $('.mn-header__search-box').on('keyup', function(e) {
      e.preventDefault();
      $('.loading_gif').css('display', 'block');
      clearTimeout(searchTimer);

      searchTimer = setTimeout(function() {
          $('.mn-header__search-close').show();
          liveSearch();
          $('.previous_search_list').append('\
          <li class="section-product__sidebar-filter-content-list-item list-inline-item previous_search_saved">\
            <a href="#" class="d-flex align-items-center previous_search">\
              <img src="' + register_vars.themeUrl + '/assets/dist/img/menu-white.png" alt="" class="img-fluid">\
              <span class="saved_keyword">' + $('.mn-header__search-box').val() + '</span>\
            </a>\
          </li>');
      }, searchInterval);
  });

  //Trigger AJAX on previous search result click
  $('body').on('click', '.previous_search_saved', function(e) {
    e.preventDefault();
    $('.mn-header__search-box').val($(this).find('a .saved_keyword').text());
    liveSearch();
  });

  /**
   * Append search results ajax
   * @return boolean
   */
  function liveSearch()
  {
    var keyword = $('.mn-header__search-box').val();
  
    $.ajax({
      url: register_vars.ajax_url,
      type: 'post',
      data: {
        page: register_vars.current_page,
        action: register_vars.live_search,
        query: keyword,
      },
      success: function(response) {
        $('.mns__previous_search').show();
        $('.loading_gif').hide();
        $('.mn-header__search-results_list').html('');
        $('.mn-header__search-results_list').append(response);
        return true;
      }
    });
  }

  //Clear search result on close button click
  $('.mn-header__search-close').on('click', function() {
    $('.mn-header__search-box').val('');
    $('.mn-header__search-results_list').html('');
  });
  /* End of Live Search */
});