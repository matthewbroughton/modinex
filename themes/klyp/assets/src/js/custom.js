$(document).ready(function() {
  // array of filter for type attributes
  var typeAttributeList = [];

  // array of filter for space attributes
  var spaceAttributeList = [];

  // array of filter for application attributes
  var applicationAttributeList = [];

  // array of filter for color attributes
  var colorAttributeList = [];

  /* Banner Animation JS */
  $('.section-hero__con-col').mouseenter(function() {
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
  });

  $('.section-hero__con-col').mouseleave(function() {
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

  /* CheckBox JS */
  $('.mn-custom-checkbox .form-check-input').change(function() {
    if ($(this).is(':checked')) {
      $(this).parents('.mn-custom-checkbox').addClass('active');
    } else {
      $(this).parents('.mn-custom-checkbox').removeClass('active');
    }
  });
  /* End of CheckBox JS */

  /* Product Category Filter JS */
  $('#toggle-filter').click(function(e) {
    e.preventDefault();
    $('#product-sidebar').toggleClass('translate-y-full');
    $(this).text($(this).text() == 'Apply' ? 'Filter' : 'Apply');
  });

  /**
   * Add sticky for product sidebar
   */
  function fixSidebar() {
    var screenSize = $(window).width();
    if (screenSize > 991) {
      $('.section-product__sidebar-wrap').stickySidebar({
        topSpacing: 60,
        resizeSensor: true
      });
    }
  }
  fixSidebar();
  /* End of Product Category Filter JS */

  var container = $('.section-product-list__masonry');
  container.imagesLoaded(function() {
    container.masonry({
      // options
      itemSelector: '.section-product-list__masonry-item',
      columnWidth: 3,
      gutterWidth: 0
    });
  });

  /* Trigered when individual attribute clear is clicled */
  $(document).on('click', '.remove-filter', function(e) {
    e.preventDefault();
    var attributeType = $(this).attr('name');
    var value = $(this).data('value');
    var ajaxurl = $('.project-posts-container').data('url');

    switch (attributeType) {
      case 'type':
        typeAttributeList.remove(value);
        break;
      case 'space':
        spaceAttributeList.remove(value);
        break;
      case 'application':
        applicationAttributeList.remove(value);
        break;
      case 'color':
        colorAttributeList.remove(value);
        break;
      default:
        break;
    }

    $.ajax({
      url: ajaxurl,
      type: 'post',
      data: {
        typeAttributeList: typeAttributeList,
        spaceAttributeList: spaceAttributeList,
        applicationAttributeList: applicationAttributeList,
        colorAttributeList: colorAttributeList,
        action: 'project_filter'
      },
      error: function(e) {
        console.log(e);
      },
      success: function(response) {
        $('.project-posts-container').empty();
        $('#' + value).prop("checked", false);
        checkRemoveLoadMore(response);
        removeAttributeFromFilter(value);
      }
    });
  });
  /* End of function */

  /* Called to hide clear all button when no attributes is in filter list */
  function removeAttributeFromFilter(value) {
    $('.list-inline-item.' + value).remove();
    if ($('.project-filter-list').children().length == 0) {
      $('.clear-all-container').hide();
    }
  }
  /* End of function */

  /* Called to show/hide Loadmore button  */
  function checkRemoveLoadMore(response) {
    $('.project-posts-container').append(response).masonry('reloadItems').masonry('layout');
    var page = $('.project-posts-container .project-post:last-child').data('page');
    var maxPageNumber = $('.project-posts-container .project-post:last-child').data('maxpage');

    if (page == maxPageNumber) {
      $('.load-more-container').hide();
    } else if (maxPageNumber > page) {
      $('.load-more-container').show();
    }
  }

  if (window.location.href.indexOf('/product-category/') > -1) {
    var pageLink = $(document).find('#products_page_link').val();
    $('.mn-custom-checkbox .form-check-input').click(function() {
      window.history.pushState(null, null, pageLink);
      $('.section-product-list__heading').html('All Products');
      $('.product-cat__banner').hide();
    });
    $('.section-product__sidebar-filter-clear').click(function() {
      window.history.pushState(null, null, pageLink);
      $('.section-product-list__heading').html('All Products');
      $('.product-cat__banner').hide();
    });
  }
  /* End of function */

  /* Announcement Bar */
  $(document).on('click', '.mn-announcement__close', function() {
    setCookie('hide-announcement', 'yes', 2);
  });

  /* Set Cookie to hide announcement */
  function setCookie(cname, cvalue, hr) {
    var expires = '';
    var date = new Date();
    date.setTime(date.getTime() + (hr * 60 * 60 * 1000));
    expires = '; expires=' + date.toUTCString();
    document.cookie = cname + '=' + (cvalue || '')  + expires + '; path=/';
    $('.mn-announcement').hide();
  }

  /* Get Cookie to hide announcement */
  function getCookie(name) {
    var nameEQ = name + '=';
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
  }

  /* check cookie */
  var CookieGet = getCookie('hide-announcement');
  if (CookieGet == 'yes') {
    $('.mn-announcement').hide();
  }

  setTimeout(()=>{
    $('.mn-announcement').hide();
  }, 3000);

  $(document).on('click', '.mn-footer__menu-item', function(e) {
    e.preventDefault();
    $(window).scrollTop(0);
    let href = $(this).find('a').attr('href');
    $('.mn-header__toggle').trigger('click');
    $('.nav_filter_step').find('a[href=' + href +']').trigger('click');
  });
});
