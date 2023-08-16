/*
 Template Name: Zinzer - Responsive Bootstrap 4 Admin Dashboard
 Author: ThemeDesign
 File: Main js
 */



!function($) {
    "use strict";

    var MainApp = function() {};

    MainApp.prototype.initNavbar = function () {

        $('.navbar-toggle').on('click', function (event) {
            $(this).toggleClass('open');
            $('#navigation').slideToggle(400);
        });

        $('.navigation-menu>li').slice(-1).addClass('last-elements');

        $('.navigation-menu li.has-submenu a[href="#"]').on('click', function (e) {
            if ($(window).width() < 992) {
                e.preventDefault();
                $(this).parent('li').toggleClass('open').find('.submenu:first').toggleClass('open');
            }
        });
    },
    MainApp.prototype.initLoader = function () {
        $(window).on('load', function() {
            $('#status').fadeOut();
            $('#preloader').delay(350).fadeOut('slow');
            $('body').delay(350).css({
                'overflow': 'visible'
            });
        });
    },
    MainApp.prototype.initScrollbar = function () {
        $('.slimscroll-noti').slimScroll({
            height: '208px',
            position: 'right',
            size: "5px",
            color: '#98a6ad',
            wheelStep: 10
        });
    }
    // === fo,llowing js will activate the menu in left side bar based on url ====
    MainApp.prototype.initMenuItem = function () {
        $(".navigation-menu a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) { 
                $(this).parent().addClass("active"); // add active to li of the current link
                $(this).parent().parent().parent().addClass("active"); // add active class to an anchor
                $(this).parent().parent().parent().parent().parent().addClass("active"); // add active class to an anchor
            }
        });
    },
    MainApp.prototype.initComponents = function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();
    },
    MainApp.prototype.initToggleSearch = function () {
        $('.toggle-search').on('click', function () {
            var targetId = $(this).data('target');
            var $searchBar;
            if (targetId) {
                $searchBar = $(targetId);
                $searchBar.toggleClass('open');
            }
        });
    },

    MainApp.prototype.init = function () {
        this.initNavbar();
        this.initLoader();
        this.initScrollbar();
        this.initMenuItem();
        this.initComponents();
        this.initToggleSearch();
    },

    //init
    $.MainApp = new MainApp, $.MainApp.Constructor = MainApp
}(window.jQuery),

//initializing
function ($) {
    "use strict";
    $.MainApp.init();
}(window.jQuery);


jQuery(document).ready(function($) {
    var bsDefaults = {
          offset: false,
          overlay: true,
          width: '330px'
       },
       bsMain = $('.bs-offset-main'),
       bsOverlay = $('.bs-canvas-overlay');
 
    $('[data-toggle="canvas"][aria-expanded="false"]').on('click', function() {
       var canvas = $(this).data('target'),
          opts = $.extend({}, bsDefaults, $(canvas).data()),
          prop = $(canvas).hasClass('bs-canvas-right') ? 'margin-right' : 'margin-left';
 
       if (opts.width === '100%')
          opts.offset = false;
       
       $(canvas).css('width', opts.width);
       if (opts.offset && bsMain.length)
          bsMain.css(prop, opts.width);
 
       $(canvas + ' .bs-canvas-close').attr('aria-expanded', "true");
       $('[data-toggle="canvas"][data-target="' + canvas + '"]').attr('aria-expanded', "true");
       if (opts.overlay && bsOverlay.length)
          bsOverlay.addClass('show');
       return false;
    });
 
    $('.bs-canvas-close, .bs-canvas-overlay').on('click', function() {
       var canvas, aria;
       if ($(this).hasClass('bs-canvas-close')) {
          canvas = $(this).closest('.bs-canvas');
          aria = $(this).add($('[data-toggle="canvas"][data-target="#' + canvas.attr('id') + '"]'));
          if (bsMain.length)
             bsMain.css(($(canvas).hasClass('bs-canvas-right') ? 'margin-right' : 'margin-left'), '');
       } else {
          canvas = $('.bs-canvas');
          aria = $('.bs-canvas-close, [data-toggle="canvas"]');
          if (bsMain.length)
             bsMain.css({
                'margin-left': '',
                'margin-right': ''
             });
       }
       canvas.css('width', '');
       aria.attr('aria-expanded', "false");
       if (bsOverlay.length)
          bsOverlay.removeClass('show');
       return false;
    });
 });