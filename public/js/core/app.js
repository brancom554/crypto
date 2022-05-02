/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/core/app.js ***!
  \**********************************/
/*=========================================================================================
  File Name: app.js
  Description: Template related app JS.
  ----------------------------------------------------------------------------------------
  Item Name: Bicrypto - Crypto Trading Platform
  Author: MashDiv
  Author URL: hhttp://www.themeforest.net/user/mashdiv
==========================================================================================*/
window.colors = {
  solid: {
    primary: '#7367F0',
    secondary: '#82868b',
    success: '#28C76F',
    info: '#00cfe8',
    warning: '#FF9F43',
    danger: '#EA5455',
    dark: '#4b4b4b',
    black: '#000',
    white: '#fff',
    body: '#f8f8f8'
  },
  light: {
    primary: '#7367F01a',
    secondary: '#82868b1a',
    success: '#28C76F1a',
    info: '#00cfe81a',
    warning: '#FF9F431a',
    danger: '#EA54551a',
    dark: '#4b4b4b1a'
  }
};

(function (window, document, $) {
  'use strict';

  $('.custom-data-bs-table').closest('.card').find('.card-search').append('<div class="input-group float-end"><input type="text" name="search_table" class="form-control bg-white" placeholder="Search Table"><button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button></div>');
  $('.custom-data-bs-table').closest('.card').find('.card-body').attr('style', 'padding-top:0px');
  var tr_elements = $('.custom-data-bs-table tbody tr');
  $(document).on('input', 'input[name=search_table]', function () {
    var search = $(this).val().toUpperCase();
    var match = tr_elements.filter(function (idx, elem) {
      return $(elem).text().trim().toUpperCase().indexOf(search) >= 0 ? elem : null;
    }).sort();
    var table_content = $('.custom-data-bs-table tbody');

    if (match.length == 0) {
      table_content.html('<tr><td colspan="100%" class="text-center">Data Not Found</td></tr>');
    } else {
      table_content.html(match);
    }
  });
  var img = $('.bg_img');
  img.css('background-image', function () {
    var bg = 'url(' + $(this).data('background') + ')';
    return bg;
  });
  $(function () {
    $('[data-bs-toggle="tooltip"]').tooltip();
  });

  function toggleFullScreen() {
    if (!document.fullscreenElement) {
      document.documentElement.requestFullscreen();
      $('#toggleFullScreen').removeClass('bi-aspect-ratio').addClass('bi-fullscreen-exit');
    } else {
      if (document.exitFullscreen) {
        document.exitFullscreen();
        $('#toggleFullScreen').removeClass('bi-fullscreen-exit').addClass('bi-aspect-ratio');
      }
    }
  }

  $('.fullscreen-btn').on('click', function () {
    $(this).toggleClass('active');
  });

  function proPicURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        var preview = $(input).parents('.thumb').find('.profilePicPreview');
        $(preview).css('background-image', 'url(' + e.target.result + ')');
        $(preview).addClass('has-image');
        $(preview).hide();
        $(preview).fadeIn(650);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

  $(".profilePicUpload").on('change', function () {
    proPicURL(this);
  });
  $(".remove-image").on('click', function () {
    $(this).parents(".profilePicPreview").css('background-image', 'none');
    $(this).parents(".profilePicPreview").removeClass('has-image');
    $(this).parents(".thumb").find('input[type=file]').val('');
  });
  $("form").on("change", ".file-upload-field", function () {
    $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, ''));
  });
  var $html = $('html');
  var $body = $('body');
  var $textcolor = '#4e5154';
  var assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  } // to remove sm control classes from datatables


  if ($.fn.dataTable) {
    $.extend($.fn.dataTable.ext.classes, {
      sFilterInput: 'form-control',
      sLengthSelect: 'form-select'
    });
  }

  $(window).on('load', function () {
    var rtl;
    var compactMenu = false;

    if ($body.hasClass('menu-collapsed') || localStorage.getItem('menuCollapsed') === 'true') {
      compactMenu = true;
    }

    if ($('html').data('textdirection') == 'rtl') {
      rtl = true;
    }

    setTimeout(function () {
      $html.removeClass('loading').addClass('loaded');
    }, 1200);
    $.app.menu.init(compactMenu); // Navigation configurations

    var config = {
      speed: 300 // set speed to expand / collapse menu

    };

    if ($.app.nav.initialized === false) {
      $.app.nav.init(config);
    }

    Unison.on('change', function (bp) {
      $.app.menu.change(compactMenu);
    }); // Tooltip Initialization
    // $('[data-bs-toggle="tooltip"]').tooltip({
    //   container: 'body'
    // });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    }); // Collapsible Card

    $('a[data-action="collapse"]').on('click', function (e) {
      e.preventDefault();
      $(this).closest('.card').children('.card-content').collapse('toggle');
      $(this).closest('.card').find('[data-action="collapse"]').toggleClass('rotate');
    }); // Cart dropdown touchspin

    if ($('.touchspin-cart').length > 0) {
      $('.touchspin-cart').TouchSpin({
        buttondown_class: 'btn btn-primary',
        buttonup_class: 'btn btn-primary',
        buttondown_txt: feather.icons['minus'].toSvg(),
        buttonup_txt: feather.icons['plus'].toSvg()
      });
    } // Do not close cart or notification dropdown on click of the items


    $('.dropdown-notification .dropdown-menu, .dropdown-cart .dropdown-menu').on('click', function (e) {
      e.stopPropagation();
    }); //  Notifications & messages scrollable

    $('.scrollable-container').each(function () {
      var scrollable_container = new PerfectScrollbar($(this)[0], {
        wheelPropagation: false
      });
    }); // Reload Card

    $('a[data-action="reload"]').on('click', function () {
      var block_ele = $(this).closest('.card');
      var reloadActionOverlay;

      if ($html.hasClass('dark-layout')) {
        var reloadActionOverlay = '#10163a';
      } else {
        var reloadActionOverlay = '#fff';
      } // Block Element


      block_ele.block({
        message: feather.icons['refresh-cw'].toSvg({
          "class": 'font-medium-1 spinner text-primary'
        }),
        timeout: 2000,
        //unblock after 2 seconds
        overlayCSS: {
          backgroundColor: reloadActionOverlay,
          cursor: 'wait'
        },
        css: {
          border: 0,
          padding: 0,
          backgroundColor: 'none'
        }
      });
    }); // Close Card

    $('a[data-action="close"]').on('click', function () {
      $(this).closest('.card').removeClass().slideUp('fast');
    });
    $('.card .heading-elements a[data-action="collapse"]').on('click', function () {
      var $this = $(this),
          card = $this.closest('.card');
      var cardHeight;

      if (parseInt(card[0].style.height, 10) > 0) {
        cardHeight = card.css('height');
        card.css('height', '').attr('data-height', cardHeight);
      } else {
        if (card.data('height')) {
          cardHeight = card.data('height');
          card.css('height', cardHeight).attr('data-height', '');
        }
      }
    }); // Add disabled class to input group when input is disabled

    $('input:disabled, textarea:disabled').closest('.input-group').addClass('disabled'); // Add sidebar group active class to active menu

    $('.main-menu-content').find('li.active').parents('li').addClass('sidebar-group-active'); // Add open class to parent list item if subitem is active except compact menu

    var menuType = $body.data('menu');

    if (menuType != 'horizontal-menu' && compactMenu === false) {
      $('.main-menu-content').find('li.active').parents('li').addClass('open');
    }

    if (menuType == 'horizontal-menu') {
      $('.main-menu-content').find('li.active').parents('li:not(.nav-item)').addClass('open');
      $('.main-menu-content').find('li.active').closest('li.nav-item').addClass('sidebar-group-active open'); // $(".main-menu-content")
      //   .find("li.active")
      //   .parents("li")
      //   .addClass("active");
    } //  Dynamic height for the chartjs div for the chart animations to work


    var chartjsDiv = $('.chartjs'),
        canvasHeight = chartjsDiv.children('canvas').attr('height'),
        mainMenu = $('.main-menu');
    chartjsDiv.css('height', canvasHeight);

    if ($body.hasClass('boxed-layout')) {
      if ($body.hasClass('vertical-overlay-menu')) {
        var menuWidth = mainMenu.width();
        var contentPosition = $('.app-content').position().left;
        var menuPositionAdjust = contentPosition - menuWidth;

        if ($body.hasClass('menu-flipped')) {
          mainMenu.css('right', menuPositionAdjust + 'px');
        } else {
          mainMenu.css('left', menuPositionAdjust + 'px');
        }
      }
    }
    /* Text Area Counter Set Start */


    $('.char-textarea').on('keyup', function (event) {
      checkTextAreaMaxLength(this, event); // to later change text color in dark layout

      $(this).addClass('active');
    });
    /*
    Checks the MaxLength of the Textarea
    -----------------------------------------------------
    @prerequisite:  textBox = textarea dom element
            e = textarea event
                    length = Max length of characters
    */

    function checkTextAreaMaxLength(textBox, e) {
      var maxLength = parseInt($(textBox).data('length')),
          counterValue = $('.textarea-counter-value'),
          charTextarea = $('.char-textarea');

      if (!checkSpecialKeys(e)) {
        if (textBox.value.length < maxLength - 1) textBox.value = textBox.value.substring(0, maxLength);
      }

      $('.char-count').html(textBox.value.length);

      if (textBox.value.length > maxLength) {
        counterValue.css('background-color', window.colors.solid.danger);
        charTextarea.css('color', window.colors.solid.danger); // to change text color after limit is maxedout out

        charTextarea.addClass('max-limit');
      } else {
        counterValue.css('background-color', window.colors.solid.primary);
        charTextarea.css('color', $textcolor);
        charTextarea.removeClass('max-limit');
      }

      return true;
    }
    /*
    Checks if the keyCode pressed is inside special chars
    -------------------------------------------------------
    @prerequisite:  e = e.keyCode object for the key pressed
    */


    function checkSpecialKeys(e) {
      if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40) return false;else return true;
    }

    $('.content-overlay').on('click', function () {
      $('.search-list').removeClass('show');
      var searchInput = $('.search-input-close').closest('.search-input');

      if (searchInput.hasClass('open')) {
        searchInput.removeClass('open');
        searchInputInputfield.val('');
        searchInputInputfield.blur();
        searchList.removeClass('show');
      }

      $('.app-content').removeClass('show-overlay');
      $('.bookmark-wrapper .bookmark-input').removeClass('show');
    }); // To show shadow in main menu when menu scrolls

    var container = document.getElementsByClassName('main-menu-content');

    if (container.length > 0) {
      container[0].addEventListener('ps-scroll-y', function () {
        if ($(this).find('.ps__thumb-y').position().top > 0) {
          $('.shadow-bottom').css('display', 'block');
        } else {
          $('.shadow-bottom').css('display', 'none');
        }
      });
    }
  }); // Hide overlay menu on content overlay click on small screens

  $(document).on('click', '.sidenav-overlay', function (e) {
    // Hide menu
    $.app.menu.hide();
    return false;
  }); // Execute below code only if we find hammer js for touch swipe feature on small screen

  if (typeof Hammer !== 'undefined') {
    var rtl;

    if ($('html').data('textdirection') == 'rtl') {
      rtl = true;
    } // Swipe menu gesture


    var swipeInElement = document.querySelector('.drag-target'),
        swipeInAction = 'panright',
        swipeOutAction = 'panleft';

    if (rtl === true) {
      swipeInAction = 'panleft';
      swipeOutAction = 'panright';
    }

    if ($(swipeInElement).length > 0) {
      var swipeInMenu = new Hammer(swipeInElement);
      swipeInMenu.on(swipeInAction, function (ev) {
        if ($body.hasClass('vertical-overlay-menu')) {
          $.app.menu.open();
          return false;
        }
      });
    } // menu swipe out gesture


    setTimeout(function () {
      var swipeOutElement = document.querySelector('.main-menu');
      var swipeOutMenu;

      if ($(swipeOutElement).length > 0) {
        swipeOutMenu = new Hammer(swipeOutElement);
        swipeOutMenu.get('pan').set({
          direction: Hammer.DIRECTION_ALL,
          threshold: 250
        });
        swipeOutMenu.on(swipeOutAction, function (ev) {
          if ($body.hasClass('vertical-overlay-menu')) {
            $.app.menu.hide();
            return false;
          }
        });
      }
    }, 300); // menu close on overlay tap

    var swipeOutOverlayElement = document.querySelector('.sidenav-overlay');

    if ($(swipeOutOverlayElement).length > 0) {
      var swipeOutOverlayMenu = new Hammer(swipeOutOverlayElement);
      swipeOutOverlayMenu.on('tap', function (ev) {
        if ($body.hasClass('vertical-overlay-menu')) {
          $.app.menu.hide();
          return false;
        }
      });
    }
  }

  $(document).on('click', '.menu-toggle, .modern-nav-toggle', function (e) {
    e.preventDefault(); // Toggle menu

    $.app.menu.toggle();
    setTimeout(function () {
      $(window).trigger('resize');
    }, 200);

    if ($('#collapse-sidebar-switch').length > 0) {
      setTimeout(function () {
        if ($body.hasClass('menu-expanded') || $body.hasClass('menu-open')) {
          $('#collapse-sidebar-switch').prop('checked', false);
        } else {
          $('#collapse-sidebar-switch').prop('checked', true);
        }
      }, 50);
    } // Save menu collapsed status in localstorage


    if ($body.hasClass('menu-expanded') || $body.hasClass('menu-open')) {
      localStorage.setItem('menuCollapsed', false);
    } else {
      localStorage.setItem('menuCollapsed', true);
    } // Hides dropdown on click of menu toggle
    // $('[data-bs-toggle="dropdown"]').dropdown('hide');


    return false;
  }); // Add Children Class

  $('.navigation').find('li').has('ul').addClass('has-sub'); // Update manual scroller when window is resized

  $(window).resize(function () {
    $.app.menu.manualScroller.updateHeight();
  });
  $('#sidebar-page-navigation').on('click', 'a.nav-link', function (e) {
    e.preventDefault();
    e.stopPropagation();
    var $this = $(this),
        href = $this.attr('href');
    var offset = $(href).offset();
    var scrollto = offset.top - 80; // minus fixed header height

    $('html, body').animate({
      scrollTop: scrollto
    }, 0);
    setTimeout(function () {
      $this.parent('.nav-item').siblings('.nav-item').children('.nav-link').removeClass('active');
      $this.addClass('active');
    }, 100);
  }); // main menu internationalization
  // init i18n and load language file

  if ($body.attr('data-framework') === 'laravel') {
    // change language according to data-language of dropdown item
    var language = $('html')[0].lang;

    if (language !== null) {
      // get the selected flag class
      var selectedLang = $('.dropdown-language').find('a[data-language=' + language + ']').text();
      var selectedFlag = $('.dropdown-language').find('a[data-language=' + language + '] .flag-icon').attr('class'); // set the class in button

      $('#dropdown-flag .selected-language').text(selectedLang);
      $('#dropdown-flag .flag-icon').removeClass().addClass(selectedFlag);
    }
  } else {
    i18next.use(window.i18nextXHRBackend).init({
      debug: false,
      fallbackLng: 'en',
      backend: {
        loadPath: assetPath + 'data/locales/{{lng}}.json'
      },
      returnObjects: true
    }, function (err, t) {
      // resources have been loaded
      jqueryI18next.init(i18next, $);
    }); // change language according to data-language of dropdown item

    $('.dropdown-language .dropdown-item').on('click', function () {
      var $this = $(this);
      $this.siblings('.selected').removeClass('selected');
      $this.addClass('selected');
      var selectedLang = $this.text();
      var selectedFlag = $this.find('.flag-icon').attr('class');
      $('#dropdown-flag .selected-language').text(selectedLang);
      $('#dropdown-flag .flag-icon').removeClass().addClass(selectedFlag);
      var currentLanguage = $this.data('language');
      i18next.changeLanguage(currentLanguage, function (err, t) {
        $('.main-menu, .horizontal-menu-wrapper').localize();
      });
    });
  } // Waves Effect


  Waves.init();
  Waves.attach(".btn:not([class*='btn-relief-']):not([class*='btn-gradient-']):not([class*='btn-outline-']):not([class*='btn-flat-'])", ['waves-float', 'waves-light']);
  Waves.attach("[class*='btn-outline-']");
  Waves.attach("[class*='btn-flat-']");
  $('.form-password-toggle .input-group-text').on('click', function (e) {
    e.preventDefault();
    var $this = $(this),
        inputGroupText = $this.closest('.form-password-toggle'),
        formPasswordToggleIcon = $this,
        formPasswordToggleInput = inputGroupText.find('input');

    if (formPasswordToggleInput.attr('type') === 'text') {
      formPasswordToggleInput.attr('type', 'password');

      if (feather) {
        formPasswordToggleIcon.find('svg').replaceWith(feather.icons['eye'].toSvg({
          "class": 'font-small-4'
        }));
      }
    } else if (formPasswordToggleInput.attr('type') === 'password') {
      formPasswordToggleInput.attr('type', 'text');

      if (feather) {
        formPasswordToggleIcon.find('svg').replaceWith(feather.icons['eye-off'].toSvg({
          "class": 'font-small-4'
        }));
      }
    }
  }); // on window scroll button show/hide

  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 400) {
      $('.scroll-top').fadeIn();
    } else {
      $('.scroll-top').fadeOut();
    } // On Scroll navbar color on horizontal menu


    if ($body.hasClass('navbar-static')) {
      var scroll = $(window).scrollTop();

      if (scroll > 65) {
        $('html:not(.dark-layout) .horizontal-menu .header-navbar.navbar-fixed').css({
          background: '#fff',
          'box-shadow': '0 4px 20px 0 rgba(0,0,0,.05)'
        });
        $('.horizontal-menu.dark-layout .header-navbar.navbar-fixed').css({
          background: '#161d31',
          'box-shadow': '0 4px 20px 0 rgba(0,0,0,.05)'
        });
        $('html:not(.dark-layout) .horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', '#fff');
        $('.dark-layout .horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', '#161d31');
      } else {
        $('html:not(.dark-layout) .horizontal-menu .header-navbar.navbar-fixed').css({
          background: '#f8f8f8',
          'box-shadow': 'none'
        });
        $('.dark-layout .horizontal-menu .header-navbar.navbar-fixed').css({
          background: '#161d31',
          'box-shadow': 'none'
        });
        $('html:not(.dark-layout) .horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', '#fff');
        $('.dark-layout .horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', '#161d31');
      }
    }
  }); // Click event to scroll to top

  $('.scroll-top').on('click', function () {
    $('html, body').animate({
      scrollTop: 0
    }, 75);
  });

  function getCurrentLayout() {
    var currentLayout = '';

    if ($html.hasClass('dark-layout')) {
      currentLayout = 'dark-layout';
    } else if ($html.hasClass('bordered-layout')) {
      currentLayout = 'bordered-layout';
    } else if ($html.hasClass('semi-dark-layout')) {
      currentLayout = 'semi-dark-layout';
    } else {
      currentLayout = 'light-layout';
    }

    return currentLayout;
  } // Get the data layout, for blank set to light layout


  var dataLayout = $html.attr('data-layout') ? $html.attr('data-layout') : 'light-layout'; // Navbar Dark / Light Layout Toggle Switch

  $('.nav-link-style').on('click', function () {
    var currentLayout = getCurrentLayout(),
        switchToLayout = '',
        prevLayout = localStorage.getItem(dataLayout + '-prev-skin', currentLayout); // If currentLayout is not dark layout

    if (currentLayout !== 'dark-layout') {
      // Switch to dark
      switchToLayout = 'dark-layout';
    } else {
      // Switch to light
      // switchToLayout = prevLayout ? prevLayout : 'light-layout';
      if (currentLayout === prevLayout) {
        switchToLayout = 'light-layout';
      } else {
        switchToLayout = prevLayout ? prevLayout : 'light-layout';
      }
    } // Set Previous skin in local db


    localStorage.setItem(dataLayout + '-prev-skin', currentLayout); // Set Current skin in local db

    localStorage.setItem(dataLayout + '-current-skin', switchToLayout); // Call set layout

    setLayout(switchToLayout); // ToDo: Customizer fix

    $('.horizontal-menu .header-navbar.navbar-fixed').css({
      background: 'inherit',
      'box-shadow': 'inherit'
    });
    $('.horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', 'inherit');
  }); // Get current local storage layout

  var currentLocalStorageLayout = localStorage.getItem(dataLayout + '-current-skin'); // Set layout on screen load
  //? Comment it if you don't want to sync layout with local db
  // setLayout(currentLocalStorageLayout);

  function setLayout(currentLocalStorageLayout) {
    var navLinkStyle = $('.nav-link-style'),
        currentLayout = getCurrentLayout(),
        mainMenu = $('.main-menu'),
        navbar = $('.header-navbar'),
        // Witch to local storage layout if we have else current layout
    switchToLayout = currentLocalStorageLayout ? currentLocalStorageLayout : currentLayout;
    $html.removeClass('semi-dark-layout dark-layout bordered-layout');

    if (switchToLayout === 'dark-layout') {
      $html.addClass('dark-layout');
      mainMenu.removeClass('menu-light').addClass('menu-dark');
      navbar.removeClass('navbar-light').addClass('navbar-dark');
      navLinkStyle.find('.bi-moon').replaceWith('<i class="bi bi-sun"></i>');
    } else if (switchToLayout === 'bordered-layout') {
      $html.addClass('bordered-layout');
      mainMenu.removeClass('menu-dark').addClass('menu-light');
      navbar.removeClass('navbar-dark').addClass('navbar-light');
      navLinkStyle.find('.bi-sun').replaceWith('<i class="bi bi-moon"></i>');
    } else if (switchToLayout === 'semi-dark-layout') {
      $html.addClass('semi-dark-layout');
      mainMenu.removeClass('menu-dark').addClass('menu-light');
      navbar.removeClass('navbar-dark').addClass('navbar-light');
      navLinkStyle.find('.bi-sun').replaceWith('<i class="bi bi-moon"></i>');
    } else {
      $html.addClass('light-layout');
      mainMenu.removeClass('menu-dark').addClass('menu-light');
      navbar.removeClass('navbar-dark').addClass('navbar-light');
      navLinkStyle.find('.bi-sun').replaceWith('<i class="bi bi-moon"></i>');
    } // Set radio in customizer if we have


    if ($('input:radio[data-layout=' + switchToLayout + ']').length > 0) {
      setTimeout(function () {
        $('input:radio[data-layout=' + switchToLayout + ']').prop('checked', true);
      });
    }
  }
})(window, document, jQuery); // To use feather svg icons with different sizes


