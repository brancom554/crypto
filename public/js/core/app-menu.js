/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/core/app-menu.js ***!
  \***************************************/
/*=========================================================================================
  File Name: app-menu.js
  Description: Menu navigation, custom scrollbar, hover scroll bar, multilevel menu
  initialization and manipulations
  ----------------------------------------------------------------------------------------
  Item Name: Bicrypto - Crypto Trading Platform
  Author: MashDiv
  Author URL: hhttp://www.themeforest.net/user/mashdiv
==========================================================================================*/
(function (window, document, $) {
  'use strict';

  var vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', vh + 'px');
  $.app = $.app || {};
  var $body = $('body');
  var $window = $(window);
  var menuWrapper_el = $('div[data-menu="menu-wrapper"]').html();
  var menuWrapperClasses = $('div[data-menu="menu-wrapper"]').attr('class'); // Main menu

  $.app.menu = {
    expanded: null,
    collapsed: null,
    hidden: null,
    container: null,
    horizontalMenu: false,
    is_touch_device: function is_touch_device() {
      var prefixes = ' -webkit- -moz- -o- -ms- '.split(' ');

      var mq = function mq(query) {
        return window.matchMedia(query).matches;
      };

      if ('ontouchstart' in window || window.DocumentTouch && document instanceof DocumentTouch) {
        return true;
      } // include the 'heartz' as a way to have a non matching MQ to help terminate the join
      // https://git.io/vznFH


      var query = ['(', prefixes.join('touch-enabled),('), 'heartz', ')'].join('');
      return mq(query);
    },
    manualScroller: {
      obj: null,
      init: function init() {
        var scroll_theme = $('.main-menu').hasClass('menu-dark') ? 'light' : 'dark';

        if (!$.app.menu.is_touch_device()) {
          this.obj = new PerfectScrollbar('.main-menu-content', {
            suppressScrollX: true,
            wheelPropagation: false
          });
        } else {
          $('.main-menu').addClass('menu-native-scroll');
        }
      },
      update: function update() {
        // if (this.obj) {
        // Scroll to currently active menu on page load if data-scroll-to-active is true
        if ($('.main-menu').data('scroll-to-active') === true) {
          var activeEl, menu, activeElHeight;
          activeEl = document.querySelector('.main-menu-content li.active');
          menu = document.querySelector('.main-menu-content');

          if ($body.hasClass('menu-collapsed')) {
            if ($('.main-menu-content li.sidebar-group-active').length) {
              activeEl = document.querySelector('.main-menu-content li.sidebar-group-active');
            }
          }

          if (activeEl) {
            activeElHeight = activeEl.getBoundingClientRect().top + menu.scrollTop;
          } // If active element's top position is less than 2/3 (66%) of menu height than do not scroll


          if (activeElHeight > parseInt(menu.clientHeight * 2 / 3)) {
            var start = menu.scrollTop,
                change = activeElHeight - start - parseInt(menu.clientHeight / 2);
          }

          setTimeout(function () {
            $.app.menu.container.stop().animate({
              scrollTop: change
            }, 300);
            $('.main-menu').data('scroll-to-active', 'false');
          }, 300);
        } // this.obj.update();
        // }

      },
      enable: function enable() {
        if (!$('.main-menu-content').hasClass('ps')) {
          this.init();
        }
      },
      disable: function disable() {
        if (this.obj) {
          this.obj.destroy();
        }
      },
      updateHeight: function updateHeight() {
        if (($body.data('menu') == 'vertical-menu' || $body.data('menu') == 'vertical-menu-modern' || $body.data('menu') == 'vertical-overlay-menu') && $('.main-menu').hasClass('menu-fixed')) {
          $('.main-menu-content').css('height', $(window).height() - $('.header-navbar').height() - $('.main-menu-header').outerHeight() - $('.main-menu-footer').outerHeight());
          this.update();
        }
      }
    },
    init: function init(compactMenu) {
      if ($('.main-menu-content').length > 0) {
        this.container = $('.main-menu-content');
        var menuObj = this;
        this.change(compactMenu);
      }
    },
    change: function change(compactMenu) {
      var currentBreakpoint = Unison.fetch.now(); // Current Breakpoint

      this.reset();
      var menuType = $body.data('menu');

      if (currentBreakpoint) {
        switch (currentBreakpoint.name) {
          case 'xl':
            if (menuType === 'vertical-overlay-menu') {
              this.hide();
            } else {
              if (compactMenu === true) this.collapse(compactMenu);else this.expand();
            }

            break;

          case 'lg':
            if (menuType === 'vertical-overlay-menu' || menuType === 'vertical-menu-modern' || menuType === 'horizontal-menu') {
              this.hide();
            } else {
              this.collapse();
            }

            break;

          case 'md':
          case 'sm':
            this.hide();
            break;

          case 'xs':
            this.hide();
            break;
        }
      } // On the small and extra small screen make them overlay menu


      if (menuType === 'vertical-menu' || menuType === 'vertical-menu-modern') {
        this.toOverlayMenu(currentBreakpoint.name, menuType);
      }

      if ($body.is('.horizontal-layout') && !$body.hasClass('.horizontal-menu-demo')) {
        this.changeMenu(currentBreakpoint.name);
        $('.menu-toggle').removeClass('is-active');
      } // Dropdown submenu on large screen on hover For Large screen only
      // ---------------------------------------------------------------


      if (currentBreakpoint.name == 'xl') {
        $('body[data-open="hover"] .main-menu-content .dropdown') // Use selector $('body[data-open="hover"] .header-navbar .dropdown') for menu and navbar DD open on hover
        .on('mouseenter', function () {
          if (!$(this).hasClass('show')) {
            $(this).addClass('show');
          } else {
            $(this).removeClass('show');
          }
        }).on('mouseleave', function (event) {
          $(this).removeClass('show');
        });
        /* ? Uncomment to enable all DD open on hover
        $('body[data-open="hover"] .dropdown a').on('click', function (e) {
          if (menuType == 'horizontal-menu') {
            var $this = $(this);
            if ($this.hasClass('dropdown-toggle')) {
              return false;
            }
          }
        });
        */
      } // Added data attribute brand-center for navbar-brand-center


      if (currentBreakpoint.name == 'sm' || currentBreakpoint.name == 'xs') {
        $('.header-navbar[data-nav=brand-center]').removeClass('navbar-brand-center');
      } else {
        $('.header-navbar[data-nav=brand-center]').addClass('navbar-brand-center');
      } // On screen width change, current active menu in horizontal


      if (currentBreakpoint.name == 'xl' && menuType == 'horizontal-menu') {
        $('.main-menu-content').find('li.active').parents('li').addClass('sidebar-group-active active');
      }

      if (currentBreakpoint.name !== 'xl' && menuType == 'horizontal-menu') {
        $('#navbar-type').toggleClass('d-none d-xl-block');
      } // Dropdown submenu on small screen on click
      // --------------------------------------------------


      $('ul.dropdown-menu [data-bs-toggle=dropdown]').on('click', function (event) {
        if ($(this).siblings('ul.dropdown-menu').length > 0) {
          event.preventDefault();
        }

        event.stopPropagation();
        $(this).parent().siblings().removeClass('show');
        $(this).parent().toggleClass('show');
      }); // Horizontal layout submenu drawer scrollbar

      if (menuType == 'horizontal-menu') {
        $('li.dropdown-submenu').on('mouseenter', function () {
          if (!$(this).parent('.dropdown').hasClass('show')) {
            $(this).removeClass('openLeft');
          }

          var dd = $(this).find('.dropdown-menu');

          if (dd) {
            var pageHeight = $(window).height(),
                // ddTop = dd.offset().top,
            ddTop = $(this).position().top,
                ddLeft = dd.offset().left,
                ddWidth = dd.width(),
                ddHeight = dd.height();

            if (pageHeight - ddTop - ddHeight - 28 < 1) {
              var maxHeight = pageHeight - ddTop - 170;
              $(this).find('.dropdown-menu').css({
                'max-height': maxHeight + 'px',
                'overflow-y': 'auto',
                'overflow-x': 'hidden'
              });
              var menu_content = new PerfectScrollbar('li.dropdown-submenu.show .dropdown-menu', {
                wheelPropagation: false
              });
            } // Add class to horizontal sub menu if screen width is small


            if (ddLeft + ddWidth - (window.innerWidth - 16) >= 0) {
              $(this).addClass('openLeft');
            }
          }
        });
        $('.theme-layouts').find('.semi-dark').hide();
      } // Horizontal Fixed Nav Sticky hight issue on small screens
      // if (menuType == 'horizontal-menu') {
      //   if (currentBreakpoint.name == 'sm' || currentBreakpoint.name == 'xs') {
      //     if ($(".menu-fixed").length) {
      //       $(".menu-fixed").unstick();
      //     }
      //   }
      //   else {
      //     if ($(".navbar-fixed").length) {
      //       $(".navbar-fixed").sticky();
      //     }
      //   }
      // }

    },
    transit: function transit(callback1, callback2) {
      var menuObj = this;
      $body.addClass('changing-menu');
      callback1.call(menuObj);

      if ($body.hasClass('vertical-layout')) {
        if ($body.hasClass('menu-open') || $body.hasClass('menu-expanded')) {
          $('.menu-toggle').addClass('is-active'); // Show menu header search when menu is normally visible

          if ($body.data('menu') === 'vertical-menu') {
            if ($('.main-menu-header')) {
              $('.main-menu-header').show();
            }
          }
        } else {
          $('.menu-toggle').removeClass('is-active'); // Hide menu header search when only menu icons are visible

          if ($body.data('menu') === 'vertical-menu') {
            if ($('.main-menu-header')) {
              $('.main-menu-header').hide();
            }
          }
        }
      }

      setTimeout(function () {
        callback2.call(menuObj);
        $body.removeClass('changing-menu');
        menuObj.update();
      }, 500);
    },
    open: function open() {
      this.transit(function () {
        $body.removeClass('menu-hide menu-collapsed').addClass('menu-open');
        this.hidden = false;
        this.expanded = true;

        if ($body.hasClass('vertical-overlay-menu')) {
          $('.sidenav-overlay').addClass('show'); // $('.sidenav-overlay').removeClass('d-none').addClass('d-block');
          // $('body').css('overflow', 'hidden');
        }
      }, function () {
        if (!$('.main-menu').hasClass('menu-native-scroll') && $('.main-menu').hasClass('menu-fixed')) {
          this.manualScroller.enable();
          $('.main-menu-content').css('height', $(window).height() - $('.header-navbar').height() - $('.main-menu-header').outerHeight() - $('.main-menu-footer').outerHeight()); // this.manualScroller.update();
        }

        if (!$body.hasClass('vertical-overlay-menu')) {
          $('.sidenav-overlay').removeClass('show'); // $('.sidenav-overlay').removeClass('d-block d-none');
          // $('body').css('overflow', 'auto');
        }
      });
    },
    hide: function hide() {
      this.transit(function () {
        $body.removeClass('menu-open menu-expanded').addClass('menu-hide');
        this.hidden = true;
        this.expanded = false;

        if ($body.hasClass('vertical-overlay-menu')) {
          $('.sidenav-overlay').removeClass('show'); // $('.sidenav-overlay').removeClass('d-block').addClass('d-none');
          // $('body').css('overflow', 'auto');
        }
      }, function () {
        if (!$('.main-menu').hasClass('menu-native-scroll') && $('.main-menu').hasClass('menu-fixed')) {
          this.manualScroller.enable();
        }

        if (!$body.hasClass('vertical-overlay-menu')) {
          $('.sidenav-overlay').removeClass('show'); // $('.sidenav-overlay').removeClass('d-block d-none');
          // $('body').css('overflow', 'auto');
        }
      });
    },
    expand: function expand() {
      if (this.expanded === false) {
        if ($body.data('menu') == 'vertical-menu-modern') {
          $('.modern-nav-toggle').find('.collapse-toggle-icon').replaceWith(feather.icons['disc'].toSvg({
            "class": 'd-none d-xl-block collapse-toggle-icon primary font-medium-4'
          }));
        }

        this.transit(function () {
          $body.removeClass('menu-collapsed').addClass('menu-expanded');
          this.collapsed = false;
          this.expanded = true;
          $('.sidenav-overlay').removeClass('show'); // $('.sidenav-overlay').removeClass('d-block d-none');
        }, function () {
          if ($('.main-menu').hasClass('menu-native-scroll') || $body.data('menu') == 'horizontal-menu') {
            this.manualScroller.disable();
          } else {
            if ($('.main-menu').hasClass('menu-fixed')) this.manualScroller.enable();
          }

          if (($body.data('menu') == 'vertical-menu' || $body.data('menu') == 'vertical-menu-modern') && $('.main-menu').hasClass('menu-fixed')) {
            $('.main-menu-content').css('height', $(window).height() - $('.header-navbar').height() - $('.main-menu-header').outerHeight() - $('.main-menu-footer').outerHeight()); // this.manualScroller.update();
          }
        });
      }
    },
    collapse: function collapse() {
      if (this.collapsed === false) {
        if ($body.data('menu') == 'vertical-menu-modern') {
          $('.modern-nav-toggle').find('.collapse-toggle-icon').replaceWith(feather.icons['circle'].toSvg({
            "class": 'd-none d-xl-block collapse-toggle-icon primary font-medium-4'
          }));
        }

        this.transit(function () {
          $body.removeClass('menu-expanded').addClass('menu-collapsed');
          this.collapsed = true;
          this.expanded = false;
          $('.content-overlay').removeClass('d-block d-none');
        }, function () {
          if ($body.data('menu') == 'horizontal-menu' && $body.hasClass('vertical-overlay-menu')) {
            if ($('.main-menu').hasClass('menu-fixed')) this.manualScroller.enable();
          }

          if (($body.data('menu') == 'vertical-menu' || $body.data('menu') == 'vertical-menu-modern') && $('.main-menu').hasClass('menu-fixed')) {
            $('.main-menu-content').css('height', $(window).height() - $('.header-navbar').height()); // this.manualScroller.update();
          }

          if ($body.data('menu') == 'vertical-menu-modern') {
            if ($('.main-menu').hasClass('menu-fixed')) this.manualScroller.enable();
          }
        });
      }
    },
    toOverlayMenu: function toOverlayMenu(screen, menuType) {
      var menu = $body.data('menu');

      if (menuType == 'vertical-menu-modern') {
        if (screen == 'lg' || screen == 'md' || screen == 'sm' || screen == 'xs') {
          if ($body.hasClass(menu)) {
            $body.removeClass(menu).addClass('vertical-overlay-menu');
          }
        } else {
          if ($body.hasClass('vertical-overlay-menu')) {
            $body.removeClass('vertical-overlay-menu').addClass(menu);
          }
        }
      } else {
        if (screen == 'sm' || screen == 'xs') {
          if ($body.hasClass(menu)) {
            $body.removeClass(menu).addClass('vertical-overlay-menu');
          }
        } else {
          if ($body.hasClass('vertical-overlay-menu')) {
            $body.removeClass('vertical-overlay-menu').addClass(menu);
          }
        }
      }
    },
    changeMenu: function changeMenu(screen) {
      // Replace menu html
      $('div[data-menu="menu-wrapper"]').html('');
      $('div[data-menu="menu-wrapper"]').html(menuWrapper_el);
      var menuWrapper = $('div[data-menu="menu-wrapper"]'),
          menuContainer = $('div[data-menu="menu-container"]'),
          menuNavigation = $('ul[data-menu="menu-navigation"]'),

      /*megaMenu           = $('li[data-menu="megamenu"]'),
      megaMenuCol        = $('li[data-mega-col]'),*/
      dropdownMenu = $('li[data-menu="dropdown"]'),
          dropdownSubMenu = $('li[data-menu="dropdown-submenu"]');

      if (screen === 'xl') {
        // Change body classes
        $body.removeClass('vertical-layout vertical-overlay-menu fixed-navbar').addClass($body.data('menu')); // Remove navbar-fix-top class on large screens

        $('nav.header-navbar').removeClass('fixed-top'); // Change menu wrapper, menu container, menu navigation classes

        menuWrapper.removeClass().addClass(menuWrapperClasses);
        $('a.dropdown-item.nav-has-children').on('click', function () {
          event.preventDefault();
          event.stopPropagation();
        });
        $('a.dropdown-item.nav-has-parent').on('click', function () {
          event.preventDefault();
          event.stopPropagation();
        });
      } else {
        // Change body classes
        $body.removeClass($body.data('menu')).addClass('vertical-layout vertical-overlay-menu fixed-navbar'); // Add navbar-fix-top class on small screens

        $('nav.header-navbar').addClass('fixed-top'); // Change menu wrapper, menu container, menu navigation classes

        menuWrapper.removeClass().addClass('main-menu menu-light menu-fixed menu-shadow'); // menuContainer.removeClass().addClass('main-menu-content');

        menuNavigation.removeClass().addClass('navigation navigation-main'); // If Dropdown Menu

        dropdownMenu.removeClass('dropdown').addClass('has-sub');
        dropdownMenu.find('a').removeClass('dropdown-toggle nav-link');
        dropdownMenu.find('a').attr('data-bs-toggle', '');
        dropdownMenu.children('ul').find('a').removeClass('dropdown-item');
        dropdownMenu.find('ul').removeClass('dropdown-menu');
        dropdownSubMenu.removeClass().addClass('has-sub');
        $.app.nav.init(); // Dropdown submenu on small screen on click
        // --------------------------------------------------

        $('ul.dropdown-menu [data-bs-toggle=dropdown]').on('click', function (event) {
          event.preventDefault();
          event.stopPropagation();
          $(this).parent().siblings().removeClass('open');
          $(this).parent().toggleClass('open');
        });
        $('.main-menu-content').find('li.active').parents('li').addClass('sidebar-group-active');
        $('.main-menu-content').find('li.active').closest('li.nav-item').addClass('open');
      }

      if (feather) {
        feather.replace({
          width: 14,
          height: 14
        });
      }
    },
    toggle: function toggle() {
      var currentBreakpoint = Unison.fetch.now(); // Current Breakpoint

      var collapsed = this.collapsed;
      var expanded = this.expanded;
      var hidden = this.hidden;
      var menu = $body.data('menu');

      switch (currentBreakpoint.name) {
        case 'xl':
          if (expanded === true) {
            if (menu == 'vertical-overlay-menu') {
              this.hide();
            } else {
              this.collapse();
            }
          } else {
            if (menu == 'vertical-overlay-menu') {
              this.open();
            } else {
              this.expand();
            }
          }

          break;

        case 'lg':
          if (expanded === true) {
            if (menu == 'vertical-overlay-menu' || menu == 'vertical-menu-modern' || menu == 'horizontal-menu') {
              this.hide();
            } else {
              this.collapse();
            }
          } else {
            if (menu == 'vertical-overlay-menu' || menu == 'vertical-menu-modern' || menu == 'horizontal-menu') {
              this.open();
            } else {
              this.expand();
            }
          }

          break;

        case 'md':
        case 'sm':
          if (hidden === true) {
            this.open();
          } else {
            this.hide();
          }

          break;

        case 'xs':
          if (hidden === true) {
            this.open();
          } else {
            this.hide();
          }

          break;
      }
    },
    update: function update() {
      this.manualScroller.update();
    },
    reset: function reset() {
      this.expanded = false;
      this.collapsed = false;
      this.hidden = false;
      $body.removeClass('menu-hide menu-open menu-collapsed menu-expanded');
    }
  }; // Navigation Menu

  $.app.nav = {
    container: $('.navigation-main'),
    initialized: false,
    navItem: $('.navigation-main').find('li').not('.navigation-category'),
    TRANSITION_EVENTS: ['transitionend', 'webkitTransitionEnd', 'oTransitionEnd'],
    TRANSITION_PROPERTIES: ['transition', 'MozTransition', 'webkitTransition', 'WebkitTransition', 'OTransition'],
    config: {
      speed: 300
    },
    init: function init(config) {
      this.initialized = true; // Set to true when initialized

      $.extend(this.config, config);
      this.bind_events();
    },
    bind_events: function bind_events() {
      var menuObj = this;
      $('.navigation-main').on('mouseenter.app.menu', 'li', function () {
        var $this = $(this); // $('.hover', '.navigation-main').removeClass('hover');

        if ($body.hasClass('menu-collapsed') && $body.data('menu') != 'vertical-menu-modern') {
          $('.main-menu-content').children('span.menu-title').remove();
          $('.main-menu-content').children('a.menu-title').remove();
          $('.main-menu-content').children('ul.menu-content').remove(); // Title

          var menuTitle = $this.find('span.menu-title').clone(),
              tempTitle,
              tempLink;

          if (!$this.hasClass('has-sub')) {
            tempTitle = $this.find('span.menu-title').text();
            tempLink = $this.children('a').attr('href');

            if (tempTitle !== '') {
              menuTitle = $('<a>');
              menuTitle.attr('href', tempLink);
              menuTitle.attr('title', tempTitle);
              menuTitle.text(tempTitle);
              menuTitle.addClass('menu-title');
            }
          } // menu_header_height = ($('.main-menu-header').length) ? $('.main-menu-header').height() : 0,
          // fromTop = menu_header_height + $this.position().top + parseInt($this.css( "border-top" ),10);


          var fromTop;

          if ($this.css('border-top')) {
            fromTop = $this.position().top + parseInt($this.css('border-top'), 10);
          } else {
            fromTop = $this.position().top;
          }

          if ($body.data('menu') !== 'vertical-compact-menu') {
            menuTitle.appendTo('.main-menu-content').css({
              position: 'fixed',
              top: fromTop
            });
          } // Content

          /* if ($this.hasClass('has-sub') && $this.hasClass('nav-item')) {
            var menuContent = $this.children('ul:first');
            menuObj.adjustSubmenu($this);
          } */

        } // $this.addClass('hover');

      }).on('mouseleave.app.menu', 'li', function () {// $(this).removeClass('hover');
      }).on('active.app.menu', 'li', function (e) {
        $(this).addClass('active');
        e.stopPropagation();
      }).on('deactive.app.menu', 'li.active', function (e) {
        $(this).removeClass('active');
        e.stopPropagation();
      }).on('open.app.menu', 'li', function (e) {
        var $listItem = $(this);
        menuObj.expand($listItem); // $listItem.addClass('open');
        // If menu collapsible then do not take any action

        if ($('.main-menu').hasClass('menu-collapsible')) {
          return false;
        } // If menu accordion then close all except clicked once
        else {
          $listItem.siblings('.open').find('li.open').trigger('close.app.menu');
          $listItem.siblings('.open').trigger('close.app.menu');
        }

        e.stopPropagation();
      }).on('close.app.menu', 'li.open', function (e) {
        var $listItem = $(this);
        menuObj.collapse($listItem); // $listItem.removeClass('open');

        e.stopPropagation();
      }).on('click.app.menu', 'li', function (e) {
        var $listItem = $(this);

        if ($listItem.is('.disabled')) {
          e.preventDefault();
        } else {
          if ($body.hasClass('menu-collapsed') && $body.data('menu') != 'vertical-menu-modern') {
            e.preventDefault();
          } else {
            if ($listItem.has('ul').length) {
              if ($listItem.is('.open')) {
                $listItem.trigger('close.app.menu');
              } else {
                $listItem.trigger('open.app.menu');
              }
            } else {
              if (!$listItem.is('.active')) {
                $listItem.siblings('.active').trigger('deactive.app.menu');
                $listItem.trigger('active.app.menu');
              }
            }
          }
        }

        e.stopPropagation();
      });
      $('.navbar-header, .main-menu').on('mouseenter', modernMenuExpand).on('mouseleave', modernMenuCollapse);

      function modernMenuExpand() {
        if ($body.data('menu') == 'vertical-menu-modern') {
          $('.main-menu, .navbar-header').addClass('expanded');

          if ($body.hasClass('menu-collapsed')) {
            if ($('.main-menu li.open').length === 0) {
              $('.main-menu-content').find('li.active').parents('li').addClass('open');
            }

            var $listItem = $('.main-menu li.menu-collapsed-open'),
                $subList = $listItem.children('ul');
            $subList.hide().slideDown(200, function () {
              $(this).css('display', '');
            });
            $listItem.addClass('open').removeClass('menu-collapsed-open'); // $.app.menu.changeLogo('expand');
          }
        }
      }

      function modernMenuCollapse() {
        if ($body.hasClass('menu-collapsed') && $body.data('menu') == 'vertical-menu-modern') {
          setTimeout(function () {
            if ($('.main-menu:hover').length === 0 && $('.navbar-header:hover').length === 0) {
              $('.main-menu, .navbar-header').removeClass('expanded');

              if ($body.hasClass('menu-collapsed')) {
                var $listItem = $('.main-menu li.open'),
                    $subList = $listItem.children('ul');
                $listItem.addClass('menu-collapsed-open');
                $subList.show().slideUp(200, function () {
                  $(this).css('display', '');
                });
                $listItem.removeClass('open'); // $.app.menu.changeLogo();
              }
            }
          }, 1);
        }
      }

      $('.main-menu-content').on('mouseleave', function () {
        if ($body.hasClass('menu-collapsed')) {
          $('.main-menu-content').children('span.menu-title').remove();
          $('.main-menu-content').children('a.menu-title').remove();
          $('.main-menu-content').children('ul.menu-content').remove();
        }

        $('.hover', '.navigation-main').removeClass('hover');
      }); // If list item has sub menu items then prevent redirection.

      $('.navigation-main li.has-sub > a').on('click', function (e) {
        e.preventDefault();
      });
    },

    /**
     * Ensure an admin submenu is within the visual viewport.
     * @param {jQuery} $menuItem The parent menu item containing the submenu.
     */

    /* adjustSubmenu: function ($menuItem) {
      var menuHeaderHeight,
        menutop,
        topPos,
        winHeight,
        bottomOffset,
        subMenuHeight,
        popOutMenuHeight,
        borderWidth,
        scroll_theme,
        $submenu = $menuItem.children('ul:first'),
        ul = $submenu.clone(true);
       menuHeaderHeight = $('.main-menu-header').height();
      menutop = $menuItem.position().top;
      winHeight = $window.height() - $('.header-navbar').height();
      borderWidth = 0;
      subMenuHeight = $submenu.height();
       if (parseInt($menuItem.css('border-top'), 10) > 0) {
        borderWidth = parseInt($menuItem.css('border-top'), 10);
      }
       popOutMenuHeight = winHeight - menutop - $menuItem.height() - 30;
      scroll_theme = $('.main-menu').hasClass('menu-dark') ? 'light' : 'dark';
       topPos = menutop + $menuItem.height() + borderWidth;
       ul.addClass('menu-popout').appendTo('.main-menu-content').css({
        top: topPos,
        position: 'fixed',
        'max-height': popOutMenuHeight
      });
       var menu_content = new PerfectScrollbar('.main-menu-content > ul.menu-content', {
        wheelPropagation: false
      });
    }, */
    // Collapse Submenu With Transition (Height animation)
    collapse: function collapse($listItem, callback) {
      var subList = $listItem.children('ul'),
          toggleLink = $listItem.children().first(),
          linkHeight = $(toggleLink).outerHeight();
      $listItem.css({
        height: linkHeight + subList.outerHeight() + 'px',
        overflow: 'hidden'
      });
      $listItem.addClass('menu-item-animating');
      $listItem.addClass('menu-item-closing');

      $.app.nav._bindAnimationEndEvent($listItem, function () {
        $listItem.removeClass('open');

        $.app.nav._clearItemStyle($listItem);
      });

      setTimeout(function () {
        $listItem.css({
          height: linkHeight + 'px'
        });
      }, 50);
    },
    // Expand Submenu With Transition (Height animation)
    expand: function expand($listItem, callback) {
      var subList = $listItem.children('ul'),
          toggleLink = $listItem.children().first(),
          linkHeight = $(toggleLink).outerHeight();
      $listItem.addClass('menu-item-animating');
      $listItem.css({
        overflow: 'hidden',
        height: linkHeight + 'px'
      });
      $listItem.addClass('open');

      $.app.nav._bindAnimationEndEvent($listItem, function () {
        $.app.nav._clearItemStyle($listItem);
      });

      setTimeout(function () {
        $listItem.css({
          height: linkHeight + subList.outerHeight() + 'px'
        });
      }, 50);
    },
    _bindAnimationEndEvent: function _bindAnimationEndEvent(el, handler) {
      el = el[0];

      var cb = function cb(e) {
        if (e.target !== el) return;

        $.app.nav._unbindAnimationEndEvent(el);

        handler(e);
      };

      var duration = window.getComputedStyle(el).transitionDuration;
      duration = parseFloat(duration) * (duration.indexOf('ms') !== -1 ? 1 : 1000);
      el._menuAnimationEndEventCb = cb;
      $.app.nav.TRANSITION_EVENTS.forEach(function (ev) {
        el.addEventListener(ev, el._menuAnimationEndEventCb, false);
      });
      el._menuAnimationEndEventTimeout = setTimeout(function () {
        cb({
          target: el
        });
      }, duration + 50);
    },
    _unbindAnimationEndEvent: function _unbindAnimationEndEvent(el) {
      var cb = el._menuAnimationEndEventCb;

      if (el._menuAnimationEndEventTimeout) {
        clearTimeout(el._menuAnimationEndEventTimeout);
        el._menuAnimationEndEventTimeout = null;
      }

      if (!cb) return;
      $.app.nav.TRANSITION_EVENTS.forEach(function (ev) {
        el.removeEventListener(ev, cb, false);
      });
      el._menuAnimationEndEventCb = null;
    },
    _clearItemStyle: function _clearItemStyle($listItem) {
      $listItem.removeClass('menu-item-animating');
      $listItem.removeClass('menu-item-closing');
      $listItem.css({
        overflow: '',
        height: ''
      });
    },
    refresh: function refresh() {
      $.app.nav.container.find('.open').removeClass('open');
    }
  }; // On href=# click page refresh issue resolve
  //? User should remove this code for their project to enable # click

  $(document).on('click', 'a[href="#"]', function (e) {
    e.preventDefault();
  });
})(window, document, jQuery); // We listen to the resize event


