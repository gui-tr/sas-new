/**
 * Sasexpliq Theme - Main JavaScript File
 */

(function ($) {
    'use strict';

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        // Initialize Superfish with default settings
        $('#primary-menu').superfish();

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