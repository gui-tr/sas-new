 /**
 * Sasexpliq Theme - Main JavaScript File
 */

(function ($) {
    'use strict';

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const menuToggle = $('.menu-toggle');
        const navMenu = $('.nav-menu');
        
        menuToggle.on('click', function() {
            $(this).toggleClass('active');
            navMenu.toggleClass('active');
        });
        
        // Close menu when clicking outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.main-navigation').length) {
                menuToggle.removeClass('active');
                navMenu.removeClass('active');
            }
        });
        
        // Handle sub-menu toggles for mobile
        if (window.innerWidth < 768) {
            $('.menu-item-has-children > a').on('click', function(e) {
                e.preventDefault();
                $(this).siblings('.sub-menu').slideToggle();
            });
        }
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