function featherSVG(iconSize) {
  // Feather Icons
  if (iconSize == undefined) {
    iconSize = '14';
  }

  return feather.replace({
    width: iconSize,
    height: iconSize
  });
} // jQuery Validation Global Defaults


if (typeof jQuery.validator === 'function') {
  jQuery.validator.setDefaults({
    errorElement: 'span',
    errorPlacement: function errorPlacement(error, element) {
      if (element.parent().hasClass('input-group') || element.hasClass('select2') || element.attr('type') === 'checkbox') {
        error.insertAfter(element.parent());
      } else if (element.hasClass('form-check-input')) {
        error.insertAfter(element.parent().siblings(':last'));
      } else {
        error.insertAfter(element);
      }

      if (element.parent().hasClass('input-group')) {
        element.parent().addClass('is-invalid');
      }
    },
    highlight: function highlight(element, errorClass, validClass) {
      $(element).addClass('error');

      if ($(element).parent().hasClass('input-group')) {
        $(element).parent().addClass('is-invalid');
      }
    },
    unhighlight: function unhighlight(element, errorClass, validClass) {
      $(element).removeClass('error');

      if ($(element).parent().hasClass('input-group')) {
        $(element).parent().removeClass('is-invalid');
      }
    }
  });
} // Add validation class to input-group (input group validation fix, currently disabled but will be useful in future)