window.addEventListener('resize', function () {
  // We execute the same script as before
  var vh = window.innerHeight * 0.01;
  document.documentElement.style.setProperty('--vh', vh + 'px');
});
/******/ })()
;
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiL2pzL2NvcmUvYXBwLW1lbnUuanMiLCJtYXBwaW5ncyI6Ijs7Ozs7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxDQUFDLFVBQVVBLE1BQVYsRUFBa0JDLFFBQWxCLEVBQTRCQyxDQUE1QixFQUErQjtBQUM5Qjs7QUFFQSxNQUFJQyxFQUFFLEdBQUdILE1BQU0sQ0FBQ0ksV0FBUCxHQUFxQixJQUE5QjtBQUNBSCxFQUFBQSxRQUFRLENBQUNJLGVBQVQsQ0FBeUJDLEtBQXpCLENBQStCQyxXQUEvQixDQUEyQyxNQUEzQyxFQUFtREosRUFBRSxHQUFHLElBQXhEO0FBRUFELEVBQUFBLENBQUMsQ0FBQ00sR0FBRixHQUFRTixDQUFDLENBQUNNLEdBQUYsSUFBUyxFQUFqQjtBQUVBLE1BQUlDLEtBQUssR0FBR1AsQ0FBQyxDQUFDLE1BQUQsQ0FBYjtBQUNBLE1BQUlRLE9BQU8sR0FBR1IsQ0FBQyxDQUFDRixNQUFELENBQWY7QUFDQSxNQUFJVyxjQUFjLEdBQUdULENBQUMsQ0FBQywrQkFBRCxDQUFELENBQW1DVSxJQUFuQyxFQUFyQjtBQUNBLE1BQUlDLGtCQUFrQixHQUFHWCxDQUFDLENBQUMsK0JBQUQsQ0FBRCxDQUFtQ1ksSUFBbkMsQ0FBd0MsT0FBeEMsQ0FBekIsQ0FYOEIsQ0FhOUI7O0FBQ0FaLEVBQUFBLENBQUMsQ0FBQ00sR0FBRixDQUFNTyxJQUFOLEdBQWE7QUFDWEMsSUFBQUEsUUFBUSxFQUFFLElBREM7QUFFWEMsSUFBQUEsU0FBUyxFQUFFLElBRkE7QUFHWEMsSUFBQUEsTUFBTSxFQUFFLElBSEc7QUFJWEMsSUFBQUEsU0FBUyxFQUFFLElBSkE7QUFLWEMsSUFBQUEsY0FBYyxFQUFFLEtBTEw7QUFPWEMsSUFBQUEsZUFBZSxFQUFFLDJCQUFZO0FBQzNCLFVBQUlDLFFBQVEsR0FBRyw0QkFBNEJDLEtBQTVCLENBQWtDLEdBQWxDLENBQWY7O0FBQ0EsVUFBSUMsRUFBRSxHQUFHLFNBQUxBLEVBQUssQ0FBVUMsS0FBVixFQUFpQjtBQUN4QixlQUFPekIsTUFBTSxDQUFDMEIsVUFBUCxDQUFrQkQsS0FBbEIsRUFBeUJFLE9BQWhDO0FBQ0QsT0FGRDs7QUFHQSxVQUFJLGtCQUFrQjNCLE1BQWxCLElBQTZCQSxNQUFNLENBQUM0QixhQUFQLElBQXdCM0IsUUFBUSxZQUFZMkIsYUFBN0UsRUFBNkY7QUFDM0YsZUFBTyxJQUFQO0FBQ0QsT0FQMEIsQ0FRM0I7QUFDQTs7O0FBQ0EsVUFBSUgsS0FBSyxHQUFHLENBQUMsR0FBRCxFQUFNSCxRQUFRLENBQUNPLElBQVQsQ0FBYyxrQkFBZCxDQUFOLEVBQXlDLFFBQXpDLEVBQW1ELEdBQW5ELEVBQXdEQSxJQUF4RCxDQUE2RCxFQUE3RCxDQUFaO0FBQ0EsYUFBT0wsRUFBRSxDQUFDQyxLQUFELENBQVQ7QUFDRCxLQW5CVTtBQXFCWEssSUFBQUEsY0FBYyxFQUFFO0FBQ2RDLE1BQUFBLEdBQUcsRUFBRSxJQURTO0FBR2RDLE1BQUFBLElBQUksRUFBRSxnQkFBWTtBQUNoQixZQUFJQyxZQUFZLEdBQUcvQixDQUFDLENBQUMsWUFBRCxDQUFELENBQWdCZ0MsUUFBaEIsQ0FBeUIsV0FBekIsSUFBd0MsT0FBeEMsR0FBa0QsTUFBckU7O0FBQ0EsWUFBSSxDQUFDaEMsQ0FBQyxDQUFDTSxHQUFGLENBQU1PLElBQU4sQ0FBV00sZUFBWCxFQUFMLEVBQW1DO0FBQ2pDLGVBQUtVLEdBQUwsR0FBVyxJQUFJSSxnQkFBSixDQUFxQixvQkFBckIsRUFBMkM7QUFDcERDLFlBQUFBLGVBQWUsRUFBRSxJQURtQztBQUVwREMsWUFBQUEsZ0JBQWdCLEVBQUU7QUFGa0MsV0FBM0MsQ0FBWDtBQUlELFNBTEQsTUFLTztBQUNMbkMsVUFBQUEsQ0FBQyxDQUFDLFlBQUQsQ0FBRCxDQUFnQm9DLFFBQWhCLENBQXlCLG9CQUF6QjtBQUNEO0FBQ0YsT0FiYTtBQWVkQyxNQUFBQSxNQUFNLEVBQUUsa0JBQVk7QUFDbEI7QUFDQTtBQUNBLFlBQUlyQyxDQUFDLENBQUMsWUFBRCxDQUFELENBQWdCc0MsSUFBaEIsQ0FBcUIsa0JBQXJCLE1BQTZDLElBQWpELEVBQXVEO0FBQ3JELGNBQUlDLFFBQUosRUFBYzFCLElBQWQsRUFBb0IyQixjQUFwQjtBQUNBRCxVQUFBQSxRQUFRLEdBQUd4QyxRQUFRLENBQUMwQyxhQUFULENBQXVCLDhCQUF2QixDQUFYO0FBQ0E1QixVQUFBQSxJQUFJLEdBQUdkLFFBQVEsQ0FBQzBDLGFBQVQsQ0FBdUIsb0JBQXZCLENBQVA7O0FBQ0EsY0FBSWxDLEtBQUssQ0FBQ3lCLFFBQU4sQ0FBZSxnQkFBZixDQUFKLEVBQXNDO0FBQ3BDLGdCQUFJaEMsQ0FBQyxDQUFDLDRDQUFELENBQUQsQ0FBZ0QwQyxNQUFwRCxFQUE0RDtBQUMxREgsY0FBQUEsUUFBUSxHQUFHeEMsUUFBUSxDQUFDMEMsYUFBVCxDQUF1Qiw0Q0FBdkIsQ0FBWDtBQUNEO0FBQ0Y7O0FBQ0QsY0FBSUYsUUFBSixFQUFjO0FBQ1pDLFlBQUFBLGNBQWMsR0FBR0QsUUFBUSxDQUFDSSxxQkFBVCxHQUFpQ0MsR0FBakMsR0FBdUMvQixJQUFJLENBQUNnQyxTQUE3RDtBQUNELFdBWG9ELENBYXJEOzs7QUFDQSxjQUFJTCxjQUFjLEdBQUdNLFFBQVEsQ0FBRWpDLElBQUksQ0FBQ2tDLFlBQUwsR0FBb0IsQ0FBckIsR0FBMEIsQ0FBM0IsQ0FBN0IsRUFBNEQ7QUFDMUQsZ0JBQUlDLEtBQUssR0FBR25DLElBQUksQ0FBQ2dDLFNBQWpCO0FBQUEsZ0JBQ0VJLE1BQU0sR0FBR1QsY0FBYyxHQUFHUSxLQUFqQixHQUF5QkYsUUFBUSxDQUFDakMsSUFBSSxDQUFDa0MsWUFBTCxHQUFvQixDQUFyQixDQUQ1QztBQUVEOztBQUNERyxVQUFBQSxVQUFVLENBQUMsWUFBWTtBQUNyQmxELFlBQUFBLENBQUMsQ0FBQ00sR0FBRixDQUFNTyxJQUFOLENBQVdJLFNBQVgsQ0FBcUJrQyxJQUFyQixHQUE0QkMsT0FBNUIsQ0FDRTtBQUNFUCxjQUFBQSxTQUFTLEVBQUVJO0FBRGIsYUFERixFQUlFLEdBSkY7QUFNQWpELFlBQUFBLENBQUMsQ0FBQyxZQUFELENBQUQsQ0FBZ0JzQyxJQUFoQixDQUFxQixrQkFBckIsRUFBeUMsT0FBekM7QUFDRCxXQVJTLEVBUVAsR0FSTyxDQUFWO0FBU0QsU0E5QmlCLENBK0JsQjtBQUNBOztBQUNELE9BaERhO0FBa0RkZSxNQUFBQSxNQUFNLEVBQUUsa0JBQVk7QUFDbEIsWUFBSSxDQUFDckQsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0JnQyxRQUF4QixDQUFpQyxJQUFqQyxDQUFMLEVBQTZDO0FBQzNDLGVBQUtGLElBQUw7QUFDRDtBQUNGLE9BdERhO0FBd0Rkd0IsTUFBQUEsT0FBTyxFQUFFLG1CQUFZO0FBQ25CLFlBQUksS0FBS3pCLEdBQVQsRUFBYztBQUNaLGVBQUtBLEdBQUwsQ0FBUzBCLE9BQVQ7QUFDRDtBQUNGLE9BNURhO0FBOERkQyxNQUFBQSxZQUFZLEVBQUUsd0JBQVk7QUFDeEIsWUFDRSxDQUFDakQsS0FBSyxDQUFDK0IsSUFBTixDQUFXLE1BQVgsS0FBc0IsZUFBdEIsSUFDQy9CLEtBQUssQ0FBQytCLElBQU4sQ0FBVyxNQUFYLEtBQXNCLHNCQUR2QixJQUVDL0IsS0FBSyxDQUFDK0IsSUFBTixDQUFXLE1BQVgsS0FBc0IsdUJBRnhCLEtBR0F0QyxDQUFDLENBQUMsWUFBRCxDQUFELENBQWdCZ0MsUUFBaEIsQ0FBeUIsWUFBekIsQ0FKRixFQUtFO0FBQ0FoQyxVQUFBQSxDQUFDLENBQUMsb0JBQUQsQ0FBRCxDQUF3QnlELEdBQXhCLENBQ0UsUUFERixFQUVFekQsQ0FBQyxDQUFDRixNQUFELENBQUQsQ0FBVTRELE1BQVYsS0FDRTFELENBQUMsQ0FBQyxnQkFBRCxDQUFELENBQW9CMEQsTUFBcEIsRUFERixHQUVFMUQsQ0FBQyxDQUFDLG1CQUFELENBQUQsQ0FBdUIyRCxXQUF2QixFQUZGLEdBR0UzRCxDQUFDLENBQUMsbUJBQUQsQ0FBRCxDQUF1QjJELFdBQXZCLEVBTEo7QUFPQSxlQUFLdEIsTUFBTDtBQUNEO0FBQ0Y7QUE5RWEsS0FyQkw7QUFzR1hQLElBQUFBLElBQUksRUFBRSxjQUFVOEIsV0FBVixFQUF1QjtBQUMzQixVQUFJNUQsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0IwQyxNQUF4QixHQUFpQyxDQUFyQyxFQUF3QztBQUN0QyxhQUFLekIsU0FBTCxHQUFpQmpCLENBQUMsQ0FBQyxvQkFBRCxDQUFsQjtBQUVBLFlBQUk2RCxPQUFPLEdBQUcsSUFBZDtBQUVBLGFBQUtaLE1BQUwsQ0FBWVcsV0FBWjtBQUNEO0FBQ0YsS0E5R1U7QUFnSFhYLElBQUFBLE1BQU0sRUFBRSxnQkFBVVcsV0FBVixFQUF1QjtBQUM3QixVQUFJRSxpQkFBaUIsR0FBR0MsTUFBTSxDQUFDQyxLQUFQLENBQWFDLEdBQWIsRUFBeEIsQ0FENkIsQ0FDZTs7QUFFNUMsV0FBS0MsS0FBTDtBQUVBLFVBQUlDLFFBQVEsR0FBRzVELEtBQUssQ0FBQytCLElBQU4sQ0FBVyxNQUFYLENBQWY7O0FBRUEsVUFBSXdCLGlCQUFKLEVBQXVCO0FBQ3JCLGdCQUFRQSxpQkFBaUIsQ0FBQ00sSUFBMUI7QUFDRSxlQUFLLElBQUw7QUFDRSxnQkFBSUQsUUFBUSxLQUFLLHVCQUFqQixFQUEwQztBQUN4QyxtQkFBS0UsSUFBTDtBQUNELGFBRkQsTUFFTztBQUNMLGtCQUFJVCxXQUFXLEtBQUssSUFBcEIsRUFBMEIsS0FBS1UsUUFBTCxDQUFjVixXQUFkLEVBQTFCLEtBQ0ssS0FBS1csTUFBTDtBQUNOOztBQUNEOztBQUNGLGVBQUssSUFBTDtBQUNFLGdCQUNFSixRQUFRLEtBQUssdUJBQWIsSUFDQUEsUUFBUSxLQUFLLHNCQURiLElBRUFBLFFBQVEsS0FBSyxpQkFIZixFQUlFO0FBQ0EsbUJBQUtFLElBQUw7QUFDRCxhQU5ELE1BTU87QUFDTCxtQkFBS0MsUUFBTDtBQUNEOztBQUNEOztBQUNGLGVBQUssSUFBTDtBQUNBLGVBQUssSUFBTDtBQUNFLGlCQUFLRCxJQUFMO0FBQ0E7O0FBQ0YsZUFBSyxJQUFMO0FBQ0UsaUJBQUtBLElBQUw7QUFDQTtBQTFCSjtBQTRCRCxPQXBDNEIsQ0FzQzdCOzs7QUFDQSxVQUFJRixRQUFRLEtBQUssZUFBYixJQUFnQ0EsUUFBUSxLQUFLLHNCQUFqRCxFQUF5RTtBQUN2RSxhQUFLSyxhQUFMLENBQW1CVixpQkFBaUIsQ0FBQ00sSUFBckMsRUFBMkNELFFBQTNDO0FBQ0Q7O0FBRUQsVUFBSTVELEtBQUssQ0FBQ2tFLEVBQU4sQ0FBUyxvQkFBVCxLQUFrQyxDQUFDbEUsS0FBSyxDQUFDeUIsUUFBTixDQUFlLHVCQUFmLENBQXZDLEVBQWdGO0FBQzlFLGFBQUswQyxVQUFMLENBQWdCWixpQkFBaUIsQ0FBQ00sSUFBbEM7QUFFQXBFLFFBQUFBLENBQUMsQ0FBQyxjQUFELENBQUQsQ0FBa0IyRSxXQUFsQixDQUE4QixXQUE5QjtBQUNELE9BL0M0QixDQWlEN0I7QUFDQTs7O0FBQ0EsVUFBSWIsaUJBQWlCLENBQUNNLElBQWxCLElBQTBCLElBQTlCLEVBQW9DO0FBQ2xDcEUsUUFBQUEsQ0FBQyxDQUFDLHNEQUFELENBQUQsQ0FBMEQ7QUFBMUQsU0FDRzRFLEVBREgsQ0FDTSxZQUROLEVBQ29CLFlBQVk7QUFDNUIsY0FBSSxDQUFDNUUsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRZ0MsUUFBUixDQUFpQixNQUFqQixDQUFMLEVBQStCO0FBQzdCaEMsWUFBQUEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRb0MsUUFBUixDQUFpQixNQUFqQjtBQUNELFdBRkQsTUFFTztBQUNMcEMsWUFBQUEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRMkUsV0FBUixDQUFvQixNQUFwQjtBQUNEO0FBQ0YsU0FQSCxFQVFHQyxFQVJILENBUU0sWUFSTixFQVFvQixVQUFVQyxLQUFWLEVBQWlCO0FBQ2pDN0UsVUFBQUEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRMkUsV0FBUixDQUFvQixNQUFwQjtBQUNELFNBVkg7QUFXQTtBQUNSO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNPLE9BekU0QixDQTJFN0I7OztBQUVBLFVBQUliLGlCQUFpQixDQUFDTSxJQUFsQixJQUEwQixJQUExQixJQUFrQ04saUJBQWlCLENBQUNNLElBQWxCLElBQTBCLElBQWhFLEVBQXNFO0FBQ3BFcEUsUUFBQUEsQ0FBQyxDQUFDLHVDQUFELENBQUQsQ0FBMkMyRSxXQUEzQyxDQUF1RCxxQkFBdkQ7QUFDRCxPQUZELE1BRU87QUFDTDNFLFFBQUFBLENBQUMsQ0FBQyx1Q0FBRCxDQUFELENBQTJDb0MsUUFBM0MsQ0FBb0QscUJBQXBEO0FBQ0QsT0FqRjRCLENBa0Y3Qjs7O0FBQ0EsVUFBSTBCLGlCQUFpQixDQUFDTSxJQUFsQixJQUEwQixJQUExQixJQUFrQ0QsUUFBUSxJQUFJLGlCQUFsRCxFQUFxRTtBQUNuRW5FLFFBQUFBLENBQUMsQ0FBQyxvQkFBRCxDQUFELENBQXdCOEUsSUFBeEIsQ0FBNkIsV0FBN0IsRUFBMENDLE9BQTFDLENBQWtELElBQWxELEVBQXdEM0MsUUFBeEQsQ0FBaUUsNkJBQWpFO0FBQ0Q7O0FBRUQsVUFBSTBCLGlCQUFpQixDQUFDTSxJQUFsQixLQUEyQixJQUEzQixJQUFtQ0QsUUFBUSxJQUFJLGlCQUFuRCxFQUFzRTtBQUNwRW5FLFFBQUFBLENBQUMsQ0FBQyxjQUFELENBQUQsQ0FBa0JnRixXQUFsQixDQUE4QixtQkFBOUI7QUFDRCxPQXpGNEIsQ0EyRjdCO0FBQ0E7OztBQUNBaEYsTUFBQUEsQ0FBQyxDQUFDLDRDQUFELENBQUQsQ0FBZ0Q0RSxFQUFoRCxDQUFtRCxPQUFuRCxFQUE0RCxVQUFVQyxLQUFWLEVBQWlCO0FBQzNFLFlBQUk3RSxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFpRixRQUFSLENBQWlCLGtCQUFqQixFQUFxQ3ZDLE1BQXJDLEdBQThDLENBQWxELEVBQXFEO0FBQ25EbUMsVUFBQUEsS0FBSyxDQUFDSyxjQUFOO0FBQ0Q7O0FBQ0RMLFFBQUFBLEtBQUssQ0FBQ00sZUFBTjtBQUNBbkYsUUFBQUEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRb0YsTUFBUixHQUFpQkgsUUFBakIsR0FBNEJOLFdBQTVCLENBQXdDLE1BQXhDO0FBQ0EzRSxRQUFBQSxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFvRixNQUFSLEdBQWlCSixXQUFqQixDQUE2QixNQUE3QjtBQUNELE9BUEQsRUE3RjZCLENBc0c3Qjs7QUFDQSxVQUFJYixRQUFRLElBQUksaUJBQWhCLEVBQW1DO0FBQ2pDbkUsUUFBQUEsQ0FBQyxDQUFDLHFCQUFELENBQUQsQ0FBeUI0RSxFQUF6QixDQUE0QixZQUE1QixFQUEwQyxZQUFZO0FBQ3BELGNBQUksQ0FBQzVFLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUW9GLE1BQVIsQ0FBZSxXQUFmLEVBQTRCcEQsUUFBNUIsQ0FBcUMsTUFBckMsQ0FBTCxFQUFtRDtBQUNqRGhDLFlBQUFBLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUTJFLFdBQVIsQ0FBb0IsVUFBcEI7QUFDRDs7QUFDRCxjQUFJVSxFQUFFLEdBQUdyRixDQUFDLENBQUMsSUFBRCxDQUFELENBQVE4RSxJQUFSLENBQWEsZ0JBQWIsQ0FBVDs7QUFDQSxjQUFJTyxFQUFKLEVBQVE7QUFDTixnQkFBSUMsVUFBVSxHQUFHdEYsQ0FBQyxDQUFDRixNQUFELENBQUQsQ0FBVTRELE1BQVYsRUFBakI7QUFBQSxnQkFDRTtBQUNBNkIsWUFBQUEsS0FBSyxHQUFHdkYsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRd0YsUUFBUixHQUFtQjVDLEdBRjdCO0FBQUEsZ0JBR0U2QyxNQUFNLEdBQUdKLEVBQUUsQ0FBQ0ssTUFBSCxHQUFZQyxJQUh2QjtBQUFBLGdCQUlFQyxPQUFPLEdBQUdQLEVBQUUsQ0FBQ1EsS0FBSCxFQUpaO0FBQUEsZ0JBS0VDLFFBQVEsR0FBR1QsRUFBRSxDQUFDM0IsTUFBSCxFQUxiOztBQU1BLGdCQUFJNEIsVUFBVSxHQUFHQyxLQUFiLEdBQXFCTyxRQUFyQixHQUFnQyxFQUFoQyxHQUFxQyxDQUF6QyxFQUE0QztBQUMxQyxrQkFBSUMsU0FBUyxHQUFHVCxVQUFVLEdBQUdDLEtBQWIsR0FBcUIsR0FBckM7QUFDQXZGLGNBQUFBLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FDRzhFLElBREgsQ0FDUSxnQkFEUixFQUVHckIsR0FGSCxDQUVPO0FBQ0gsOEJBQWNzQyxTQUFTLEdBQUcsSUFEdkI7QUFFSCw4QkFBYyxNQUZYO0FBR0gsOEJBQWM7QUFIWCxlQUZQO0FBT0Esa0JBQUlDLFlBQVksR0FBRyxJQUFJL0QsZ0JBQUosQ0FBcUIseUNBQXJCLEVBQWdFO0FBQ2pGRSxnQkFBQUEsZ0JBQWdCLEVBQUU7QUFEK0QsZUFBaEUsQ0FBbkI7QUFHRCxhQW5CSyxDQW9CTjs7O0FBQ0EsZ0JBQUlzRCxNQUFNLEdBQUdHLE9BQVQsSUFBb0I5RixNQUFNLENBQUNtRyxVQUFQLEdBQW9CLEVBQXhDLEtBQStDLENBQW5ELEVBQXNEO0FBQ3BEakcsY0FBQUEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRb0MsUUFBUixDQUFpQixVQUFqQjtBQUNEO0FBQ0Y7QUFDRixTQTlCRDtBQStCQXBDLFFBQUFBLENBQUMsQ0FBQyxnQkFBRCxDQUFELENBQW9COEUsSUFBcEIsQ0FBeUIsWUFBekIsRUFBdUNULElBQXZDO0FBQ0QsT0F4STRCLENBMEk3QjtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFDRCxLQXZRVTtBQXlRWDZCLElBQUFBLE9BQU8sRUFBRSxpQkFBVUMsU0FBVixFQUFxQkMsU0FBckIsRUFBZ0M7QUFDdkMsVUFBSXZDLE9BQU8sR0FBRyxJQUFkO0FBQ0F0RCxNQUFBQSxLQUFLLENBQUM2QixRQUFOLENBQWUsZUFBZjtBQUVBK0QsTUFBQUEsU0FBUyxDQUFDRSxJQUFWLENBQWV4QyxPQUFmOztBQUVBLFVBQUl0RCxLQUFLLENBQUN5QixRQUFOLENBQWUsaUJBQWYsQ0FBSixFQUF1QztBQUNyQyxZQUFJekIsS0FBSyxDQUFDeUIsUUFBTixDQUFlLFdBQWYsS0FBK0J6QixLQUFLLENBQUN5QixRQUFOLENBQWUsZUFBZixDQUFuQyxFQUFvRTtBQUNsRWhDLFVBQUFBLENBQUMsQ0FBQyxjQUFELENBQUQsQ0FBa0JvQyxRQUFsQixDQUEyQixXQUEzQixFQURrRSxDQUdsRTs7QUFDQSxjQUFJN0IsS0FBSyxDQUFDK0IsSUFBTixDQUFXLE1BQVgsTUFBdUIsZUFBM0IsRUFBNEM7QUFDMUMsZ0JBQUl0QyxDQUFDLENBQUMsbUJBQUQsQ0FBTCxFQUE0QjtBQUMxQkEsY0FBQUEsQ0FBQyxDQUFDLG1CQUFELENBQUQsQ0FBdUJzRyxJQUF2QjtBQUNEO0FBQ0Y7QUFDRixTQVRELE1BU087QUFDTHRHLFVBQUFBLENBQUMsQ0FBQyxjQUFELENBQUQsQ0FBa0IyRSxXQUFsQixDQUE4QixXQUE5QixFQURLLENBR0w7O0FBQ0EsY0FBSXBFLEtBQUssQ0FBQytCLElBQU4sQ0FBVyxNQUFYLE1BQXVCLGVBQTNCLEVBQTRDO0FBQzFDLGdCQUFJdEMsQ0FBQyxDQUFDLG1CQUFELENBQUwsRUFBNEI7QUFDMUJBLGNBQUFBLENBQUMsQ0FBQyxtQkFBRCxDQUFELENBQXVCcUUsSUFBdkI7QUFDRDtBQUNGO0FBQ0Y7QUFDRjs7QUFFRG5CLE1BQUFBLFVBQVUsQ0FBQyxZQUFZO0FBQ3JCa0QsUUFBQUEsU0FBUyxDQUFDQyxJQUFWLENBQWV4QyxPQUFmO0FBQ0F0RCxRQUFBQSxLQUFLLENBQUNvRSxXQUFOLENBQWtCLGVBQWxCO0FBRUFkLFFBQUFBLE9BQU8sQ0FBQ3hCLE1BQVI7QUFDRCxPQUxTLEVBS1AsR0FMTyxDQUFWO0FBTUQsS0EzU1U7QUE2U1hrRSxJQUFBQSxJQUFJLEVBQUUsZ0JBQVk7QUFDaEIsV0FBS0wsT0FBTCxDQUNFLFlBQVk7QUFDVjNGLFFBQUFBLEtBQUssQ0FBQ29FLFdBQU4sQ0FBa0IsMEJBQWxCLEVBQThDdkMsUUFBOUMsQ0FBdUQsV0FBdkQ7QUFDQSxhQUFLcEIsTUFBTCxHQUFjLEtBQWQ7QUFDQSxhQUFLRixRQUFMLEdBQWdCLElBQWhCOztBQUVBLFlBQUlQLEtBQUssQ0FBQ3lCLFFBQU4sQ0FBZSx1QkFBZixDQUFKLEVBQTZDO0FBQzNDaEMsVUFBQUEsQ0FBQyxDQUFDLGtCQUFELENBQUQsQ0FBc0JvQyxRQUF0QixDQUErQixNQUEvQixFQUQyQyxDQUUzQztBQUNBO0FBQ0Q7QUFDRixPQVhILEVBWUUsWUFBWTtBQUNWLFlBQUksQ0FBQ3BDLENBQUMsQ0FBQyxZQUFELENBQUQsQ0FBZ0JnQyxRQUFoQixDQUF5QixvQkFBekIsQ0FBRCxJQUFtRGhDLENBQUMsQ0FBQyxZQUFELENBQUQsQ0FBZ0JnQyxRQUFoQixDQUF5QixZQUF6QixDQUF2RCxFQUErRjtBQUM3RixlQUFLSixjQUFMLENBQW9CeUIsTUFBcEI7QUFDQXJELFVBQUFBLENBQUMsQ0FBQyxvQkFBRCxDQUFELENBQXdCeUQsR0FBeEIsQ0FDRSxRQURGLEVBRUV6RCxDQUFDLENBQUNGLE1BQUQsQ0FBRCxDQUFVNEQsTUFBVixLQUNFMUQsQ0FBQyxDQUFDLGdCQUFELENBQUQsQ0FBb0IwRCxNQUFwQixFQURGLEdBRUUxRCxDQUFDLENBQUMsbUJBQUQsQ0FBRCxDQUF1QjJELFdBQXZCLEVBRkYsR0FHRTNELENBQUMsQ0FBQyxtQkFBRCxDQUFELENBQXVCMkQsV0FBdkIsRUFMSixFQUY2RixDQVM3RjtBQUNEOztBQUVELFlBQUksQ0FBQ3BELEtBQUssQ0FBQ3lCLFFBQU4sQ0FBZSx1QkFBZixDQUFMLEVBQThDO0FBQzVDaEMsVUFBQUEsQ0FBQyxDQUFDLGtCQUFELENBQUQsQ0FBc0IyRSxXQUF0QixDQUFrQyxNQUFsQyxFQUQ0QyxDQUU1QztBQUNBO0FBQ0Q7QUFDRixPQTlCSDtBQWdDRCxLQTlVVTtBQWdWWE4sSUFBQUEsSUFBSSxFQUFFLGdCQUFZO0FBQ2hCLFdBQUs2QixPQUFMLENBQ0UsWUFBWTtBQUNWM0YsUUFBQUEsS0FBSyxDQUFDb0UsV0FBTixDQUFrQix5QkFBbEIsRUFBNkN2QyxRQUE3QyxDQUFzRCxXQUF0RDtBQUNBLGFBQUtwQixNQUFMLEdBQWMsSUFBZDtBQUNBLGFBQUtGLFFBQUwsR0FBZ0IsS0FBaEI7O0FBRUEsWUFBSVAsS0FBSyxDQUFDeUIsUUFBTixDQUFlLHVCQUFmLENBQUosRUFBNkM7QUFDM0NoQyxVQUFBQSxDQUFDLENBQUMsa0JBQUQsQ0FBRCxDQUFzQjJFLFdBQXRCLENBQWtDLE1BQWxDLEVBRDJDLENBRTNDO0FBQ0E7QUFDRDtBQUNGLE9BWEgsRUFZRSxZQUFZO0FBQ1YsWUFBSSxDQUFDM0UsQ0FBQyxDQUFDLFlBQUQsQ0FBRCxDQUFnQmdDLFFBQWhCLENBQXlCLG9CQUF6QixDQUFELElBQW1EaEMsQ0FBQyxDQUFDLFlBQUQsQ0FBRCxDQUFnQmdDLFFBQWhCLENBQXlCLFlBQXpCLENBQXZELEVBQStGO0FBQzdGLGVBQUtKLGNBQUwsQ0FBb0J5QixNQUFwQjtBQUNEOztBQUVELFlBQUksQ0FBQzlDLEtBQUssQ0FBQ3lCLFFBQU4sQ0FBZSx1QkFBZixDQUFMLEVBQThDO0FBQzVDaEMsVUFBQUEsQ0FBQyxDQUFDLGtCQUFELENBQUQsQ0FBc0IyRSxXQUF0QixDQUFrQyxNQUFsQyxFQUQ0QyxDQUU1QztBQUNBO0FBQ0Q7QUFDRixPQXRCSDtBQXdCRCxLQXpXVTtBQTJXWEosSUFBQUEsTUFBTSxFQUFFLGtCQUFZO0FBQ2xCLFVBQUksS0FBS3pELFFBQUwsS0FBa0IsS0FBdEIsRUFBNkI7QUFDM0IsWUFBSVAsS0FBSyxDQUFDK0IsSUFBTixDQUFXLE1BQVgsS0FBc0Isc0JBQTFCLEVBQWtEO0FBQ2hEdEMsVUFBQUEsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FDRzhFLElBREgsQ0FDUSx1QkFEUixFQUVHMEIsV0FGSCxDQUdJQyxPQUFPLENBQUNDLEtBQVIsQ0FBYyxNQUFkLEVBQXNCQyxLQUF0QixDQUE0QjtBQUFFLHFCQUFPO0FBQVQsV0FBNUIsQ0FISjtBQUtEOztBQUNELGFBQUtULE9BQUwsQ0FDRSxZQUFZO0FBQ1YzRixVQUFBQSxLQUFLLENBQUNvRSxXQUFOLENBQWtCLGdCQUFsQixFQUFvQ3ZDLFFBQXBDLENBQTZDLGVBQTdDO0FBQ0EsZUFBS3JCLFNBQUwsR0FBaUIsS0FBakI7QUFDQSxlQUFLRCxRQUFMLEdBQWdCLElBQWhCO0FBQ0FkLFVBQUFBLENBQUMsQ0FBQyxrQkFBRCxDQUFELENBQXNCMkUsV0FBdEIsQ0FBa0MsTUFBbEMsRUFKVSxDQU1WO0FBQ0QsU0FSSCxFQVNFLFlBQVk7QUFDVixjQUFJM0UsQ0FBQyxDQUFDLFlBQUQsQ0FBRCxDQUFnQmdDLFFBQWhCLENBQXlCLG9CQUF6QixLQUFrRHpCLEtBQUssQ0FBQytCLElBQU4sQ0FBVyxNQUFYLEtBQXNCLGlCQUE1RSxFQUErRjtBQUM3RixpQkFBS1YsY0FBTCxDQUFvQjBCLE9BQXBCO0FBQ0QsV0FGRCxNQUVPO0FBQ0wsZ0JBQUl0RCxDQUFDLENBQUMsWUFBRCxDQUFELENBQWdCZ0MsUUFBaEIsQ0FBeUIsWUFBekIsQ0FBSixFQUE0QyxLQUFLSixjQUFMLENBQW9CeUIsTUFBcEI7QUFDN0M7O0FBRUQsY0FDRSxDQUFDOUMsS0FBSyxDQUFDK0IsSUFBTixDQUFXLE1BQVgsS0FBc0IsZUFBdEIsSUFBeUMvQixLQUFLLENBQUMrQixJQUFOLENBQVcsTUFBWCxLQUFzQixzQkFBaEUsS0FDQXRDLENBQUMsQ0FBQyxZQUFELENBQUQsQ0FBZ0JnQyxRQUFoQixDQUF5QixZQUF6QixDQUZGLEVBR0U7QUFDQWhDLFlBQUFBLENBQUMsQ0FBQyxvQkFBRCxDQUFELENBQXdCeUQsR0FBeEIsQ0FDRSxRQURGLEVBRUV6RCxDQUFDLENBQUNGLE1BQUQsQ0FBRCxDQUFVNEQsTUFBVixLQUNFMUQsQ0FBQyxDQUFDLGdCQUFELENBQUQsQ0FBb0IwRCxNQUFwQixFQURGLEdBRUUxRCxDQUFDLENBQUMsbUJBQUQsQ0FBRCxDQUF1QjJELFdBQXZCLEVBRkYsR0FHRTNELENBQUMsQ0FBQyxtQkFBRCxDQUFELENBQXVCMkQsV0FBdkIsRUFMSixFQURBLENBUUE7QUFDRDtBQUNGLFNBN0JIO0FBK0JEO0FBQ0YsS0FwWlU7QUFzWlhXLElBQUFBLFFBQVEsRUFBRSxvQkFBWTtBQUNwQixVQUFJLEtBQUt2RCxTQUFMLEtBQW1CLEtBQXZCLEVBQThCO0FBQzVCLFlBQUlSLEtBQUssQ0FBQytCLElBQU4sQ0FBVyxNQUFYLEtBQXNCLHNCQUExQixFQUFrRDtBQUNoRHRDLFVBQUFBLENBQUMsQ0FBQyxvQkFBRCxDQUFELENBQ0c4RSxJQURILENBQ1EsdUJBRFIsRUFFRzBCLFdBRkgsQ0FHSUMsT0FBTyxDQUFDQyxLQUFSLENBQWMsUUFBZCxFQUF3QkMsS0FBeEIsQ0FBOEI7QUFDNUIscUJBQU87QUFEcUIsV0FBOUIsQ0FISjtBQU9EOztBQUNELGFBQUtULE9BQUwsQ0FDRSxZQUFZO0FBQ1YzRixVQUFBQSxLQUFLLENBQUNvRSxXQUFOLENBQWtCLGVBQWxCLEVBQW1DdkMsUUFBbkMsQ0FBNEMsZ0JBQTVDO0FBQ0EsZUFBS3JCLFNBQUwsR0FBaUIsSUFBakI7QUFDQSxlQUFLRCxRQUFMLEdBQWdCLEtBQWhCO0FBRUFkLFVBQUFBLENBQUMsQ0FBQyxrQkFBRCxDQUFELENBQXNCMkUsV0FBdEIsQ0FBa0MsZ0JBQWxDO0FBQ0QsU0FQSCxFQVFFLFlBQVk7QUFDVixjQUFJcEUsS0FBSyxDQUFDK0IsSUFBTixDQUFXLE1BQVgsS0FBc0IsaUJBQXRCLElBQTJDL0IsS0FBSyxDQUFDeUIsUUFBTixDQUFlLHVCQUFmLENBQS9DLEVBQXdGO0FBQ3RGLGdCQUFJaEMsQ0FBQyxDQUFDLFlBQUQsQ0FBRCxDQUFnQmdDLFFBQWhCLENBQXlCLFlBQXpCLENBQUosRUFBNEMsS0FBS0osY0FBTCxDQUFvQnlCLE1BQXBCO0FBQzdDOztBQUNELGNBQ0UsQ0FBQzlDLEtBQUssQ0FBQytCLElBQU4sQ0FBVyxNQUFYLEtBQXNCLGVBQXRCLElBQXlDL0IsS0FBSyxDQUFDK0IsSUFBTixDQUFXLE1BQVgsS0FBc0Isc0JBQWhFLEtBQ0F0QyxDQUFDLENBQUMsWUFBRCxDQUFELENBQWdCZ0MsUUFBaEIsQ0FBeUIsWUFBekIsQ0FGRixFQUdFO0FBQ0FoQyxZQUFBQSxDQUFDLENBQUMsb0JBQUQsQ0FBRCxDQUF3QnlELEdBQXhCLENBQTRCLFFBQTVCLEVBQXNDekQsQ0FBQyxDQUFDRixNQUFELENBQUQsQ0FBVTRELE1BQVYsS0FBcUIxRCxDQUFDLENBQUMsZ0JBQUQsQ0FBRCxDQUFvQjBELE1BQXBCLEVBQTNELEVBREEsQ0FFQTtBQUNEOztBQUNELGNBQUluRCxLQUFLLENBQUMrQixJQUFOLENBQVcsTUFBWCxLQUFzQixzQkFBMUIsRUFBa0Q7QUFDaEQsZ0JBQUl0QyxDQUFDLENBQUMsWUFBRCxDQUFELENBQWdCZ0MsUUFBaEIsQ0FBeUIsWUFBekIsQ0FBSixFQUE0QyxLQUFLSixjQUFMLENBQW9CeUIsTUFBcEI7QUFDN0M7QUFDRixTQXRCSDtBQXdCRDtBQUNGLEtBMWJVO0FBNGJYbUIsSUFBQUEsYUFBYSxFQUFFLHVCQUFVb0MsTUFBVixFQUFrQnpDLFFBQWxCLEVBQTRCO0FBQ3pDLFVBQUl0RCxJQUFJLEdBQUdOLEtBQUssQ0FBQytCLElBQU4sQ0FBVyxNQUFYLENBQVg7O0FBQ0EsVUFBSTZCLFFBQVEsSUFBSSxzQkFBaEIsRUFBd0M7QUFDdEMsWUFBSXlDLE1BQU0sSUFBSSxJQUFWLElBQWtCQSxNQUFNLElBQUksSUFBNUIsSUFBb0NBLE1BQU0sSUFBSSxJQUE5QyxJQUFzREEsTUFBTSxJQUFJLElBQXBFLEVBQTBFO0FBQ3hFLGNBQUlyRyxLQUFLLENBQUN5QixRQUFOLENBQWVuQixJQUFmLENBQUosRUFBMEI7QUFDeEJOLFlBQUFBLEtBQUssQ0FBQ29FLFdBQU4sQ0FBa0I5RCxJQUFsQixFQUF3QnVCLFFBQXhCLENBQWlDLHVCQUFqQztBQUNEO0FBQ0YsU0FKRCxNQUlPO0FBQ0wsY0FBSTdCLEtBQUssQ0FBQ3lCLFFBQU4sQ0FBZSx1QkFBZixDQUFKLEVBQTZDO0FBQzNDekIsWUFBQUEsS0FBSyxDQUFDb0UsV0FBTixDQUFrQix1QkFBbEIsRUFBMkN2QyxRQUEzQyxDQUFvRHZCLElBQXBEO0FBQ0Q7QUFDRjtBQUNGLE9BVkQsTUFVTztBQUNMLFlBQUkrRixNQUFNLElBQUksSUFBVixJQUFrQkEsTUFBTSxJQUFJLElBQWhDLEVBQXNDO0FBQ3BDLGNBQUlyRyxLQUFLLENBQUN5QixRQUFOLENBQWVuQixJQUFmLENBQUosRUFBMEI7QUFDeEJOLFlBQUFBLEtBQUssQ0FBQ29FLFdBQU4sQ0FBa0I5RCxJQUFsQixFQUF3QnVCLFFBQXhCLENBQWlDLHVCQUFqQztBQUNEO0FBQ0YsU0FKRCxNQUlPO0FBQ0wsY0FBSTdCLEtBQUssQ0FBQ3lCLFFBQU4sQ0FBZSx1QkFBZixDQUFKLEVBQTZDO0FBQzNDekIsWUFBQUEsS0FBSyxDQUFDb0UsV0FBTixDQUFrQix1QkFBbEIsRUFBMkN2QyxRQUEzQyxDQUFvRHZCLElBQXBEO0FBQ0Q7QUFDRjtBQUNGO0FBQ0YsS0FuZFU7QUFxZFg2RCxJQUFBQSxVQUFVLEVBQUUsb0JBQVVrQyxNQUFWLEVBQWtCO0FBQzVCO0FBQ0E1RyxNQUFBQSxDQUFDLENBQUMsK0JBQUQsQ0FBRCxDQUFtQ1UsSUFBbkMsQ0FBd0MsRUFBeEM7QUFDQVYsTUFBQUEsQ0FBQyxDQUFDLCtCQUFELENBQUQsQ0FBbUNVLElBQW5DLENBQXdDRCxjQUF4QztBQUVBLFVBQUlvRyxXQUFXLEdBQUc3RyxDQUFDLENBQUMsK0JBQUQsQ0FBbkI7QUFBQSxVQUNFOEcsYUFBYSxHQUFHOUcsQ0FBQyxDQUFDLGlDQUFELENBRG5CO0FBQUEsVUFFRStHLGNBQWMsR0FBRy9HLENBQUMsQ0FBQyxpQ0FBRCxDQUZwQjs7QUFHRTtBQUNSO0FBQ1FnSCxNQUFBQSxZQUFZLEdBQUdoSCxDQUFDLENBQUMsMEJBQUQsQ0FMbEI7QUFBQSxVQU1FaUgsZUFBZSxHQUFHakgsQ0FBQyxDQUFDLGtDQUFELENBTnJCOztBQVFBLFVBQUk0RyxNQUFNLEtBQUssSUFBZixFQUFxQjtBQUNuQjtBQUNBckcsUUFBQUEsS0FBSyxDQUFDb0UsV0FBTixDQUFrQixvREFBbEIsRUFBd0V2QyxRQUF4RSxDQUFpRjdCLEtBQUssQ0FBQytCLElBQU4sQ0FBVyxNQUFYLENBQWpGLEVBRm1CLENBSW5COztBQUNBdEMsUUFBQUEsQ0FBQyxDQUFDLG1CQUFELENBQUQsQ0FBdUIyRSxXQUF2QixDQUFtQyxXQUFuQyxFQUxtQixDQU9uQjs7QUFDQWtDLFFBQUFBLFdBQVcsQ0FBQ2xDLFdBQVosR0FBMEJ2QyxRQUExQixDQUFtQ3pCLGtCQUFuQztBQUVBWCxRQUFBQSxDQUFDLENBQUMsa0NBQUQsQ0FBRCxDQUFzQzRFLEVBQXRDLENBQXlDLE9BQXpDLEVBQWtELFlBQVk7QUFDNURDLFVBQUFBLEtBQUssQ0FBQ0ssY0FBTjtBQUNBTCxVQUFBQSxLQUFLLENBQUNNLGVBQU47QUFDRCxTQUhEO0FBSUFuRixRQUFBQSxDQUFDLENBQUMsZ0NBQUQsQ0FBRCxDQUFvQzRFLEVBQXBDLENBQXVDLE9BQXZDLEVBQWdELFlBQVk7QUFDMURDLFVBQUFBLEtBQUssQ0FBQ0ssY0FBTjtBQUNBTCxVQUFBQSxLQUFLLENBQUNNLGVBQU47QUFDRCxTQUhEO0FBSUQsT0FsQkQsTUFrQk87QUFDTDtBQUNBNUUsUUFBQUEsS0FBSyxDQUFDb0UsV0FBTixDQUFrQnBFLEtBQUssQ0FBQytCLElBQU4sQ0FBVyxNQUFYLENBQWxCLEVBQXNDRixRQUF0QyxDQUErQyxvREFBL0MsRUFGSyxDQUlMOztBQUNBcEMsUUFBQUEsQ0FBQyxDQUFDLG1CQUFELENBQUQsQ0FBdUJvQyxRQUF2QixDQUFnQyxXQUFoQyxFQUxLLENBT0w7O0FBQ0F5RSxRQUFBQSxXQUFXLENBQUNsQyxXQUFaLEdBQTBCdkMsUUFBMUIsQ0FBbUMsNkNBQW5DLEVBUkssQ0FTTDs7QUFDQTJFLFFBQUFBLGNBQWMsQ0FBQ3BDLFdBQWYsR0FBNkJ2QyxRQUE3QixDQUFzQyw0QkFBdEMsRUFWSyxDQVlMOztBQUNBNEUsUUFBQUEsWUFBWSxDQUFDckMsV0FBYixDQUF5QixVQUF6QixFQUFxQ3ZDLFFBQXJDLENBQThDLFNBQTlDO0FBQ0E0RSxRQUFBQSxZQUFZLENBQUNsQyxJQUFiLENBQWtCLEdBQWxCLEVBQXVCSCxXQUF2QixDQUFtQywwQkFBbkM7QUFDQXFDLFFBQUFBLFlBQVksQ0FBQ2xDLElBQWIsQ0FBa0IsR0FBbEIsRUFBdUJsRSxJQUF2QixDQUE0QixnQkFBNUIsRUFBOEMsRUFBOUM7QUFDQW9HLFFBQUFBLFlBQVksQ0FBQ0UsUUFBYixDQUFzQixJQUF0QixFQUE0QnBDLElBQTVCLENBQWlDLEdBQWpDLEVBQXNDSCxXQUF0QyxDQUFrRCxlQUFsRDtBQUNBcUMsUUFBQUEsWUFBWSxDQUFDbEMsSUFBYixDQUFrQixJQUFsQixFQUF3QkgsV0FBeEIsQ0FBb0MsZUFBcEM7QUFDQXNDLFFBQUFBLGVBQWUsQ0FBQ3RDLFdBQWhCLEdBQThCdkMsUUFBOUIsQ0FBdUMsU0FBdkM7QUFFQXBDLFFBQUFBLENBQUMsQ0FBQ00sR0FBRixDQUFNNkcsR0FBTixDQUFVckYsSUFBVixHQXBCSyxDQXNCTDtBQUNBOztBQUNBOUIsUUFBQUEsQ0FBQyxDQUFDLDRDQUFELENBQUQsQ0FBZ0Q0RSxFQUFoRCxDQUFtRCxPQUFuRCxFQUE0RCxVQUFVQyxLQUFWLEVBQWlCO0FBQzNFQSxVQUFBQSxLQUFLLENBQUNLLGNBQU47QUFDQUwsVUFBQUEsS0FBSyxDQUFDTSxlQUFOO0FBQ0FuRixVQUFBQSxDQUFDLENBQUMsSUFBRCxDQUFELENBQVFvRixNQUFSLEdBQWlCSCxRQUFqQixHQUE0Qk4sV0FBNUIsQ0FBd0MsTUFBeEM7QUFDQTNFLFVBQUFBLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUW9GLE1BQVIsR0FBaUJKLFdBQWpCLENBQTZCLE1BQTdCO0FBQ0QsU0FMRDtBQU9BaEYsUUFBQUEsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0I4RSxJQUF4QixDQUE2QixXQUE3QixFQUEwQ0MsT0FBMUMsQ0FBa0QsSUFBbEQsRUFBd0QzQyxRQUF4RCxDQUFpRSxzQkFBakU7QUFFQXBDLFFBQUFBLENBQUMsQ0FBQyxvQkFBRCxDQUFELENBQXdCOEUsSUFBeEIsQ0FBNkIsV0FBN0IsRUFBMENzQyxPQUExQyxDQUFrRCxhQUFsRCxFQUFpRWhGLFFBQWpFLENBQTBFLE1BQTFFO0FBQ0Q7O0FBRUQsVUFBSXFFLE9BQUosRUFBYTtBQUNYQSxRQUFBQSxPQUFPLENBQUNZLE9BQVIsQ0FBZ0I7QUFBRXhCLFVBQUFBLEtBQUssRUFBRSxFQUFUO0FBQWFuQyxVQUFBQSxNQUFNLEVBQUU7QUFBckIsU0FBaEI7QUFDRDtBQUNGLEtBM2hCVTtBQTZoQlg0RCxJQUFBQSxNQUFNLEVBQUUsa0JBQVk7QUFDbEIsVUFBSXhELGlCQUFpQixHQUFHQyxNQUFNLENBQUNDLEtBQVAsQ0FBYUMsR0FBYixFQUF4QixDQURrQixDQUMwQjs7QUFDNUMsVUFBSWxELFNBQVMsR0FBRyxLQUFLQSxTQUFyQjtBQUNBLFVBQUlELFFBQVEsR0FBRyxLQUFLQSxRQUFwQjtBQUNBLFVBQUlFLE1BQU0sR0FBRyxLQUFLQSxNQUFsQjtBQUNBLFVBQUlILElBQUksR0FBR04sS0FBSyxDQUFDK0IsSUFBTixDQUFXLE1BQVgsQ0FBWDs7QUFFQSxjQUFRd0IsaUJBQWlCLENBQUNNLElBQTFCO0FBQ0UsYUFBSyxJQUFMO0FBQ0UsY0FBSXRELFFBQVEsS0FBSyxJQUFqQixFQUF1QjtBQUNyQixnQkFBSUQsSUFBSSxJQUFJLHVCQUFaLEVBQXFDO0FBQ25DLG1CQUFLd0QsSUFBTDtBQUNELGFBRkQsTUFFTztBQUNMLG1CQUFLQyxRQUFMO0FBQ0Q7QUFDRixXQU5ELE1BTU87QUFDTCxnQkFBSXpELElBQUksSUFBSSx1QkFBWixFQUFxQztBQUNuQyxtQkFBSzBGLElBQUw7QUFDRCxhQUZELE1BRU87QUFDTCxtQkFBS2hDLE1BQUw7QUFDRDtBQUNGOztBQUNEOztBQUNGLGFBQUssSUFBTDtBQUNFLGNBQUl6RCxRQUFRLEtBQUssSUFBakIsRUFBdUI7QUFDckIsZ0JBQUlELElBQUksSUFBSSx1QkFBUixJQUFtQ0EsSUFBSSxJQUFJLHNCQUEzQyxJQUFxRUEsSUFBSSxJQUFJLGlCQUFqRixFQUFvRztBQUNsRyxtQkFBS3dELElBQUw7QUFDRCxhQUZELE1BRU87QUFDTCxtQkFBS0MsUUFBTDtBQUNEO0FBQ0YsV0FORCxNQU1PO0FBQ0wsZ0JBQUl6RCxJQUFJLElBQUksdUJBQVIsSUFBbUNBLElBQUksSUFBSSxzQkFBM0MsSUFBcUVBLElBQUksSUFBSSxpQkFBakYsRUFBb0c7QUFDbEcsbUJBQUswRixJQUFMO0FBQ0QsYUFGRCxNQUVPO0FBQ0wsbUJBQUtoQyxNQUFMO0FBQ0Q7QUFDRjs7QUFDRDs7QUFDRixhQUFLLElBQUw7QUFDQSxhQUFLLElBQUw7QUFDRSxjQUFJdkQsTUFBTSxLQUFLLElBQWYsRUFBcUI7QUFDbkIsaUJBQUt1RixJQUFMO0FBQ0QsV0FGRCxNQUVPO0FBQ0wsaUJBQUtsQyxJQUFMO0FBQ0Q7O0FBQ0Q7O0FBQ0YsYUFBSyxJQUFMO0FBQ0UsY0FBSXJELE1BQU0sS0FBSyxJQUFmLEVBQXFCO0FBQ25CLGlCQUFLdUYsSUFBTDtBQUNELFdBRkQsTUFFTztBQUNMLGlCQUFLbEMsSUFBTDtBQUNEOztBQUNEO0FBN0NKO0FBK0NELEtBbmxCVTtBQXFsQlhoQyxJQUFBQSxNQUFNLEVBQUUsa0JBQVk7QUFDbEIsV0FBS1QsY0FBTCxDQUFvQlMsTUFBcEI7QUFDRCxLQXZsQlU7QUF5bEJYNkIsSUFBQUEsS0FBSyxFQUFFLGlCQUFZO0FBQ2pCLFdBQUtwRCxRQUFMLEdBQWdCLEtBQWhCO0FBQ0EsV0FBS0MsU0FBTCxHQUFpQixLQUFqQjtBQUNBLFdBQUtDLE1BQUwsR0FBYyxLQUFkO0FBQ0FULE1BQUFBLEtBQUssQ0FBQ29FLFdBQU4sQ0FBa0Isa0RBQWxCO0FBQ0Q7QUE5bEJVLEdBQWIsQ0FkOEIsQ0ErbUI5Qjs7QUFDQTNFLEVBQUFBLENBQUMsQ0FBQ00sR0FBRixDQUFNNkcsR0FBTixHQUFZO0FBQ1ZsRyxJQUFBQSxTQUFTLEVBQUVqQixDQUFDLENBQUMsa0JBQUQsQ0FERjtBQUVWdUgsSUFBQUEsV0FBVyxFQUFFLEtBRkg7QUFHVkMsSUFBQUEsT0FBTyxFQUFFeEgsQ0FBQyxDQUFDLGtCQUFELENBQUQsQ0FBc0I4RSxJQUF0QixDQUEyQixJQUEzQixFQUFpQzJDLEdBQWpDLENBQXFDLHNCQUFyQyxDQUhDO0FBSVZDLElBQUFBLGlCQUFpQixFQUFFLENBQUMsZUFBRCxFQUFrQixxQkFBbEIsRUFBeUMsZ0JBQXpDLENBSlQ7QUFLVkMsSUFBQUEscUJBQXFCLEVBQUUsQ0FBQyxZQUFELEVBQWUsZUFBZixFQUFnQyxrQkFBaEMsRUFBb0Qsa0JBQXBELEVBQXdFLGFBQXhFLENBTGI7QUFPVkMsSUFBQUEsTUFBTSxFQUFFO0FBQ05DLE1BQUFBLEtBQUssRUFBRTtBQURELEtBUEU7QUFXVi9GLElBQUFBLElBQUksRUFBRSxjQUFVOEYsTUFBVixFQUFrQjtBQUN0QixXQUFLTCxXQUFMLEdBQW1CLElBQW5CLENBRHNCLENBQ0c7O0FBQ3pCdkgsTUFBQUEsQ0FBQyxDQUFDOEgsTUFBRixDQUFTLEtBQUtGLE1BQWQsRUFBc0JBLE1BQXRCO0FBRUEsV0FBS0csV0FBTDtBQUNELEtBaEJTO0FBa0JWQSxJQUFBQSxXQUFXLEVBQUUsdUJBQVk7QUFDdkIsVUFBSWxFLE9BQU8sR0FBRyxJQUFkO0FBRUE3RCxNQUFBQSxDQUFDLENBQUMsa0JBQUQsQ0FBRCxDQUNHNEUsRUFESCxDQUNNLHFCQUROLEVBQzZCLElBRDdCLEVBQ21DLFlBQVk7QUFDM0MsWUFBSW9ELEtBQUssR0FBR2hJLENBQUMsQ0FBQyxJQUFELENBQWIsQ0FEMkMsQ0FFM0M7O0FBQ0EsWUFBSU8sS0FBSyxDQUFDeUIsUUFBTixDQUFlLGdCQUFmLEtBQW9DekIsS0FBSyxDQUFDK0IsSUFBTixDQUFXLE1BQVgsS0FBc0Isc0JBQTlELEVBQXNGO0FBQ3BGdEMsVUFBQUEsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0JrSCxRQUF4QixDQUFpQyxpQkFBakMsRUFBb0RlLE1BQXBEO0FBQ0FqSSxVQUFBQSxDQUFDLENBQUMsb0JBQUQsQ0FBRCxDQUF3QmtILFFBQXhCLENBQWlDLGNBQWpDLEVBQWlEZSxNQUFqRDtBQUNBakksVUFBQUEsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0JrSCxRQUF4QixDQUFpQyxpQkFBakMsRUFBb0RlLE1BQXBELEdBSG9GLENBS3BGOztBQUNBLGNBQUlDLFNBQVMsR0FBR0YsS0FBSyxDQUFDbEQsSUFBTixDQUFXLGlCQUFYLEVBQThCcUQsS0FBOUIsRUFBaEI7QUFBQSxjQUNFQyxTQURGO0FBQUEsY0FFRUMsUUFGRjs7QUFHQSxjQUFJLENBQUNMLEtBQUssQ0FBQ2hHLFFBQU4sQ0FBZSxTQUFmLENBQUwsRUFBZ0M7QUFDOUJvRyxZQUFBQSxTQUFTLEdBQUdKLEtBQUssQ0FBQ2xELElBQU4sQ0FBVyxpQkFBWCxFQUE4QndELElBQTlCLEVBQVo7QUFDQUQsWUFBQUEsUUFBUSxHQUFHTCxLQUFLLENBQUNkLFFBQU4sQ0FBZSxHQUFmLEVBQW9CdEcsSUFBcEIsQ0FBeUIsTUFBekIsQ0FBWDs7QUFDQSxnQkFBSXdILFNBQVMsS0FBSyxFQUFsQixFQUFzQjtBQUNwQkYsY0FBQUEsU0FBUyxHQUFHbEksQ0FBQyxDQUFDLEtBQUQsQ0FBYjtBQUNBa0ksY0FBQUEsU0FBUyxDQUFDdEgsSUFBVixDQUFlLE1BQWYsRUFBdUJ5SCxRQUF2QjtBQUNBSCxjQUFBQSxTQUFTLENBQUN0SCxJQUFWLENBQWUsT0FBZixFQUF3QndILFNBQXhCO0FBQ0FGLGNBQUFBLFNBQVMsQ0FBQ0ksSUFBVixDQUFlRixTQUFmO0FBQ0FGLGNBQUFBLFNBQVMsQ0FBQzlGLFFBQVYsQ0FBbUIsWUFBbkI7QUFDRDtBQUNGLFdBbkJtRixDQW9CcEY7QUFDQTs7O0FBQ0EsY0FBSW1HLE9BQUo7O0FBQ0EsY0FBSVAsS0FBSyxDQUFDdkUsR0FBTixDQUFVLFlBQVYsQ0FBSixFQUE2QjtBQUMzQjhFLFlBQUFBLE9BQU8sR0FBR1AsS0FBSyxDQUFDeEMsUUFBTixHQUFpQjVDLEdBQWpCLEdBQXVCRSxRQUFRLENBQUNrRixLQUFLLENBQUN2RSxHQUFOLENBQVUsWUFBVixDQUFELEVBQTBCLEVBQTFCLENBQXpDO0FBQ0QsV0FGRCxNQUVPO0FBQ0w4RSxZQUFBQSxPQUFPLEdBQUdQLEtBQUssQ0FBQ3hDLFFBQU4sR0FBaUI1QyxHQUEzQjtBQUNEOztBQUNELGNBQUlyQyxLQUFLLENBQUMrQixJQUFOLENBQVcsTUFBWCxNQUF1Qix1QkFBM0IsRUFBb0Q7QUFDbEQ0RixZQUFBQSxTQUFTLENBQUNNLFFBQVYsQ0FBbUIsb0JBQW5CLEVBQXlDL0UsR0FBekMsQ0FBNkM7QUFDM0MrQixjQUFBQSxRQUFRLEVBQUUsT0FEaUM7QUFFM0M1QyxjQUFBQSxHQUFHLEVBQUUyRjtBQUZzQyxhQUE3QztBQUlELFdBakNtRixDQW1DcEY7O0FBQ0E7QUFDWjtBQUNBO0FBQ0E7O0FBQ1csU0EzQzBDLENBNEMzQzs7QUFDRCxPQTlDSCxFQStDRzNELEVBL0NILENBK0NNLHFCQS9DTixFQStDNkIsSUEvQzdCLEVBK0NtQyxZQUFZLENBQzNDO0FBQ0QsT0FqREgsRUFrREdBLEVBbERILENBa0RNLGlCQWxETixFQWtEeUIsSUFsRHpCLEVBa0QrQixVQUFVNkQsQ0FBVixFQUFhO0FBQ3hDekksUUFBQUEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFRb0MsUUFBUixDQUFpQixRQUFqQjtBQUNBcUcsUUFBQUEsQ0FBQyxDQUFDdEQsZUFBRjtBQUNELE9BckRILEVBc0RHUCxFQXRESCxDQXNETSxtQkF0RE4sRUFzRDJCLFdBdEQzQixFQXNEd0MsVUFBVTZELENBQVYsRUFBYTtBQUNqRHpJLFFBQUFBLENBQUMsQ0FBQyxJQUFELENBQUQsQ0FBUTJFLFdBQVIsQ0FBb0IsUUFBcEI7QUFDQThELFFBQUFBLENBQUMsQ0FBQ3RELGVBQUY7QUFDRCxPQXpESCxFQTBER1AsRUExREgsQ0EwRE0sZUExRE4sRUEwRHVCLElBMUR2QixFQTBENkIsVUFBVTZELENBQVYsRUFBYTtBQUN0QyxZQUFJQyxTQUFTLEdBQUcxSSxDQUFDLENBQUMsSUFBRCxDQUFqQjtBQUVBNkQsUUFBQUEsT0FBTyxDQUFDVSxNQUFSLENBQWVtRSxTQUFmLEVBSHNDLENBSXRDO0FBRUE7O0FBQ0EsWUFBSTFJLENBQUMsQ0FBQyxZQUFELENBQUQsQ0FBZ0JnQyxRQUFoQixDQUF5QixrQkFBekIsQ0FBSixFQUFrRDtBQUNoRCxpQkFBTyxLQUFQO0FBQ0QsU0FGRCxDQUdBO0FBSEEsYUFJSztBQUNIMEcsVUFBQUEsU0FBUyxDQUFDekQsUUFBVixDQUFtQixPQUFuQixFQUE0QkgsSUFBNUIsQ0FBaUMsU0FBakMsRUFBNEM2RCxPQUE1QyxDQUFvRCxnQkFBcEQ7QUFDQUQsVUFBQUEsU0FBUyxDQUFDekQsUUFBVixDQUFtQixPQUFuQixFQUE0QjBELE9BQTVCLENBQW9DLGdCQUFwQztBQUNEOztBQUVERixRQUFBQSxDQUFDLENBQUN0RCxlQUFGO0FBQ0QsT0EzRUgsRUE0RUdQLEVBNUVILENBNEVNLGdCQTVFTixFQTRFd0IsU0E1RXhCLEVBNEVtQyxVQUFVNkQsQ0FBVixFQUFhO0FBQzVDLFlBQUlDLFNBQVMsR0FBRzFJLENBQUMsQ0FBQyxJQUFELENBQWpCO0FBRUE2RCxRQUFBQSxPQUFPLENBQUNTLFFBQVIsQ0FBaUJvRSxTQUFqQixFQUg0QyxDQUk1Qzs7QUFFQUQsUUFBQUEsQ0FBQyxDQUFDdEQsZUFBRjtBQUNELE9BbkZILEVBb0ZHUCxFQXBGSCxDQW9GTSxnQkFwRk4sRUFvRndCLElBcEZ4QixFQW9GOEIsVUFBVTZELENBQVYsRUFBYTtBQUN2QyxZQUFJQyxTQUFTLEdBQUcxSSxDQUFDLENBQUMsSUFBRCxDQUFqQjs7QUFDQSxZQUFJMEksU0FBUyxDQUFDakUsRUFBVixDQUFhLFdBQWIsQ0FBSixFQUErQjtBQUM3QmdFLFVBQUFBLENBQUMsQ0FBQ3ZELGNBQUY7QUFDRCxTQUZELE1BRU87QUFDTCxjQUFJM0UsS0FBSyxDQUFDeUIsUUFBTixDQUFlLGdCQUFmLEtBQW9DekIsS0FBSyxDQUFDK0IsSUFBTixDQUFXLE1BQVgsS0FBc0Isc0JBQTlELEVBQXNGO0FBQ3BGbUcsWUFBQUEsQ0FBQyxDQUFDdkQsY0FBRjtBQUNELFdBRkQsTUFFTztBQUNMLGdCQUFJd0QsU0FBUyxDQUFDRSxHQUFWLENBQWMsSUFBZCxFQUFvQmxHLE1BQXhCLEVBQWdDO0FBQzlCLGtCQUFJZ0csU0FBUyxDQUFDakUsRUFBVixDQUFhLE9BQWIsQ0FBSixFQUEyQjtBQUN6QmlFLGdCQUFBQSxTQUFTLENBQUNDLE9BQVYsQ0FBa0IsZ0JBQWxCO0FBQ0QsZUFGRCxNQUVPO0FBQ0xELGdCQUFBQSxTQUFTLENBQUNDLE9BQVYsQ0FBa0IsZUFBbEI7QUFDRDtBQUNGLGFBTkQsTUFNTztBQUNMLGtCQUFJLENBQUNELFNBQVMsQ0FBQ2pFLEVBQVYsQ0FBYSxTQUFiLENBQUwsRUFBOEI7QUFDNUJpRSxnQkFBQUEsU0FBUyxDQUFDekQsUUFBVixDQUFtQixTQUFuQixFQUE4QjBELE9BQTlCLENBQXNDLG1CQUF0QztBQUNBRCxnQkFBQUEsU0FBUyxDQUFDQyxPQUFWLENBQWtCLGlCQUFsQjtBQUNEO0FBQ0Y7QUFDRjtBQUNGOztBQUVERixRQUFBQSxDQUFDLENBQUN0RCxlQUFGO0FBQ0QsT0E1R0g7QUE4R0FuRixNQUFBQSxDQUFDLENBQUMsNEJBQUQsQ0FBRCxDQUFnQzRFLEVBQWhDLENBQW1DLFlBQW5DLEVBQWlEaUUsZ0JBQWpELEVBQW1FakUsRUFBbkUsQ0FBc0UsWUFBdEUsRUFBb0ZrRSxrQkFBcEY7O0FBRUEsZUFBU0QsZ0JBQVQsR0FBNEI7QUFDMUIsWUFBSXRJLEtBQUssQ0FBQytCLElBQU4sQ0FBVyxNQUFYLEtBQXNCLHNCQUExQixFQUFrRDtBQUNoRHRDLFVBQUFBLENBQUMsQ0FBQyw0QkFBRCxDQUFELENBQWdDb0MsUUFBaEMsQ0FBeUMsVUFBekM7O0FBQ0EsY0FBSTdCLEtBQUssQ0FBQ3lCLFFBQU4sQ0FBZSxnQkFBZixDQUFKLEVBQXNDO0FBQ3BDLGdCQUFJaEMsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0IwQyxNQUF4QixLQUFtQyxDQUF2QyxFQUEwQztBQUN4QzFDLGNBQUFBLENBQUMsQ0FBQyxvQkFBRCxDQUFELENBQXdCOEUsSUFBeEIsQ0FBNkIsV0FBN0IsRUFBMENDLE9BQTFDLENBQWtELElBQWxELEVBQXdEM0MsUUFBeEQsQ0FBaUUsTUFBakU7QUFDRDs7QUFDRCxnQkFBSXNHLFNBQVMsR0FBRzFJLENBQUMsQ0FBQyxtQ0FBRCxDQUFqQjtBQUFBLGdCQUNFK0ksUUFBUSxHQUFHTCxTQUFTLENBQUN4QixRQUFWLENBQW1CLElBQW5CLENBRGI7QUFHQTZCLFlBQUFBLFFBQVEsQ0FBQzFFLElBQVQsR0FBZ0IyRSxTQUFoQixDQUEwQixHQUExQixFQUErQixZQUFZO0FBQ3pDaEosY0FBQUEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFReUQsR0FBUixDQUFZLFNBQVosRUFBdUIsRUFBdkI7QUFDRCxhQUZEO0FBSUFpRixZQUFBQSxTQUFTLENBQUN0RyxRQUFWLENBQW1CLE1BQW5CLEVBQTJCdUMsV0FBM0IsQ0FBdUMscUJBQXZDLEVBWG9DLENBWXBDO0FBQ0Q7QUFDRjtBQUNGOztBQUVELGVBQVNtRSxrQkFBVCxHQUE4QjtBQUM1QixZQUFJdkksS0FBSyxDQUFDeUIsUUFBTixDQUFlLGdCQUFmLEtBQW9DekIsS0FBSyxDQUFDK0IsSUFBTixDQUFXLE1BQVgsS0FBc0Isc0JBQTlELEVBQXNGO0FBQ3BGWSxVQUFBQSxVQUFVLENBQUMsWUFBWTtBQUNyQixnQkFBSWxELENBQUMsQ0FBQyxrQkFBRCxDQUFELENBQXNCMEMsTUFBdEIsS0FBaUMsQ0FBakMsSUFBc0MxQyxDQUFDLENBQUMsc0JBQUQsQ0FBRCxDQUEwQjBDLE1BQTFCLEtBQXFDLENBQS9FLEVBQWtGO0FBQ2hGMUMsY0FBQUEsQ0FBQyxDQUFDLDRCQUFELENBQUQsQ0FBZ0MyRSxXQUFoQyxDQUE0QyxVQUE1Qzs7QUFDQSxrQkFBSXBFLEtBQUssQ0FBQ3lCLFFBQU4sQ0FBZSxnQkFBZixDQUFKLEVBQXNDO0FBQ3BDLG9CQUFJMEcsU0FBUyxHQUFHMUksQ0FBQyxDQUFDLG9CQUFELENBQWpCO0FBQUEsb0JBQ0UrSSxRQUFRLEdBQUdMLFNBQVMsQ0FBQ3hCLFFBQVYsQ0FBbUIsSUFBbkIsQ0FEYjtBQUVBd0IsZ0JBQUFBLFNBQVMsQ0FBQ3RHLFFBQVYsQ0FBbUIscUJBQW5CO0FBRUEyRyxnQkFBQUEsUUFBUSxDQUFDekMsSUFBVCxHQUFnQjJDLE9BQWhCLENBQXdCLEdBQXhCLEVBQTZCLFlBQVk7QUFDdkNqSixrQkFBQUEsQ0FBQyxDQUFDLElBQUQsQ0FBRCxDQUFReUQsR0FBUixDQUFZLFNBQVosRUFBdUIsRUFBdkI7QUFDRCxpQkFGRDtBQUlBaUYsZ0JBQUFBLFNBQVMsQ0FBQy9ELFdBQVYsQ0FBc0IsTUFBdEIsRUFUb0MsQ0FVcEM7QUFDRDtBQUNGO0FBQ0YsV0FoQlMsRUFnQlAsQ0FoQk8sQ0FBVjtBQWlCRDtBQUNGOztBQUVEM0UsTUFBQUEsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0I0RSxFQUF4QixDQUEyQixZQUEzQixFQUF5QyxZQUFZO0FBQ25ELFlBQUlyRSxLQUFLLENBQUN5QixRQUFOLENBQWUsZ0JBQWYsQ0FBSixFQUFzQztBQUNwQ2hDLFVBQUFBLENBQUMsQ0FBQyxvQkFBRCxDQUFELENBQXdCa0gsUUFBeEIsQ0FBaUMsaUJBQWpDLEVBQW9EZSxNQUFwRDtBQUNBakksVUFBQUEsQ0FBQyxDQUFDLG9CQUFELENBQUQsQ0FBd0JrSCxRQUF4QixDQUFpQyxjQUFqQyxFQUFpRGUsTUFBakQ7QUFDQWpJLFVBQUFBLENBQUMsQ0FBQyxvQkFBRCxDQUFELENBQXdCa0gsUUFBeEIsQ0FBaUMsaUJBQWpDLEVBQW9EZSxNQUFwRDtBQUNEOztBQUNEakksUUFBQUEsQ0FBQyxDQUFDLFFBQUQsRUFBVyxrQkFBWCxDQUFELENBQWdDMkUsV0FBaEMsQ0FBNEMsT0FBNUM7QUFDRCxPQVBELEVBN0p1QixDQXNLdkI7O0FBQ0EzRSxNQUFBQSxDQUFDLENBQUMsaUNBQUQsQ0FBRCxDQUFxQzRFLEVBQXJDLENBQXdDLE9BQXhDLEVBQWlELFVBQVU2RCxDQUFWLEVBQWE7QUFDNURBLFFBQUFBLENBQUMsQ0FBQ3ZELGNBQUY7QUFDRCxPQUZEO0FBR0QsS0E1TFM7O0FBOExWO0FBQ0o7QUFDQTtBQUNBOztBQUVJO0FBQ0o7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFRSTtBQUNBWixJQUFBQSxRQUFRLEVBQUUsa0JBQVVvRSxTQUFWLEVBQXFCUSxRQUFyQixFQUErQjtBQUN2QyxVQUFJQyxPQUFPLEdBQUdULFNBQVMsQ0FBQ3hCLFFBQVYsQ0FBbUIsSUFBbkIsQ0FBZDtBQUFBLFVBQ0VrQyxVQUFVLEdBQUdWLFNBQVMsQ0FBQ3hCLFFBQVYsR0FBcUJtQyxLQUFyQixFQURmO0FBQUEsVUFFRUMsVUFBVSxHQUFHdEosQ0FBQyxDQUFDb0osVUFBRCxDQUFELENBQWN6RixXQUFkLEVBRmY7QUFJQStFLE1BQUFBLFNBQVMsQ0FBQ2pGLEdBQVYsQ0FBYztBQUNaQyxRQUFBQSxNQUFNLEVBQUU0RixVQUFVLEdBQUdILE9BQU8sQ0FBQ3hGLFdBQVIsRUFBYixHQUFxQyxJQURqQztBQUVaNEYsUUFBQUEsUUFBUSxFQUFFO0FBRkUsT0FBZDtBQUtBYixNQUFBQSxTQUFTLENBQUN0RyxRQUFWLENBQW1CLHFCQUFuQjtBQUNBc0csTUFBQUEsU0FBUyxDQUFDdEcsUUFBVixDQUFtQixtQkFBbkI7O0FBRUFwQyxNQUFBQSxDQUFDLENBQUNNLEdBQUYsQ0FBTTZHLEdBQU4sQ0FBVXFDLHNCQUFWLENBQWlDZCxTQUFqQyxFQUE0QyxZQUFZO0FBQ3REQSxRQUFBQSxTQUFTLENBQUMvRCxXQUFWLENBQXNCLE1BQXRCOztBQUNBM0UsUUFBQUEsQ0FBQyxDQUFDTSxHQUFGLENBQU02RyxHQUFOLENBQVVzQyxlQUFWLENBQTBCZixTQUExQjtBQUNELE9BSEQ7O0FBS0F4RixNQUFBQSxVQUFVLENBQUMsWUFBWTtBQUNyQndGLFFBQUFBLFNBQVMsQ0FBQ2pGLEdBQVYsQ0FBYztBQUNaQyxVQUFBQSxNQUFNLEVBQUU0RixVQUFVLEdBQUc7QUFEVCxTQUFkO0FBR0QsT0FKUyxFQUlQLEVBSk8sQ0FBVjtBQUtELEtBbFFTO0FBb1FWO0FBQ0EvRSxJQUFBQSxNQUFNLEVBQUUsZ0JBQVVtRSxTQUFWLEVBQXFCUSxRQUFyQixFQUErQjtBQUNyQyxVQUFJQyxPQUFPLEdBQUdULFNBQVMsQ0FBQ3hCLFFBQVYsQ0FBbUIsSUFBbkIsQ0FBZDtBQUFBLFVBQ0VrQyxVQUFVLEdBQUdWLFNBQVMsQ0FBQ3hCLFFBQVYsR0FBcUJtQyxLQUFyQixFQURmO0FBQUEsVUFFRUMsVUFBVSxHQUFHdEosQ0FBQyxDQUFDb0osVUFBRCxDQUFELENBQWN6RixXQUFkLEVBRmY7QUFJQStFLE1BQUFBLFNBQVMsQ0FBQ3RHLFFBQVYsQ0FBbUIscUJBQW5CO0FBRUFzRyxNQUFBQSxTQUFTLENBQUNqRixHQUFWLENBQWM7QUFDWjhGLFFBQUFBLFFBQVEsRUFBRSxRQURFO0FBRVo3RixRQUFBQSxNQUFNLEVBQUU0RixVQUFVLEdBQUc7QUFGVCxPQUFkO0FBS0FaLE1BQUFBLFNBQVMsQ0FBQ3RHLFFBQVYsQ0FBbUIsTUFBbkI7O0FBRUFwQyxNQUFBQSxDQUFDLENBQUNNLEdBQUYsQ0FBTTZHLEdBQU4sQ0FBVXFDLHNCQUFWLENBQWlDZCxTQUFqQyxFQUE0QyxZQUFZO0FBQ3REMUksUUFBQUEsQ0FBQyxDQUFDTSxHQUFGLENBQU02RyxHQUFOLENBQVVzQyxlQUFWLENBQTBCZixTQUExQjtBQUNELE9BRkQ7O0FBSUF4RixNQUFBQSxVQUFVLENBQUMsWUFBWTtBQUNyQndGLFFBQUFBLFNBQVMsQ0FBQ2pGLEdBQVYsQ0FBYztBQUNaQyxVQUFBQSxNQUFNLEVBQUU0RixVQUFVLEdBQUdILE9BQU8sQ0FBQ3hGLFdBQVIsRUFBYixHQUFxQztBQURqQyxTQUFkO0FBR0QsT0FKUyxFQUlQLEVBSk8sQ0FBVjtBQUtELEtBNVJTO0FBOFJWNkYsSUFBQUEsc0JBOVJVLGtDQThSYUUsRUE5UmIsRUE4UmlCQyxPQTlSakIsRUE4UjBCO0FBQ2xDRCxNQUFBQSxFQUFFLEdBQUdBLEVBQUUsQ0FBQyxDQUFELENBQVA7O0FBRUEsVUFBSUUsRUFBRSxHQUFHLFNBQUxBLEVBQUssQ0FBVW5CLENBQVYsRUFBYTtBQUNwQixZQUFJQSxDQUFDLENBQUNvQixNQUFGLEtBQWFILEVBQWpCLEVBQXFCOztBQUNyQjFKLFFBQUFBLENBQUMsQ0FBQ00sR0FBRixDQUFNNkcsR0FBTixDQUFVMkMsd0JBQVYsQ0FBbUNKLEVBQW5DOztBQUNBQyxRQUFBQSxPQUFPLENBQUNsQixDQUFELENBQVA7QUFDRCxPQUpEOztBQU1BLFVBQUlzQixRQUFRLEdBQUdqSyxNQUFNLENBQUNrSyxnQkFBUCxDQUF3Qk4sRUFBeEIsRUFBNEJPLGtCQUEzQztBQUNBRixNQUFBQSxRQUFRLEdBQUdHLFVBQVUsQ0FBQ0gsUUFBRCxDQUFWLElBQXdCQSxRQUFRLENBQUNJLE9BQVQsQ0FBaUIsSUFBakIsTUFBMkIsQ0FBQyxDQUE1QixHQUFnQyxDQUFoQyxHQUFvQyxJQUE1RCxDQUFYO0FBRUFULE1BQUFBLEVBQUUsQ0FBQ1Usd0JBQUgsR0FBOEJSLEVBQTlCO0FBQ0E1SixNQUFBQSxDQUFDLENBQUNNLEdBQUYsQ0FBTTZHLEdBQU4sQ0FBVU8saUJBQVYsQ0FBNEIyQyxPQUE1QixDQUFvQyxVQUFVQyxFQUFWLEVBQWM7QUFDaERaLFFBQUFBLEVBQUUsQ0FBQ2EsZ0JBQUgsQ0FBb0JELEVBQXBCLEVBQXdCWixFQUFFLENBQUNVLHdCQUEzQixFQUFxRCxLQUFyRDtBQUNELE9BRkQ7QUFJQVYsTUFBQUEsRUFBRSxDQUFDYyw2QkFBSCxHQUFtQ3RILFVBQVUsQ0FBQyxZQUFZO0FBQ3hEMEcsUUFBQUEsRUFBRSxDQUFDO0FBQUVDLFVBQUFBLE1BQU0sRUFBRUg7QUFBVixTQUFELENBQUY7QUFDRCxPQUY0QyxFQUUxQ0ssUUFBUSxHQUFHLEVBRitCLENBQTdDO0FBR0QsS0FsVFM7QUFvVFZELElBQUFBLHdCQXBUVSxvQ0FvVGVKLEVBcFRmLEVBb1RtQjtBQUMzQixVQUFJRSxFQUFFLEdBQUdGLEVBQUUsQ0FBQ1Usd0JBQVo7O0FBRUEsVUFBSVYsRUFBRSxDQUFDYyw2QkFBUCxFQUFzQztBQUNwQ0MsUUFBQUEsWUFBWSxDQUFDZixFQUFFLENBQUNjLDZCQUFKLENBQVo7QUFDQWQsUUFBQUEsRUFBRSxDQUFDYyw2QkFBSCxHQUFtQyxJQUFuQztBQUNEOztBQUVELFVBQUksQ0FBQ1osRUFBTCxFQUFTO0FBRVQ1SixNQUFBQSxDQUFDLENBQUNNLEdBQUYsQ0FBTTZHLEdBQU4sQ0FBVU8saUJBQVYsQ0FBNEIyQyxPQUE1QixDQUFvQyxVQUFVQyxFQUFWLEVBQWM7QUFDaERaLFFBQUFBLEVBQUUsQ0FBQ2dCLG1CQUFILENBQXVCSixFQUF2QixFQUEyQlYsRUFBM0IsRUFBK0IsS0FBL0I7QUFDRCxPQUZEO0FBR0FGLE1BQUFBLEVBQUUsQ0FBQ1Usd0JBQUgsR0FBOEIsSUFBOUI7QUFDRCxLQWxVUztBQW9VVlgsSUFBQUEsZUFBZSxFQUFFLHlCQUFVZixTQUFWLEVBQXFCO0FBQ3BDQSxNQUFBQSxTQUFTLENBQUMvRCxXQUFWLENBQXNCLHFCQUF0QjtBQUNBK0QsTUFBQUEsU0FBUyxDQUFDL0QsV0FBVixDQUFzQixtQkFBdEI7QUFDQStELE1BQUFBLFNBQVMsQ0FBQ2pGLEdBQVYsQ0FBYztBQUNaOEYsUUFBQUEsUUFBUSxFQUFFLEVBREU7QUFFWjdGLFFBQUFBLE1BQU0sRUFBRTtBQUZJLE9BQWQ7QUFJRCxLQTNVUztBQTZVVmlILElBQUFBLE9BQU8sRUFBRSxtQkFBWTtBQUNuQjNLLE1BQUFBLENBQUMsQ0FBQ00sR0FBRixDQUFNNkcsR0FBTixDQUFVbEcsU0FBVixDQUFvQjZELElBQXBCLENBQXlCLE9BQXpCLEVBQWtDSCxXQUFsQyxDQUE4QyxNQUE5QztBQUNEO0FBL1VTLEdBQVosQ0FobkI4QixDQWs4QjlCO0FBQ0E7O0FBQ0EzRSxFQUFBQSxDQUFDLENBQUNELFFBQUQsQ0FBRCxDQUFZNkUsRUFBWixDQUFlLE9BQWYsRUFBd0IsYUFBeEIsRUFBdUMsVUFBVTZELENBQVYsRUFBYTtBQUNsREEsSUFBQUEsQ0FBQyxDQUFDdkQsY0FBRjtBQUNELEdBRkQ7QUFHRCxDQXY4QkQsRUF1OEJHcEYsTUF2OEJILEVBdThCV0MsUUF2OEJYLEVBdThCcUI2SyxNQXY4QnJCLEdBeThCQTs7O0FBQ0E5SyxNQUFNLENBQUN5SyxnQkFBUCxDQUF3QixRQUF4QixFQUFrQyxZQUFZO0FBQzVDO0FBQ0EsTUFBSXRLLEVBQUUsR0FBR0gsTUFBTSxDQUFDSSxXQUFQLEdBQXFCLElBQTlCO0FBQ0FILEVBQUFBLFFBQVEsQ0FBQ0ksZUFBVCxDQUF5QkMsS0FBekIsQ0FBK0JDLFdBQS9CLENBQTJDLE1BQTNDLEVBQW1ESixFQUFFLEdBQUcsSUFBeEQ7QUFDRCxDQUpELEUiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvY29yZS9hcHAtbWVudS5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyIvKj09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09XG4gIEZpbGUgTmFtZTogYXBwLW1lbnUuanNcbiAgRGVzY3JpcHRpb246IE1lbnUgbmF2aWdhdGlvbiwgY3VzdG9tIHNjcm9sbGJhciwgaG92ZXIgc2Nyb2xsIGJhciwgbXVsdGlsZXZlbCBtZW51XG4gIGluaXRpYWxpemF0aW9uIGFuZCBtYW5pcHVsYXRpb25zXG4gIC0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAgSXRlbSBOYW1lOiBCaWNyeXB0byAtIENyeXB0byBUcmFkaW5nIFBsYXRmb3JtXG4gIEF1dGhvcjogTWFzaERpdlxuICBBdXRob3IgVVJMOiBoaHR0cDovL3d3dy50aGVtZWZvcmVzdC5uZXQvdXNlci9tYXNoZGl2XG49PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT0qL1xuKGZ1bmN0aW9uICh3aW5kb3csIGRvY3VtZW50LCAkKSB7XG4gICd1c2Ugc3RyaWN0JztcblxuICB2YXIgdmggPSB3aW5kb3cuaW5uZXJIZWlnaHQgKiAwLjAxO1xuICBkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc3R5bGUuc2V0UHJvcGVydHkoJy0tdmgnLCB2aCArICdweCcpO1xuXG4gICQuYXBwID0gJC5hcHAgfHwge307XG5cbiAgdmFyICRib2R5ID0gJCgnYm9keScpO1xuICB2YXIgJHdpbmRvdyA9ICQod2luZG93KTtcbiAgdmFyIG1lbnVXcmFwcGVyX2VsID0gJCgnZGl2W2RhdGEtbWVudT1cIm1lbnUtd3JhcHBlclwiXScpLmh0bWwoKTtcbiAgdmFyIG1lbnVXcmFwcGVyQ2xhc3NlcyA9ICQoJ2RpdltkYXRhLW1lbnU9XCJtZW51LXdyYXBwZXJcIl0nKS5hdHRyKCdjbGFzcycpO1xuXG4gIC8vIE1haW4gbWVudVxuICAkLmFwcC5tZW51ID0ge1xuICAgIGV4cGFuZGVkOiBudWxsLFxuICAgIGNvbGxhcHNlZDogbnVsbCxcbiAgICBoaWRkZW46IG51bGwsXG4gICAgY29udGFpbmVyOiBudWxsLFxuICAgIGhvcml6b250YWxNZW51OiBmYWxzZSxcblxuICAgIGlzX3RvdWNoX2RldmljZTogZnVuY3Rpb24gKCkge1xuICAgICAgdmFyIHByZWZpeGVzID0gJyAtd2Via2l0LSAtbW96LSAtby0gLW1zLSAnLnNwbGl0KCcgJyk7XG4gICAgICB2YXIgbXEgPSBmdW5jdGlvbiAocXVlcnkpIHtcbiAgICAgICAgcmV0dXJuIHdpbmRvdy5tYXRjaE1lZGlhKHF1ZXJ5KS5tYXRjaGVzO1xuICAgICAgfTtcbiAgICAgIGlmICgnb250b3VjaHN0YXJ0JyBpbiB3aW5kb3cgfHwgKHdpbmRvdy5Eb2N1bWVudFRvdWNoICYmIGRvY3VtZW50IGluc3RhbmNlb2YgRG9jdW1lbnRUb3VjaCkpIHtcbiAgICAgICAgcmV0dXJuIHRydWU7XG4gICAgICB9XG4gICAgICAvLyBpbmNsdWRlIHRoZSAnaGVhcnR6JyBhcyBhIHdheSB0byBoYXZlIGEgbm9uIG1hdGNoaW5nIE1RIHRvIGhlbHAgdGVybWluYXRlIHRoZSBqb2luXG4gICAgICAvLyBodHRwczovL2dpdC5pby92em5GSFxuICAgICAgdmFyIHF1ZXJ5ID0gWycoJywgcHJlZml4ZXMuam9pbigndG91Y2gtZW5hYmxlZCksKCcpLCAnaGVhcnR6JywgJyknXS5qb2luKCcnKTtcbiAgICAgIHJldHVybiBtcShxdWVyeSk7XG4gICAgfSxcblxuICAgIG1hbnVhbFNjcm9sbGVyOiB7XG4gICAgICBvYmo6IG51bGwsXG5cbiAgICAgIGluaXQ6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgdmFyIHNjcm9sbF90aGVtZSA9ICQoJy5tYWluLW1lbnUnKS5oYXNDbGFzcygnbWVudS1kYXJrJykgPyAnbGlnaHQnIDogJ2RhcmsnO1xuICAgICAgICBpZiAoISQuYXBwLm1lbnUuaXNfdG91Y2hfZGV2aWNlKCkpIHtcbiAgICAgICAgICB0aGlzLm9iaiA9IG5ldyBQZXJmZWN0U2Nyb2xsYmFyKCcubWFpbi1tZW51LWNvbnRlbnQnLCB7XG4gICAgICAgICAgICBzdXBwcmVzc1Njcm9sbFg6IHRydWUsXG4gICAgICAgICAgICB3aGVlbFByb3BhZ2F0aW9uOiBmYWxzZVxuICAgICAgICAgIH0pO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICQoJy5tYWluLW1lbnUnKS5hZGRDbGFzcygnbWVudS1uYXRpdmUtc2Nyb2xsJyk7XG4gICAgICAgIH1cbiAgICAgIH0sXG5cbiAgICAgIHVwZGF0ZTogZnVuY3Rpb24gKCkge1xuICAgICAgICAvLyBpZiAodGhpcy5vYmopIHtcbiAgICAgICAgLy8gU2Nyb2xsIHRvIGN1cnJlbnRseSBhY3RpdmUgbWVudSBvbiBwYWdlIGxvYWQgaWYgZGF0YS1zY3JvbGwtdG8tYWN0aXZlIGlzIHRydWVcbiAgICAgICAgaWYgKCQoJy5tYWluLW1lbnUnKS5kYXRhKCdzY3JvbGwtdG8tYWN0aXZlJykgPT09IHRydWUpIHtcbiAgICAgICAgICB2YXIgYWN0aXZlRWwsIG1lbnUsIGFjdGl2ZUVsSGVpZ2h0O1xuICAgICAgICAgIGFjdGl2ZUVsID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignLm1haW4tbWVudS1jb250ZW50IGxpLmFjdGl2ZScpO1xuICAgICAgICAgIG1lbnUgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcubWFpbi1tZW51LWNvbnRlbnQnKTtcbiAgICAgICAgICBpZiAoJGJvZHkuaGFzQ2xhc3MoJ21lbnUtY29sbGFwc2VkJykpIHtcbiAgICAgICAgICAgIGlmICgkKCcubWFpbi1tZW51LWNvbnRlbnQgbGkuc2lkZWJhci1ncm91cC1hY3RpdmUnKS5sZW5ndGgpIHtcbiAgICAgICAgICAgICAgYWN0aXZlRWwgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcubWFpbi1tZW51LWNvbnRlbnQgbGkuc2lkZWJhci1ncm91cC1hY3RpdmUnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9XG4gICAgICAgICAgaWYgKGFjdGl2ZUVsKSB7XG4gICAgICAgICAgICBhY3RpdmVFbEhlaWdodCA9IGFjdGl2ZUVsLmdldEJvdW5kaW5nQ2xpZW50UmVjdCgpLnRvcCArIG1lbnUuc2Nyb2xsVG9wO1xuICAgICAgICAgIH1cblxuICAgICAgICAgIC8vIElmIGFjdGl2ZSBlbGVtZW50J3MgdG9wIHBvc2l0aW9uIGlzIGxlc3MgdGhhbiAyLzMgKDY2JSkgb2YgbWVudSBoZWlnaHQgdGhhbiBkbyBub3Qgc2Nyb2xsXG4gICAgICAgICAgaWYgKGFjdGl2ZUVsSGVpZ2h0ID4gcGFyc2VJbnQoKG1lbnUuY2xpZW50SGVpZ2h0ICogMikgLyAzKSkge1xuICAgICAgICAgICAgdmFyIHN0YXJ0ID0gbWVudS5zY3JvbGxUb3AsXG4gICAgICAgICAgICAgIGNoYW5nZSA9IGFjdGl2ZUVsSGVpZ2h0IC0gc3RhcnQgLSBwYXJzZUludChtZW51LmNsaWVudEhlaWdodCAvIDIpO1xuICAgICAgICAgIH1cbiAgICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgICQuYXBwLm1lbnUuY29udGFpbmVyLnN0b3AoKS5hbmltYXRlKFxuICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgc2Nyb2xsVG9wOiBjaGFuZ2VcbiAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgICAgMzAwXG4gICAgICAgICAgICApO1xuICAgICAgICAgICAgJCgnLm1haW4tbWVudScpLmRhdGEoJ3Njcm9sbC10by1hY3RpdmUnLCAnZmFsc2UnKTtcbiAgICAgICAgICB9LCAzMDApO1xuICAgICAgICB9XG4gICAgICAgIC8vIHRoaXMub2JqLnVwZGF0ZSgpO1xuICAgICAgICAvLyB9XG4gICAgICB9LFxuXG4gICAgICBlbmFibGU6IGZ1bmN0aW9uICgpIHtcbiAgICAgICAgaWYgKCEkKCcubWFpbi1tZW51LWNvbnRlbnQnKS5oYXNDbGFzcygncHMnKSkge1xuICAgICAgICAgIHRoaXMuaW5pdCgpO1xuICAgICAgICB9XG4gICAgICB9LFxuXG4gICAgICBkaXNhYmxlOiBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGlmICh0aGlzLm9iaikge1xuICAgICAgICAgIHRoaXMub2JqLmRlc3Ryb3koKTtcbiAgICAgICAgfVxuICAgICAgfSxcblxuICAgICAgdXBkYXRlSGVpZ2h0OiBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGlmIChcbiAgICAgICAgICAoJGJvZHkuZGF0YSgnbWVudScpID09ICd2ZXJ0aWNhbC1tZW51JyB8fFxuICAgICAgICAgICAgJGJvZHkuZGF0YSgnbWVudScpID09ICd2ZXJ0aWNhbC1tZW51LW1vZGVybicgfHxcbiAgICAgICAgICAgICRib2R5LmRhdGEoJ21lbnUnKSA9PSAndmVydGljYWwtb3ZlcmxheS1tZW51JykgJiZcbiAgICAgICAgICAkKCcubWFpbi1tZW51JykuaGFzQ2xhc3MoJ21lbnUtZml4ZWQnKVxuICAgICAgICApIHtcbiAgICAgICAgICAkKCcubWFpbi1tZW51LWNvbnRlbnQnKS5jc3MoXG4gICAgICAgICAgICAnaGVpZ2h0JyxcbiAgICAgICAgICAgICQod2luZG93KS5oZWlnaHQoKSAtXG4gICAgICAgICAgICAgICQoJy5oZWFkZXItbmF2YmFyJykuaGVpZ2h0KCkgLVxuICAgICAgICAgICAgICAkKCcubWFpbi1tZW51LWhlYWRlcicpLm91dGVySGVpZ2h0KCkgLVxuICAgICAgICAgICAgICAkKCcubWFpbi1tZW51LWZvb3RlcicpLm91dGVySGVpZ2h0KClcbiAgICAgICAgICApO1xuICAgICAgICAgIHRoaXMudXBkYXRlKCk7XG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9LFxuXG4gICAgaW5pdDogZnVuY3Rpb24gKGNvbXBhY3RNZW51KSB7XG4gICAgICBpZiAoJCgnLm1haW4tbWVudS1jb250ZW50JykubGVuZ3RoID4gMCkge1xuICAgICAgICB0aGlzLmNvbnRhaW5lciA9ICQoJy5tYWluLW1lbnUtY29udGVudCcpO1xuXG4gICAgICAgIHZhciBtZW51T2JqID0gdGhpcztcblxuICAgICAgICB0aGlzLmNoYW5nZShjb21wYWN0TWVudSk7XG4gICAgICB9XG4gICAgfSxcblxuICAgIGNoYW5nZTogZnVuY3Rpb24gKGNvbXBhY3RNZW51KSB7XG4gICAgICB2YXIgY3VycmVudEJyZWFrcG9pbnQgPSBVbmlzb24uZmV0Y2gubm93KCk7IC8vIEN1cnJlbnQgQnJlYWtwb2ludFxuXG4gICAgICB0aGlzLnJlc2V0KCk7XG5cbiAgICAgIHZhciBtZW51VHlwZSA9ICRib2R5LmRhdGEoJ21lbnUnKTtcblxuICAgICAgaWYgKGN1cnJlbnRCcmVha3BvaW50KSB7XG4gICAgICAgIHN3aXRjaCAoY3VycmVudEJyZWFrcG9pbnQubmFtZSkge1xuICAgICAgICAgIGNhc2UgJ3hsJzpcbiAgICAgICAgICAgIGlmIChtZW51VHlwZSA9PT0gJ3ZlcnRpY2FsLW92ZXJsYXktbWVudScpIHtcbiAgICAgICAgICAgICAgdGhpcy5oaWRlKCk7XG4gICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICBpZiAoY29tcGFjdE1lbnUgPT09IHRydWUpIHRoaXMuY29sbGFwc2UoY29tcGFjdE1lbnUpO1xuICAgICAgICAgICAgICBlbHNlIHRoaXMuZXhwYW5kKCk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICBicmVhaztcbiAgICAgICAgICBjYXNlICdsZyc6XG4gICAgICAgICAgICBpZiAoXG4gICAgICAgICAgICAgIG1lbnVUeXBlID09PSAndmVydGljYWwtb3ZlcmxheS1tZW51JyB8fFxuICAgICAgICAgICAgICBtZW51VHlwZSA9PT0gJ3ZlcnRpY2FsLW1lbnUtbW9kZXJuJyB8fFxuICAgICAgICAgICAgICBtZW51VHlwZSA9PT0gJ2hvcml6b250YWwtbWVudSdcbiAgICAgICAgICAgICkge1xuICAgICAgICAgICAgICB0aGlzLmhpZGUoKTtcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgIHRoaXMuY29sbGFwc2UoKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgIGNhc2UgJ21kJzpcbiAgICAgICAgICBjYXNlICdzbSc6XG4gICAgICAgICAgICB0aGlzLmhpZGUoKTtcbiAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgIGNhc2UgJ3hzJzpcbiAgICAgICAgICAgIHRoaXMuaGlkZSgpO1xuICAgICAgICAgICAgYnJlYWs7XG4gICAgICAgIH1cbiAgICAgIH1cblxuICAgICAgLy8gT24gdGhlIHNtYWxsIGFuZCBleHRyYSBzbWFsbCBzY3JlZW4gbWFrZSB0aGVtIG92ZXJsYXkgbWVudVxuICAgICAgaWYgKG1lbnVUeXBlID09PSAndmVydGljYWwtbWVudScgfHwgbWVudVR5cGUgPT09ICd2ZXJ0aWNhbC1tZW51LW1vZGVybicpIHtcbiAgICAgICAgdGhpcy50b092ZXJsYXlNZW51KGN1cnJlbnRCcmVha3BvaW50Lm5hbWUsIG1lbnVUeXBlKTtcbiAgICAgIH1cblxuICAgICAgaWYgKCRib2R5LmlzKCcuaG9yaXpvbnRhbC1sYXlvdXQnKSAmJiAhJGJvZHkuaGFzQ2xhc3MoJy5ob3Jpem9udGFsLW1lbnUtZGVtbycpKSB7XG4gICAgICAgIHRoaXMuY2hhbmdlTWVudShjdXJyZW50QnJlYWtwb2ludC5uYW1lKTtcblxuICAgICAgICAkKCcubWVudS10b2dnbGUnKS5yZW1vdmVDbGFzcygnaXMtYWN0aXZlJyk7XG4gICAgICB9XG5cbiAgICAgIC8vIERyb3Bkb3duIHN1Ym1lbnUgb24gbGFyZ2Ugc2NyZWVuIG9uIGhvdmVyIEZvciBMYXJnZSBzY3JlZW4gb25seVxuICAgICAgLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXG4gICAgICBpZiAoY3VycmVudEJyZWFrcG9pbnQubmFtZSA9PSAneGwnKSB7XG4gICAgICAgICQoJ2JvZHlbZGF0YS1vcGVuPVwiaG92ZXJcIl0gLm1haW4tbWVudS1jb250ZW50IC5kcm9wZG93bicpIC8vIFVzZSBzZWxlY3RvciAkKCdib2R5W2RhdGEtb3Blbj1cImhvdmVyXCJdIC5oZWFkZXItbmF2YmFyIC5kcm9wZG93bicpIGZvciBtZW51IGFuZCBuYXZiYXIgREQgb3BlbiBvbiBob3ZlclxuICAgICAgICAgIC5vbignbW91c2VlbnRlcicsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIGlmICghJCh0aGlzKS5oYXNDbGFzcygnc2hvdycpKSB7XG4gICAgICAgICAgICAgICQodGhpcykuYWRkQ2xhc3MoJ3Nob3cnKTtcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICQodGhpcykucmVtb3ZlQ2xhc3MoJ3Nob3cnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9KVxuICAgICAgICAgIC5vbignbW91c2VsZWF2ZScsIGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICAgICAgJCh0aGlzKS5yZW1vdmVDbGFzcygnc2hvdycpO1xuICAgICAgICAgIH0pO1xuICAgICAgICAvKiA/IFVuY29tbWVudCB0byBlbmFibGUgYWxsIEREIG9wZW4gb24gaG92ZXJcbiAgICAgICAgJCgnYm9keVtkYXRhLW9wZW49XCJob3ZlclwiXSAuZHJvcGRvd24gYScpLm9uKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XG4gICAgICAgICAgaWYgKG1lbnVUeXBlID09ICdob3Jpem9udGFsLW1lbnUnKSB7XG4gICAgICAgICAgICB2YXIgJHRoaXMgPSAkKHRoaXMpO1xuICAgICAgICAgICAgaWYgKCR0aGlzLmhhc0NsYXNzKCdkcm9wZG93bi10b2dnbGUnKSkge1xuICAgICAgICAgICAgICByZXR1cm4gZmFsc2U7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgfVxuICAgICAgICB9KTtcbiAgICAgICAgKi9cbiAgICAgIH1cblxuICAgICAgLy8gQWRkZWQgZGF0YSBhdHRyaWJ1dGUgYnJhbmQtY2VudGVyIGZvciBuYXZiYXItYnJhbmQtY2VudGVyXG5cbiAgICAgIGlmIChjdXJyZW50QnJlYWtwb2ludC5uYW1lID09ICdzbScgfHwgY3VycmVudEJyZWFrcG9pbnQubmFtZSA9PSAneHMnKSB7XG4gICAgICAgICQoJy5oZWFkZXItbmF2YmFyW2RhdGEtbmF2PWJyYW5kLWNlbnRlcl0nKS5yZW1vdmVDbGFzcygnbmF2YmFyLWJyYW5kLWNlbnRlcicpO1xuICAgICAgfSBlbHNlIHtcbiAgICAgICAgJCgnLmhlYWRlci1uYXZiYXJbZGF0YS1uYXY9YnJhbmQtY2VudGVyXScpLmFkZENsYXNzKCduYXZiYXItYnJhbmQtY2VudGVyJyk7XG4gICAgICB9XG4gICAgICAvLyBPbiBzY3JlZW4gd2lkdGggY2hhbmdlLCBjdXJyZW50IGFjdGl2ZSBtZW51IGluIGhvcml6b250YWxcbiAgICAgIGlmIChjdXJyZW50QnJlYWtwb2ludC5uYW1lID09ICd4bCcgJiYgbWVudVR5cGUgPT0gJ2hvcml6b250YWwtbWVudScpIHtcbiAgICAgICAgJCgnLm1haW4tbWVudS1jb250ZW50JykuZmluZCgnbGkuYWN0aXZlJykucGFyZW50cygnbGknKS5hZGRDbGFzcygnc2lkZWJhci1ncm91cC1hY3RpdmUgYWN0aXZlJyk7XG4gICAgICB9XG5cbiAgICAgIGlmIChjdXJyZW50QnJlYWtwb2ludC5uYW1lICE9PSAneGwnICYmIG1lbnVUeXBlID09ICdob3Jpem9udGFsLW1lbnUnKSB7XG4gICAgICAgICQoJyNuYXZiYXItdHlwZScpLnRvZ2dsZUNsYXNzKCdkLW5vbmUgZC14bC1ibG9jaycpO1xuICAgICAgfVxuXG4gICAgICAvLyBEcm9wZG93biBzdWJtZW51IG9uIHNtYWxsIHNjcmVlbiBvbiBjbGlja1xuICAgICAgLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAgICAgICQoJ3VsLmRyb3Bkb3duLW1lbnUgW2RhdGEtYnMtdG9nZ2xlPWRyb3Bkb3duXScpLm9uKCdjbGljaycsIGZ1bmN0aW9uIChldmVudCkge1xuICAgICAgICBpZiAoJCh0aGlzKS5zaWJsaW5ncygndWwuZHJvcGRvd24tbWVudScpLmxlbmd0aCA+IDApIHtcbiAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICB9XG4gICAgICAgIGV2ZW50LnN0b3BQcm9wYWdhdGlvbigpO1xuICAgICAgICAkKHRoaXMpLnBhcmVudCgpLnNpYmxpbmdzKCkucmVtb3ZlQ2xhc3MoJ3Nob3cnKTtcbiAgICAgICAgJCh0aGlzKS5wYXJlbnQoKS50b2dnbGVDbGFzcygnc2hvdycpO1xuICAgICAgfSk7XG5cbiAgICAgIC8vIEhvcml6b250YWwgbGF5b3V0IHN1Ym1lbnUgZHJhd2VyIHNjcm9sbGJhclxuICAgICAgaWYgKG1lbnVUeXBlID09ICdob3Jpem9udGFsLW1lbnUnKSB7XG4gICAgICAgICQoJ2xpLmRyb3Bkb3duLXN1Ym1lbnUnKS5vbignbW91c2VlbnRlcicsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICBpZiAoISQodGhpcykucGFyZW50KCcuZHJvcGRvd24nKS5oYXNDbGFzcygnc2hvdycpKSB7XG4gICAgICAgICAgICAkKHRoaXMpLnJlbW92ZUNsYXNzKCdvcGVuTGVmdCcpO1xuICAgICAgICAgIH1cbiAgICAgICAgICB2YXIgZGQgPSAkKHRoaXMpLmZpbmQoJy5kcm9wZG93bi1tZW51Jyk7XG4gICAgICAgICAgaWYgKGRkKSB7XG4gICAgICAgICAgICB2YXIgcGFnZUhlaWdodCA9ICQod2luZG93KS5oZWlnaHQoKSxcbiAgICAgICAgICAgICAgLy8gZGRUb3AgPSBkZC5vZmZzZXQoKS50b3AsXG4gICAgICAgICAgICAgIGRkVG9wID0gJCh0aGlzKS5wb3NpdGlvbigpLnRvcCxcbiAgICAgICAgICAgICAgZGRMZWZ0ID0gZGQub2Zmc2V0KCkubGVmdCxcbiAgICAgICAgICAgICAgZGRXaWR0aCA9IGRkLndpZHRoKCksXG4gICAgICAgICAgICAgIGRkSGVpZ2h0ID0gZGQuaGVpZ2h0KCk7XG4gICAgICAgICAgICBpZiAocGFnZUhlaWdodCAtIGRkVG9wIC0gZGRIZWlnaHQgLSAyOCA8IDEpIHtcbiAgICAgICAgICAgICAgdmFyIG1heEhlaWdodCA9IHBhZ2VIZWlnaHQgLSBkZFRvcCAtIDE3MDtcbiAgICAgICAgICAgICAgJCh0aGlzKVxuICAgICAgICAgICAgICAgIC5maW5kKCcuZHJvcGRvd24tbWVudScpXG4gICAgICAgICAgICAgICAgLmNzcyh7XG4gICAgICAgICAgICAgICAgICAnbWF4LWhlaWdodCc6IG1heEhlaWdodCArICdweCcsXG4gICAgICAgICAgICAgICAgICAnb3ZlcmZsb3cteSc6ICdhdXRvJyxcbiAgICAgICAgICAgICAgICAgICdvdmVyZmxvdy14JzogJ2hpZGRlbidcbiAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgdmFyIG1lbnVfY29udGVudCA9IG5ldyBQZXJmZWN0U2Nyb2xsYmFyKCdsaS5kcm9wZG93bi1zdWJtZW51LnNob3cgLmRyb3Bkb3duLW1lbnUnLCB7XG4gICAgICAgICAgICAgICAgd2hlZWxQcm9wYWdhdGlvbjogZmFsc2VcbiAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICAvLyBBZGQgY2xhc3MgdG8gaG9yaXpvbnRhbCBzdWIgbWVudSBpZiBzY3JlZW4gd2lkdGggaXMgc21hbGxcbiAgICAgICAgICAgIGlmIChkZExlZnQgKyBkZFdpZHRoIC0gKHdpbmRvdy5pbm5lcldpZHRoIC0gMTYpID49IDApIHtcbiAgICAgICAgICAgICAgJCh0aGlzKS5hZGRDbGFzcygnb3BlbkxlZnQnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9XG4gICAgICAgIH0pO1xuICAgICAgICAkKCcudGhlbWUtbGF5b3V0cycpLmZpbmQoJy5zZW1pLWRhcmsnKS5oaWRlKCk7XG4gICAgICB9XG5cbiAgICAgIC8vIEhvcml6b250YWwgRml4ZWQgTmF2IFN0aWNreSBoaWdodCBpc3N1ZSBvbiBzbWFsbCBzY3JlZW5zXG4gICAgICAvLyBpZiAobWVudVR5cGUgPT0gJ2hvcml6b250YWwtbWVudScpIHtcbiAgICAgIC8vICAgaWYgKGN1cnJlbnRCcmVha3BvaW50Lm5hbWUgPT0gJ3NtJyB8fCBjdXJyZW50QnJlYWtwb2ludC5uYW1lID09ICd4cycpIHtcbiAgICAgIC8vICAgICBpZiAoJChcIi5tZW51LWZpeGVkXCIpLmxlbmd0aCkge1xuICAgICAgLy8gICAgICAgJChcIi5tZW51LWZpeGVkXCIpLnVuc3RpY2soKTtcbiAgICAgIC8vICAgICB9XG4gICAgICAvLyAgIH1cbiAgICAgIC8vICAgZWxzZSB7XG4gICAgICAvLyAgICAgaWYgKCQoXCIubmF2YmFyLWZpeGVkXCIpLmxlbmd0aCkge1xuICAgICAgLy8gICAgICAgJChcIi5uYXZiYXItZml4ZWRcIikuc3RpY2t5KCk7XG4gICAgICAvLyAgICAgfVxuICAgICAgLy8gICB9XG4gICAgICAvLyB9XG4gICAgfSxcblxuICAgIHRyYW5zaXQ6IGZ1bmN0aW9uIChjYWxsYmFjazEsIGNhbGxiYWNrMikge1xuICAgICAgdmFyIG1lbnVPYmogPSB0aGlzO1xuICAgICAgJGJvZHkuYWRkQ2xhc3MoJ2NoYW5naW5nLW1lbnUnKTtcblxuICAgICAgY2FsbGJhY2sxLmNhbGwobWVudU9iaik7XG5cbiAgICAgIGlmICgkYm9keS5oYXNDbGFzcygndmVydGljYWwtbGF5b3V0JykpIHtcbiAgICAgICAgaWYgKCRib2R5Lmhhc0NsYXNzKCdtZW51LW9wZW4nKSB8fCAkYm9keS5oYXNDbGFzcygnbWVudS1leHBhbmRlZCcpKSB7XG4gICAgICAgICAgJCgnLm1lbnUtdG9nZ2xlJykuYWRkQ2xhc3MoJ2lzLWFjdGl2ZScpO1xuXG4gICAgICAgICAgLy8gU2hvdyBtZW51IGhlYWRlciBzZWFyY2ggd2hlbiBtZW51IGlzIG5vcm1hbGx5IHZpc2libGVcbiAgICAgICAgICBpZiAoJGJvZHkuZGF0YSgnbWVudScpID09PSAndmVydGljYWwtbWVudScpIHtcbiAgICAgICAgICAgIGlmICgkKCcubWFpbi1tZW51LWhlYWRlcicpKSB7XG4gICAgICAgICAgICAgICQoJy5tYWluLW1lbnUtaGVhZGVyJykuc2hvdygpO1xuICAgICAgICAgICAgfVxuICAgICAgICAgIH1cbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAkKCcubWVudS10b2dnbGUnKS5yZW1vdmVDbGFzcygnaXMtYWN0aXZlJyk7XG5cbiAgICAgICAgICAvLyBIaWRlIG1lbnUgaGVhZGVyIHNlYXJjaCB3aGVuIG9ubHkgbWVudSBpY29ucyBhcmUgdmlzaWJsZVxuICAgICAgICAgIGlmICgkYm9keS5kYXRhKCdtZW51JykgPT09ICd2ZXJ0aWNhbC1tZW51Jykge1xuICAgICAgICAgICAgaWYgKCQoJy5tYWluLW1lbnUtaGVhZGVyJykpIHtcbiAgICAgICAgICAgICAgJCgnLm1haW4tbWVudS1oZWFkZXInKS5oaWRlKCk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgfVxuICAgICAgICB9XG4gICAgICB9XG5cbiAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgICBjYWxsYmFjazIuY2FsbChtZW51T2JqKTtcbiAgICAgICAgJGJvZHkucmVtb3ZlQ2xhc3MoJ2NoYW5naW5nLW1lbnUnKTtcblxuICAgICAgICBtZW51T2JqLnVwZGF0ZSgpO1xuICAgICAgfSwgNTAwKTtcbiAgICB9LFxuXG4gICAgb3BlbjogZnVuY3Rpb24gKCkge1xuICAgICAgdGhpcy50cmFuc2l0KFxuICAgICAgICBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgJGJvZHkucmVtb3ZlQ2xhc3MoJ21lbnUtaGlkZSBtZW51LWNvbGxhcHNlZCcpLmFkZENsYXNzKCdtZW51LW9wZW4nKTtcbiAgICAgICAgICB0aGlzLmhpZGRlbiA9IGZhbHNlO1xuICAgICAgICAgIHRoaXMuZXhwYW5kZWQgPSB0cnVlO1xuXG4gICAgICAgICAgaWYgKCRib2R5Lmhhc0NsYXNzKCd2ZXJ0aWNhbC1vdmVybGF5LW1lbnUnKSkge1xuICAgICAgICAgICAgJCgnLnNpZGVuYXYtb3ZlcmxheScpLmFkZENsYXNzKCdzaG93Jyk7XG4gICAgICAgICAgICAvLyAkKCcuc2lkZW5hdi1vdmVybGF5JykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpLmFkZENsYXNzKCdkLWJsb2NrJyk7XG4gICAgICAgICAgICAvLyAkKCdib2R5JykuY3NzKCdvdmVyZmxvdycsICdoaWRkZW4nKTtcbiAgICAgICAgICB9XG4gICAgICAgIH0sXG4gICAgICAgIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICBpZiAoISQoJy5tYWluLW1lbnUnKS5oYXNDbGFzcygnbWVudS1uYXRpdmUtc2Nyb2xsJykgJiYgJCgnLm1haW4tbWVudScpLmhhc0NsYXNzKCdtZW51LWZpeGVkJykpIHtcbiAgICAgICAgICAgIHRoaXMubWFudWFsU2Nyb2xsZXIuZW5hYmxlKCk7XG4gICAgICAgICAgICAkKCcubWFpbi1tZW51LWNvbnRlbnQnKS5jc3MoXG4gICAgICAgICAgICAgICdoZWlnaHQnLFxuICAgICAgICAgICAgICAkKHdpbmRvdykuaGVpZ2h0KCkgLVxuICAgICAgICAgICAgICAgICQoJy5oZWFkZXItbmF2YmFyJykuaGVpZ2h0KCkgLVxuICAgICAgICAgICAgICAgICQoJy5tYWluLW1lbnUtaGVhZGVyJykub3V0ZXJIZWlnaHQoKSAtXG4gICAgICAgICAgICAgICAgJCgnLm1haW4tbWVudS1mb290ZXInKS5vdXRlckhlaWdodCgpXG4gICAgICAgICAgICApO1xuICAgICAgICAgICAgLy8gdGhpcy5tYW51YWxTY3JvbGxlci51cGRhdGUoKTtcbiAgICAgICAgICB9XG5cbiAgICAgICAgICBpZiAoISRib2R5Lmhhc0NsYXNzKCd2ZXJ0aWNhbC1vdmVybGF5LW1lbnUnKSkge1xuICAgICAgICAgICAgJCgnLnNpZGVuYXYtb3ZlcmxheScpLnJlbW92ZUNsYXNzKCdzaG93Jyk7XG4gICAgICAgICAgICAvLyAkKCcuc2lkZW5hdi1vdmVybGF5JykucmVtb3ZlQ2xhc3MoJ2QtYmxvY2sgZC1ub25lJyk7XG4gICAgICAgICAgICAvLyAkKCdib2R5JykuY3NzKCdvdmVyZmxvdycsICdhdXRvJyk7XG4gICAgICAgICAgfVxuICAgICAgICB9XG4gICAgICApO1xuICAgIH0sXG5cbiAgICBoaWRlOiBmdW5jdGlvbiAoKSB7XG4gICAgICB0aGlzLnRyYW5zaXQoXG4gICAgICAgIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAkYm9keS5yZW1vdmVDbGFzcygnbWVudS1vcGVuIG1lbnUtZXhwYW5kZWQnKS5hZGRDbGFzcygnbWVudS1oaWRlJyk7XG4gICAgICAgICAgdGhpcy5oaWRkZW4gPSB0cnVlO1xuICAgICAgICAgIHRoaXMuZXhwYW5kZWQgPSBmYWxzZTtcblxuICAgICAgICAgIGlmICgkYm9keS5oYXNDbGFzcygndmVydGljYWwtb3ZlcmxheS1tZW51JykpIHtcbiAgICAgICAgICAgICQoJy5zaWRlbmF2LW92ZXJsYXknKS5yZW1vdmVDbGFzcygnc2hvdycpO1xuICAgICAgICAgICAgLy8gJCgnLnNpZGVuYXYtb3ZlcmxheScpLnJlbW92ZUNsYXNzKCdkLWJsb2NrJykuYWRkQ2xhc3MoJ2Qtbm9uZScpO1xuICAgICAgICAgICAgLy8gJCgnYm9keScpLmNzcygnb3ZlcmZsb3cnLCAnYXV0bycpO1xuICAgICAgICAgIH1cbiAgICAgICAgfSxcbiAgICAgICAgZnVuY3Rpb24gKCkge1xuICAgICAgICAgIGlmICghJCgnLm1haW4tbWVudScpLmhhc0NsYXNzKCdtZW51LW5hdGl2ZS1zY3JvbGwnKSAmJiAkKCcubWFpbi1tZW51JykuaGFzQ2xhc3MoJ21lbnUtZml4ZWQnKSkge1xuICAgICAgICAgICAgdGhpcy5tYW51YWxTY3JvbGxlci5lbmFibGUoKTtcbiAgICAgICAgICB9XG5cbiAgICAgICAgICBpZiAoISRib2R5Lmhhc0NsYXNzKCd2ZXJ0aWNhbC1vdmVybGF5LW1lbnUnKSkge1xuICAgICAgICAgICAgJCgnLnNpZGVuYXYtb3ZlcmxheScpLnJlbW92ZUNsYXNzKCdzaG93Jyk7XG4gICAgICAgICAgICAvLyAkKCcuc2lkZW5hdi1vdmVybGF5JykucmVtb3ZlQ2xhc3MoJ2QtYmxvY2sgZC1ub25lJyk7XG4gICAgICAgICAgICAvLyAkKCdib2R5JykuY3NzKCdvdmVyZmxvdycsICdhdXRvJyk7XG4gICAgICAgICAgfVxuICAgICAgICB9XG4gICAgICApO1xuICAgIH0sXG5cbiAgICBleHBhbmQ6IGZ1bmN0aW9uICgpIHtcbiAgICAgIGlmICh0aGlzLmV4cGFuZGVkID09PSBmYWxzZSkge1xuICAgICAgICBpZiAoJGJvZHkuZGF0YSgnbWVudScpID09ICd2ZXJ0aWNhbC1tZW51LW1vZGVybicpIHtcbiAgICAgICAgICAkKCcubW9kZXJuLW5hdi10b2dnbGUnKVxuICAgICAgICAgICAgLmZpbmQoJy5jb2xsYXBzZS10b2dnbGUtaWNvbicpXG4gICAgICAgICAgICAucmVwbGFjZVdpdGgoXG4gICAgICAgICAgICAgIGZlYXRoZXIuaWNvbnNbJ2Rpc2MnXS50b1N2Zyh7IGNsYXNzOiAnZC1ub25lIGQteGwtYmxvY2sgY29sbGFwc2UtdG9nZ2xlLWljb24gcHJpbWFyeSBmb250LW1lZGl1bS00JyB9KVxuICAgICAgICAgICAgKTtcbiAgICAgICAgfVxuICAgICAgICB0aGlzLnRyYW5zaXQoXG4gICAgICAgICAgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgJGJvZHkucmVtb3ZlQ2xhc3MoJ21lbnUtY29sbGFwc2VkJykuYWRkQ2xhc3MoJ21lbnUtZXhwYW5kZWQnKTtcbiAgICAgICAgICAgIHRoaXMuY29sbGFwc2VkID0gZmFsc2U7XG4gICAgICAgICAgICB0aGlzLmV4cGFuZGVkID0gdHJ1ZTtcbiAgICAgICAgICAgICQoJy5zaWRlbmF2LW92ZXJsYXknKS5yZW1vdmVDbGFzcygnc2hvdycpO1xuXG4gICAgICAgICAgICAvLyAkKCcuc2lkZW5hdi1vdmVybGF5JykucmVtb3ZlQ2xhc3MoJ2QtYmxvY2sgZC1ub25lJyk7XG4gICAgICAgICAgfSxcbiAgICAgICAgICBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBpZiAoJCgnLm1haW4tbWVudScpLmhhc0NsYXNzKCdtZW51LW5hdGl2ZS1zY3JvbGwnKSB8fCAkYm9keS5kYXRhKCdtZW51JykgPT0gJ2hvcml6b250YWwtbWVudScpIHtcbiAgICAgICAgICAgICAgdGhpcy5tYW51YWxTY3JvbGxlci5kaXNhYmxlKCk7XG4gICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICBpZiAoJCgnLm1haW4tbWVudScpLmhhc0NsYXNzKCdtZW51LWZpeGVkJykpIHRoaXMubWFudWFsU2Nyb2xsZXIuZW5hYmxlKCk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIGlmIChcbiAgICAgICAgICAgICAgKCRib2R5LmRhdGEoJ21lbnUnKSA9PSAndmVydGljYWwtbWVudScgfHwgJGJvZHkuZGF0YSgnbWVudScpID09ICd2ZXJ0aWNhbC1tZW51LW1vZGVybicpICYmXG4gICAgICAgICAgICAgICQoJy5tYWluLW1lbnUnKS5oYXNDbGFzcygnbWVudS1maXhlZCcpXG4gICAgICAgICAgICApIHtcbiAgICAgICAgICAgICAgJCgnLm1haW4tbWVudS1jb250ZW50JykuY3NzKFxuICAgICAgICAgICAgICAgICdoZWlnaHQnLFxuICAgICAgICAgICAgICAgICQod2luZG93KS5oZWlnaHQoKSAtXG4gICAgICAgICAgICAgICAgICAkKCcuaGVhZGVyLW5hdmJhcicpLmhlaWdodCgpIC1cbiAgICAgICAgICAgICAgICAgICQoJy5tYWluLW1lbnUtaGVhZGVyJykub3V0ZXJIZWlnaHQoKSAtXG4gICAgICAgICAgICAgICAgICAkKCcubWFpbi1tZW51LWZvb3RlcicpLm91dGVySGVpZ2h0KClcbiAgICAgICAgICAgICAgKTtcbiAgICAgICAgICAgICAgLy8gdGhpcy5tYW51YWxTY3JvbGxlci51cGRhdGUoKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9XG4gICAgICAgICk7XG4gICAgICB9XG4gICAgfSxcblxuICAgIGNvbGxhcHNlOiBmdW5jdGlvbiAoKSB7XG4gICAgICBpZiAodGhpcy5jb2xsYXBzZWQgPT09IGZhbHNlKSB7XG4gICAgICAgIGlmICgkYm9keS5kYXRhKCdtZW51JykgPT0gJ3ZlcnRpY2FsLW1lbnUtbW9kZXJuJykge1xuICAgICAgICAgICQoJy5tb2Rlcm4tbmF2LXRvZ2dsZScpXG4gICAgICAgICAgICAuZmluZCgnLmNvbGxhcHNlLXRvZ2dsZS1pY29uJylcbiAgICAgICAgICAgIC5yZXBsYWNlV2l0aChcbiAgICAgICAgICAgICAgZmVhdGhlci5pY29uc1snY2lyY2xlJ10udG9Tdmcoe1xuICAgICAgICAgICAgICAgIGNsYXNzOiAnZC1ub25lIGQteGwtYmxvY2sgY29sbGFwc2UtdG9nZ2xlLWljb24gcHJpbWFyeSBmb250LW1lZGl1bS00J1xuICAgICAgICAgICAgICB9KVxuICAgICAgICAgICAgKTtcbiAgICAgICAgfVxuICAgICAgICB0aGlzLnRyYW5zaXQoXG4gICAgICAgICAgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgJGJvZHkucmVtb3ZlQ2xhc3MoJ21lbnUtZXhwYW5kZWQnKS5hZGRDbGFzcygnbWVudS1jb2xsYXBzZWQnKTtcbiAgICAgICAgICAgIHRoaXMuY29sbGFwc2VkID0gdHJ1ZTtcbiAgICAgICAgICAgIHRoaXMuZXhwYW5kZWQgPSBmYWxzZTtcblxuICAgICAgICAgICAgJCgnLmNvbnRlbnQtb3ZlcmxheScpLnJlbW92ZUNsYXNzKCdkLWJsb2NrIGQtbm9uZScpO1xuICAgICAgICAgIH0sXG4gICAgICAgICAgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgaWYgKCRib2R5LmRhdGEoJ21lbnUnKSA9PSAnaG9yaXpvbnRhbC1tZW51JyAmJiAkYm9keS5oYXNDbGFzcygndmVydGljYWwtb3ZlcmxheS1tZW51JykpIHtcbiAgICAgICAgICAgICAgaWYgKCQoJy5tYWluLW1lbnUnKS5oYXNDbGFzcygnbWVudS1maXhlZCcpKSB0aGlzLm1hbnVhbFNjcm9sbGVyLmVuYWJsZSgpO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgaWYgKFxuICAgICAgICAgICAgICAoJGJvZHkuZGF0YSgnbWVudScpID09ICd2ZXJ0aWNhbC1tZW51JyB8fCAkYm9keS5kYXRhKCdtZW51JykgPT0gJ3ZlcnRpY2FsLW1lbnUtbW9kZXJuJykgJiZcbiAgICAgICAgICAgICAgJCgnLm1haW4tbWVudScpLmhhc0NsYXNzKCdtZW51LWZpeGVkJylcbiAgICAgICAgICAgICkge1xuICAgICAgICAgICAgICAkKCcubWFpbi1tZW51LWNvbnRlbnQnKS5jc3MoJ2hlaWdodCcsICQod2luZG93KS5oZWlnaHQoKSAtICQoJy5oZWFkZXItbmF2YmFyJykuaGVpZ2h0KCkpO1xuICAgICAgICAgICAgICAvLyB0aGlzLm1hbnVhbFNjcm9sbGVyLnVwZGF0ZSgpO1xuICAgICAgICAgICAgfVxuICAgICAgICAgICAgaWYgKCRib2R5LmRhdGEoJ21lbnUnKSA9PSAndmVydGljYWwtbWVudS1tb2Rlcm4nKSB7XG4gICAgICAgICAgICAgIGlmICgkKCcubWFpbi1tZW51JykuaGFzQ2xhc3MoJ21lbnUtZml4ZWQnKSkgdGhpcy5tYW51YWxTY3JvbGxlci5lbmFibGUoKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9XG4gICAgICAgICk7XG4gICAgICB9XG4gICAgfSxcblxuICAgIHRvT3ZlcmxheU1lbnU6IGZ1bmN0aW9uIChzY3JlZW4sIG1lbnVUeXBlKSB7XG4gICAgICB2YXIgbWVudSA9ICRib2R5LmRhdGEoJ21lbnUnKTtcbiAgICAgIGlmIChtZW51VHlwZSA9PSAndmVydGljYWwtbWVudS1tb2Rlcm4nKSB7XG4gICAgICAgIGlmIChzY3JlZW4gPT0gJ2xnJyB8fCBzY3JlZW4gPT0gJ21kJyB8fCBzY3JlZW4gPT0gJ3NtJyB8fCBzY3JlZW4gPT0gJ3hzJykge1xuICAgICAgICAgIGlmICgkYm9keS5oYXNDbGFzcyhtZW51KSkge1xuICAgICAgICAgICAgJGJvZHkucmVtb3ZlQ2xhc3MobWVudSkuYWRkQ2xhc3MoJ3ZlcnRpY2FsLW92ZXJsYXktbWVudScpO1xuICAgICAgICAgIH1cbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICBpZiAoJGJvZHkuaGFzQ2xhc3MoJ3ZlcnRpY2FsLW92ZXJsYXktbWVudScpKSB7XG4gICAgICAgICAgICAkYm9keS5yZW1vdmVDbGFzcygndmVydGljYWwtb3ZlcmxheS1tZW51JykuYWRkQ2xhc3MobWVudSk7XG4gICAgICAgICAgfVxuICAgICAgICB9XG4gICAgICB9IGVsc2Uge1xuICAgICAgICBpZiAoc2NyZWVuID09ICdzbScgfHwgc2NyZWVuID09ICd4cycpIHtcbiAgICAgICAgICBpZiAoJGJvZHkuaGFzQ2xhc3MobWVudSkpIHtcbiAgICAgICAgICAgICRib2R5LnJlbW92ZUNsYXNzKG1lbnUpLmFkZENsYXNzKCd2ZXJ0aWNhbC1vdmVybGF5LW1lbnUnKTtcbiAgICAgICAgICB9XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgaWYgKCRib2R5Lmhhc0NsYXNzKCd2ZXJ0aWNhbC1vdmVybGF5LW1lbnUnKSkge1xuICAgICAgICAgICAgJGJvZHkucmVtb3ZlQ2xhc3MoJ3ZlcnRpY2FsLW92ZXJsYXktbWVudScpLmFkZENsYXNzKG1lbnUpO1xuICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgICAgfVxuICAgIH0sXG5cbiAgICBjaGFuZ2VNZW51OiBmdW5jdGlvbiAoc2NyZWVuKSB7XG4gICAgICAvLyBSZXBsYWNlIG1lbnUgaHRtbFxuICAgICAgJCgnZGl2W2RhdGEtbWVudT1cIm1lbnUtd3JhcHBlclwiXScpLmh0bWwoJycpO1xuICAgICAgJCgnZGl2W2RhdGEtbWVudT1cIm1lbnUtd3JhcHBlclwiXScpLmh0bWwobWVudVdyYXBwZXJfZWwpO1xuXG4gICAgICB2YXIgbWVudVdyYXBwZXIgPSAkKCdkaXZbZGF0YS1tZW51PVwibWVudS13cmFwcGVyXCJdJyksXG4gICAgICAgIG1lbnVDb250YWluZXIgPSAkKCdkaXZbZGF0YS1tZW51PVwibWVudS1jb250YWluZXJcIl0nKSxcbiAgICAgICAgbWVudU5hdmlnYXRpb24gPSAkKCd1bFtkYXRhLW1lbnU9XCJtZW51LW5hdmlnYXRpb25cIl0nKSxcbiAgICAgICAgLyptZWdhTWVudSAgICAgICAgICAgPSAkKCdsaVtkYXRhLW1lbnU9XCJtZWdhbWVudVwiXScpLFxuICAgICAgICBtZWdhTWVudUNvbCAgICAgICAgPSAkKCdsaVtkYXRhLW1lZ2EtY29sXScpLCovXG4gICAgICAgIGRyb3Bkb3duTWVudSA9ICQoJ2xpW2RhdGEtbWVudT1cImRyb3Bkb3duXCJdJyksXG4gICAgICAgIGRyb3Bkb3duU3ViTWVudSA9ICQoJ2xpW2RhdGEtbWVudT1cImRyb3Bkb3duLXN1Ym1lbnVcIl0nKTtcblxuICAgICAgaWYgKHNjcmVlbiA9PT0gJ3hsJykge1xuICAgICAgICAvLyBDaGFuZ2UgYm9keSBjbGFzc2VzXG4gICAgICAgICRib2R5LnJlbW92ZUNsYXNzKCd2ZXJ0aWNhbC1sYXlvdXQgdmVydGljYWwtb3ZlcmxheS1tZW51IGZpeGVkLW5hdmJhcicpLmFkZENsYXNzKCRib2R5LmRhdGEoJ21lbnUnKSk7XG5cbiAgICAgICAgLy8gUmVtb3ZlIG5hdmJhci1maXgtdG9wIGNsYXNzIG9uIGxhcmdlIHNjcmVlbnNcbiAgICAgICAgJCgnbmF2LmhlYWRlci1uYXZiYXInKS5yZW1vdmVDbGFzcygnZml4ZWQtdG9wJyk7XG5cbiAgICAgICAgLy8gQ2hhbmdlIG1lbnUgd3JhcHBlciwgbWVudSBjb250YWluZXIsIG1lbnUgbmF2aWdhdGlvbiBjbGFzc2VzXG4gICAgICAgIG1lbnVXcmFwcGVyLnJlbW92ZUNsYXNzKCkuYWRkQ2xhc3MobWVudVdyYXBwZXJDbGFzc2VzKTtcblxuICAgICAgICAkKCdhLmRyb3Bkb3duLWl0ZW0ubmF2LWhhcy1jaGlsZHJlbicpLm9uKCdjbGljaycsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgICAgIGV2ZW50LnN0b3BQcm9wYWdhdGlvbigpO1xuICAgICAgICB9KTtcbiAgICAgICAgJCgnYS5kcm9wZG93bi1pdGVtLm5hdi1oYXMtcGFyZW50Jykub24oJ2NsaWNrJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgICAgICAgZXZlbnQuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgIH0pO1xuICAgICAgfSBlbHNlIHtcbiAgICAgICAgLy8gQ2hhbmdlIGJvZHkgY2xhc3Nlc1xuICAgICAgICAkYm9keS5yZW1vdmVDbGFzcygkYm9keS5kYXRhKCdtZW51JykpLmFkZENsYXNzKCd2ZXJ0aWNhbC1sYXlvdXQgdmVydGljYWwtb3ZlcmxheS1tZW51IGZpeGVkLW5hdmJhcicpO1xuXG4gICAgICAgIC8vIEFkZCBuYXZiYXItZml4LXRvcCBjbGFzcyBvbiBzbWFsbCBzY3JlZW5zXG4gICAgICAgICQoJ25hdi5oZWFkZXItbmF2YmFyJykuYWRkQ2xhc3MoJ2ZpeGVkLXRvcCcpO1xuXG4gICAgICAgIC8vIENoYW5nZSBtZW51IHdyYXBwZXIsIG1lbnUgY29udGFpbmVyLCBtZW51IG5hdmlnYXRpb24gY2xhc3Nlc1xuICAgICAgICBtZW51V3JhcHBlci5yZW1vdmVDbGFzcygpLmFkZENsYXNzKCdtYWluLW1lbnUgbWVudS1saWdodCBtZW51LWZpeGVkIG1lbnUtc2hhZG93Jyk7XG4gICAgICAgIC8vIG1lbnVDb250YWluZXIucmVtb3ZlQ2xhc3MoKS5hZGRDbGFzcygnbWFpbi1tZW51LWNvbnRlbnQnKTtcbiAgICAgICAgbWVudU5hdmlnYXRpb24ucmVtb3ZlQ2xhc3MoKS5hZGRDbGFzcygnbmF2aWdhdGlvbiBuYXZpZ2F0aW9uLW1haW4nKTtcblxuICAgICAgICAvLyBJZiBEcm9wZG93biBNZW51XG4gICAgICAgIGRyb3Bkb3duTWVudS5yZW1vdmVDbGFzcygnZHJvcGRvd24nKS5hZGRDbGFzcygnaGFzLXN1YicpO1xuICAgICAgICBkcm9wZG93bk1lbnUuZmluZCgnYScpLnJlbW92ZUNsYXNzKCdkcm9wZG93bi10b2dnbGUgbmF2LWxpbmsnKTtcbiAgICAgICAgZHJvcGRvd25NZW51LmZpbmQoJ2EnKS5hdHRyKCdkYXRhLWJzLXRvZ2dsZScsICcnKTtcbiAgICAgICAgZHJvcGRvd25NZW51LmNoaWxkcmVuKCd1bCcpLmZpbmQoJ2EnKS5yZW1vdmVDbGFzcygnZHJvcGRvd24taXRlbScpO1xuICAgICAgICBkcm9wZG93bk1lbnUuZmluZCgndWwnKS5yZW1vdmVDbGFzcygnZHJvcGRvd24tbWVudScpO1xuICAgICAgICBkcm9wZG93blN1Yk1lbnUucmVtb3ZlQ2xhc3MoKS5hZGRDbGFzcygnaGFzLXN1YicpO1xuXG4gICAgICAgICQuYXBwLm5hdi5pbml0KCk7XG5cbiAgICAgICAgLy8gRHJvcGRvd24gc3VibWVudSBvbiBzbWFsbCBzY3JlZW4gb24gY2xpY2tcbiAgICAgICAgLy8gLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS1cbiAgICAgICAgJCgndWwuZHJvcGRvd24tbWVudSBbZGF0YS1icy10b2dnbGU9ZHJvcGRvd25dJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKGV2ZW50KSB7XG4gICAgICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICBldmVudC5zdG9wUHJvcGFnYXRpb24oKTtcbiAgICAgICAgICAkKHRoaXMpLnBhcmVudCgpLnNpYmxpbmdzKCkucmVtb3ZlQ2xhc3MoJ29wZW4nKTtcbiAgICAgICAgICAkKHRoaXMpLnBhcmVudCgpLnRvZ2dsZUNsYXNzKCdvcGVuJyk7XG4gICAgICAgIH0pO1xuXG4gICAgICAgICQoJy5tYWluLW1lbnUtY29udGVudCcpLmZpbmQoJ2xpLmFjdGl2ZScpLnBhcmVudHMoJ2xpJykuYWRkQ2xhc3MoJ3NpZGViYXItZ3JvdXAtYWN0aXZlJyk7XG5cbiAgICAgICAgJCgnLm1haW4tbWVudS1jb250ZW50JykuZmluZCgnbGkuYWN0aXZlJykuY2xvc2VzdCgnbGkubmF2LWl0ZW0nKS5hZGRDbGFzcygnb3BlbicpO1xuICAgICAgfVxuXG4gICAgICBpZiAoZmVhdGhlcikge1xuICAgICAgICBmZWF0aGVyLnJlcGxhY2UoeyB3aWR0aDogMTQsIGhlaWdodDogMTQgfSk7XG4gICAgICB9XG4gICAgfSxcblxuICAgIHRvZ2dsZTogZnVuY3Rpb24gKCkge1xuICAgICAgdmFyIGN1cnJlbnRCcmVha3BvaW50ID0gVW5pc29uLmZldGNoLm5vdygpOyAvLyBDdXJyZW50IEJyZWFrcG9pbnRcbiAgICAgIHZhciBjb2xsYXBzZWQgPSB0aGlzLmNvbGxhcHNlZDtcbiAgICAgIHZhciBleHBhbmRlZCA9IHRoaXMuZXhwYW5kZWQ7XG4gICAgICB2YXIgaGlkZGVuID0gdGhpcy5oaWRkZW47XG4gICAgICB2YXIgbWVudSA9ICRib2R5LmRhdGEoJ21lbnUnKTtcblxuICAgICAgc3dpdGNoIChjdXJyZW50QnJlYWtwb2ludC5uYW1lKSB7XG4gICAgICAgIGNhc2UgJ3hsJzpcbiAgICAgICAgICBpZiAoZXhwYW5kZWQgPT09IHRydWUpIHtcbiAgICAgICAgICAgIGlmIChtZW51ID09ICd2ZXJ0aWNhbC1vdmVybGF5LW1lbnUnKSB7XG4gICAgICAgICAgICAgIHRoaXMuaGlkZSgpO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgdGhpcy5jb2xsYXBzZSgpO1xuICAgICAgICAgICAgfVxuICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBpZiAobWVudSA9PSAndmVydGljYWwtb3ZlcmxheS1tZW51Jykge1xuICAgICAgICAgICAgICB0aGlzLm9wZW4oKTtcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgIHRoaXMuZXhwYW5kKCk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgfVxuICAgICAgICAgIGJyZWFrO1xuICAgICAgICBjYXNlICdsZyc6XG4gICAgICAgICAgaWYgKGV4cGFuZGVkID09PSB0cnVlKSB7XG4gICAgICAgICAgICBpZiAobWVudSA9PSAndmVydGljYWwtb3ZlcmxheS1tZW51JyB8fCBtZW51ID09ICd2ZXJ0aWNhbC1tZW51LW1vZGVybicgfHwgbWVudSA9PSAnaG9yaXpvbnRhbC1tZW51Jykge1xuICAgICAgICAgICAgICB0aGlzLmhpZGUoKTtcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgIHRoaXMuY29sbGFwc2UoKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgaWYgKG1lbnUgPT0gJ3ZlcnRpY2FsLW92ZXJsYXktbWVudScgfHwgbWVudSA9PSAndmVydGljYWwtbWVudS1tb2Rlcm4nIHx8IG1lbnUgPT0gJ2hvcml6b250YWwtbWVudScpIHtcbiAgICAgICAgICAgICAgdGhpcy5vcGVuKCk7XG4gICAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgICB0aGlzLmV4cGFuZCgpO1xuICAgICAgICAgICAgfVxuICAgICAgICAgIH1cbiAgICAgICAgICBicmVhaztcbiAgICAgICAgY2FzZSAnbWQnOlxuICAgICAgICBjYXNlICdzbSc6XG4gICAgICAgICAgaWYgKGhpZGRlbiA9PT0gdHJ1ZSkge1xuICAgICAgICAgICAgdGhpcy5vcGVuKCk7XG4gICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIHRoaXMuaGlkZSgpO1xuICAgICAgICAgIH1cbiAgICAgICAgICBicmVhaztcbiAgICAgICAgY2FzZSAneHMnOlxuICAgICAgICAgIGlmIChoaWRkZW4gPT09IHRydWUpIHtcbiAgICAgICAgICAgIHRoaXMub3BlbigpO1xuICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICB0aGlzLmhpZGUoKTtcbiAgICAgICAgICB9XG4gICAgICAgICAgYnJlYWs7XG4gICAgICB9XG4gICAgfSxcblxuICAgIHVwZGF0ZTogZnVuY3Rpb24gKCkge1xuICAgICAgdGhpcy5tYW51YWxTY3JvbGxlci51cGRhdGUoKTtcbiAgICB9LFxuXG4gICAgcmVzZXQ6IGZ1bmN0aW9uICgpIHtcbiAgICAgIHRoaXMuZXhwYW5kZWQgPSBmYWxzZTtcbiAgICAgIHRoaXMuY29sbGFwc2VkID0gZmFsc2U7XG4gICAgICB0aGlzLmhpZGRlbiA9IGZhbHNlO1xuICAgICAgJGJvZHkucmVtb3ZlQ2xhc3MoJ21lbnUtaGlkZSBtZW51LW9wZW4gbWVudS1jb2xsYXBzZWQgbWVudS1leHBhbmRlZCcpO1xuICAgIH1cbiAgfTtcblxuICAvLyBOYXZpZ2F0aW9uIE1lbnVcbiAgJC5hcHAubmF2ID0ge1xuICAgIGNvbnRhaW5lcjogJCgnLm5hdmlnYXRpb24tbWFpbicpLFxuICAgIGluaXRpYWxpemVkOiBmYWxzZSxcbiAgICBuYXZJdGVtOiAkKCcubmF2aWdhdGlvbi1tYWluJykuZmluZCgnbGknKS5ub3QoJy5uYXZpZ2F0aW9uLWNhdGVnb3J5JyksXG4gICAgVFJBTlNJVElPTl9FVkVOVFM6IFsndHJhbnNpdGlvbmVuZCcsICd3ZWJraXRUcmFuc2l0aW9uRW5kJywgJ29UcmFuc2l0aW9uRW5kJ10sXG4gICAgVFJBTlNJVElPTl9QUk9QRVJUSUVTOiBbJ3RyYW5zaXRpb24nLCAnTW96VHJhbnNpdGlvbicsICd3ZWJraXRUcmFuc2l0aW9uJywgJ1dlYmtpdFRyYW5zaXRpb24nLCAnT1RyYW5zaXRpb24nXSxcblxuICAgIGNvbmZpZzoge1xuICAgICAgc3BlZWQ6IDMwMFxuICAgIH0sXG5cbiAgICBpbml0OiBmdW5jdGlvbiAoY29uZmlnKSB7XG4gICAgICB0aGlzLmluaXRpYWxpemVkID0gdHJ1ZTsgLy8gU2V0IHRvIHRydWUgd2hlbiBpbml0aWFsaXplZFxuICAgICAgJC5leHRlbmQodGhpcy5jb25maWcsIGNvbmZpZyk7XG5cbiAgICAgIHRoaXMuYmluZF9ldmVudHMoKTtcbiAgICB9LFxuXG4gICAgYmluZF9ldmVudHM6IGZ1bmN0aW9uICgpIHtcbiAgICAgIHZhciBtZW51T2JqID0gdGhpcztcblxuICAgICAgJCgnLm5hdmlnYXRpb24tbWFpbicpXG4gICAgICAgIC5vbignbW91c2VlbnRlci5hcHAubWVudScsICdsaScsIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICB2YXIgJHRoaXMgPSAkKHRoaXMpO1xuICAgICAgICAgIC8vICQoJy5ob3ZlcicsICcubmF2aWdhdGlvbi1tYWluJykucmVtb3ZlQ2xhc3MoJ2hvdmVyJyk7XG4gICAgICAgICAgaWYgKCRib2R5Lmhhc0NsYXNzKCdtZW51LWNvbGxhcHNlZCcpICYmICRib2R5LmRhdGEoJ21lbnUnKSAhPSAndmVydGljYWwtbWVudS1tb2Rlcm4nKSB7XG4gICAgICAgICAgICAkKCcubWFpbi1tZW51LWNvbnRlbnQnKS5jaGlsZHJlbignc3Bhbi5tZW51LXRpdGxlJykucmVtb3ZlKCk7XG4gICAgICAgICAgICAkKCcubWFpbi1tZW51LWNvbnRlbnQnKS5jaGlsZHJlbignYS5tZW51LXRpdGxlJykucmVtb3ZlKCk7XG4gICAgICAgICAgICAkKCcubWFpbi1tZW51LWNvbnRlbnQnKS5jaGlsZHJlbigndWwubWVudS1jb250ZW50JykucmVtb3ZlKCk7XG5cbiAgICAgICAgICAgIC8vIFRpdGxlXG4gICAgICAgICAgICB2YXIgbWVudVRpdGxlID0gJHRoaXMuZmluZCgnc3Bhbi5tZW51LXRpdGxlJykuY2xvbmUoKSxcbiAgICAgICAgICAgICAgdGVtcFRpdGxlLFxuICAgICAgICAgICAgICB0ZW1wTGluaztcbiAgICAgICAgICAgIGlmICghJHRoaXMuaGFzQ2xhc3MoJ2hhcy1zdWInKSkge1xuICAgICAgICAgICAgICB0ZW1wVGl0bGUgPSAkdGhpcy5maW5kKCdzcGFuLm1lbnUtdGl0bGUnKS50ZXh0KCk7XG4gICAgICAgICAgICAgIHRlbXBMaW5rID0gJHRoaXMuY2hpbGRyZW4oJ2EnKS5hdHRyKCdocmVmJyk7XG4gICAgICAgICAgICAgIGlmICh0ZW1wVGl0bGUgIT09ICcnKSB7XG4gICAgICAgICAgICAgICAgbWVudVRpdGxlID0gJCgnPGE+Jyk7XG4gICAgICAgICAgICAgICAgbWVudVRpdGxlLmF0dHIoJ2hyZWYnLCB0ZW1wTGluayk7XG4gICAgICAgICAgICAgICAgbWVudVRpdGxlLmF0dHIoJ3RpdGxlJywgdGVtcFRpdGxlKTtcbiAgICAgICAgICAgICAgICBtZW51VGl0bGUudGV4dCh0ZW1wVGl0bGUpO1xuICAgICAgICAgICAgICAgIG1lbnVUaXRsZS5hZGRDbGFzcygnbWVudS10aXRsZScpO1xuICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICAvLyBtZW51X2hlYWRlcl9oZWlnaHQgPSAoJCgnLm1haW4tbWVudS1oZWFkZXInKS5sZW5ndGgpID8gJCgnLm1haW4tbWVudS1oZWFkZXInKS5oZWlnaHQoKSA6IDAsXG4gICAgICAgICAgICAvLyBmcm9tVG9wID0gbWVudV9oZWFkZXJfaGVpZ2h0ICsgJHRoaXMucG9zaXRpb24oKS50b3AgKyBwYXJzZUludCgkdGhpcy5jc3MoIFwiYm9yZGVyLXRvcFwiICksMTApO1xuICAgICAgICAgICAgdmFyIGZyb21Ub3A7XG4gICAgICAgICAgICBpZiAoJHRoaXMuY3NzKCdib3JkZXItdG9wJykpIHtcbiAgICAgICAgICAgICAgZnJvbVRvcCA9ICR0aGlzLnBvc2l0aW9uKCkudG9wICsgcGFyc2VJbnQoJHRoaXMuY3NzKCdib3JkZXItdG9wJyksIDEwKTtcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgIGZyb21Ub3AgPSAkdGhpcy5wb3NpdGlvbigpLnRvcDtcbiAgICAgICAgICAgIH1cbiAgICAgICAgICAgIGlmICgkYm9keS5kYXRhKCdtZW51JykgIT09ICd2ZXJ0aWNhbC1jb21wYWN0LW1lbnUnKSB7XG4gICAgICAgICAgICAgIG1lbnVUaXRsZS5hcHBlbmRUbygnLm1haW4tbWVudS1jb250ZW50JykuY3NzKHtcbiAgICAgICAgICAgICAgICBwb3NpdGlvbjogJ2ZpeGVkJyxcbiAgICAgICAgICAgICAgICB0b3A6IGZyb21Ub3BcbiAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIC8vIENvbnRlbnRcbiAgICAgICAgICAgIC8qIGlmICgkdGhpcy5oYXNDbGFzcygnaGFzLXN1YicpICYmICR0aGlzLmhhc0NsYXNzKCduYXYtaXRlbScpKSB7XG4gICAgICAgICAgICAgIHZhciBtZW51Q29udGVudCA9ICR0aGlzLmNoaWxkcmVuKCd1bDpmaXJzdCcpO1xuICAgICAgICAgICAgICBtZW51T2JqLmFkanVzdFN1Ym1lbnUoJHRoaXMpO1xuICAgICAgICAgICAgfSAqL1xuICAgICAgICAgIH1cbiAgICAgICAgICAvLyAkdGhpcy5hZGRDbGFzcygnaG92ZXInKTtcbiAgICAgICAgfSlcbiAgICAgICAgLm9uKCdtb3VzZWxlYXZlLmFwcC5tZW51JywgJ2xpJywgZnVuY3Rpb24gKCkge1xuICAgICAgICAgIC8vICQodGhpcykucmVtb3ZlQ2xhc3MoJ2hvdmVyJyk7XG4gICAgICAgIH0pXG4gICAgICAgIC5vbignYWN0aXZlLmFwcC5tZW51JywgJ2xpJywgZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgICAkKHRoaXMpLmFkZENsYXNzKCdhY3RpdmUnKTtcbiAgICAgICAgICBlLnN0b3BQcm9wYWdhdGlvbigpO1xuICAgICAgICB9KVxuICAgICAgICAub24oJ2RlYWN0aXZlLmFwcC5tZW51JywgJ2xpLmFjdGl2ZScsIGZ1bmN0aW9uIChlKSB7XG4gICAgICAgICAgJCh0aGlzKS5yZW1vdmVDbGFzcygnYWN0aXZlJyk7XG4gICAgICAgICAgZS5zdG9wUHJvcGFnYXRpb24oKTtcbiAgICAgICAgfSlcbiAgICAgICAgLm9uKCdvcGVuLmFwcC5tZW51JywgJ2xpJywgZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgICB2YXIgJGxpc3RJdGVtID0gJCh0aGlzKTtcblxuICAgICAgICAgIG1lbnVPYmouZXhwYW5kKCRsaXN0SXRlbSk7XG4gICAgICAgICAgLy8gJGxpc3RJdGVtLmFkZENsYXNzKCdvcGVuJyk7XG5cbiAgICAgICAgICAvLyBJZiBtZW51IGNvbGxhcHNpYmxlIHRoZW4gZG8gbm90IHRha2UgYW55IGFjdGlvblxuICAgICAgICAgIGlmICgkKCcubWFpbi1tZW51JykuaGFzQ2xhc3MoJ21lbnUtY29sbGFwc2libGUnKSkge1xuICAgICAgICAgICAgcmV0dXJuIGZhbHNlO1xuICAgICAgICAgIH1cbiAgICAgICAgICAvLyBJZiBtZW51IGFjY29yZGlvbiB0aGVuIGNsb3NlIGFsbCBleGNlcHQgY2xpY2tlZCBvbmNlXG4gICAgICAgICAgZWxzZSB7XG4gICAgICAgICAgICAkbGlzdEl0ZW0uc2libGluZ3MoJy5vcGVuJykuZmluZCgnbGkub3BlbicpLnRyaWdnZXIoJ2Nsb3NlLmFwcC5tZW51Jyk7XG4gICAgICAgICAgICAkbGlzdEl0ZW0uc2libGluZ3MoJy5vcGVuJykudHJpZ2dlcignY2xvc2UuYXBwLm1lbnUnKTtcbiAgICAgICAgICB9XG5cbiAgICAgICAgICBlLnN0b3BQcm9wYWdhdGlvbigpO1xuICAgICAgICB9KVxuICAgICAgICAub24oJ2Nsb3NlLmFwcC5tZW51JywgJ2xpLm9wZW4nLCBmdW5jdGlvbiAoZSkge1xuICAgICAgICAgIHZhciAkbGlzdEl0ZW0gPSAkKHRoaXMpO1xuXG4gICAgICAgICAgbWVudU9iai5jb2xsYXBzZSgkbGlzdEl0ZW0pO1xuICAgICAgICAgIC8vICRsaXN0SXRlbS5yZW1vdmVDbGFzcygnb3BlbicpO1xuXG4gICAgICAgICAgZS5zdG9wUHJvcGFnYXRpb24oKTtcbiAgICAgICAgfSlcbiAgICAgICAgLm9uKCdjbGljay5hcHAubWVudScsICdsaScsIGZ1bmN0aW9uIChlKSB7XG4gICAgICAgICAgdmFyICRsaXN0SXRlbSA9ICQodGhpcyk7XG4gICAgICAgICAgaWYgKCRsaXN0SXRlbS5pcygnLmRpc2FibGVkJykpIHtcbiAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgaWYgKCRib2R5Lmhhc0NsYXNzKCdtZW51LWNvbGxhcHNlZCcpICYmICRib2R5LmRhdGEoJ21lbnUnKSAhPSAndmVydGljYWwtbWVudS1tb2Rlcm4nKSB7XG4gICAgICAgICAgICAgIGUucHJldmVudERlZmF1bHQoKTtcbiAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgIGlmICgkbGlzdEl0ZW0uaGFzKCd1bCcpLmxlbmd0aCkge1xuICAgICAgICAgICAgICAgIGlmICgkbGlzdEl0ZW0uaXMoJy5vcGVuJykpIHtcbiAgICAgICAgICAgICAgICAgICRsaXN0SXRlbS50cmlnZ2VyKCdjbG9zZS5hcHAubWVudScpO1xuICAgICAgICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICAgICAgICAkbGlzdEl0ZW0udHJpZ2dlcignb3Blbi5hcHAubWVudScpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICBpZiAoISRsaXN0SXRlbS5pcygnLmFjdGl2ZScpKSB7XG4gICAgICAgICAgICAgICAgICAkbGlzdEl0ZW0uc2libGluZ3MoJy5hY3RpdmUnKS50cmlnZ2VyKCdkZWFjdGl2ZS5hcHAubWVudScpO1xuICAgICAgICAgICAgICAgICAgJGxpc3RJdGVtLnRyaWdnZXIoJ2FjdGl2ZS5hcHAubWVudScpO1xuICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfVxuICAgICAgICAgIH1cblxuICAgICAgICAgIGUuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgICAgIH0pO1xuXG4gICAgICAkKCcubmF2YmFyLWhlYWRlciwgLm1haW4tbWVudScpLm9uKCdtb3VzZWVudGVyJywgbW9kZXJuTWVudUV4cGFuZCkub24oJ21vdXNlbGVhdmUnLCBtb2Rlcm5NZW51Q29sbGFwc2UpO1xuXG4gICAgICBmdW5jdGlvbiBtb2Rlcm5NZW51RXhwYW5kKCkge1xuICAgICAgICBpZiAoJGJvZHkuZGF0YSgnbWVudScpID09ICd2ZXJ0aWNhbC1tZW51LW1vZGVybicpIHtcbiAgICAgICAgICAkKCcubWFpbi1tZW51LCAubmF2YmFyLWhlYWRlcicpLmFkZENsYXNzKCdleHBhbmRlZCcpO1xuICAgICAgICAgIGlmICgkYm9keS5oYXNDbGFzcygnbWVudS1jb2xsYXBzZWQnKSkge1xuICAgICAgICAgICAgaWYgKCQoJy5tYWluLW1lbnUgbGkub3BlbicpLmxlbmd0aCA9PT0gMCkge1xuICAgICAgICAgICAgICAkKCcubWFpbi1tZW51LWNvbnRlbnQnKS5maW5kKCdsaS5hY3RpdmUnKS5wYXJlbnRzKCdsaScpLmFkZENsYXNzKCdvcGVuJyk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICB2YXIgJGxpc3RJdGVtID0gJCgnLm1haW4tbWVudSBsaS5tZW51LWNvbGxhcHNlZC1vcGVuJyksXG4gICAgICAgICAgICAgICRzdWJMaXN0ID0gJGxpc3RJdGVtLmNoaWxkcmVuKCd1bCcpO1xuXG4gICAgICAgICAgICAkc3ViTGlzdC5oaWRlKCkuc2xpZGVEb3duKDIwMCwgZnVuY3Rpb24gKCkge1xuICAgICAgICAgICAgICAkKHRoaXMpLmNzcygnZGlzcGxheScsICcnKTtcbiAgICAgICAgICAgIH0pO1xuXG4gICAgICAgICAgICAkbGlzdEl0ZW0uYWRkQ2xhc3MoJ29wZW4nKS5yZW1vdmVDbGFzcygnbWVudS1jb2xsYXBzZWQtb3BlbicpO1xuICAgICAgICAgICAgLy8gJC5hcHAubWVudS5jaGFuZ2VMb2dvKCdleHBhbmQnKTtcbiAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICAgIH1cblxuICAgICAgZnVuY3Rpb24gbW9kZXJuTWVudUNvbGxhcHNlKCkge1xuICAgICAgICBpZiAoJGJvZHkuaGFzQ2xhc3MoJ21lbnUtY29sbGFwc2VkJykgJiYgJGJvZHkuZGF0YSgnbWVudScpID09ICd2ZXJ0aWNhbC1tZW51LW1vZGVybicpIHtcbiAgICAgICAgICBzZXRUaW1lb3V0KGZ1bmN0aW9uICgpIHtcbiAgICAgICAgICAgIGlmICgkKCcubWFpbi1tZW51OmhvdmVyJykubGVuZ3RoID09PSAwICYmICQoJy5uYXZiYXItaGVhZGVyOmhvdmVyJykubGVuZ3RoID09PSAwKSB7XG4gICAgICAgICAgICAgICQoJy5tYWluLW1lbnUsIC5uYXZiYXItaGVhZGVyJykucmVtb3ZlQ2xhc3MoJ2V4cGFuZGVkJyk7XG4gICAgICAgICAgICAgIGlmICgkYm9keS5oYXNDbGFzcygnbWVudS1jb2xsYXBzZWQnKSkge1xuICAgICAgICAgICAgICAgIHZhciAkbGlzdEl0ZW0gPSAkKCcubWFpbi1tZW51IGxpLm9wZW4nKSxcbiAgICAgICAgICAgICAgICAgICRzdWJMaXN0ID0gJGxpc3RJdGVtLmNoaWxkcmVuKCd1bCcpO1xuICAgICAgICAgICAgICAgICRsaXN0SXRlbS5hZGRDbGFzcygnbWVudS1jb2xsYXBzZWQtb3BlbicpO1xuXG4gICAgICAgICAgICAgICAgJHN1Ykxpc3Quc2hvdygpLnNsaWRlVXAoMjAwLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICAgICAgICAkKHRoaXMpLmNzcygnZGlzcGxheScsICcnKTtcbiAgICAgICAgICAgICAgICB9KTtcblxuICAgICAgICAgICAgICAgICRsaXN0SXRlbS5yZW1vdmVDbGFzcygnb3BlbicpO1xuICAgICAgICAgICAgICAgIC8vICQuYXBwLm1lbnUuY2hhbmdlTG9nbygpO1xuICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9XG4gICAgICAgICAgfSwgMSk7XG4gICAgICAgIH1cbiAgICAgIH1cblxuICAgICAgJCgnLm1haW4tbWVudS1jb250ZW50Jykub24oJ21vdXNlbGVhdmUnLCBmdW5jdGlvbiAoKSB7XG4gICAgICAgIGlmICgkYm9keS5oYXNDbGFzcygnbWVudS1jb2xsYXBzZWQnKSkge1xuICAgICAgICAgICQoJy5tYWluLW1lbnUtY29udGVudCcpLmNoaWxkcmVuKCdzcGFuLm1lbnUtdGl0bGUnKS5yZW1vdmUoKTtcbiAgICAgICAgICAkKCcubWFpbi1tZW51LWNvbnRlbnQnKS5jaGlsZHJlbignYS5tZW51LXRpdGxlJykucmVtb3ZlKCk7XG4gICAgICAgICAgJCgnLm1haW4tbWVudS1jb250ZW50JykuY2hpbGRyZW4oJ3VsLm1lbnUtY29udGVudCcpLnJlbW92ZSgpO1xuICAgICAgICB9XG4gICAgICAgICQoJy5ob3ZlcicsICcubmF2aWdhdGlvbi1tYWluJykucmVtb3ZlQ2xhc3MoJ2hvdmVyJyk7XG4gICAgICB9KTtcblxuICAgICAgLy8gSWYgbGlzdCBpdGVtIGhhcyBzdWIgbWVudSBpdGVtcyB0aGVuIHByZXZlbnQgcmVkaXJlY3Rpb24uXG4gICAgICAkKCcubmF2aWdhdGlvbi1tYWluIGxpLmhhcy1zdWIgPiBhJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpO1xuICAgICAgfSk7XG4gICAgfSxcblxuICAgIC8qKlxuICAgICAqIEVuc3VyZSBhbiBhZG1pbiBzdWJtZW51IGlzIHdpdGhpbiB0aGUgdmlzdWFsIHZpZXdwb3J0LlxuICAgICAqIEBwYXJhbSB7alF1ZXJ5fSAkbWVudUl0ZW0gVGhlIHBhcmVudCBtZW51IGl0ZW0gY29udGFpbmluZyB0aGUgc3VibWVudS5cbiAgICAgKi9cblxuICAgIC8qIGFkanVzdFN1Ym1lbnU6IGZ1bmN0aW9uICgkbWVudUl0ZW0pIHtcbiAgICAgIHZhciBtZW51SGVhZGVySGVpZ2h0LFxuICAgICAgICBtZW51dG9wLFxuICAgICAgICB0b3BQb3MsXG4gICAgICAgIHdpbkhlaWdodCxcbiAgICAgICAgYm90dG9tT2Zmc2V0LFxuICAgICAgICBzdWJNZW51SGVpZ2h0LFxuICAgICAgICBwb3BPdXRNZW51SGVpZ2h0LFxuICAgICAgICBib3JkZXJXaWR0aCxcbiAgICAgICAgc2Nyb2xsX3RoZW1lLFxuICAgICAgICAkc3VibWVudSA9ICRtZW51SXRlbS5jaGlsZHJlbigndWw6Zmlyc3QnKSxcbiAgICAgICAgdWwgPSAkc3VibWVudS5jbG9uZSh0cnVlKTtcblxuICAgICAgbWVudUhlYWRlckhlaWdodCA9ICQoJy5tYWluLW1lbnUtaGVhZGVyJykuaGVpZ2h0KCk7XG4gICAgICBtZW51dG9wID0gJG1lbnVJdGVtLnBvc2l0aW9uKCkudG9wO1xuICAgICAgd2luSGVpZ2h0ID0gJHdpbmRvdy5oZWlnaHQoKSAtICQoJy5oZWFkZXItbmF2YmFyJykuaGVpZ2h0KCk7XG4gICAgICBib3JkZXJXaWR0aCA9IDA7XG4gICAgICBzdWJNZW51SGVpZ2h0ID0gJHN1Ym1lbnUuaGVpZ2h0KCk7XG5cbiAgICAgIGlmIChwYXJzZUludCgkbWVudUl0ZW0uY3NzKCdib3JkZXItdG9wJyksIDEwKSA+IDApIHtcbiAgICAgICAgYm9yZGVyV2lkdGggPSBwYXJzZUludCgkbWVudUl0ZW0uY3NzKCdib3JkZXItdG9wJyksIDEwKTtcbiAgICAgIH1cblxuICAgICAgcG9wT3V0TWVudUhlaWdodCA9IHdpbkhlaWdodCAtIG1lbnV0b3AgLSAkbWVudUl0ZW0uaGVpZ2h0KCkgLSAzMDtcbiAgICAgIHNjcm9sbF90aGVtZSA9ICQoJy5tYWluLW1lbnUnKS5oYXNDbGFzcygnbWVudS1kYXJrJykgPyAnbGlnaHQnIDogJ2RhcmsnO1xuXG4gICAgICB0b3BQb3MgPSBtZW51dG9wICsgJG1lbnVJdGVtLmhlaWdodCgpICsgYm9yZGVyV2lkdGg7XG5cbiAgICAgIHVsLmFkZENsYXNzKCdtZW51LXBvcG91dCcpLmFwcGVuZFRvKCcubWFpbi1tZW51LWNvbnRlbnQnKS5jc3Moe1xuICAgICAgICB0b3A6IHRvcFBvcyxcbiAgICAgICAgcG9zaXRpb246ICdmaXhlZCcsXG4gICAgICAgICdtYXgtaGVpZ2h0JzogcG9wT3V0TWVudUhlaWdodFxuICAgICAgfSk7XG5cbiAgICAgIHZhciBtZW51X2NvbnRlbnQgPSBuZXcgUGVyZmVjdFNjcm9sbGJhcignLm1haW4tbWVudS1jb250ZW50ID4gdWwubWVudS1jb250ZW50Jywge1xuICAgICAgICB3aGVlbFByb3BhZ2F0aW9uOiBmYWxzZVxuICAgICAgfSk7XG4gICAgfSwgKi9cblxuICAgIC8vIENvbGxhcHNlIFN1Ym1lbnUgV2l0aCBUcmFuc2l0aW9uIChIZWlnaHQgYW5pbWF0aW9uKVxuICAgIGNvbGxhcHNlOiBmdW5jdGlvbiAoJGxpc3RJdGVtLCBjYWxsYmFjaykge1xuICAgICAgdmFyIHN1Ykxpc3QgPSAkbGlzdEl0ZW0uY2hpbGRyZW4oJ3VsJyksXG4gICAgICAgIHRvZ2dsZUxpbmsgPSAkbGlzdEl0ZW0uY2hpbGRyZW4oKS5maXJzdCgpLFxuICAgICAgICBsaW5rSGVpZ2h0ID0gJCh0b2dnbGVMaW5rKS5vdXRlckhlaWdodCgpO1xuXG4gICAgICAkbGlzdEl0ZW0uY3NzKHtcbiAgICAgICAgaGVpZ2h0OiBsaW5rSGVpZ2h0ICsgc3ViTGlzdC5vdXRlckhlaWdodCgpICsgJ3B4JyxcbiAgICAgICAgb3ZlcmZsb3c6ICdoaWRkZW4nXG4gICAgICB9KTtcblxuICAgICAgJGxpc3RJdGVtLmFkZENsYXNzKCdtZW51LWl0ZW0tYW5pbWF0aW5nJyk7XG4gICAgICAkbGlzdEl0ZW0uYWRkQ2xhc3MoJ21lbnUtaXRlbS1jbG9zaW5nJyk7XG5cbiAgICAgICQuYXBwLm5hdi5fYmluZEFuaW1hdGlvbkVuZEV2ZW50KCRsaXN0SXRlbSwgZnVuY3Rpb24gKCkge1xuICAgICAgICAkbGlzdEl0ZW0ucmVtb3ZlQ2xhc3MoJ29wZW4nKTtcbiAgICAgICAgJC5hcHAubmF2Ll9jbGVhckl0ZW1TdHlsZSgkbGlzdEl0ZW0pO1xuICAgICAgfSk7XG5cbiAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgICAkbGlzdEl0ZW0uY3NzKHtcbiAgICAgICAgICBoZWlnaHQ6IGxpbmtIZWlnaHQgKyAncHgnXG4gICAgICAgIH0pO1xuICAgICAgfSwgNTApO1xuICAgIH0sXG5cbiAgICAvLyBFeHBhbmQgU3VibWVudSBXaXRoIFRyYW5zaXRpb24gKEhlaWdodCBhbmltYXRpb24pXG4gICAgZXhwYW5kOiBmdW5jdGlvbiAoJGxpc3RJdGVtLCBjYWxsYmFjaykge1xuICAgICAgdmFyIHN1Ykxpc3QgPSAkbGlzdEl0ZW0uY2hpbGRyZW4oJ3VsJyksXG4gICAgICAgIHRvZ2dsZUxpbmsgPSAkbGlzdEl0ZW0uY2hpbGRyZW4oKS5maXJzdCgpLFxuICAgICAgICBsaW5rSGVpZ2h0ID0gJCh0b2dnbGVMaW5rKS5vdXRlckhlaWdodCgpO1xuXG4gICAgICAkbGlzdEl0ZW0uYWRkQ2xhc3MoJ21lbnUtaXRlbS1hbmltYXRpbmcnKTtcblxuICAgICAgJGxpc3RJdGVtLmNzcyh7XG4gICAgICAgIG92ZXJmbG93OiAnaGlkZGVuJyxcbiAgICAgICAgaGVpZ2h0OiBsaW5rSGVpZ2h0ICsgJ3B4J1xuICAgICAgfSk7XG5cbiAgICAgICRsaXN0SXRlbS5hZGRDbGFzcygnb3BlbicpO1xuXG4gICAgICAkLmFwcC5uYXYuX2JpbmRBbmltYXRpb25FbmRFdmVudCgkbGlzdEl0ZW0sIGZ1bmN0aW9uICgpIHtcbiAgICAgICAgJC5hcHAubmF2Ll9jbGVhckl0ZW1TdHlsZSgkbGlzdEl0ZW0pO1xuICAgICAgfSk7XG5cbiAgICAgIHNldFRpbWVvdXQoZnVuY3Rpb24gKCkge1xuICAgICAgICAkbGlzdEl0ZW0uY3NzKHtcbiAgICAgICAgICBoZWlnaHQ6IGxpbmtIZWlnaHQgKyBzdWJMaXN0Lm91dGVySGVpZ2h0KCkgKyAncHgnXG4gICAgICAgIH0pO1xuICAgICAgfSwgNTApO1xuICAgIH0sXG5cbiAgICBfYmluZEFuaW1hdGlvbkVuZEV2ZW50KGVsLCBoYW5kbGVyKSB7XG4gICAgICBlbCA9IGVsWzBdO1xuXG4gICAgICB2YXIgY2IgPSBmdW5jdGlvbiAoZSkge1xuICAgICAgICBpZiAoZS50YXJnZXQgIT09IGVsKSByZXR1cm47XG4gICAgICAgICQuYXBwLm5hdi5fdW5iaW5kQW5pbWF0aW9uRW5kRXZlbnQoZWwpO1xuICAgICAgICBoYW5kbGVyKGUpO1xuICAgICAgfTtcblxuICAgICAgbGV0IGR1cmF0aW9uID0gd2luZG93LmdldENvbXB1dGVkU3R5bGUoZWwpLnRyYW5zaXRpb25EdXJhdGlvbjtcbiAgICAgIGR1cmF0aW9uID0gcGFyc2VGbG9hdChkdXJhdGlvbikgKiAoZHVyYXRpb24uaW5kZXhPZignbXMnKSAhPT0gLTEgPyAxIDogMTAwMCk7XG5cbiAgICAgIGVsLl9tZW51QW5pbWF0aW9uRW5kRXZlbnRDYiA9IGNiO1xuICAgICAgJC5hcHAubmF2LlRSQU5TSVRJT05fRVZFTlRTLmZvckVhY2goZnVuY3Rpb24gKGV2KSB7XG4gICAgICAgIGVsLmFkZEV2ZW50TGlzdGVuZXIoZXYsIGVsLl9tZW51QW5pbWF0aW9uRW5kRXZlbnRDYiwgZmFsc2UpO1xuICAgICAgfSk7XG5cbiAgICAgIGVsLl9tZW51QW5pbWF0aW9uRW5kRXZlbnRUaW1lb3V0ID0gc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4gICAgICAgIGNiKHsgdGFyZ2V0OiBlbCB9KTtcbiAgICAgIH0sIGR1cmF0aW9uICsgNTApO1xuICAgIH0sXG5cbiAgICBfdW5iaW5kQW5pbWF0aW9uRW5kRXZlbnQoZWwpIHtcbiAgICAgIHZhciBjYiA9IGVsLl9tZW51QW5pbWF0aW9uRW5kRXZlbnRDYjtcblxuICAgICAgaWYgKGVsLl9tZW51QW5pbWF0aW9uRW5kRXZlbnRUaW1lb3V0KSB7XG4gICAgICAgIGNsZWFyVGltZW91dChlbC5fbWVudUFuaW1hdGlvbkVuZEV2ZW50VGltZW91dCk7XG4gICAgICAgIGVsLl9tZW51QW5pbWF0aW9uRW5kRXZlbnRUaW1lb3V0ID0gbnVsbDtcbiAgICAgIH1cblxuICAgICAgaWYgKCFjYikgcmV0dXJuO1xuXG4gICAgICAkLmFwcC5uYXYuVFJBTlNJVElPTl9FVkVOVFMuZm9yRWFjaChmdW5jdGlvbiAoZXYpIHtcbiAgICAgICAgZWwucmVtb3ZlRXZlbnRMaXN0ZW5lcihldiwgY2IsIGZhbHNlKTtcbiAgICAgIH0pO1xuICAgICAgZWwuX21lbnVBbmltYXRpb25FbmRFdmVudENiID0gbnVsbDtcbiAgICB9LFxuXG4gICAgX2NsZWFySXRlbVN0eWxlOiBmdW5jdGlvbiAoJGxpc3RJdGVtKSB7XG4gICAgICAkbGlzdEl0ZW0ucmVtb3ZlQ2xhc3MoJ21lbnUtaXRlbS1hbmltYXRpbmcnKTtcbiAgICAgICRsaXN0SXRlbS5yZW1vdmVDbGFzcygnbWVudS1pdGVtLWNsb3NpbmcnKTtcbiAgICAgICRsaXN0SXRlbS5jc3Moe1xuICAgICAgICBvdmVyZmxvdzogJycsXG4gICAgICAgIGhlaWdodDogJydcbiAgICAgIH0pO1xuICAgIH0sXG5cbiAgICByZWZyZXNoOiBmdW5jdGlvbiAoKSB7XG4gICAgICAkLmFwcC5uYXYuY29udGFpbmVyLmZpbmQoJy5vcGVuJykucmVtb3ZlQ2xhc3MoJ29wZW4nKTtcbiAgICB9XG4gIH07XG5cbiAgLy8gT24gaHJlZj0jIGNsaWNrIHBhZ2UgcmVmcmVzaCBpc3N1ZSByZXNvbHZlXG4gIC8vPyBVc2VyIHNob3VsZCByZW1vdmUgdGhpcyBjb2RlIGZvciB0aGVpciBwcm9qZWN0IHRvIGVuYWJsZSAjIGNsaWNrXG4gICQoZG9jdW1lbnQpLm9uKCdjbGljaycsICdhW2hyZWY9XCIjXCJdJywgZnVuY3Rpb24gKGUpIHtcbiAgICBlLnByZXZlbnREZWZhdWx0KCk7XG4gIH0pO1xufSkod2luZG93LCBkb2N1bWVudCwgalF1ZXJ5KTtcblxuLy8gV2UgbGlzdGVuIHRvIHRoZSByZXNpemUgZXZlbnRcbndpbmRvdy5hZGRFdmVudExpc3RlbmVyKCdyZXNpemUnLCBmdW5jdGlvbiAoKSB7XG4gIC8vIFdlIGV4ZWN1dGUgdGhlIHNhbWUgc2NyaXB0IGFzIGJlZm9yZVxuICB2YXIgdmggPSB3aW5kb3cuaW5uZXJIZWlnaHQgKiAwLjAxO1xuICBkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc3R5bGUuc2V0UHJvcGVydHkoJy0tdmgnLCB2aCArICdweCcpO1xufSk7XG4iXSwibmFtZXMiOlsid2luZG93IiwiZG9jdW1lbnQiLCIkIiwidmgiLCJpbm5lckhlaWdodCIsImRvY3VtZW50RWxlbWVudCIsInN0eWxlIiwic2V0UHJvcGVydHkiLCJhcHAiLCIkYm9keSIsIiR3aW5kb3ciLCJtZW51V3JhcHBlcl9lbCIsImh0bWwiLCJtZW51V3JhcHBlckNsYXNzZXMiLCJhdHRyIiwibWVudSIsImV4cGFuZGVkIiwiY29sbGFwc2VkIiwiaGlkZGVuIiwiY29udGFpbmVyIiwiaG9yaXpvbnRhbE1lbnUiLCJpc190b3VjaF9kZXZpY2UiLCJwcmVmaXhlcyIsInNwbGl0IiwibXEiLCJxdWVyeSIsIm1hdGNoTWVkaWEiLCJtYXRjaGVzIiwiRG9jdW1lbnRUb3VjaCIsImpvaW4iLCJtYW51YWxTY3JvbGxlciIsIm9iaiIsImluaXQiLCJzY3JvbGxfdGhlbWUiLCJoYXNDbGFzcyIsIlBlcmZlY3RTY3JvbGxiYXIiLCJzdXBwcmVzc1Njcm9sbFgiLCJ3aGVlbFByb3BhZ2F0aW9uIiwiYWRkQ2xhc3MiLCJ1cGRhdGUiLCJkYXRhIiwiYWN0aXZlRWwiLCJhY3RpdmVFbEhlaWdodCIsInF1ZXJ5U2VsZWN0b3IiLCJsZW5ndGgiLCJnZXRCb3VuZGluZ0NsaWVudFJlY3QiLCJ0b3AiLCJzY3JvbGxUb3AiLCJwYXJzZUludCIsImNsaWVudEhlaWdodCIsInN0YXJ0IiwiY2hhbmdlIiwic2V0VGltZW91dCIsInN0b3AiLCJhbmltYXRlIiwiZW5hYmxlIiwiZGlzYWJsZSIsImRlc3Ryb3kiLCJ1cGRhdGVIZWlnaHQiLCJjc3MiLCJoZWlnaHQiLCJvdXRlckhlaWdodCIsImNvbXBhY3RNZW51IiwibWVudU9iaiIsImN1cnJlbnRCcmVha3BvaW50IiwiVW5pc29uIiwiZmV0Y2giLCJub3ciLCJyZXNldCIsIm1lbnVUeXBlIiwibmFtZSIsImhpZGUiLCJjb2xsYXBzZSIsImV4cGFuZCIsInRvT3ZlcmxheU1lbnUiLCJpcyIsImNoYW5nZU1lbnUiLCJyZW1vdmVDbGFzcyIsIm9uIiwiZXZlbnQiLCJmaW5kIiwicGFyZW50cyIsInRvZ2dsZUNsYXNzIiwic2libGluZ3MiLCJwcmV2ZW50RGVmYXVsdCIsInN0b3BQcm9wYWdhdGlvbiIsInBhcmVudCIsImRkIiwicGFnZUhlaWdodCIsImRkVG9wIiwicG9zaXRpb24iLCJkZExlZnQiLCJvZmZzZXQiLCJsZWZ0IiwiZGRXaWR0aCIsIndpZHRoIiwiZGRIZWlnaHQiLCJtYXhIZWlnaHQiLCJtZW51X2NvbnRlbnQiLCJpbm5lcldpZHRoIiwidHJhbnNpdCIsImNhbGxiYWNrMSIsImNhbGxiYWNrMiIsImNhbGwiLCJzaG93Iiwib3BlbiIsInJlcGxhY2VXaXRoIiwiZmVhdGhlciIsImljb25zIiwidG9TdmciLCJzY3JlZW4iLCJtZW51V3JhcHBlciIsIm1lbnVDb250YWluZXIiLCJtZW51TmF2aWdhdGlvbiIsImRyb3Bkb3duTWVudSIsImRyb3Bkb3duU3ViTWVudSIsImNoaWxkcmVuIiwibmF2IiwiY2xvc2VzdCIsInJlcGxhY2UiLCJ0b2dnbGUiLCJpbml0aWFsaXplZCIsIm5hdkl0ZW0iLCJub3QiLCJUUkFOU0lUSU9OX0VWRU5UUyIsIlRSQU5TSVRJT05fUFJPUEVSVElFUyIsImNvbmZpZyIsInNwZWVkIiwiZXh0ZW5kIiwiYmluZF9ldmVudHMiLCIkdGhpcyIsInJlbW92ZSIsIm1lbnVUaXRsZSIsImNsb25lIiwidGVtcFRpdGxlIiwidGVtcExpbmsiLCJ0ZXh0IiwiZnJvbVRvcCIsImFwcGVuZFRvIiwiZSIsIiRsaXN0SXRlbSIsInRyaWdnZXIiLCJoYXMiLCJtb2Rlcm5NZW51RXhwYW5kIiwibW9kZXJuTWVudUNvbGxhcHNlIiwiJHN1Ykxpc3QiLCJzbGlkZURvd24iLCJzbGlkZVVwIiwiY2FsbGJhY2siLCJzdWJMaXN0IiwidG9nZ2xlTGluayIsImZpcnN0IiwibGlua0hlaWdodCIsIm92ZXJmbG93IiwiX2JpbmRBbmltYXRpb25FbmRFdmVudCIsIl9jbGVhckl0ZW1TdHlsZSIsImVsIiwiaGFuZGxlciIsImNiIiwidGFyZ2V0IiwiX3VuYmluZEFuaW1hdGlvbkVuZEV2ZW50IiwiZHVyYXRpb24iLCJnZXRDb21wdXRlZFN0eWxlIiwidHJhbnNpdGlvbkR1cmF0aW9uIiwicGFyc2VGbG9hdCIsImluZGV4T2YiLCJfbWVudUFuaW1hdGlvbkVuZEV2ZW50Q2IiLCJmb3JFYWNoIiwiZXYiLCJhZGRFdmVudExpc3RlbmVyIiwiX21lbnVBbmltYXRpb25FbmRFdmVudFRpbWVvdXQiLCJjbGVhclRpbWVvdXQiLCJyZW1vdmVFdmVudExpc3RlbmVyIiwicmVmcmVzaCIsImpRdWVyeSJdLCJzb3VyY2VSb290IjoiIn0=