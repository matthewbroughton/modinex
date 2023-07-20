$(document).ready(function() {
  /* Project Details Option JS */
  var default_product_image = $('.section-des__sidebar-img').data('default-img');
  var options = {};

  $('.section-des__sidebar-img img').attr('src', default_product_image);
  $('.section-des__sidebar-img').css('filter', 'blur(5px)');

  show_email_specs_on_load('', '', true , '');

  var all_selected_filter = [];

  $('.section-des__option-list-item').click(function() {
    var noSelect = false;
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      noSelect = true;
    } else {
      if (! $(this).hasClass('option-disabled')) {
        $(this).parents('.section-des__option-list').children('.section-des__option-list-item').removeClass('active');
        $(this).addClass('active');
      }
    }

    price_update();

    var next_section = $(this).parent().parent().next();
    //If not the last option, scroll to the next section
    if (next_section.length && ! $(this).hasClass('option-disabled')) {
      $(this).parent().parent().nextAll().find('.section-des__option-list').children('.section-des__option-list-item').removeClass('active');
      if (noSelect) {
        $(this).parent().parent().nextAll().find('.section-des__option-list').children('.section-des__option-list-item').addClass('option-disabled');
      } else {
        $(this).parent().parent().next().nextAll().find('.section-des__option-list').children('.section-des__option-list-item').addClass('option-disabled');
        $('html,body').animate({
          scrollTop: $(next_section).offset().top - 80
        }, 1000);
      }
    }

    var callAjax = false;
    if (! $(this).hasClass('option-disabled') && ! noSelect) {
      callAjax = true;
    }

    //Add selected value to option table
    var opKey = $(this).parent().data('option-key');
    var nextType = next_section.data('option-type');
    show_email_specs_on_load(nextType, opKey, callAjax, 'click');

  });
  /* End of Project Details option JS */

  /* Project Details Page Fixed Nav and Footer Spacing JS */
  $('.section-project-bottom-nav a.nav-link').on('click', function(e) {
    var nlink = $(this).attr('href');
    $('.nav-link').removeClass('active');
    $(this).addClass('active');
    $('html, body').animate({
      scrollTop: $(nlink).offset().top
    }, 300);
    e.preventDefault();
  });
  var fixNavHeight = $('body').find('.section-project-bottom-nav').innerHeight();
  if (fixNavHeight > 0) {
    $('.footer').css('margin-bottom', fixNavHeight);
  }
  /* End of Project Details Page Fixed Nav and Footer Spacing JS */

  /* Project Details Side Form JS */
  $('.section-project-bottom-nav__btn-form').on('click', function (e) {
    e.preventDefault();
    var btnData = $(this).data('btn');
    switch (btnData) {
      case 'sample-form':
        $('body').addClass('mn-form-side--sample');
        break;
      case 'quote-form':
        $('body').addClass('mn-form-side--quote');
        break;
      case 'emailSpecs-form':
        $('body').addClass('mn-form-side--emailSpecs');
        break;
    }
    $('body').addClass('mn-form-side');
    let html = '';
    options = {};
    $('.section-des__option-list').each(function() {
      let optionHtml = '';
      let hasActive = 0;
      $(this).find('.section-des__option-list-item').each(function() {
        if (! $(this).hasClass('option-disabled')) {
          let option_value = $(this).find('.section-des__option-list-title').text();
          if ($(this).hasClass('active')) {
            hasActive = 1;
            optionHtml += '<option value="' + option_value + '" selected>' + option_value + '</option>';
          } else {
            optionHtml += '<option value="' + option_value + '">' + option_value + '</option>';
          }
        }
      });
      if (hasActive) {
        let option_type = $(this).find('.section-des__option-list-item.active').parent().parent().data('option-type');
        let option_value = $(this).find('.section-des__option-list-item.active').text();

        //Unique class name for each option
        let row_class = 'ot_' + option_type.replace(/\s/g, '').toLowerCase();

        //Update value if exists, or append new value
        html += '<tr class="' + row_class + '">\
          <td class="ot_title">' + option_type + '</td>\
          <td class="ot_value"><select class="mn-ot__value-options">' + optionHtml + '</select></td>\
        </tr>';
        //Unique class name for each option
        options['product'] = 'Product: ' + $('.section-des__intro .mn-title--big').text().trim() + '\n';
        options[row_class] = option_type + ': ' + option_value.trim() + '\n';
        let options_array = Object.values(options).toString().replace(/,/g, '');
        $('.formSelectedOptions').val(options_array);
      }
    });
    $('.section-side-form--quote .selected_options_table tbody').html(html);
    $('.section-side-form--sample .selected_options_table tbody').html(html);

    // add email
    if ($('#product_attachment_1').length) {
      $('#emailAttachment1').val($('#product_attachment_1').val());
    }
    if ($('#product_attachment_2').length) {
      $('#emailAttachment2').val($('#product_attachment_2').val());
    }
  });

  var productHashButtons = window.location.hash;

  if (typeof $('.section-project-bottom-nav__btn-form').data('btn') !== 'undefined' && productHashButtons != '') {
    $('.section-project-bottom-nav__btn-form[data-btn=' + productHashButtons.slice(1) + ']').trigger('click');
  }

  function sideFormClose() {
    $('body').removeClass('mn-form-side mn-form-side--sample mn-form-side--quote mn-form-side--emailSpecs');
  }
  $('.section-side-form__close,.section-side-form-overlay').click(function (e) {
    sideFormClose();

    let hash = window.location.hash;
    let href = window.location.href;
    let newHref = href.replace('/' + hash, '');
    window.history.pushState(null, null, newHref);
  });
  $(document).on('click', '.section-side-form__response-close', function (e) {
    sideFormClose();
  });

  $(document).on('wpcf7mailsent', function(event) {
    sideFormClose();
  });

  $('.quoteProductName').val($('.section-des__intro .mn-title--big').text().trim()).attr('disabled', 'disabled');
  /* End of Project Details Side Form JS */


  /* Function to update price on product option selection */
  function price_update()
  {
    var original_price = parseFloat($('.product_price').data('original-price'));
    var total_price_change = 0;

    $('.section-des__option-list-item.active').each(function() {
      var price_change = parseFloat($(this).data('price-change'));
      if (!isNaN(price_change)) {
        total_price_change += parseFloat($(this).data('price-change'));
      }
    });
    $('.price_amount').text(parseFloat(original_price + total_price_change));
  }
  /* End of function */

  /* Assign $_GET value to filtered product category */
  $('.section-product__sidebar-filter-content-list-item').each(function(){
    all_selected_filter.push($(this).data('selected-cat'));
  });

  /* Selected product filter */
  $('.product__filter__option .mn-custom-checkbox .form-check-input').on('change', function() {
    var option_value = $(this).data('value');
    if ($(this).is(':checked')) {
      $(this).parents('.mn-custom-checkbox').addClass('active');
      if ($.inArray(option_value,all_selected_filter) == -1) {
        $('.section-product__sidebar-filter-content-list').append('\
          <li class="section-product__sidebar-filter-content-list-item list-inline-item fo_' + option_value + '">\
              <a href="javascript:void(0);" class="d-flex align-items-center product-remove-cat" data-id="' + option_value + '">\
                <img src="' + register_vars.themeUrl + '/assets/dist/img/menu-white.png" alt="" class="img-fluid">\
                    <span>' + $(this).parent().text() + '</span>\
              </a>\
          </li>');
        register_vars.current_page = 0;
        all_selected_filter.push(option_value);
      }
    } else {
      $(this).parents('.mn-custom-checkbox').removeClass('active');
      if ($.inArray(option_value,all_selected_filter) != -1) {
        $('.fo_' + option_value).remove();
        all_selected_filter = $.grep(all_selected_filter, function(value) {
          return value != option_value;
        });
      }
    }
    $('.product-list-container').fadeOut(100, function() {
      $(this).html('');
    });
    register_vars.current_page = 1;
    product_list_refresh(all_selected_filter.toString());
  });
  $('.product-filter-clear').on('click', function(e) {
    e.preventDefault();
    if (all_selected_filter.length) {
      all_selected_filter.length = 0;
      $('.section-product__sidebar-filter-content-list').html('');
      $('.section-product__sidebar-title').addClass('collapsed');
      $('.section-product__sidebar-acc-content').removeClass('show');
      $('.mn-custom-checkbox').removeClass('active');
      $('.form-check-input').prop('checked', false);
      register_vars.current_page = 1;
      $('.product-list-container').fadeOut(100, function() {
        $(this).html('');
      });
      product_list_refresh(all_selected_filter.toString());
    }
  });
  /* End of CheckBox JS */

  /**
   * Ajax function to refresh lisf of products
   * @return void
   */
  function product_list_refresh(data_query) {
    $.ajax({
      url: register_vars.ajax_url,
      type: 'post',
      data: {
        page: register_vars.current_page,
        action: register_vars.product_list_refresh,
        product_option: data_query,
      },
      success: function(response) {
        $('.product-list-container').fadeIn(200, function() {
          $(this).append(response);
          if ($(document).find('#product_pagemax').data('maxpage') == undefined) {
            $('.section-product-list__load-more').hide();
          }
          let max_page = $(document).find('#product_pagemax').data('maxpage');
          if (register_vars.current_page >= max_page) {
            $('.section-product-list__load-more').hide();
          } else {
            $('.section-product-list__load-more').show();
          }
        });
      }
    });
  }

  /* Set up sticky sidebar */
  var screenWidth = $(window).width();
  if (screenWidth > 767) {
    $('.section-des__sticky').stickySidebar({
      topSpacing: 60,
      resizeSensor: true
    });
  }

  /* Carousel for testimonial slider */
  $('.section-review__slider-wrap').slick({
    arrows: false,
    dots: true
  });

  /* Make product price bar fixed on top on mobile */
  $(window).on('scroll', function(){
    if ($(window).scrollTop() >= 600){
      $('.section-des__sidebar-title').addClass('fixed_scroll');
    } else {
      $('.section-des__sidebar-title').removeClass('fixed_scroll');
    }
  });

  setTimeout(()=> {
    if ($('.product-list-container').length) {
      register_vars.current_page = 1;
    }
  }, 500);

  if ($('.product-load-more').length) {
    $(window).on('scroll', function() {
      if($(window).scrollTop() > ($('.product-load-more').offset().top) - $(window).height()) {
        if ($('.product-load-more').is(':visible')) {
          $('.product-load-more').trigger('click');
          $('.section-product-list__load-more').hide();
        }
      }
    });

    /* Triggered when Load More Button is clicked */
    $(document).on('click', '.product-load-more', function(e) {
      e.preventDefault();
      let max_page = $(document).find('#product_pagemax').data('maxpage');
      if (register_vars.current_page <= max_page) {
        register_vars.current_page++;
        product_list_refresh(all_selected_filter.toString());
        $('.section-product-list__load-more').show();
      }
    });

  }

  function getUrlParameter(sParam) {
    let sPageURL = window.location.search.substring(1),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;
    for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');
      if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
      }
    }
    return false;
  };

  /* Function to show email spec and disable options */
  function show_email_specs_on_load(nextType, opKey, callAjax, callType) {
    var optionsArr = {};
    var postId = $('.get_options_product_id').val();
    var html = '';

    let choices = [];
    if ($('#page-permalink').length > 0) {
      let pageUrl = window.location.href;
      if (pageUrl.indexOf('profile_option') != -1) {
        choices.push(decodeURIComponent(getUrlParameter('profile_option')).replace(/\/$/, ''));
      }
      if (pageUrl.indexOf('batten_spacing') != -1) {
        choices.push(decodeURIComponent(getUrlParameter('batten_spacing')).replace(/\/$/, ''));
      }
      if (pageUrl.indexOf('channel_width') != -1) {
        choices.push(decodeURIComponent(getUrlParameter('channel_width')).replace(/\/$/, ''));
      }
      if (pageUrl.indexOf('material') != -1) {
        choices.push(decodeURIComponent(getUrlParameter('material')).replace(/\/$/, ''));
      }
      if (pageUrl.indexOf('colour') != -1) {
        choices.push(decodeURIComponent(getUrlParameter('colour')).replace(/\/$/, ''));
      }
    }
    let all_selected_filter = [];
    $('.section-product__sidebar-filter-content-list-item').each(function(){
      all_selected_filter.push($(this).data('selected-cat'));
    });
    product_list_refresh(all_selected_filter.toString());

    $('.section-des__option-list-item').each(function() {
      var option_type = $(this).parent().parent().data('option-type');
      var option_value = $(this).find('.section-des__option-list-title').text();

      if (choices.length != 0 && callType == '') {
        if($.inArray($(this).data('option-value'), choices) != -1) {
          $(this).addClass('active');
          $(this).removeClass('option-disabled');
        } else {
          $(this).removeClass('active');
        }
      }

      //Add selected value to option table
      if ($(this).hasClass('active')) {
        optionsArr[option_type] = $(this).data('option-value');
        //Unique class name for each option
        var row_class = 'ot_' + option_type.replace(/\s/g, '').toLowerCase();

        //Update value if exists, or append new value
        html += '<tr class="' + row_class + '">\
          <td class="ot_title">' + option_type + '</td>\
          <td class="ot_value">' + option_value + '</td>\
        </tr>';
        options[row_class] = option_type + ': ' + option_value.trim() + '\n';

        //Check if any option has been selected
        var has_selected = 0;
        $('.section-des__option-list-item').each(function() {
          if ($(this).hasClass('active')) {
            has_selected = 1;
          }
        });

        //Display Email Me Specs button when option selected
        if (has_selected == 1) {
          $('.emailSpecs-form').removeClass('btn--hide');
        } else {
          $('.emailSpecs-form').addClass('btn--hide');
        }
      }
      if (optionsArr[optionTypeTransform(option_type)] == '' || optionsArr[optionTypeTransform(option_type)] == undefined) {
        optionsArr[optionTypeTransform(option_type)] = '';
      }
    });

    let productName = $('.section-des__intro .mn-title--big').text().trim();
    let tHead = '<tr><th>' + productName + '</th></tr>';
    $('.selected_options_table thead').html(tHead);
    $('.selected_options_table tbody').html(html);
    options['product'] = 'Product: ' + productName + '\n';
    var options_array = Object.values(options).toString().replace(/,/g, '');
    $('.formSelectedOptions').val(options_array);

    if (callAjax) {
      if ($('#page-permalink').length > 0) {
        let baseUrl = $('#page-permalink').val();

        let choices = '';
        $.each(optionsArr, function (key, value) {
          if (value != '') {
            choices += key + '=' + encodeURIComponent(value) + '&';
          }
        });
        let newChoices = choices.slice(0, -1);
        let hash = window.location.hash;
        if (hash != '') {
          newChoices = newChoices + '/' + hash;
        }
        window.history.pushState(null, null, baseUrl + '?' + newChoices);
      }
      $.ajax({
        url: register_vars.ajax_url,
        type: 'post',
        dataType :'json',
        data: {
          action: 'product_variation_image_upload',
          postId: postId,
          nextType: nextType,
          opKey: opKey,
          options: optionsArr,
          nonce: register_vars.klyp_generate_nonce
        },
        success: function(response) {
          if (response.image != '' && response.image != null) {
            $('.section-des__sidebar-img img').attr('src', response.image);
            $('.section-des__sidebar-img').css('filter', 'none');
            $('.selectedOptionImage').val(response.image);
          } else {
            $('.section-des__sidebar-img img').attr('src', default_product_image);
            $('.section-des__sidebar-img').css('filter', 'blur(5px)');
            $('.selectedOptionImage').val(default_product_image);
          }
          var next = response.nextValues;
          // During dependencies selection, the image value will be blank
          // Disable the product option that is not belong to the selected dependencies
          if (response.image == '') {
            $('.section-des__option-list-item').each(function() {
              var $this = $(this);
              if ($this.parent().data('option-key') == (opKey + 1)) {
                if (! $this.hasClass('option-disabled')) {
                  $this.addClass('option-disabled');
                }
                for (var i in next) {
                  if ($this.data('option-value') == next[i]) {
                    $this.removeClass('option-disabled');
                  }
                }
              }
            });
          }
        }
      });
    }
  }

  $(document).on('click', '.section-project-bottom-nav__btn-form', function () {
    let btnData = $(this).data('btn');
    let hash = window.location.hash;
    let href = window.location.href;
    if (btnData != '')
      if (hash == '') {
        window.history.pushState(null, null, href + '/#' + btnData);
      } else {
        let newHref = href.replace(hash, '');
        window.history.pushState(null, null, newHref + '/#' + btnData);
      }
  });

  $(document).on('change', '.mn-ot__value-options', function() {
    let selected_option_type_class = $(this).closest('tr').attr('class');
    let selected_val = $(this).val();
    options = {};
    $('.section-des__option-list-item').each(function() {
      let option_type = $(this).parent().parent().data('option-type');
      //Add selected value to option table
      if ($(this).hasClass('active') && !$(this).hasClass('option-disabled')) {
        let option_value = $(this).find('.section-des__option-list-title').text();
        //Unique class name for each option
        let row_class = 'ot_' + option_type.replace(/\s/g, '').toLowerCase();
        options['product'] = 'Product: ' + $('.section-des__intro .mn-title--big').text().trim() + '\n';
        if (row_class == selected_option_type_class) {
          options[row_class] = option_type + ': ' + selected_val.trim() + '\n';
        } else {
          options[row_class] = option_type + ': ' + option_value.trim() + '\n';
        }
        let options_array = Object.values(options).toString().replace(/,/g, '');
        $('.formSelectedOptions').val(options_array);
      }
    });
  });

  /* Function to transform the option values */
  function optionTypeTransform(type) {
    var tType = '';
    tType = type.trim();
    tType = tType.toLowerCase();
    tType = tType.replace(' ', '_');
    return tType;
  }

  $(document).on('click', '.product-remove-cat', function(e) {
    let catId = $(this).data('id');
    $('.mn-custom-checkbox').each(function() {
      let checkbox = $(this).find(':checkbox');
      if (checkbox.data('value') == catId) {
        $(this).find(':checkbox').click();
      }
    });
  });
  /* Gallery Image Popup JS */
  $('.section-gallery .mn-product-pop-btn').magnificPopup({
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