/* function inputGroupValidation(el) {
  var validEl,
    invalidEl,
    elem = $(el);

  if (elem.hasClass('form-control')) {
    if ($(elem).is('.form-control:valid, .form-control.is-valid')) {
      validEl = elem;
    }
    if ($(elem).is('.form-control:invalid, .form-control.is-invalid')) {
      invalidEl = elem;
    }
  } else {
    validEl = elem.find('.form-control:valid, .form-control.is-valid');
    invalidEl = elem.find('.form-control:invalid, .form-control.is-invalid');
  }
  if (validEl !== undefined) {
    validEl.closest('.input-group').removeClass('.is-valid is-invalid').addClass('is-valid');
  }
  if (invalidEl !== undefined) {
    invalidEl.closest('.input-group').removeClass('.is-valid is-invalid').addClass('is-invalid');
  }
} */
/******/ })()
;
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QVIsR0FBaUJqQixRQUFqQixDQUEwQixZQUExQjtBQUNEO0FBQ0YsS0FsQjBCO0FBbUIzQmtNLElBQUFBLFNBQVMsRUFBRSxtQkFBVUYsT0FBVixFQUFtQkcsVUFBbkIsRUFBK0JDLFVBQS9CLEVBQTJDO0FBQ3BEbk8sTUFBQUEsQ0FBQyxDQUFDK04sT0FBRCxDQUFELENBQVdoTSxRQUFYLENBQW9CLE9BQXBCOztBQUNBLFVBQUkvQixDQUFDLENBQUMrTixPQUFELENBQUQsQ0FBVy9LLE1BQVgsR0FBb0JlLFFBQXBCLENBQTZCLGFBQTdCLENBQUosRUFBaUQ7QUFDL0MvRCxRQUFBQSxDQUFDLENBQUMrTixPQUFELENBQUQsQ0FBVy9LLE1BQVgsR0FBb0JqQixRQUFwQixDQUE2QixZQUE3QjtBQUNEO0FBQ0YsS0F4QjBCO0FBeUIzQnFNLElBQUFBLFdBQVcsRUFBRSxxQkFBVUwsT0FBVixFQUFtQkcsVUFBbkIsRUFBK0JDLFVBQS9CLEVBQTJDO0FBQ3REbk8sTUFBQUEsQ0FBQyxDQUFDK04sT0FBRCxDQUFELENBQVdqTSxXQUFYLENBQXVCLE9BQXZCOztBQUNBLFVBQUk5QixDQUFDLENBQUMrTixPQUFELENBQUQsQ0FBVy9LLE1BQVgsR0FBb0JlLFFBQXBCLENBQTZCLGFBQTdCLENBQUosRUFBaUQ7QUFDL0MvRCxRQUFBQSxDQUFDLENBQUMrTixPQUFELENBQUQsQ0FBVy9LLE1BQVgsR0FBb0JsQixXQUFwQixDQUFnQyxZQUFoQztBQUNEO0FBQ0Y7QUE5QjBCLEdBQTdCO0FBZ0NELEVBRUQ7O0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxJIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2pzL2NvcmUvYXBwLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8qPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1cbiAgRmlsZSBOYW1lOiBhcHAuanNcbiAgRGVzY3JpcHRpb246IFRlbXBsYXRlIHJlbGF0ZWQgYXBwIEpTLlxuICAtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gIEl0ZW0gTmFtZTogQmljcnlwdG8gLSBDcnlwdG8gVHJhZGluZyBQbGF0Zm9ybVxuICBBdXRob3I6IE1hc2hEaXZcbiAgQXV0aG9yIFVSTDogaGh0dHA6Ly93d3cudGhlbWVmb3Jlc3QubmV0L3VzZXIvbWFzaGRpdlxuPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09Ki9cbndpbmRvdy5jb2xvcnMgPSB7XG4gIHNvbGlkOiB7XG4gICAgcHJpbWFyeTogJyM3MzY3RjAnLFxuICAgIHNlY29uZGFyeTogJyM4Mjg2OGInLFxuICAgIHN1Y2Nlc3M6ICcjMjhDNzZGJyxcbiAgICBpbmZvOiAnIzAwY2ZlOCcsXG4gICAgd2FybmluZzogJyNGRjlGNDMnLFxuICAgIGRhbmdlcjogJyNFQTU0NTUnLFxuICAgIGRhcms6ICcjNGI0YjRiJyxcbiAgICBibGFjazogJyMwMDAnLFxuICAgIHdoaXRlOiAnI2ZmZicsXG4gICAgYm9keTogJyNmOGY4ZjgnXG4gIH0sXG4gIGxpZ2h0OiB7XG4gICAgcHJpbWFyeTogJyM3MzY3RjAxYScsXG4gICAgc2Vjb25kYXJ5OiAnIzgyODY4YjFhJyxcbiAgICBzdWNjZXNzOiAnIzI4Qzc2RjFhJyxcbiAgICBpbmZvOiAnIzAwY2ZlODFhJyxcbiAgICB3YXJuaW5nOiAnI0ZGOUY0MzFhJyxcbiAgICBkYW5nZXI6ICcjRUE1NDU1MWEnLFxuICAgIGRhcms6ICcjNGI0YjRiMWEnXG4gIH1cbn1cbjsoZnVuY3Rpb24gKHdpbmRvdywgZG9jdW1lbnQsICQpIHtcbiAgJ3VzZSBzdHJpY3QnXG4gICQoJy5jdXN0b20tZGF0YS1icy10YWJsZScpLmNsb3Nlc3QoJy5jYXJkJykuZmluZCgnLmNhcmQtc2VhcmNoJykuYXBwZW5kKCc8ZGl2IGNsYXNzPVwiaW5wdXQtZ3JvdXAgZmxvYXQtZW5kXCI+PGlucHV0IHR5cGU9XCJ0ZXh0XCIgbmFtZT1cInNlYXJjaF90YWJsZVwiIGNsYXNzPVwiZm9ybS1jb250cm9sIGJnLXdoaXRlXCIgcGxhY2Vob2xkZXI9XCJTZWFyY2ggVGFibGVcIj48YnV0dG9uIGNsYXNzPVwiYnRuIGJ0bi1vdXRsaW5lLXByaW1hcnlcIiB0eXBlPVwic3VibWl0XCI+PGkgY2xhc3M9XCJiaSBiaS1zZWFyY2hcIj48L2k+PC9idXR0b24+PC9kaXY+Jyk7XG4kKCcuY3VzdG9tLWRhdGEtYnMtdGFibGUnKS5jbG9zZXN0KCcuY2FyZCcpLmZpbmQoJy5jYXJkLWJvZHknKS5hdHRyKCdzdHlsZScsJ3BhZGRpbmctdG9wOjBweCcpO1xudmFyIHRyX2VsZW1lbnRzID0gJCgnLmN1c3RvbS1kYXRhLWJzLXRhYmxlIHRib2R5IHRyJyk7XG4kKGRvY3VtZW50KS5vbignaW5wdXQnLCdpbnB1dFtuYW1lPXNlYXJjaF90YWJsZV0nLGZ1bmN0aW9uKCl7XG4gIHZhciBzZWFyY2ggPSAkKHRoaXMpLnZhbCgpLnRvVXBwZXJDYXNlKCk7XG4gIHZhciBtYXRjaCA9IHRyX2VsZW1lbnRzLmZpbHRlcihmdW5jdGlvbiAoaWR4LCBlbGVtKSB7XG4gICAgcmV0dXJuICQoZWxlbSkudGV4dCgpLnRyaW0oKS50b1VwcGVyQ2FzZSgpLmluZGV4T2Yoc2VhcmNoKSA+PSAwID8gZWxlbSA6IG51bGw7XG4gIH0pLnNvcnQoKTtcbiAgdmFyIHRhYmxlX2NvbnRlbnQgPSAkKCcuY3VzdG9tLWRhdGEtYnMtdGFibGUgdGJvZHknKTtcbiAgaWYgKG1hdGNoLmxlbmd0aCA9PSAwKSB7XG4gICAgdGFibGVfY29udGVudC5odG1sKCc8dHI+PHRkIGNvbHNwYW49XCIxMDAlXCIgY2xhc3M9XCJ0ZXh0LWNlbnRlclwiPkRhdGEgTm90IEZvdW5kPC90ZD48L3RyPicpO1xuICB9ZWxzZXtcbiAgICB0YWJsZV9jb250ZW50Lmh0bWwobWF0Y2gpO1xuICB9XG59KTtcblxubGV0IGltZyA9ICQoJy5iZ19pbWcnKTtcbmltZy5jc3MoJ2JhY2tncm91bmQtaW1hZ2UnLCBmdW5jdGlvbiAoKSB7XG4gIGxldCBiZyA9ICgndXJsKCcgKyAkKHRoaXMpLmRhdGEoJ2JhY2tncm91bmQnKSArICcpJyk7XG4gIHJldHVybiBiZztcbn0pO1xuXG4gICQoZnVuY3Rpb24gKCkge1xuICAgICQoJ1tkYXRhLWJzLXRvZ2dsZT1cInRvb2x0aXBcIl0nKS50b29sdGlwKClcbiAgfSlcblxuZnVuY3Rpb24gdG9nZ2xlRnVsbFNjcmVlbigpIHtcbiAgaWYgKCFkb2N1bWVudC5mdWxsc2NyZWVuRWxlbWVudCkge1xuICAgICAgZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LnJlcXVlc3RGdWxsc2NyZWVuKCk7XG4gICAgICAkKCcjdG9nZ2xlRnVsbFNjcmVlbicpXG4gICAgICAucmVtb3ZlQ2xhc3MoJ2JpLWFzcGVjdC1yYXRpbycpXG4gICAgICAuYWRkQ2xhc3MoJ2JpLWZ1bGxzY3JlZW4tZXhpdCcpO1xuICB9IGVsc2Uge1xuICAgIGlmIChkb2N1bWVudC5leGl0RnVsbHNjcmVlbikge1xuICAgICAgZG9jdW1lbnQuZXhpdEZ1bGxzY3JlZW4oKTtcbiAgICAgICQoJyN0b2dnbGVGdWxsU2NyZWVuJylcbiAgICAgIC5yZW1vdmVDbGFzcygnYmktZnVsbHNjcmVlbi1leGl0JylcbiAgICAgIC5hZGRDbGFzcygnYmktYXNwZWN0LXJhdGlvJyk7XG4gICAgfVxuICB9XG59XG5cbiQoJy5mdWxsc2NyZWVuLWJ0bicpLm9uKCdjbGljaycsIGZ1bmN0aW9uKCl7XG4gICQodGhpcykudG9nZ2xlQ2xhc3MoJ2FjdGl2ZScpO1xufSk7XG5cbmZ1bmN0aW9uIHByb1BpY1VSTChpbnB1dCkge1xuICAgIGlmIChpbnB1dC5maWxlcyAmJiBpbnB1dC5maWxlc1swXSkge1xuICAgICAgICB2YXIgcmVhZGVyID0gbmV3IEZpbGVSZWFkZXIoKTtcbiAgICAgICAgcmVhZGVyLm9ubG9hZCA9IGZ1bmN0aW9uIChlKSB7XG4gICAgICAgICAgICB2YXIgcHJldmlldyA9ICQoaW5wdXQpLnBhcmVudHMoJy50aHVtYicpLmZpbmQoJy5wcm9maWxlUGljUHJldmlldycpO1xuICAgICAgICAgICAgJChwcmV2aWV3KS5jc3MoJ2JhY2tncm91bmQtaW1hZ2UnLCAndXJsKCcgKyBlLnRhcmdldC5yZXN1bHQgKyAnKScpO1xuICAgICAgICAgICAgJChwcmV2aWV3KS5hZGRDbGFzcygnaGFzLWltYWdlJyk7XG4gICAgICAgICAgICAkKHByZXZpZXcpLmhpZGUoKTtcbiAgICAgICAgICAgICQocHJldmlldykuZmFkZUluKDY1MCk7XG4gICAgICAgIH1cbiAgICAgICAgcmVhZGVyLnJlYWRBc0RhdGFVUkwoaW5wdXQuZmlsZXNbMF0pO1xuICAgIH1cbn1cbiQoXCIucHJvZmlsZVBpY1VwbG9hZFwiKS5vbignY2hhbmdlJywgZnVuY3Rpb24gKCkge1xuICAgIHByb1BpY1VSTCh0aGlzKTtcbn0pO1xuXG4kKFwiLnJlbW92ZS1pbWFnZVwiKS5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG4gICAgJCh0aGlzKS5wYXJlbnRzKFwiLnByb2ZpbGVQaWNQcmV2aWV3XCIpLmNzcygnYmFja2dyb3VuZC1pbWFnZScsICdub25lJyk7XG4gICAgJCh0aGlzKS5wYXJlbnRzKFwiLnByb2ZpbGVQaWNQcmV2aWV3XCIpLnJlbW92ZUNsYXNzKCdoYXMtaW1hZ2UnKTtcbiAgICAkKHRoaXMpLnBhcmVudHMoXCIudGh1bWJcIikuZmluZCgnaW5wdXRbdHlwZT1maWxlXScpLnZhbCgnJyk7XG59KTtcblxuJChcImZvcm1cIikub24oXCJjaGFuZ2VcIiwgXCIuZmlsZS11cGxvYWQtZmllbGRcIiwgZnVuY3Rpb24oKXtcbiAgJCh0aGlzKS5wYXJlbnQoXCIuZmlsZS11cGxvYWQtd3JhcHBlclwiKS5hdHRyKFwiZGF0YS10ZXh0XCIsJCh0aGlzKS52YWwoKS5yZXBsYWNlKC8uKihcXC98XFxcXCkvLCAnJykgKTtcbn0pO1xuICB2YXIgJGh0bWwgPSAkKCdodG1sJylcbiAgdmFyICRib2R5ID0gJCgnYm9keScpXG4gIHZhciAkdGV4dGNvbG9yID0gJyM0ZTUxNTQnXG4gIHZhciBhc3NldFBhdGggPSAnLi4vLi4vLi4vYXBwLWFzc2V0cy8nXG5cbiAgaWYgKCQoJ2JvZHknKS5hdHRyKCdkYXRhLWZyYW1ld29yaycpID09PSAnbGFyYXZlbCcpIHtcbiAgICBhc3NldFBhdGggPSAkKCdib2R5JykuYXR0cignZGF0YS1hc3NldC1wYXRoJylcbiAgfVxuXG4gIC8vIHRvIHJlbW92ZSBzbSBjb250cm9sIGNsYXNzZXMgZnJvbSBkYXRhdGFibGVzXG4gIGlmICgkLmZuLmRhdGFUYWJsZSkge1xuICAgICQuZXh0ZW5kKCQuZm4uZGF0YVRhYmxlLmV4dC5jbGFzc2VzLCB7XG4gICAgICBzRmlsdGVySW5wdXQ6ICdmb3JtLWNvbnRyb2wnLFxuICAgICAgc0xlbmd0aFNlbGVjdDogJ2Zvcm0tc2VsZWN0J1xuICAgIH0pXG4gIH1cblxuICAkKHdpbmRvdykub24oJ2xvYWQnLCBmdW5jdGlvbiAoKSB7XG4gICAgdmFyIHJ0bFxuICAgIHZhciBjb21wYWN0TWVudSA9IGZhbHNlXG5cbiAgICBpZiAoJGJvZHkuaGFzQ2xhc3MoJ21lbnUtY29sbGFwc2VkJykgfHwgbG9jYWxTdG9yYWdlLmdldEl0ZW0oJ21lbnVDb2xsYXBzZWQnKSA9PT0gJ3RydWUnKSB7XG4gICAgICBjb21wYWN0TWVudSA9IHRydWVcbiAgICB9XG5cbiAgICBpZiAoJCgnaHRtbCcpLmRhdGEoJ3RleHRkaXJlY3Rpb24nKSA9PSAncnRsJykge1xuICAgICAgcnRsID0gdHJ1ZVxuICAgIH1cblxuICAgIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgJGh0bWwucmVtb3ZlQ2xhc3MoJ2xvYWRpbmcnKS5hZGRDbGFzcygnbG9hZGVkJylcbiAgICB9LCAxMjAwKVxuXG4gICAgJC5hcHAubWVudS5pbml0KGNvbXBhY3RNZW51KVxuXG4gICAgLy8gTmF2aWdhdGlvbiBjb25maWd1cmF0aW9uc1xuICAgIHZhciBjb25maWcgPSB7XG4gICAgICBzcGVlZDogMzAwIC8vIHNldCBzcGVlZCB0byBleHBhbmQgLyBjb2xsYXBzZSBtZW51XG4gICAgfVxuICAgIGlmICgkLmFwcC5uYXYuaW5pdGlhbGl6ZWQgPT09IGZhbHNlKSB7XG4gICAgICAkLmFwcC5uYXYuaW5pdChjb25maWcpXG4gICAgfVxuXG4gICAgVW5pc29uLm9uKCdjaGFuZ2UnLCBmdW5jdGlvbiAoYnApIHtcbiAgICAgICQuYXBwLm1lbnUuY2hhbmdlKGNvbXBhY3RNZW51KVxuICAgIH0pXG5cbiAgICAvLyBUb29sdGlwIEluaXRpYWxpemF0aW9uXG4gICAgLy8gJCgnW2RhdGEtYnMtdG9nZ2xlPVwidG9vbHRpcFwiXScpLnRvb2x0aXAoe1xuICAgIC8vICAgY29udGFpbmVyOiAnYm9keSdcbiAgICAvLyB9KTtcbiAgICB2YXIgdG9vbHRpcFRyaWdnZXJMaXN0ID0gW10uc2xpY2UuY2FsbChkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCdbZGF0YS1icy10b2dnbGU9XCJ0b29sdGlwXCJdJykpXG4gICAgdmFyIHRvb2x0aXBMaXN0ID0gdG9vbHRpcFRyaWdnZXJMaXN0Lm1hcChmdW5jdGlvbiAodG9vbHRpcFRyaWdnZXJFbCkge1xuICAgICAgcmV0dXJuIG5ldyBib290c3RyYXAuVG9vbHRpcCh0b29sdGlwVHJpZ2dlckVsKVxuICAgIH0pXG5cbiAgICAvLyBDb2xsYXBzaWJsZSBDYXJkXG4gICAgJCgnYVtkYXRhLWFjdGlvbj1cImNvbGxhcHNlXCJdJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcbiAgICAgIGUucHJldmVudERlZmF1bHQoKVxuICAgICAgJCh0aGlzKS5jbG9zZXN0KCcuY2FyZCcpLmNoaWxkcmVuKCcuY2FyZC1jb250ZW50JykuY29sbGFwc2UoJ3RvZ2dsZScpXG4gICAgICAkKHRoaXMpLmNsb3Nlc3QoJy5jYXJkJykuZmluZCgnW2RhdGEtYWN0aW9uPVwiY29sbGFwc2VcIl0nKS50b2dnbGVDbGFzcygncm90YXRlJylcbiAgICB9KVxuXG4gICAgLy8gQ2FydCBkcm9wZG93biB0b3VjaHNwaW5cbiAgICBpZiAoJCgnLnRvdWNoc3Bpbi1jYXJ0JykubGVuZ3RoID4gMCkge1xuICAgICAgJCgnLnRvdWNoc3Bpbi1jYXJ0JykuVG91Y2hTcGluKHtcbiAgICAgICAgYnV0dG9uZG93bl9jbGFzczogJ2J0biBidG4tcHJpbWFyeScsXG4gICAgICAgIGJ1dHRvbnVwX2NsYXNzOiAnYnRuIGJ0bi1wcmltYXJ5JyxcbiAgICAgICAgYnV0dG9uZG93bl90eHQ6IGZlYXRoZXIuaWNvbnNbJ21pbnVzJ10udG9TdmcoKSxcbiAgICAgICAgYnV0dG9udXBfdHh0OiBmZWF0aGVyLmljb25zWydwbHVzJ10udG9TdmcoKVxuICAgICAgfSlcbiAgICB9XG5cbiAgICAvLyBEbyBub3QgY2xvc2UgY2FydCBvciBub3RpZmljYXRpb24gZHJvcGRvd24gb24gY2xpY2sgb2YgdGhlIGl0ZW1zXG4gICAgJCgnLmRyb3Bkb3duLW5vdGlmaWNhdGlvbiAuZHJvcGRvd24tbWVudSwgLmRyb3Bkb3duLWNhcnQgLmRyb3Bkb3duLW1lbnUnKS5vbignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xuICAgICAgZS5zdG9wUHJvcGFnYXRpb24oKVxuICAgIH0pXG5cbiAgICAvLyAgTm90aWZpY2F0aW9ucyAmIG1lc3NhZ2VzIHNjcm9sbGFibGVcbiAgICAkKCcuc2Nyb2xsYWJsZS1jb250YWluZXInKS5lYWNoKGZ1bmN0aW9uICgpIHtcbiAgICAgIHZhciBzY3JvbGxhYmxlX2NvbnRhaW5lciA9IG5ldyBQZXJmZWN0U2Nyb2xsYmFyKCQodGhpcylbMF0sIHtcbiAgICAgICAgd2hlZWxQcm9wYWdhdGlvbjogZmFsc2VcbiAgICAgIH0pXG4gICAgfSlcblxuICAgIC8vIFJlbG9hZCBDYXJkXG4gICAgJCgnYVtkYXRhLWFjdGlvbj1cInJlbG9hZFwiXScpLm9uKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAgIHZhciBibG9ja19lbGUgPSAkKHRoaXMpLmNsb3Nlc3QoJy5jYXJkJylcbiAgICAgIHZhciByZWxvYWRBY3Rpb25PdmVybGF5XG4gICAgICBpZiAoJGh0bWwuaGFzQ2xhc3MoJ2RhcmstbGF5b3V0JykpIHtcbiAgICAgICAgdmFyIHJlbG9hZEFjdGlvbk92ZXJsYXkgPSAnIzEwMTYzYSdcbiAgICAgIH0gZWxzZSB7XG4gICAgICAgIHZhciByZWxvYWRBY3Rpb25PdmVybGF5ID0gJyNmZmYnXG4gICAgICB9XG4gICAgICAvLyBCbG9jayBFbGVtZW50XG4gICAgICBibG9ja19lbGUuYmxvY2soe1xuICAgICAgICBtZXNzYWdlOiBmZWF0aGVyLmljb25zWydyZWZyZXNoLWN3J10udG9TdmcoeyBjbGFzczogJ2ZvbnQtbWVkaXVtLTEgc3Bpbm5lciB0ZXh0LXByaW1hcnknIH0pLFxuICAgICAgICB0aW1lb3V0OiAyMDAwLCAvL3VuYmxvY2sgYWZ0ZXIgMiBzZWNvbmRzXG4gICAgICAgIG92ZXJsYXlDU1M6IHtcbiAgICAgICAgICBiYWNrZ3JvdW5kQ29sb3I6IHJlbG9hZEFjdGlvbk92ZXJsYXksXG4gICAgICAgICAgY3Vyc29yOiAnd2FpdCdcbiAgICAgICAgfSxcbiAgICAgICAgY3NzOiB7XG4gICAgICAgICAgYm9yZGVyOiAwLFxuICAgICAgICAgIHBhZGRpbmc6IDAsXG4gICAgICAgICAgYmFja2dyb3VuZENvbG9yOiAnbm9uZSdcbiAgICAgICAgfVxuICAgICAgfSlcbiAgICB9KVxuXG4gICAgLy8gQ2xvc2UgQ2FyZFxuICAgICQoJ2FbZGF0YS1hY3Rpb249XCJjbG9zZVwiXScpLm9uKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAgICQodGhpcykuY2xvc2VzdCgnLmNhcmQnKS5yZW1vdmVDbGFzcygpLnNsaWRlVXAoJ2Zhc3QnKVxuICAgIH0pXG5cbiAgICAkKCcuY2FyZCAuaGVhZGluZy1lbGVtZW50cyBhW2RhdGEtYWN0aW9uPVwiY29sbGFwc2VcIl0nKS5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG4gICAgICB2YXIgJHRoaXMgPSAkKHRoaXMpLFxuICAgICAgICBjYXJkID0gJHRoaXMuY2xvc2VzdCgnLmNhcmQnKVxuICAgICAgdmFyIGNhcmRIZWlnaHRcblxuICAgICAgaWYgKHBhcnNlSW50KGNhcmRbMF0uc3R5bGUuaGVpZ2h0LCAxMCkgPiAwKSB7XG4gICAgICAgIGNhcmRIZWlnaHQgPSBjYXJkLmNzcygnaGVpZ2h0JylcbiAgICAgICAgY2FyZC5jc3MoJ2hlaWdodCcsICcnKS5hdHRyKCdkYXRhLWhlaWdodCcsIGNhcmRIZWlnaHQpXG4gICAgICB9IGVsc2Uge1xuICAgICAgICBpZiAoY2FyZC5kYXRhKCdoZWlnaHQnKSkge1xuICAgICAgICAgIGNhcmRIZWlnaHQgPSBjYXJkLmRhdGEoJ2hlaWdodCcpXG4gICAgICAgICAgY2FyZC5jc3MoJ2hlaWdodCcsIGNhcmRIZWlnaHQpLmF0dHIoJ2RhdGEtaGVpZ2h0JywgJycpXG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9KVxuXG4gICAgLy8gQWRkIGRpc2FibGVkIGNsYXNzIHRvIGlucHV0IGdyb3VwIHdoZW4gaW5wdXQgaXMgZGlzYWJsZWRcbiAgICAkKCdpbnB1dDpkaXNhYmxlZCwgdGV4dGFyZWE6ZGlzYWJsZWQnKS5jbG9zZXN0KCcuaW5wdXQtZ3JvdXAnKS5hZGRDbGFzcygnZGlzYWJsZWQnKVxuXG4gICAgLy8gQWRkIHNpZGViYXIgZ3JvdXAgYWN0aXZlIGNsYXNzIHRvIGFjdGl2ZSBtZW51XG4gICAgJCgnLm1haW4tbWVudS1jb250ZW50JykuZmluZCgnbGkuYWN0aXZlJykucGFyZW50cygnbGknKS5hZGRDbGFzcygnc2lkZWJhci1ncm91cC1hY3RpdmUnKVxuXG4gICAgLy8gQWRkIG9wZW4gY2xhc3MgdG8gcGFyZW50IGxpc3QgaXRlbSBpZiBzdWJpdGVtIGlzIGFjdGl2ZSBleGNlcHQgY29tcGFjdCBtZW51XG4gICAgdmFyIG1lbnVUeXBlID0gJGJvZHkuZGF0YSgnbWVudScpXG4gICAgaWYgKG1lbnVUeXBlICE9ICdob3Jpem9udGFsLW1lbnUnICYmIGNvbXBhY3RNZW51ID09PSBmYWxzZSkge1xuICAgICAgJCgnLm1haW4tbWVudS1jb250ZW50JykuZmluZCgnbGkuYWN0aXZlJykucGFyZW50cygnbGknKS5hZGRDbGFzcygnb3BlbicpXG4gICAgfVxuICAgIGlmIChtZW51VHlwZSA9PSAnaG9yaXpvbnRhbC1tZW51Jykge1xuICAgICAgJCgnLm1haW4tbWVudS1jb250ZW50JykuZmluZCgnbGkuYWN0aXZlJykucGFyZW50cygnbGk6bm90KC5uYXYtaXRlbSknKS5hZGRDbGFzcygnb3BlbicpXG4gICAgICAkKCcubWFpbi1tZW51LWNvbnRlbnQnKS5maW5kKCdsaS5hY3RpdmUnKS5jbG9zZXN0KCdsaS5uYXYtaXRlbScpLmFkZENsYXNzKCdzaWRlYmFyLWdyb3VwLWFjdGl2ZSBvcGVuJylcbiAgICAgIC8vICQoXCIubWFpbi1tZW51LWNvbnRlbnRcIilcbiAgICAgIC8vICAgLmZpbmQoXCJsaS5hY3RpdmVcIilcbiAgICAgIC8vICAgLnBhcmVudHMoXCJsaVwiKVxuICAgICAgLy8gICAuYWRkQ2xhc3MoXCJhY3RpdmVcIik7XG4gICAgfVxuXG4gICAgLy8gIER5bmFtaWMgaGVpZ2h0IGZvciB0aGUgY2hhcnRqcyBkaXYgZm9yIHRoZSBjaGFydCBhbmltYXRpb25zIHRvIHdvcmtcbiAgICB2YXIgY2hhcnRqc0RpdiA9ICQoJy5jaGFydGpzJyksXG4gICAgICBjYW52YXNIZWlnaHQgPSBjaGFydGpzRGl2LmNoaWxkcmVuKCdjYW52YXMnKS5hdHRyKCdoZWlnaHQnKSxcbiAgICAgIG1haW5NZW51ID0gJCgnLm1haW4tbWVudScpXG4gICAgY2hhcnRqc0Rpdi5jc3MoJ2hlaWdodCcsIGNhbnZhc0hlaWdodClcblxuICAgIGlmICgkYm9keS5oYXNDbGFzcygnYm94ZWQtbGF5b3V0JykpIHtcbiAgICAgIGlmICgkYm9keS5oYXNDbGFzcygndmVydGljYWwtb3ZlcmxheS1tZW51JykpIHtcbiAgICAgICAgdmFyIG1lbnVXaWR0aCA9IG1haW5NZW51LndpZHRoKClcbiAgICAgICAgdmFyIGNvbnRlbnRQb3NpdGlvbiA9ICQoJy5hcHAtY29udGVudCcpLnBvc2l0aW9uKCkubGVmdFxuICAgICAgICB2YXIgbWVudVBvc2l0aW9uQWRqdXN0ID0gY29udGVudFBvc2l0aW9uIC0gbWVudVdpZHRoXG4gICAgICAgIGlmICgkYm9keS5oYXNDbGFzcygnbWVudS1mbGlwcGVkJykpIHtcbiAgICAgICAgICBtYWluTWVudS5jc3MoJ3JpZ2h0JywgbWVudVBvc2l0aW9uQWRqdXN0ICsgJ3B4JylcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICBtYWluTWVudS5jc3MoJ2xlZnQnLCBtZW51UG9zaXRpb25BZGp1c3QgKyAncHgnKVxuICAgICAgICB9XG4gICAgICB9XG4gICAgfVxuXG4gICAgLyogVGV4dCBBcmVhIENvdW50ZXIgU2V0IFN0YXJ0ICovXG5cbiAgICAkKCcuY2hhci10ZXh0YXJlYScpLm9uKCdrZXl1cCcsIGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgY2hlY2tUZXh0QXJlYU1heExlbmd0aCh0aGlzLCBldmVudClcbiAgICAgIC8vIHRvIGxhdGVyIGNoYW5nZSB0ZXh0IGNvbG9yIGluIGRhcmsgbGF5b3V0XG4gICAgICAkKHRoaXMpLmFkZENsYXNzKCdhY3RpdmUnKVxuICAgIH0pXG5cbiAgICAvKlxuICAgIENoZWNrcyB0aGUgTWF4TGVuZ3RoIG9mIHRoZSBUZXh0YXJlYVxuICAgIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gICAgQHByZXJlcXVpc2l0ZTogIHRleHRCb3ggPSB0ZXh0YXJlYSBkb20gZWxlbWVudFxuICAgICAgICAgICAgZSA9IHRleHRhcmVhIGV2ZW50XG4gICAgICAgICAgICAgICAgICAgIGxlbmd0aCA9IE1heCBsZW5ndGggb2YgY2hhcmFjdGVyc1xuICAgICovXG4gICAgZnVuY3Rpb24gY2hlY2tUZXh0QXJlYU1heExlbmd0aCh0ZXh0Qm94LCBlKSB7XG4gICAgICB2YXIgbWF4TGVuZ3RoID0gcGFyc2VJbnQoJCh0ZXh0Qm94KS5kYXRhKCdsZW5ndGgnKSksXG4gICAgICAgIGNvdW50ZXJWYWx1ZSA9ICQoJy50ZXh0YXJlYS1jb3VudGVyLXZhbHVlJyksXG4gICAgICAgIGNoYXJUZXh0YXJlYSA9ICQoJy5jaGFyLXRleHRhcmVhJylcblxuICAgICAgaWYgKCFjaGVja1NwZWNpYWxLZXlzKGUpKSB7XG4gICAgICAgIGlmICh0ZXh0Qm94LnZhbHVlLmxlbmd0aCA8IG1heExlbmd0aCAtIDEpIHRleHRCb3gudmFsdWUgPSB0ZXh0Qm94LnZhbHVlLnN1YnN0cmluZygwLCBtYXhMZW5ndGgpXG4gICAgICB9XG4gICAgICAkKCcuY2hhci1jb3VudCcpLmh0bWwodGV4dEJveC52YWx1ZS5sZW5ndGgpXG5cbiAgICAgIGlmICh0ZXh0Qm94LnZhbHVlLmxlbmd0aCA+IG1heExlbmd0aCkge1xuICAgICAgICBjb3VudGVyVmFsdWUuY3NzKCdiYWNrZ3JvdW5kLWNvbG9yJywgd2luZG93LmNvbG9ycy5zb2xpZC5kYW5nZXIpXG4gICAgICAgIGNoYXJUZXh0YXJlYS5jc3MoJ2NvbG9yJywgd2luZG93LmNvbG9ycy5zb2xpZC5kYW5nZXIpXG4gICAgICAgIC8vIHRvIGNoYW5nZSB0ZXh0IGNvbG9yIGFmdGVyIGxpbWl0IGlzIG1heGVkb3V0IG91dFxuICAgICAgICBjaGFyVGV4dGFyZWEuYWRkQ2xhc3MoJ21heC1saW1pdCcpXG4gICAgICB9IGVsc2Uge1xuICAgICAgICBjb3VudGVyVmFsdWUuY3NzKCdiYWNrZ3JvdW5kLWNvbG9yJywgd2luZG93LmNvbG9ycy5zb2xpZC5wcmltYXJ5KVxuICAgICAgICBjaGFyVGV4dGFyZWEuY3NzKCdjb2xvcicsICR0ZXh0Y29sb3IpXG4gICAgICAgIGNoYXJUZXh0YXJlYS5yZW1vdmVDbGFzcygnbWF4LWxpbWl0JylcbiAgICAgIH1cblxuICAgICAgcmV0dXJuIHRydWVcbiAgICB9XG4gICAgLypcbiAgICBDaGVja3MgaWYgdGhlIGtleUNvZGUgcHJlc3NlZCBpcyBpbnNpZGUgc3BlY2lhbCBjaGFyc1xuICAgIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAgICBAcHJlcmVxdWlzaXRlOiAgZSA9IGUua2V5Q29kZSBvYmplY3QgZm9yIHRoZSBrZXkgcHJlc3NlZFxuICAgICovXG4gICAgZnVuY3Rpb24gY2hlY2tTcGVjaWFsS2V5cyhlKSB7XG4gICAgICBpZiAoZS5rZXlDb2RlICE9IDggJiYgZS5rZXlDb2RlICE9IDQ2ICYmIGUua2V5Q29kZSAhPSAzNyAmJiBlLmtleUNvZGUgIT0gMzggJiYgZS5rZXlDb2RlICE9IDM5ICYmIGUua2V5Q29kZSAhPSA0MClcbiAgICAgICAgcmV0dXJuIGZhbHNlXG4gICAgICBlbHNlIHJldHVybiB0cnVlXG4gICAgfVxuXG4gICAgJCgnLmNvbnRlbnQtb3ZlcmxheScpLm9uKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAgICQoJy5zZWFyY2gtbGlzdCcpLnJlbW92ZUNsYXNzKCdzaG93JylcbiAgICAgIHZhciBzZWFyY2hJbnB1dCA9ICQoJy5zZWFyY2gtaW5wdXQtY2xvc2UnKS5jbG9zZXN0KCcuc2VhcmNoLWlucHV0JylcbiAgICAgIGlmIChzZWFyY2hJbnB1dC5oYXNDbGFzcygnb3BlbicpKSB7XG4gICAgICAgIHNlYXJjaElucHV0LnJlbW92ZUNsYXNzKCdvcGVuJylcbiAgICAgICAgc2VhcmNoSW5wdXRJbnB1dGZpZWxkLnZhbCgnJylcbiAgICAgICAgc2VhcmNoSW5wdXRJbnB1dGZpZWxkLmJsdXIoKVxuICAgICAgICBzZWFyY2hMaXN0LnJlbW92ZUNsYXNzKCdzaG93JylcbiAgICAgIH1cblxuICAgICAgJCgnLmFwcC1jb250ZW50JykucmVtb3ZlQ2xhc3MoJ3Nob3ctb3ZlcmxheScpXG4gICAgICAkKCcuYm9va21hcmstd3JhcHBlciAuYm9va21hcmstaW5wdXQnKS5yZW1vdmVDbGFzcygnc2hvdycpXG4gICAgfSlcblxuICAgIC8vIFRvIHNob3cgc2hhZG93IGluIG1haW4gbWVudSB3aGVuIG1lbnUgc2Nyb2xsc1xuICAgIHZhciBjb250YWluZXIgPSBkb2N1bWVudC5nZXRFbGVtZW50c0J5Q2xhc3NOYW1lKCdtYWluLW1lbnUtY29udGVudCcpXG4gICAgaWYgKGNvbnRhaW5lci5sZW5ndGggPiAwKSB7XG4gICAgICBjb250YWluZXJbMF0uYWRkRXZlbnRMaXN0ZW5lcigncHMtc2Nyb2xsLXknLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGlmICgkKHRoaXMpLmZpbmQoJy5wc19fdGh1bWIteScpLnBvc2l0aW9uKCkudG9wID4gMCkge1xuICAgICAgICAgICQoJy5zaGFkb3ctYm90dG9tJykuY3NzKCdkaXNwbGF5JywgJ2Jsb2NrJylcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAkKCcuc2hhZG93LWJvdHRvbScpLmNzcygnZGlzcGxheScsICdub25lJylcbiAgICAgICAgfVxuICAgICAgfSlcbiAgICB9XG4gIH0pXG5cbiAgLy8gSGlkZSBvdmVybGF5IG1lbnUgb24gY29udGVudCBvdmVybGF5IGNsaWNrIG9uIHNtYWxsIHNjcmVlbnNcbiAgJChkb2N1bWVudCkub24oJ2NsaWNrJywgJy5zaWRlbmF2LW92ZXJsYXknLCBmdW5jdGlvbiAoZSkge1xuICAgIC8vIEhpZGUgbWVudVxuICAgICQuYXBwLm1lbnUuaGlkZSgpXG4gICAgcmV0dXJuIGZhbHNlXG4gIH0pXG5cbiAgLy8gRXhlY3V0ZSBiZWxvdyBjb2RlIG9ubHkgaWYgd2UgZmluZCBoYW1tZXIganMgZm9yIHRvdWNoIHN3aXBlIGZlYXR1cmUgb24gc21hbGwgc2NyZWVuXG4gIGlmICh0eXBlb2YgSGFtbWVyICE9PSAndW5kZWZpbmVkJykge1xuICAgIHZhciBydGxcbiAgICBpZiAoJCgnaHRtbCcpLmRhdGEoJ3RleHRkaXJlY3Rpb24nKSA9PSAncnRsJykge1xuICAgICAgcnRsID0gdHJ1ZVxuICAgIH1cblxuICAgIC8vIFN3aXBlIG1lbnUgZ2VzdHVyZVxuICAgIHZhciBzd2lwZUluRWxlbWVudCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5kcmFnLXRhcmdldCcpLFxuICAgICAgc3dpcGVJbkFjdGlvbiA9ICdwYW5yaWdodCcsXG4gICAgICBzd2lwZU91dEFjdGlvbiA9ICdwYW5sZWZ0J1xuXG4gICAgaWYgKHJ0bCA9PT0gdHJ1ZSkge1xuICAgICAgc3dpcGVJbkFjdGlvbiA9ICdwYW5sZWZ0J1xuICAgICAgc3dpcGVPdXRBY3Rpb24gPSAncGFucmlnaHQnXG4gICAgfVxuXG4gICAgaWYgKCQoc3dpcGVJbkVsZW1lbnQpLmxlbmd0aCA+IDApIHtcbiAgICAgIHZhciBzd2lwZUluTWVudSA9IG5ldyBIYW1tZXIoc3dpcGVJbkVsZW1lbnQpXG5cbiAgICAgIHN3aXBlSW5NZW51Lm9uKHN3aXBlSW5BY3Rpb24sIGZ1bmN0aW9uIChldikge1xuICAgICAgICBpZiAoJGJvZHkuaGFzQ2xhc3MoJ3ZlcnRpY2FsLW92ZXJsYXktbWVudScpKSB7XG4gICAgICAgICAgJC5hcHAubWVudS5vcGVuKClcbiAgICAgICAgICByZXR1cm4gZmFsc2VcbiAgICAgICAgfVxuICAgICAgfSlcbiAgICB9XG5cbiAgICAvLyBtZW51IHN3aXBlIG91dCBnZXN0dXJlXG4gICAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgICB2YXIgc3dpcGVPdXRFbGVtZW50ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLm1haW4tbWVudScpXG4gICAgICB2YXIgc3dpcGVPdXRNZW51XG5cbiAgICAgIGlmICgkKHN3aXBlT3V0RWxlbWVudCkubGVuZ3RoID4gMCkge1xuICAgICAgICBzd2lwZU91dE1lbnUgPSBuZXcgSGFtbWVyKHN3aXBlT3V0RWxlbWVudClcblxuICAgICAgICBzd2lwZU91dE1lbnUuZ2V0KCdwYW4nKS5zZXQoe1xuICAgICAgICAgIGRpcmVjdGlvbjogSGFtbWVyLkRJUkVDVElPTl9BTEwsXG4gICAgICAgICAgdGhyZXNob2xkOiAyNTBcbiAgICAgICAgfSlcblxuICAgICAgICBzd2lwZU91dE1lbnUub24oc3dpcGVPdXRBY3Rpb24sIGZ1bmN0aW9uIChldikge1xuICAgICAgICAgIGlmICgkYm9keS5oYXNDbGFzcygndmVydGljYWwtb3ZlcmxheS1tZW51JykpIHtcbiAgICAgICAgICAgICQuYXBwLm1lbnUuaGlkZSgpXG4gICAgICAgICAgICByZXR1cm4gZmFsc2VcbiAgICAgICAgICB9XG4gICAgICAgIH0pXG4gICAgICB9XG4gICAgfSwgMzAwKVxuXG4gICAgLy8gbWVudSBjbG9zZSBvbiBvdmVybGF5IHRhcFxuICAgIHZhciBzd2lwZU91dE92ZXJsYXlFbGVtZW50ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLnNpZGVuYXYtb3ZlcmxheScpXG5cbiAgICBpZiAoJChzd2lwZU91dE92ZXJsYXlFbGVtZW50KS5sZW5ndGggPiAwKSB7XG4gICAgICB2YXIgc3dpcGVPdXRPdmVybGF5TWVudSA9IG5ldyBIYW1tZXIoc3dpcGVPdXRPdmVybGF5RWxlbWVudClcblxuICAgICAgc3dpcGVPdXRPdmVybGF5TWVudS5vbigndGFwJywgZnVuY3Rpb24gKGV2KSB7XG4gICAgICAgIGlmICgkYm9keS5oYXNDbGFzcygndmVydGljYWwtb3ZlcmxheS1tZW51JykpIHtcbiAgICAgICAgICAkLmFwcC5tZW51LmhpZGUoKVxuICAgICAgICAgIHJldHVybiBmYWxzZVxuICAgICAgICB9XG4gICAgICB9KVxuICAgIH1cbiAgfVxuXG4gICQoZG9jdW1lbnQpLm9uKCdjbGljaycsICcubWVudS10b2dnbGUsIC5tb2Rlcm4tbmF2LXRvZ2dsZScsIGZ1bmN0aW9uIChlKSB7XG4gICAgZS5wcmV2ZW50RGVmYXVsdCgpXG5cbiAgICAvLyBUb2dnbGUgbWVudVxuICAgICQuYXBwLm1lbnUudG9nZ2xlKClcblxuICAgIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgJCh3aW5kb3cpLnRyaWdnZXIoJ3Jlc2l6ZScpXG4gICAgfSwgMjAwKVxuXG4gICAgaWYgKCQoJyNjb2xsYXBzZS1zaWRlYmFyLXN3aXRjaCcpLmxlbmd0aCA+IDApIHtcbiAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgICBpZiAoJGJvZHkuaGFzQ2xhc3MoJ21lbnUtZXhwYW5kZWQnKSB8fCAkYm9keS5oYXNDbGFzcygnbWVudS1vcGVuJykpIHtcbiAgICAgICAgICAkKCcjY29sbGFwc2Utc2lkZWJhci1zd2l0Y2gnKS5wcm9wKCdjaGVja2VkJywgZmFsc2UpXG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgJCgnI2NvbGxhcHNlLXNpZGViYXItc3dpdGNoJykucHJvcCgnY2hlY2tlZCcsIHRydWUpXG4gICAgICAgIH1cbiAgICAgIH0sIDUwKVxuICAgIH1cblxuICAgIC8vIFNhdmUgbWVudSBjb2xsYXBzZWQgc3RhdHVzIGluIGxvY2Fsc3RvcmFnZVxuICAgIGlmICgkYm9keS5oYXNDbGFzcygnbWVudS1leHBhbmRlZCcpIHx8ICRib2R5Lmhhc0NsYXNzKCdtZW51LW9wZW4nKSkge1xuICAgICAgbG9jYWxTdG9yYWdlLnNldEl0ZW0oJ21lbnVDb2xsYXBzZWQnLCBmYWxzZSlcbiAgICB9IGVsc2Uge1xuICAgICAgbG9jYWxTdG9yYWdlLnNldEl0ZW0oJ21lbnVDb2xsYXBzZWQnLCB0cnVlKVxuICAgIH1cblxuICAgIC8vIEhpZGVzIGRyb3Bkb3duIG9uIGNsaWNrIG9mIG1lbnUgdG9nZ2xlXG4gICAgLy8gJCgnW2RhdGEtYnMtdG9nZ2xlPVwiZHJvcGRvd25cIl0nKS5kcm9wZG93bignaGlkZScpO1xuXG4gICAgcmV0dXJuIGZhbHNlXG4gIH0pXG5cbiAgLy8gQWRkIENoaWxkcmVuIENsYXNzXG4gICQoJy5uYXZpZ2F0aW9uJykuZmluZCgnbGknKS5oYXMoJ3VsJykuYWRkQ2xhc3MoJ2hhcy1zdWInKVxuICAvLyBVcGRhdGUgbWFudWFsIHNjcm9sbGVyIHdoZW4gd2luZG93IGlzIHJlc2l6ZWRcbiAgJCh3aW5kb3cpLnJlc2l6ZShmdW5jdGlvbiAoKSB7XG4gICAgJC5hcHAubWVudS5tYW51YWxTY3JvbGxlci51cGRhdGVIZWlnaHQoKVxuICB9KVxuXG4gICQoJyNzaWRlYmFyLXBhZ2UtbmF2aWdhdGlvbicpLm9uKCdjbGljaycsICdhLm5hdi1saW5rJywgZnVuY3Rpb24gKGUpIHtcbiAgICBlLnByZXZlbnREZWZhdWx0KClcbiAgICBlLnN0b3BQcm9wYWdhdGlvbigpXG4gICAgdmFyICR0aGlzID0gJCh0aGlzKSxcbiAgICAgIGhyZWYgPSAkdGhpcy5hdHRyKCdocmVmJylcbiAgICB2YXIgb2Zmc2V0ID0gJChocmVmKS5vZmZzZXQoKVxuICAgIHZhciBzY3JvbGx0byA9IG9mZnNldC50b3AgLSA4MCAvLyBtaW51cyBmaXhlZCBoZWFkZXIgaGVpZ2h0XG4gICAgJCgnaHRtbCwgYm9keScpLmFuaW1hdGUoXG4gICAgICB7XG4gICAgICAgIHNjcm9sbFRvcDogc2Nyb2xsdG9cbiAgICAgIH0sXG4gICAgICAwXG4gICAgKVxuICAgIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgJHRoaXMucGFyZW50KCcubmF2LWl0ZW0nKS5zaWJsaW5ncygnLm5hdi1pdGVtJykuY2hpbGRyZW4oJy5uYXYtbGluaycpLnJlbW92ZUNsYXNzKCdhY3RpdmUnKVxuICAgICAgJHRoaXMuYWRkQ2xhc3MoJ2FjdGl2ZScpXG4gICAgfSwgMTAwKVxuICB9KVxuXG4gIC8vIG1haW4gbWVudSBpbnRlcm5hdGlvbmFsaXphdGlvblxuXG4gIC8vIGluaXQgaTE4biBhbmQgbG9hZCBsYW5ndWFnZSBmaWxlXG4gIGlmICgkYm9keS5hdHRyKCdkYXRhLWZyYW1ld29yaycpID09PSAnbGFyYXZlbCcpIHtcbiAgICAvLyBjaGFuZ2UgbGFuZ3VhZ2UgYWNjb3JkaW5nIHRvIGRhdGEtbGFuZ3VhZ2Ugb2YgZHJvcGRvd24gaXRlbVxuICAgIHZhciBsYW5ndWFnZSA9ICQoJ2h0bWwnKVswXS5sYW5nXG4gICAgaWYgKGxhbmd1YWdlICE9PSBudWxsKSB7XG4gICAgICAvLyBnZXQgdGhlIHNlbGVjdGVkIGZsYWcgY2xhc3NcbiAgICAgIHZhciBzZWxlY3RlZExhbmcgPSAkKCcuZHJvcGRvd24tbGFuZ3VhZ2UnKVxuICAgICAgICAuZmluZCgnYVtkYXRhLWxhbmd1YWdlPScgKyBsYW5ndWFnZSArICddJylcbiAgICAgICAgLnRleHQoKVxuICAgICAgdmFyIHNlbGVjdGVkRmxhZyA9ICQoJy5kcm9wZG93bi1sYW5ndWFnZScpXG4gICAgICAgIC5maW5kKCdhW2RhdGEtbGFuZ3VhZ2U9JyArIGxhbmd1YWdlICsgJ10gLmZsYWctaWNvbicpXG4gICAgICAgIC5hdHRyKCdjbGFzcycpXG4gICAgICAvLyBzZXQgdGhlIGNsYXNzIGluIGJ1dHRvblxuICAgICAgJCgnI2Ryb3Bkb3duLWZsYWcgLnNlbGVjdGVkLWxhbmd1YWdlJykudGV4dChzZWxlY3RlZExhbmcpXG4gICAgICAkKCcjZHJvcGRvd24tZmxhZyAuZmxhZy1pY29uJykucmVtb3ZlQ2xhc3MoKS5hZGRDbGFzcyhzZWxlY3RlZEZsYWcpXG4gICAgfVxuICB9IGVsc2Uge1xuICAgIGkxOG5leHQudXNlKHdpbmRvdy5pMThuZXh0WEhSQmFja2VuZCkuaW5pdChcbiAgICAgIHtcbiAgICAgICAgZGVidWc6IGZhbHNlLFxuICAgICAgICBmYWxsYmFja0xuZzogJ2VuJyxcbiAgICAgICAgYmFja2VuZDoge1xuICAgICAgICAgIGxvYWRQYXRoOiBhc3NldFBhdGggKyAnZGF0YS9sb2NhbGVzL3t7bG5nfX0uanNvbidcbiAgICAgICAgfSxcbiAgICAgICAgcmV0dXJuT2JqZWN0czogdHJ1ZVxuICAgICAgfSxcbiAgICAgIGZ1bmN0aW9uIChlcnIsIHQpIHtcbiAgICAgICAgLy8gcmVzb3VyY2VzIGhhdmUgYmVlbiBsb2FkZWRcbiAgICAgICAganF1ZXJ5STE4bmV4dC5pbml0KGkxOG5leHQsICQpXG4gICAgICB9XG4gICAgKVxuXG4gICAgLy8gY2hhbmdlIGxhbmd1YWdlIGFjY29yZGluZyB0byBkYXRhLWxhbmd1YWdlIG9mIGRyb3Bkb3duIGl0ZW1cbiAgICAkKCcuZHJvcGRvd24tbGFuZ3VhZ2UgLmRyb3Bkb3duLWl0ZW0nKS5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG4gICAgICB2YXIgJHRoaXMgPSAkKHRoaXMpXG4gICAgICAkdGhpcy5zaWJsaW5ncygnLnNlbGVjdGVkJykucmVtb3ZlQ2xhc3MoJ3NlbGVjdGVkJylcbiAgICAgICR0aGlzLmFkZENsYXNzKCdzZWxlY3RlZCcpXG4gICAgICB2YXIgc2VsZWN0ZWRMYW5nID0gJHRoaXMudGV4dCgpXG4gICAgICB2YXIgc2VsZWN0ZWRGbGFnID0gJHRoaXMuZmluZCgnLmZsYWctaWNvbicpLmF0dHIoJ2NsYXNzJylcbiAgICAgICQoJyNkcm9wZG93bi1mbGFnIC5zZWxlY3RlZC1sYW5ndWFnZScpLnRleHQoc2VsZWN0ZWRMYW5nKVxuICAgICAgJCgnI2Ryb3Bkb3duLWZsYWcgLmZsYWctaWNvbicpLnJlbW92ZUNsYXNzKCkuYWRkQ2xhc3Moc2VsZWN0ZWRGbGFnKVxuICAgICAgdmFyIGN1cnJlbnRMYW5ndWFnZSA9ICR0aGlzLmRhdGEoJ2xhbmd1YWdlJylcbiAgICAgIGkxOG5leHQuY2hhbmdlTGFuZ3VhZ2UoY3VycmVudExhbmd1YWdlLCBmdW5jdGlvbiAoZXJyLCB0KSB7XG4gICAgICAgICQoJy5tYWluLW1lbnUsIC5ob3Jpem9udGFsLW1lbnUtd3JhcHBlcicpLmxvY2FsaXplKClcbiAgICAgIH0pXG4gICAgfSlcbiAgfVxuXG4gIC8vIFdhdmVzIEVmZmVjdFxuICBXYXZlcy5pbml0KClcbiAgV2F2ZXMuYXR0YWNoKFxuICAgIFwiLmJ0bjpub3QoW2NsYXNzKj0nYnRuLXJlbGllZi0nXSk6bm90KFtjbGFzcyo9J2J0bi1ncmFkaWVudC0nXSk6bm90KFtjbGFzcyo9J2J0bi1vdXRsaW5lLSddKTpub3QoW2NsYXNzKj0nYnRuLWZsYXQtJ10pXCIsXG4gICAgWyd3YXZlcy1mbG9hdCcsICd3YXZlcy1saWdodCddXG4gIClcbiAgV2F2ZXMuYXR0YWNoKFwiW2NsYXNzKj0nYnRuLW91dGxpbmUtJ11cIilcbiAgV2F2ZXMuYXR0YWNoKFwiW2NsYXNzKj0nYnRuLWZsYXQtJ11cIilcblxuICAkKCcuZm9ybS1wYXNzd29yZC10b2dnbGUgLmlucHV0LWdyb3VwLXRleHQnKS5vbignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xuICAgIGUucHJldmVudERlZmF1bHQoKVxuICAgIHZhciAkdGhpcyA9ICQodGhpcyksXG4gICAgICBpbnB1dEdyb3VwVGV4dCA9ICR0aGlzLmNsb3Nlc3QoJy5mb3JtLXBhc3N3b3JkLXRvZ2dsZScpLFxuICAgICAgZm9ybVBhc3N3b3JkVG9nZ2xlSWNvbiA9ICR0aGlzLFxuICAgICAgZm9ybVBhc3N3b3JkVG9nZ2xlSW5wdXQgPSBpbnB1dEdyb3VwVGV4dC5maW5kKCdpbnB1dCcpXG5cbiAgICBpZiAoZm9ybVBhc3N3b3JkVG9nZ2xlSW5wdXQuYXR0cigndHlwZScpID09PSAndGV4dCcpIHtcbiAgICAgIGZvcm1QYXNzd29yZFRvZ2dsZUlucHV0LmF0dHIoJ3R5cGUnLCAncGFzc3dvcmQnKVxuICAgICAgaWYgKGZlYXRoZXIpIHtcbiAgICAgICAgZm9ybVBhc3N3b3JkVG9nZ2xlSWNvbi5maW5kKCdzdmcnKS5yZXBsYWNlV2l0aChmZWF0aGVyLmljb25zWydleWUnXS50b1N2Zyh7IGNsYXNzOiAnZm9udC1zbWFsbC00JyB9KSlcbiAgICAgIH1cbiAgICB9IGVsc2UgaWYgKGZvcm1QYXNzd29yZFRvZ2dsZUlucHV0LmF0dHIoJ3R5cGUnKSA9PT0gJ3Bhc3N3b3JkJykge1xuICAgICAgZm9ybVBhc3N3b3JkVG9nZ2xlSW5wdXQuYXR0cigndHlwZScsICd0ZXh0JylcbiAgICAgIGlmIChmZWF0aGVyKSB7XG4gICAgICAgIGZvcm1QYXNzd29yZFRvZ2dsZUljb24uZmluZCgnc3ZnJykucmVwbGFjZVdpdGgoZmVhdGhlci5pY29uc1snZXllLW9mZiddLnRvU3ZnKHsgY2xhc3M6ICdmb250LXNtYWxsLTQnIH0pKVxuICAgICAgfVxuICAgIH1cbiAgfSlcblxuICAvLyBvbiB3aW5kb3cgc2Nyb2xsIGJ1dHRvbiBzaG93L2hpZGVcbiAgJCh3aW5kb3cpLm9uKCdzY3JvbGwnLCBmdW5jdGlvbiAoKSB7XG4gICAgaWYgKCQodGhpcykuc2Nyb2xsVG9wKCkgPiA0MDApIHtcbiAgICAgICQoJy5zY3JvbGwtdG9wJykuZmFkZUluKClcbiAgICB9IGVsc2Uge1xuICAgICAgJCgnLnNjcm9sbC10b3AnKS5mYWRlT3V0KClcbiAgICB9XG5cbiAgICAvLyBPbiBTY3JvbGwgbmF2YmFyIGNvbG9yIG9uIGhvcml6b250YWwgbWVudVxuICAgIGlmICgkYm9keS5oYXNDbGFzcygnbmF2YmFyLXN0YXRpYycpKSB7XG4gICAgICB2YXIgc2Nyb2xsID0gJCh3aW5kb3cpLnNjcm9sbFRvcCgpXG5cbiAgICAgIGlmIChzY3JvbGwgPiA2NSkge1xuICAgICAgICAkKCdodG1sOm5vdCguZGFyay1sYXlvdXQpIC5ob3Jpem9udGFsLW1lbnUgLmhlYWRlci1uYXZiYXIubmF2YmFyLWZpeGVkJykuY3NzKHtcbiAgICAgICAgICBiYWNrZ3JvdW5kOiAnI2ZmZicsXG4gICAgICAgICAgJ2JveC1zaGFkb3cnOiAnMCA0cHggMjBweCAwIHJnYmEoMCwwLDAsLjA1KSdcbiAgICAgICAgfSlcbiAgICAgICAgJCgnLmhvcml6b250YWwtbWVudS5kYXJrLWxheW91dCAuaGVhZGVyLW5hdmJhci5uYXZiYXItZml4ZWQnKS5jc3Moe1xuICAgICAgICAgIGJhY2tncm91bmQ6ICcjMTYxZDMxJyxcbiAgICAgICAgICAnYm94LXNoYWRvdyc6ICcwIDRweCAyMHB4IDAgcmdiYSgwLDAsMCwuMDUpJ1xuICAgICAgICB9KVxuICAgICAgICAkKCdodG1sOm5vdCguZGFyay1sYXlvdXQpIC5ob3Jpem9udGFsLW1lbnUgLmhvcml6b250YWwtbWVudS13cmFwcGVyLmhlYWRlci1uYXZiYXInKS5jc3MoJ2JhY2tncm91bmQnLCAnI2ZmZicpXG4gICAgICAgICQoJy5kYXJrLWxheW91dCAuaG9yaXpvbnRhbC1tZW51IC5ob3Jpem9udGFsLW1lbnUtd3JhcHBlci5oZWFkZXItbmF2YmFyJykuY3NzKCdiYWNrZ3JvdW5kJywgJyMxNjFkMzEnKVxuICAgICAgfSBlbHNlIHtcbiAgICAgICAgJCgnaHRtbDpub3QoLmRhcmstbGF5b3V0KSAuaG9yaXpvbnRhbC1tZW51IC5oZWFkZXItbmF2YmFyLm5hdmJhci1maXhlZCcpLmNzcyh7XG4gICAgICAgICAgYmFja2dyb3VuZDogJyNmOGY4ZjgnLFxuICAgICAgICAgICdib3gtc2hhZG93JzogJ25vbmUnXG4gICAgICAgIH0pXG4gICAgICAgICQoJy5kYXJrLWxheW91dCAuaG9yaXpvbnRhbC1tZW51IC5oZWFkZXItbmF2YmFyLm5hdmJhci1maXhlZCcpLmNzcyh7XG4gICAgICAgICAgYmFja2dyb3VuZDogJyMxNjFkMzEnLFxuICAgICAgICAgICdib3gtc2hhZG93JzogJ25vbmUnXG4gICAgICAgIH0pXG4gICAgICAgICQoJ2h0bWw6bm90KC5kYXJrLWxheW91dCkgLmhvcml6b250YWwtbWVudSAuaG9yaXpvbnRhbC1tZW51LXdyYXBwZXIuaGVhZGVyLW5hdmJhcicpLmNzcygnYmFja2dyb3VuZCcsICcjZmZmJylcbiAgICAgICAgJCgnLmRhcmstbGF5b3V0IC5ob3Jpem9udGFsLW1lbnUgLmhvcml6b250YWwtbWVudS13cmFwcGVyLmhlYWRlci1uYXZiYXInKS5jc3MoJ2JhY2tncm91bmQnLCAnIzE2MWQzMScpXG4gICAgICB9XG4gICAgfVxuICB9KVxuXG4gIC8vIENsaWNrIGV2ZW50IHRvIHNjcm9sbCB0byB0b3BcbiAgJCgnLnNjcm9sbC10b3AnKS5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XG4gICAgJCgnaHRtbCwgYm9keScpLmFuaW1hdGUoeyBzY3JvbGxUb3A6IDAgfSwgNzUpXG4gIH0pXG5cbiAgZnVuY3Rpb24gZ2V0Q3VycmVudExheW91dCgpIHtcbiAgICB2YXIgY3VycmVudExheW91dCA9ICcnXG4gICAgaWYgKCRodG1sLmhhc0NsYXNzKCdkYXJrLWxheW91dCcpKSB7XG4gICAgICBjdXJyZW50TGF5b3V0ID0gJ2RhcmstbGF5b3V0J1xuICAgIH0gZWxzZSBpZiAoJGh0bWwuaGFzQ2xhc3MoJ2JvcmRlcmVkLWxheW91dCcpKSB7XG4gICAgICBjdXJyZW50TGF5b3V0ID0gJ2JvcmRlcmVkLWxheW91dCdcbiAgICB9IGVsc2UgaWYgKCRodG1sLmhhc0NsYXNzKCdzZW1pLWRhcmstbGF5b3V0JykpIHtcbiAgICAgIGN1cnJlbnRMYXlvdXQgPSAnc2VtaS1kYXJrLWxheW91dCdcbiAgICB9IGVsc2Uge1xuICAgICAgY3VycmVudExheW91dCA9ICdsaWdodC1sYXlvdXQnXG4gICAgfVxuICAgIHJldHVybiBjdXJyZW50TGF5b3V0XG4gIH1cblxuICAvLyBHZXQgdGhlIGRhdGEgbGF5b3V0LCBmb3IgYmxhbmsgc2V0IHRvIGxpZ2h0IGxheW91dFxuICB2YXIgZGF0YUxheW91dCA9ICRodG1sLmF0dHIoJ2RhdGEtbGF5b3V0JykgPyAkaHRtbC5hdHRyKCdkYXRhLWxheW91dCcpIDogJ2xpZ2h0LWxheW91dCdcblxuICAvLyBOYXZiYXIgRGFyayAvIExpZ2h0IExheW91dCBUb2dnbGUgU3dpdGNoXG4gICQoJy5uYXYtbGluay1zdHlsZScpLm9uKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICB2YXIgY3VycmVudExheW91dCA9IGdldEN1cnJlbnRMYXlvdXQoKSxcbiAgICAgIHN3aXRjaFRvTGF5b3V0ID0gJycsXG4gICAgICBwcmV2TGF5b3V0ID0gbG9jYWxTdG9yYWdlLmdldEl0ZW0oZGF0YUxheW91dCArICctcHJldi1za2luJywgY3VycmVudExheW91dClcblxuICAgIC8vIElmIGN1cnJlbnRMYXlvdXQgaXMgbm90IGRhcmsgbGF5b3V0XG4gICAgaWYgKGN1cnJlbnRMYXlvdXQgIT09ICdkYXJrLWxheW91dCcpIHtcbiAgICAgIC8vIFN3aXRjaCB0byBkYXJrXG4gICAgICBzd2l0Y2hUb0xheW91dCA9ICdkYXJrLWxheW91dCdcbiAgICB9IGVsc2Uge1xuICAgICAgLy8gU3dpdGNoIHRvIGxpZ2h0XG4gICAgICAvLyBzd2l0Y2hUb0xheW91dCA9IHByZXZMYXlvdXQgPyBwcmV2TGF5b3V0IDogJ2xpZ2h0LWxheW91dCc7XG4gICAgICBpZiAoY3VycmVudExheW91dCA9PT0gcHJldkxheW91dCkge1xuICAgICAgICBzd2l0Y2hUb0xheW91dCA9ICdsaWdodC1sYXlvdXQnXG4gICAgICB9IGVsc2Uge1xuICAgICAgICBzd2l0Y2hUb0xheW91dCA9IHByZXZMYXlvdXQgPyBwcmV2TGF5b3V0IDogJ2xpZ2h0LWxheW91dCdcbiAgICAgIH1cbiAgICB9XG4gICAgLy8gU2V0IFByZXZpb3VzIHNraW4gaW4gbG9jYWwgZGJcbiAgICBsb2NhbFN0b3JhZ2Uuc2V0SXRlbShkYXRhTGF5b3V0ICsgJy1wcmV2LXNraW4nLCBjdXJyZW50TGF5b3V0KVxuICAgIC8vIFNldCBDdXJyZW50IHNraW4gaW4gbG9jYWwgZGJcbiAgICBsb2NhbFN0b3JhZ2Uuc2V0SXRlbShkYXRhTGF5b3V0ICsgJy1jdXJyZW50LXNraW4nLCBzd2l0Y2hUb0xheW91dClcblxuICAgIC8vIENhbGwgc2V0IGxheW91dFxuICAgIHNldExheW91dChzd2l0Y2hUb0xheW91dClcblxuICAgIC8vIFRvRG86IEN1c3RvbWl6ZXIgZml4XG4gICAgJCgnLmhvcml6b250YWwtbWVudSAuaGVhZGVyLW5hdmJhci5uYXZiYXItZml4ZWQnKS5jc3Moe1xuICAgICAgYmFja2dyb3VuZDogJ2luaGVyaXQnLFxuICAgICAgJ2JveC1zaGFkb3cnOiAnaW5oZXJpdCdcbiAgICB9KVxuICAgICQoJy5ob3Jpem9udGFsLW1lbnUgLmhvcml6b250YWwtbWVudS13cmFwcGVyLmhlYWRlci1uYXZiYXInKS5jc3MoJ2JhY2tncm91bmQnLCAnaW5oZXJpdCcpXG4gIH0pXG5cbiAgLy8gR2V0IGN1cnJlbnQgbG9jYWwgc3RvcmFnZSBsYXlvdXRcbiAgdmFyIGN1cnJlbnRMb2NhbFN0b3JhZ2VMYXlvdXQgPSBsb2NhbFN0b3JhZ2UuZ2V0SXRlbShkYXRhTGF5b3V0ICsgJy1jdXJyZW50LXNraW4nKVxuXG4gIC8vIFNldCBsYXlvdXQgb24gc2NyZWVuIGxvYWRcbiAgLy8/IENvbW1lbnQgaXQgaWYgeW91IGRvbid0IHdhbnQgdG8gc3luYyBsYXlvdXQgd2l0aCBsb2NhbCBkYlxuICAvLyBzZXRMYXlvdXQoY3VycmVudExvY2FsU3RvcmFnZUxheW91dCk7XG5cbiAgZnVuY3Rpb24gc2V0TGF5b3V0KGN1cnJlbnRMb2NhbFN0b3JhZ2VMYXlvdXQpIHtcbiAgICB2YXIgbmF2TGlua1N0eWxlID0gJCgnLm5hdi1saW5rLXN0eWxlJyksXG4gICAgICBjdXJyZW50TGF5b3V0ID0gZ2V0Q3VycmVudExheW91dCgpLFxuICAgICAgbWFpbk1lbnUgPSAkKCcubWFpbi1tZW51JyksXG4gICAgICBuYXZiYXIgPSAkKCcuaGVhZGVyLW5hdmJhcicpLFxuICAgICAgLy8gV2l0Y2ggdG8gbG9jYWwgc3RvcmFnZSBsYXlvdXQgaWYgd2UgaGF2ZSBlbHNlIGN1cnJlbnQgbGF5b3V0XG4gICAgICBzd2l0Y2hUb0xheW91dCA9IGN1cnJlbnRMb2NhbFN0b3JhZ2VMYXlvdXQgPyBjdXJyZW50TG9jYWxTdG9yYWdlTGF5b3V0IDogY3VycmVudExheW91dFxuXG4gICAgJGh0bWwucmVtb3ZlQ2xhc3MoJ3NlbWktZGFyay1sYXlvdXQgZGFyay1sYXlvdXQgYm9yZGVyZWQtbGF5b3V0JylcblxuICAgIGlmIChzd2l0Y2hUb0xheW91dCA9PT0gJ2RhcmstbGF5b3V0Jykge1xuICAgICAgJGh0bWwuYWRkQ2xhc3MoJ2RhcmstbGF5b3V0JylcbiAgICAgIG1haW5NZW51LnJlbW92ZUNsYXNzKCdtZW51LWxpZ2h0JykuYWRkQ2xhc3MoJ21lbnUtZGFyaycpXG4gICAgICBuYXZiYXIucmVtb3ZlQ2xhc3MoJ25hdmJhci1saWdodCcpLmFkZENsYXNzKCduYXZiYXItZGFyaycpXG4gICAgICBuYXZMaW5rU3R5bGUuZmluZCgnLmJpLW1vb24nKS5yZXBsYWNlV2l0aCgnPGkgY2xhc3M9XCJiaSBiaS1zdW5cIj48L2k+JylcbiAgICB9IGVsc2UgaWYgKHN3aXRjaFRvTGF5b3V0ID09PSAnYm9yZGVyZWQtbGF5b3V0Jykge1xuICAgICAgJGh0bWwuYWRkQ2xhc3MoJ2JvcmRlcmVkLWxheW91dCcpXG4gICAgICBtYWluTWVudS5yZW1vdmVDbGFzcygnbWVudS1kYXJrJykuYWRkQ2xhc3MoJ21lbnUtbGlnaHQnKVxuICAgICAgbmF2YmFyLnJlbW92ZUNsYXNzKCduYXZiYXItZGFyaycpLmFkZENsYXNzKCduYXZiYXItbGlnaHQnKVxuICAgICAgbmF2TGlua1N0eWxlLmZpbmQoJy5iaS1zdW4nKS5yZXBsYWNlV2l0aCgnPGkgY2xhc3M9XCJiaSBiaS1tb29uXCI+PC9pPicpXG4gICAgfSBlbHNlIGlmIChzd2l0Y2hUb0xheW91dCA9PT0gJ3NlbWktZGFyay1sYXlvdXQnKSB7XG4gICAgICAkaHRtbC5hZGRDbGFzcygnc2VtaS1kYXJrLWxheW91dCcpXG4gICAgICBtYWluTWVudS5yZW1vdmVDbGFzcygnbWVudS1kYXJrJykuYWRkQ2xhc3MoJ21lbnUtbGlnaHQnKVxuICAgICAgbmF2YmFyLnJlbW92ZUNsYXNzKCduYXZiYXItZGFyaycpLmFkZENsYXNzKCduYXZiYXItbGlnaHQnKVxuICAgICAgbmF2TGlua1N0eWxlLmZpbmQoJy5iaS1zdW4nKS5yZXBsYWNlV2l0aCgnPGkgY2xhc3M9XCJiaSBiaS1tb29uXCI+PC9pPicpXG4gICAgfSBlbHNlIHtcbiAgICAgICRodG1sLmFkZENsYXNzKCdsaWdodC1sYXlvdXQnKVxuICAgICAgbWFpbk1lbnUucmVtb3ZlQ2xhc3MoJ21lbnUtZGFyaycpLmFkZENsYXNzKCdtZW51LWxpZ2h0JylcbiAgICAgIG5hdmJhci5yZW1vdmVDbGFzcygnbmF2YmFyLWRhcmsnKS5hZGRDbGFzcygnbmF2YmFyLWxpZ2h0JylcbiAgICAgIG5hdkxpbmtTdHlsZS5maW5kKCcuYmktc3VuJykucmVwbGFjZVdpdGgoJzxpIGNsYXNzPVwiYmkgYmktbW9vblwiPjwvaT4nKVxuICAgIH1cbiAgICAvLyBTZXQgcmFkaW8gaW4gY3VzdG9taXplciBpZiB3ZSBoYXZlXG4gICAgaWYgKCQoJ2lucHV0OnJhZGlvW2RhdGEtbGF5b3V0PScgKyBzd2l0Y2hUb0xheW91dCArICddJykubGVuZ3RoID4gMCkge1xuICAgICAgc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgICAgICQoJ2lucHV0OnJhZGlvW2RhdGEtbGF5b3V0PScgKyBzd2l0Y2hUb0xheW91dCArICddJykucHJvcCgnY2hlY2tlZCcsIHRydWUpXG4gICAgICB9KVxuICAgIH1cbiAgfVxufSkod2luZG93LCBkb2N1bWVudCwgalF1ZXJ5KVxuXG4vLyBUbyB1c2UgZmVhdGhlciBzdmcgaWNvbnMgd2l0aCBkaWZmZXJlbnQgc2l6ZXNcbmZ1bmN0aW9uIGZlYXRoZXJTVkcoaWNvblNpemUpIHtcbiAgLy8gRmVhdGhlciBJY29uc1xuICBpZiAoaWNvblNpemUgPT0gdW5kZWZpbmVkKSB7XG4gICAgaWNvblNpemUgPSAnMTQnXG4gIH1cbiAgcmV0dXJuIGZlYXRoZXIucmVwbGFjZSh7IHdpZHRoOiBpY29uU2l6ZSwgaGVpZ2h0OiBpY29uU2l6ZSB9KVxufVxuXG4vLyBqUXVlcnkgVmFsaWRhdGlvbiBHbG9iYWwgRGVmYXVsdHNcbmlmICh0eXBlb2YgalF1ZXJ5LnZhbGlkYXRvciA9PT0gJ2Z1bmN0aW9uJykge1xuICBqUXVlcnkudmFsaWRhdG9yLnNldERlZmF1bHRzKHtcbiAgICBlcnJvckVsZW1lbnQ6ICdzcGFuJyxcbiAgICBlcnJvclBsYWNlbWVudDogZnVuY3Rpb24gKGVycm9yLCBlbGVtZW50KSB7XG4gICAgICBpZiAoXG4gICAgICAgIGVsZW1lbnQucGFyZW50KCkuaGFzQ2xhc3MoJ2lucHV0LWdyb3VwJykgfHxcbiAgICAgICAgZWxlbWVudC5oYXNDbGFzcygnc2VsZWN0MicpIHx8XG4gICAgICAgIGVsZW1lbnQuYXR0cigndHlwZScpID09PSAnY2hlY2tib3gnXG4gICAgICApIHtcbiAgICAgICAgZXJyb3IuaW5zZXJ0QWZ0ZXIoZWxlbWVudC5wYXJlbnQoKSlcbiAgICAgIH0gZWxzZSBpZiAoZWxlbWVudC5oYXNDbGFzcygnZm9ybS1jaGVjay1pbnB1dCcpKSB7XG4gICAgICAgIGVycm9yLmluc2VydEFmdGVyKGVsZW1lbnQucGFyZW50KCkuc2libGluZ3MoJzpsYXN0JykpXG4gICAgICB9IGVsc2Uge1xuICAgICAgICBlcnJvci5pbnNlcnRBZnRlcihlbGVtZW50KVxuICAgICAgfVxuXG4gICAgICBpZiAoZWxlbWVudC5wYXJlbnQoKS5oYXNDbGFzcygnaW5wdXQtZ3JvdXAnKSkge1xuICAgICAgICBlbGVtZW50LnBhcmVudCgpLmFkZENsYXNzKCdpcy1pbnZhbGlkJylcbiAgICAgIH1cbiAgICB9LFxuICAgIGhpZ2hsaWdodDogZnVuY3Rpb24gKGVsZW1lbnQsIGVycm9yQ2xhc3MsIHZhbGlkQ2xhc3MpIHtcbiAgICAgICQoZWxlbWVudCkuYWRkQ2xhc3MoJ2Vycm9yJylcbiAgICAgIGlmICgkKGVsZW1lbnQpLnBhcmVudCgpLmhhc0NsYXNzKCdpbnB1dC1ncm91cCcpKSB7XG4gICAgICAgICQoZWxlbWVudCkucGFyZW50KCkuYWRkQ2xhc3MoJ2lzLWludmFsaWQnKVxuICAgICAgfVxuICAgIH0sXG4gICAgdW5oaWdobGlnaHQ6IGZ1bmN0aW9uIChlbGVtZW50LCBlcnJvckNsYXNzLCB2YWxpZENsYXNzKSB7XG4gICAgICAkKGVsZW1lbnQpLnJlbW92ZUNsYXNzKCdlcnJvcicpXG4gICAgICBpZiAoJChlbGVtZW50KS5wYXJlbnQoKS5oYXNDbGFzcygnaW5wdXQtZ3JvdXAnKSkge1xuICAgICAgICAkKGVsZW1lbnQpLnBhcmVudCgpLnJlbW92ZUNsYXNzKCdpcy1pbnZhbGlkJylcbiAgICAgIH1cbiAgICB9XG4gIH0pXG59XG5cbi8vIEFkZCB2YWxpZGF0aW9uIGNsYXNzIHRvIGlucHV0LWdyb3VwIChpbnB1dCBncm91cCB2YWxpZGF0aW9uIGZpeCwgY3VycmVudGx5IGRpc2FibGVkIGJ1dCB3aWxsIGJlIHVzZWZ1bCBpbiBmdXR1cmUpXG4vKiBmdW5jdGlvbiBpbnB1dEdyb3VwVmFsaWRhdGlvbihlbCkge1xuICB2YXIgdmFsaWRFbCxcbiAgICBpbnZhbGlkRWwsXG4gICAgZWxlbSA9ICQoZWwpO1xuXG4gIGlmIChlbGVtLmhhc0NsYXNzKCdmb3JtLWNvbnRyb2wnKSkge1xuICAgIGlmICgkKGVsZW0pLmlzKCcuZm9ybS1jb250cm9sOnZhbGlkLCAuZm9ybS1jb250cm9sLmlzLXZhbGlkJykpIHtcbiAgICAgIHZhbGlkRWwgPSBlbGVtO1xuICAgIH1cbiAgICBpZiAoJChlbGVtKS5pcygnLmZvcm0tY29udHJvbDppbnZhbGlkLCAuZm9ybS1jb250cm9sLmlzLWludmFsaWQnKSkge1xuICAgICAgaW52YWxpZEVsID0gZWxlbTtcbiAgICB9XG4gIH0gZWxzZSB7XG4gICAgdmFsaWRFbCA9IGVsZW0uZmluZCgnLmZvcm0tY29udHJvbDp2YWxpZCwgLmZvcm0tY29udHJvbC5pcy12YWxpZCcpO1xuICAgIGludmFsaWRFbCA9IGVsZW0uZmluZCgnLmZvcm0tY29udHJvbDppbnZhbGlkLCAuZm9ybS1jb250cm9sLmlzLWludmFsaWQnKTtcbiAgfVxuICBpZiAodmFsaWRFbCAhPT0gdW5kZWZpbmVkKSB7XG4gICAgdmFsaWRFbC5jbG9zZXN0KCcuaW5wdXQtZ3JvdXAnKS5yZW1vdmVDbGFzcygnLmlzLXZhbGlkIGlzLWludmFsaWQnKS5hZGRDbGFzcygnaXMtdmFsaWQnKTtcbiAgfVxuICBpZiAoaW52YWxpZEVsICE9PSB1bmRlZmluZWQpIHtcbiAgICBpbnZhbGlkRWwuY2xvc2VzdCgnLmlucHV0LWdyb3VwJykucmVtb3ZlQ2xhc3MoJy5pcy12YWxpZCBpcy1pbnZhbGlkJykuYWRkQ2xhc3MoJ2lzLWludmFsaWQnKTtcbiAgfVxufSAqL1xuIl0sIm5hbWVzIjpbIndpbmRvdyIsImNvbG9ycyIsInNvbGlkIiwicHJpbWFyeSIsInNlY29uZGFyeSIsInN1Y2Nlc3MiLCJpbmZvIiwid2FybmluZyIsImRhbmdlciIsImRhcmsiLCJibGFjayIsIndoaXRlIiwiYm9keSIsImxpZ2h0IiwiZG9jdW1lbnQiLCIkIiwiY2xvc2VzdCIsImZpbmQiLCJhcHBlbmQiLCJhdHRyIiwidHJfZWxlbWVudHMiLCJvbiIsInNlYXJjaCIsInZhbCIsInRvVXBwZXJDYXNlIiwibWF0Y2giLCJmaWx0ZXIiLCJpZHgiLCJlbGVtIiwidGV4dCIsInRyaW0iLCJpbmRleE9mIiwic29ydCIsInRhYmxlX2NvbnRlbnQiLCJsZW5ndGgiLCJodG1sIiwiaW1nIiwiY3NzIiwiYmciLCJkYXRhIiwidG9vbHRpcCIsInRvZ2dsZUZ1bGxTY3JlZW4iLCJmdWxsc2NyZWVuRWxlbWVudCIsImRvY3VtZW50RWxlbWVudCIsInJlcXVlc3RGdWxsc2NyZWVuIiwicmVtb3ZlQ2xhc3MiLCJhZGRDbGFzcyIsImV4aXRGdWxsc2NyZWVuIiwidG9nZ2xlQ2xhc3MiLCJwcm9QaWNVUkwiLCJpbnB1dCIsImZpbGVzIiwicmVhZGVyIiwiRmlsZVJlYWRlciIsIm9ubG9hZCIsImUiLCJwcmV2aWV3IiwicGFyZW50cyIsInRhcmdldCIsInJlc3VsdCIsImhpZGUiLCJmYWRlSW4iLCJyZWFkQXNEYXRhVVJMIiwicGFyZW50IiwicmVwbGFjZSIsIiRodG1sIiwiJGJvZHkiLCIkdGV4dGNvbG9yIiwiYXNzZXRQYXRoIiwiZm4iLCJkYXRhVGFibGUiLCJleHRlbmQiLCJleHQiLCJjbGFzc2VzIiwic0ZpbHRlcklucHV0Iiwic0xlbmd0aFNlbGVjdCIsInJ0bCIsImNvbXBhY3RNZW51IiwiaGFzQ2xhc3MiLCJsb2NhbFN0b3JhZ2UiLCJnZXRJdGVtIiwic2V0VGltZW91dCIsImFwcCIsIm1lbnUiLCJpbml0IiwiY29uZmlnIiwic3BlZWQiLCJuYXYiLCJpbml0aWFsaXplZCIsIlVuaXNvbiIsImJwIiwiY2hhbmdlIiwidG9vbHRpcFRyaWdnZXJMaXN0Iiwic2xpY2UiLCJjYWxsIiwicXVlcnlTZWxlY3RvckFsbCIsInRvb2x0aXBMaXN0IiwibWFwIiwidG9vbHRpcFRyaWdnZXJFbCIsImJvb3RzdHJhcCIsIlRvb2x0aXAiLCJwcmV2ZW50RGVmYXVsdCIsImNoaWxkcmVuIiwiY29sbGFwc2UiLCJUb3VjaFNwaW4iLCJidXR0b25kb3duX2NsYXNzIiwiYnV0dG9udXBfY2xhc3MiLCJidXR0b25kb3duX3R4dCIsImZlYXRoZXIiLCJpY29ucyIsInRvU3ZnIiwiYnV0dG9udXBfdHh0Iiwic3RvcFByb3BhZ2F0aW9uIiwiZWFjaCIsInNjcm9sbGFibGVfY29udGFpbmVyIiwiUGVyZmVjdFNjcm9sbGJhciIsIndoZWVsUHJvcGFnYXRpb24iLCJibG9ja19lbGUiLCJyZWxvYWRBY3Rpb25PdmVybGF5IiwiYmxvY2siLCJtZXNzYWdlIiwidGltZW91dCIsIm92ZXJsYXlDU1MiLCJiYWNrZ3JvdW5kQ29sb3IiLCJjdXJzb3IiLCJib3JkZXIiLCJwYWRkaW5nIiwic2xpZGVVcCIsIiR0aGlzIiwiY2FyZCIsImNhcmRIZWlnaHQiLCJwYXJzZUludCIsInN0eWxlIiwiaGVpZ2h0IiwibWVudVR5cGUiLCJjaGFydGpzRGl2IiwiY2FudmFzSGVpZ2h0IiwibWFpbk1lbnUiLCJtZW51V2lkdGgiLCJ3aWR0aCIsImNvbnRlbnRQb3NpdGlvbiIsInBvc2l0aW9uIiwibGVmdCIsIm1lbnVQb3NpdGlvbkFkanVzdCIsImV2ZW50IiwiY2hlY2tUZXh0QXJlYU1heExlbmd0aCIsInRleHRCb3giLCJtYXhMZW5ndGgiLCJjb3VudGVyVmFsdWUiLCJjaGFyVGV4dGFyZWEiLCJjaGVja1NwZWNpYWxLZXlzIiwidmFsdWUiLCJzdWJzdHJpbmciLCJrZXlDb2RlIiwic2VhcmNoSW5wdXQiLCJzZWFyY2hJbnB1dElucHV0ZmllbGQiLCJibHVyIiwic2VhcmNoTGlzdCIsImNvbnRhaW5lciIsImdldEVsZW1lbnRzQnlDbGFzc05hbWUiLCJhZGRFdmVudExpc3RlbmVyIiwidG9wIiwiSGFtbWVyIiwic3dpcGVJbkVsZW1lbnQiLCJxdWVyeVNlbGVjdG9yIiwic3dpcGVJbkFjdGlvbiIsInN3aXBlT3V0QWN0aW9uIiwic3dpcGVJbk1lbnUiLCJldiIsIm9wZW4iLCJzd2lwZU91dEVsZW1lbnQiLCJzd2lwZU91dE1lbnUiLCJnZXQiLCJzZXQiLCJkaXJlY3Rpb24iLCJESVJFQ1RJT05fQUxMIiwidGhyZXNob2xkIiwic3dpcGVPdXRPdmVybGF5RWxlbWVudCIsInN3aXBlT3V0T3ZlcmxheU1lbnUiLCJ0b2dnbGUiLCJ0cmlnZ2VyIiwicHJvcCIsInNldEl0ZW0iLCJoYXMiLCJyZXNpemUiLCJtYW51YWxTY3JvbGxlciIsInVwZGF0ZUhlaWdodCIsImhyZWYiLCJvZmZzZXQiLCJzY3JvbGx0byIsImFuaW1hdGUiLCJzY3JvbGxUb3AiLCJzaWJsaW5ncyIsImxhbmd1YWdlIiwibGFuZyIsInNlbGVjdGVkTGFuZyIsInNlbGVjdGVkRmxhZyIsImkxOG5leHQiLCJ1c2UiLCJpMThuZXh0WEhSQmFja2VuZCIsImRlYnVnIiwiZmFsbGJhY2tMbmciLCJiYWNrZW5kIiwibG9hZFBhdGgiLCJyZXR1cm5PYmplY3RzIiwiZXJyIiwidCIsImpxdWVyeUkxOG5leHQiLCJjdXJyZW50TGFuZ3VhZ2UiLCJjaGFuZ2VMYW5ndWFnZSIsImxvY2FsaXplIiwiV2F2ZXMiLCJhdHRhY2giLCJpbnB1dEdyb3VwVGV4dCIsImZvcm1QYXNzd29yZFRvZ2dsZUljb24iLCJmb3JtUGFzc3dvcmRUb2dnbGVJbnB1dCIsInJlcGxhY2VXaXRoIiwiZmFkZU91dCIsInNjcm9sbCIsImJhY2tncm91bmQiLCJnZXRDdXJyZW50TGF5b3V0IiwiY3VycmVudExheW91dCIsImRhdGFMYXlvdXQiLCJzd2l0Y2hUb0xheW91dCIsInByZXZMYXlvdXQiLCJzZXRMYXlvdXQiLCJjdXJyZW50TG9jYWxTdG9yYWdlTGF5b3V0IiwibmF2TGlua1N0eWxlIiwibmF2YmFyIiwialF1ZXJ5IiwiZmVhdGhlclNWRyIsImljb25TaXplIiwidW5kZWZpbmVkIiwidmFsaWRhdG9yIiwic2V0RGVmYXVsdHMiLCJlcnJvckVsZW1lbnQiLCJlcnJvclBsYWNlbWVudCIsImVycm9yIiwiZWxlbWVudCIsImluc2VydEFmdGVyIiwiaGlnaGxpZ2h0IiwiZXJyb3JDbGFzcyIsInZhbGlkQ2xhc3MiLCJ1bmhpZ2hsaWdodCJdLCJzb3VyY2VSb290IjoiIn0=