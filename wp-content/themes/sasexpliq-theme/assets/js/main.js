/**
 * Sasexpliq Theme - Main JavaScript File
 */
(function ($) {
    'use strict';

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        // Handle dropdown menus
        $('.menu-item-has-children > a').on('click', function(e) {
            if ($(window).width() <= 991) {
                e.preventDefault();
                const $parent = $(this).parent();
                const $submenu = $parent.find('> .sub-menu');
        
                const isOpen = $parent.hasClass('submenu-open');
        
                // Close all other submenus
                $('.menu-item-has-children').not($parent).removeClass('submenu-open')
                    .find('> .sub-menu').stop(true, true).slideUp(300);
        
                if (isOpen) {
                    // Close current submenu
                    $parent.removeClass('submenu-open');
                    $submenu.stop(true, true).slideUp(300);
                } else {
                    // Open clicked submenu
                    $parent.addClass('submenu-open');
                    $submenu.stop(true, true).slideDown(300);
                }
            }
        });
        

        // Mobile menu toggle
        $('.menu-toggle').on('click', function(e) {
            e.preventDefault();
            $('.nav-menu').slideToggle(300);
            $(this).toggleClass('active');
        });

        // Handle window resize
        $(window).on('resize', function() {
            if ($(window).width() > 991) {
                $('.nav-menu').removeAttr('style');
                $('.menu-toggle').removeClass('active');
                $('.sub-menu').removeAttr('style');
                $('.menu-item-has-children').removeClass('submenu-open');
            }
        });
    }

    /**
     * Sticky Header
     */
    function initStickyHeader() {
        const header = $('.site-header');
        const headerHeight = header.outerHeight();

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > headerHeight) {
                header.addClass('sticky');
            } else {
                header.removeClass('sticky');
            }
        });
    }

    /**
     * Contact Form Submission
     */
    function initContactForm() {
        $('.contact-form').on('submit', function() {
            // Form validation can go here if needed
            const formMessage = $('.form-message');

            if (formMessage.length) {
                $('html, body').animate({
                    scrollTop: formMessage.offset().top - 100
                }, 500);
            }
        });
    }

    /**
     * Initialize all functions on document ready
     */
    $(document).ready(function() {
        initMobileMenu();
        initStickyHeader();
        initContactForm();
    });

})(jQuery);
