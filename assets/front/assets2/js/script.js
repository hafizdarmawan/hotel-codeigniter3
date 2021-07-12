/*
Author       : Dreamguys
Template Name: Doccure - Bootstrap Template
Version      : 1.0
*/

(function($) {
    "use strict";
	
	// Stick Sidebar
	
	if ($(window).width() > 767) {
		if($('.theiaStickySidebar').length > 0) {
			$('.theiaStickySidebar').theiaStickySidebar({
			  // Settings
			  additionalMarginTop: 30
			});
		}
	}
	
// Sidebar
	if($(window).width() <= 991){
	var Sidemenu = function() {
		this.$menuItem = $('.main-nav a');
	};
	
	function init() {
		var $this = Sidemenu;
		$('.main-nav a').on('click', function(e) {
			if($(this).parent().hasClass('has-submenu')) {
				e.preventDefault();
			}
			if(!$(this).hasClass('submenu')) {
				$('ul', $(this).parents('ul:first')).slideUp(350);
				$('a', $(this).parents('ul:first')).removeClass('submenu');
				$(this).next('ul').slideDown(350);
				$(this).addClass('submenu');
			} else if($(this).hasClass('submenu')) {
				$(this).removeClass('submenu');
				$(this).next('ul').slideUp(350);
			}
		});
		//$('.main-nav li.has-submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
	}

	// Sidebar Initiate
	init();
	}
	
	// Textarea Text Count
	
	var maxLength = 100;
	$('#review_desc').on('keyup change', function () {
		var length = $(this).val().length;
		 length = maxLength-length;
		$('#chars').text(length);
	});
	
	// Select 2
	
	if($('.select').length > 0) {
		$('.select').select2({
			minimumResultsForSearch: -1,
			width: '100%'
		});
	}
	
	// Date Time Picker
	
	if($('.datetimepicker').length > 0) {
		$('.datetimepicker').datetimepicker({
			format: 'DD/MM/YYYY',
			icons: {
				up: "fas fa-chevron-up",
				down: "fas fa-chevron-down",
				next: 'fas fa-chevron-right',
				previous: 'fas fa-chevron-left'
			}
		});
	}
	
	// Fancybox Gallery
	
	if($('.clinic-gallery a').length > 0) {
		$('.clinic-gallery a').fancybox({
			buttons: [
				"thumbs",
				"close"
			],
		});	
	}
	
	// Floating Label

	if($('.floating').length > 0 ){
		$('.floating').on('focus blur', function (e) {
		$(this).parents('.form-focus').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
		}).trigger('blur');
	}
	
	// Mobile menu sidebar overlay
	
	$('body').append('<div class="sidebar-overlay"></div>');
	$(document).on('click', '#mobile_btn', function() {
		$('main-wrapper').toggleClass('slide-nav');
		$('.sidebar-overlay').toggleClass('opened');
		$('html').addClass('menu-opened');
		return false;
	});
	
	$(document).on('click', '.sidebar-overlay', function() {
		$('html').removeClass('menu-opened');
		$(this).removeClass('opened');
		$('main-wrapper').removeClass('slide-nav');
	});
	
	$(document).on('click', '#menu_close', function() {
		$('html').removeClass('menu-opened');
		$('.sidebar-overlay').removeClass('opened');
		$('main-wrapper').removeClass('slide-nav');
	});
	
	// Mobile Menu
	
	/*if($(window).width() <= 991){
		mobileSidebar();
	} else {
		$('html').removeClass('menu-opened');
	}*/
	
	/*function mobileSidebar() {
		$('.main-nav a').on('click', function(e) {
			$('.dropdown-menu').each(function() {
			  if($(this).hasClass('show')) {
				  $(this).slideUp(350);
			  }
			});
			if(!$(this).next('.dropdown-menu').hasClass('show')) {
				$(this).next('.dropdown-menu').slideDown(350);
			}
			
		});
	}*/
	
	// Tooltip
	
	if($('[data-toggle="tooltip"]').length > 0 ){
		$('[data-toggle="tooltip"]').tooltip();
	}
	
	// Add More Hours
	
    $(".hours-info").on('click','.trash', function () {
		$(this).closest('.hours-cont').remove();
		return false;
    });

    $(".add-hours").on('click', function () {
		
		var hourscontent = '<div class="row form-row hours-cont">' +
			'<div class="col-12 col-md-10">' +
				'<div class="row form-row">' +
					'<div class="col-12 col-md-6">' +
						'<div class="form-group">' +
							'<label>Start Time</label>' +
							'<select class="form-control">' +
								'<option>-</option>' +
								'<option>12.00 am</option>' +
								'<option>12.30 am</option>' + 
								'<option>1.00 am</option>' +
								'<option>1.30 am</option>' +
							'</select>' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6">' +
						'<div class="form-group">' +
							'<label>End Time</label>' +
							'<select class="form-control">' +
								'<option>-</option>' +
								'<option>12.00 am</option>' +
								'<option>12.30 am</option>' +
								'<option>1.00 am</option>' +
								'<option>1.30 am</option>' +
							'</select>' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
		'</div>';
		
        $(".hours-info").append(hourscontent);
        return false;
    });
	
	// Content div min height set
	
	function resizeInnerDiv() {
		var height = $(window).height();	
		var header_height = $(".header").height();
		var footer_height = $(".footer").height();
		var setheight = height - header_height;
		var trueheight = setheight - footer_height;
		$(".content").css("min-height", trueheight);
	}
	
	if($('.content').length > 0 ){
		resizeInnerDiv();
	}

	$(window).resize(function(){
		if($('.content').length > 0 ){
			resizeInnerDiv();
		}
		/*if($(window).width() <= 991){
			mobileSidebar();
		} else {
			$('html').removeClass('menu-opened');
		}*/
	});
	
	// Slick Slider
	
	if($('.specialities-slider').length > 0) {
		$('.specialities-slider').slick({
			dots: true,
			autoplay:false,
			infinite: true,
			variableWidth: true,
			prevArrow: false,
			nextArrow: false
		});
	}
	
	if($('.doctor-slider').length > 0) {
		$('.doctor-slider').slick({
			dots: false,
			autoplay:false,
			infinite: true,
			variableWidth: true,
		});
	}
	if($('.features-slider').length > 0) {
		$('.features-slider').slick({
			dots: true,
			infinite: true,
			centerMode: true,
			slidesToShow: 3,
			speed: 500,
			variableWidth: true,
			arrows: false,
			autoplay:false,
			responsive: [{
				  breakpoint: 992,
				  settings: {
					slidesToShow: 1
				  }

			}]
		});
	}
	
	// Date Time Picker
	
	if($('.datepicker').length > 0) {
		$('.datepicker').datetimepicker({
			viewMode: 'years',
			showTodayButton: true,
			format: 'DD-MM-YYYY',
			// minDate:new Date(),
			widgetPositioning:{
				horizontal: 'auto',	
				vertical: 'bottom'
			}
		});
	}
	
	// Chat

	var chatAppTarget = $('.chat-window');
	(function() {
		if ($(window).width() > 991)
			chatAppTarget.removeClass('chat-slide');
		
		$(document).on("click",".chat-window .chat-users-list a.media",function () {
			if ($(window).width() <= 991) {
				chatAppTarget.addClass('chat-slide');
			}
			return false;
		});
		$(document).on("click","#back_user_list",function () {
			if ($(window).width() <= 991) {
				chatAppTarget.removeClass('chat-slide');
			}	
			return false;
		});
	})();
	
	// Circle Progress Bar
	
	function animateElements() {
		$('.circle-bar1').each(function () {
			var elementPos = $(this).offset().top;
			var topOfWindow = $(window).scrollTop();
			var percent = $(this).find('.circle-graph1').attr('data-percent');
			var animate = $(this).data('animate');
			if (elementPos < topOfWindow + $(window).height() - 30 && !animate) {
				$(this).data('animate', true);
				$(this).find('.circle-graph1').circleProgress({
					value: percent / 100,
					size : 400,
					thickness: 30,
					fill: {
						color: '#da3f81'
					}
				});
			}
		});
		$('.circle-bar2').each(function () {
			var elementPos = $(this).offset().top;
			var topOfWindow = $(window).scrollTop();
			var percent = $(this).find('.circle-graph2').attr('data-percent');
			var animate = $(this).data('animate');
			if (elementPos < topOfWindow + $(window).height() - 30 && !animate) {
				$(this).data('animate', true);
				$(this).find('.circle-graph2').circleProgress({
					value: percent / 100,
					size : 400,
					thickness: 30,
					fill: {
						color: '#68dda9'
					}
				});
			}
		});
		$('.circle-bar3').each(function () {
			var elementPos = $(this).offset().top;
			var topOfWindow = $(window).scrollTop();
			var percent = $(this).find('.circle-graph3').attr('data-percent');
			var animate = $(this).data('animate');
			if (elementPos < topOfWindow + $(window).height() - 30 && !animate) {
				$(this).data('animate', true);
				$(this).find('.circle-graph3').circleProgress({
					value: percent / 100,
					size : 400,
					thickness: 30,
					fill: {
						color: '#1b5a90'
					}
				});
			}
		});
	}	
	
	if($('.circle-bar').length > 0) {
		animateElements();
	}
	$(window).scroll(animateElements);
	
})(jQuery);


(function ($) {
    "use strict";
    // TOP Menu Sticky
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll < 400) {
            $("#sticky-header").removeClass("sticky");
            $('#back-top').fadeIn(500);
        } else {
            $("#sticky-header").addClass("sticky");
            $('#back-top').fadeIn(500);
        }
    });

    $(".room__pic__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false
    });

    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });
    // *********************************
    // :: 4.0 Welcome Slides Active Code
    // *********************************

    if ($.fn.owlCarousel) {
        var welcomeSlider = $('.welcome-slides');
        welcomeSlider.owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            smartSpeed: 1000,
            nav: true
        })

        welcomeSlider.on('translate.owl.carousel', function () {
            var layer = $("[data-animation]");
            layer.each(function () {
                var anim_name = $(this).data('animation');
                $(this).removeClass('animated ' + anim_name).css('opacity', '0');
            });
        });

        $("[data-delay]").each(function () {
            var anim_del = $(this).data('delay');
            $(this).css('animation-delay', anim_del);
        });

        $("[data-duration]").each(function () {
            var anim_dur = $(this).data('duration');
            $(this).css('animation-duration', anim_dur);
        });

        welcomeSlider.on('translated.owl.carousel', function () {
            var layer = welcomeSlider.find('.owl-item.active').find("[data-animation]");
            layer.each(function () {
                var anim_name = $(this).data('animation');
                $(this).addClass('animated ' + anim_name).css('opacity', '1');
            });
        });

        function welcomeSlide() {
            $('.owl-item').removeClass('prev next');
            var currentSlide = $('.welcome-slides .owl-item.active');
            currentSlide.next('.owl-item').addClass('next');
            currentSlide.prev('.owl-item').addClass('prev');
            var nextSlideImg = $('.owl-item.next').find('.single-welcome-slide').attr('data-img-url');
            var prevSlideImg = $('.owl-item.prev').find('.single-welcome-slide').attr('data-img-url');
            $('.owl-nav .owl-prev').css({
                background: 'url(' + prevSlideImg + ')'
            });
            $('.owl-nav .owl-next').css({
                background: 'url(' + nextSlideImg + ')'
            });
        }

        welcomeSlide();

        welcomeSlider.on('translated.owl.carousel', function () {
            welcomeSlide();
        });
    }
    // *********************************
    // :: 5.0 Project Slides Active Code
    // *********************************
    if ($.fn.owlCarousel) {
        var projectSlide = $('.projects-slides');
        projectSlide.owlCarousel({
            items: 5,
            margin: 0,
            loop: true,
            autoplay: true,
            smartSpeed: 1500,
            dots: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1500: {
                    items: 4
                }
            }
        });
    }
    /*--------------------------
         Room Details Pic Slider
     ----------------------------*/
    $(".room__details__pic__slider").owlCarousel({
        loop: true,
        margin: 10,
        items: 2,
        dots: false,
        nav: true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        autoHeight: false,
        autoplay: false,
        mouseDrag: false,
        responsive: {
            576: {
                items: 2
            },
            0: {
                items: 1
            }
        }
    });
    // ***************************
    // :: 3.0 Single Project Slide
    // ***************************

    $(".single-project-slide").on("mouseenter", function () {
        $(".single-project-slide").removeClass("active");
        $(this).addClass("active");
    });
    /*--------------------------
    Room Pic Slider
----------------------------*/
    $(".room__pic__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<i class='arrow_carrot-left'></i>", "<i class='arrow_carrot-right'></i>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false
    });

    /*--------------------------
          Gallery Slider
      ----------------------------*/
    $(".gallery__slider").owlCarousel({
        loop: true,
        margin: 10,
        items: 4,
        dots: false,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {
            992: {
                items: 4
            },
            768: {
                items: 3
            },
            576: {
                items: 2
            },
            0: {
                items: 1
            }
        }
    });


    $(document).ready(function () {

        // mobile_menu
        var menu = $('ul#navigation');
        if (menu.length) {
            menu.slicknav({
                prependTo: ".mobile_menu",
                closedSymbol: '+',
                openedSymbol: '-'
            });
        };
        // blog-menu
        // $('ul#blog-menu').slicknav({
        //   prependTo: ".blog_menu"
        // });

        // review-active
        // ***********************
        // :: 11.0 WOW Active Code
        // ***********************
        // if (roberto_window.width() > 767) {
        //   new WOW().init();
        // }
        // // *******************************
        // :: 7.0 Rooms Slides Active Code
        // *******************************
        if ($.fn.owlCarousel) {
            var roomSlides = $('.rooms-slides');
            roomSlides.owlCarousel({
                items: 1,
                margin: 0,
                loop: true,
                autoplay: true,
                smartSpeed: 1500,
                nav: true,
                navText: [('<i class="fa fa-long-arrow-left" aria-hidden="true"></i> Previous'), ('Next <i class="fa fa-long-arrow-right" aria-hidden="true"></i>')]
            });

            roomSlides.on('translate.owl.carousel', function () {
                var layer = $("[data-animation]");
                layer.each(function () {
                    var anim_name = $(this).data('animation');
                    $(this).removeClass('animated ' + anim_name).css('opacity', '0');
                });
            });

            $("[data-delay]").each(function () {
                var anim_del = $(this).data('delay');
                $(this).css('animation-delay', anim_del);
            });

            $("[data-duration]").each(function () {
                var anim_dur = $(this).data('duration');
                $(this).css('animation-duration', anim_dur);
            });

            roomSlides.on('translated.owl.carousel', function () {
                var layer = roomSlides.find('.owl-item.active').find("[data-animation]");
                layer.each(function () {
                    var anim_name = $(this).data('animation');
                    $(this).addClass('animated ' + anim_name).css('opacity', '1');
                });
            });
        }

        $('.slider_active').owlCarousel({
            loop: true,
            margin: 0,
            items: 1,
            autoplay: true,
            navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
            nav: true,
            dots: false,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                },
                767: {
                    items: 1,
                    nav: false,
                },
                992: {
                    items: 1
                }
            }
        });

        // about_active
        $('.about_active').owlCarousel({
            loop: true,
            margin: 0,
            items: 1,
            autoplay: true,
            navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
            nav: true,
            dots: false,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            responsive: {
                0: {
                    items: 1,
                    nav: false,
                },
                767: {
                    items: 1,
                    nav: false,
                },
                992: {
                    items: 1
                }
            }
        });

        // review-active
        $('.testmonial_active').owlCarousel({
            loop: true,
            margin: 0,
            items: 1,
            autoplay: true,
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            nav: true,
            dots: false,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            responsive: {
                0: {
                    items: 1,
                    dots: false,
                    nav: false,
                },
                767: {
                    items: 1,
                    dots: false,
                    nav: false,
                },
                992: {
                    items: 1,
                    nav: false
                },
                1200: {
                    items: 1,
                    nav: false
                },
                1500: {
                    items: 1
                }
            }
        });

        // for filter
        // init Isotope
        var $grid = $('.grid').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: 1
            }
        });

        // filter items on button click
        $('.portfolio-menu').on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });

        //for menu active class
        $('.portfolio-menu button').on('click', function (event) {
            $(this).siblings('.active').removeClass('active');
            $(this).addClass('active');
            event.preventDefault();
        });

        // wow js
        // new WOW().init();

        // counter 
        $('.counter').counterUp({
            delay: 10,
            time: 10000
        });

        /* magnificPopup img view */
        $('.popup-image').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });

        /* magnificPopup img view */
        $('.img-pop-up').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });

        /* magnificPopup video view */
        $('.popup-video').magnificPopup({
            type: 'iframe'
        });


        // scrollIt for smoth scroll
        // $.scrollIt({
        //     upKey: 38, // key code to navigate to the next section
        //     downKey: 40, // key code to navigate to the previous section
        //     easing: 'linear', // the easing function for animation
        //     scrollTime: 600, // how long (in ms) the animation takes
        //     activeClass: 'active', // class given to the active nav element
        //     onPageChange: null, // function(pageIndex) that is called when page is changed
        //     topOffset: 0 // offste (in px) for fixed top navigation
        // });

        // // scrollup bottom to top
        // $.scrollUp({
        //     scrollName: 'scrollUp', // Element ID
        //     topDistance: '4500', // Distance from top before showing element (px)
        //     topSpeed: 300, // Speed back to top (ms)
        //     animation: 'fade', // Fade, slide, none
        //     animationInSpeed: 200, // Animation in speed (ms)
        //     animationOutSpeed: 200, // Animation out speed (ms)
        //     scrollText: '<i class="fa fa-angle-double-up"></i>', // Text for element
        //     activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        // });


        // blog-page

        $('.nonloop-block-13').owlCarousel({
            center: false,
            items: 1,
            loop: false,
            stagePadding: 0,
            margin: 20,
            nav: true,
            navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
            responsive: {
                600: {
                    margin: 20,
                    items: 2
                },
                1000: {
                    margin: 20,
                    items: 2
                },
                1200: {
                    margin: 20,
                    items: 3
                }
            }
        });


        //brand-active
        $('.brand-active').owlCarousel({
            loop: true,
            margin: 30,
            items: 1,
            autoplay: true,
            nav: false,
            dots: false,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
            responsive: {
                0: {
                    items: 1,
                    nav: false

                },
                767: {
                    items: 4
                },
                992: {
                    items: 7
                }
            }
        });

        // blog-dtails-page

        //project-active
        $('.project-active').owlCarousel({
            loop: true,
            margin: 30,
            items: 1,
            // autoplay:true,
            navText: ['<i class="Flaticon flaticon-left-arrow"></i>', '<i class="Flaticon flaticon-right-arrow"></i>'],
            nav: true,
            dots: false,
            // autoplayHoverPause: true,
            // autoplaySpeed: 800,
            responsive: {
                0: {
                    items: 1,
                    nav: false

                },
                767: {
                    items: 1,
                    nav: false
                },
                992: {
                    items: 2,
                    nav: false
                },
                1200: {
                    items: 1,
                },
                1501: {
                    items: 2,
                }
            }
        });

        if (document.getElementById('default-select')) {
            $('select').niceSelect();
        }

        //about-pro-active
        $('.details_active').owlCarousel({
            loop: true,
            margin: 0,
            items: 1,
            // autoplay:true,
            navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
            nav: true,
            dots: false,
            // autoplayHoverPause: true,
            // autoplaySpeed: 800,
            responsive: {
                0: {
                    items: 1,
                    nav: false

                },
                767: {
                    items: 1,
                    nav: false
                },
                992: {
                    items: 1,
                    nav: false
                },
                1200: {
                    items: 1,
                }
            }
        });

    });

    // resitration_Form
    $(document).ready(function () {
        $('.popup-with-form').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name',

            // When elemened is focused, some mobile browsers in some cases zoom in
            // It looks not nice, so we disable it:
            callbacks: {
                beforeOpen: function () {
                    if ($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            }
        });
    });


    AOS.init({
        duration: 1000
    });

    // home slider
    $('.home-slider').owlCarousel({
        loop: true,
        autoplay: true,
        margin: 10,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        nav: true,
        autoplayHoverPause: true,
        items: 1,
        autoheight: true,
        navText: ["<span class='ion-chevron-left'></span>", "<span class='ion-chevron-right'></span>"],
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 1,
                nav: false
            },
            1000: {
                items: 1,
                nav: true
            }
        }
    });

    // *************************************
    // :: 6.0 Testimonial Slides Active Code
    // *************************************
    if ($.fn.owlCarousel) {
        var testiThumbSlide = $('.testimonial-thumbnail');
        testiThumbSlide.owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            autoplay: true,
            smartSpeed: 500
        });
    }
    if ($.fn.owlCarousel) {
        var testiSlides = $('.testimonial-slides');
        testiSlides.owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            autoplay: true,
            smartSpeed: 1000
        });
    }
    // gallery index
    /* 5. Gallery Active */
    var client_list = $('.gallery-active');
    if (client_list.length) {
        client_list.owlCarousel({
            slidesToShow: 3,
            slidesToScroll: 1,
            loop: true,
            autoplay: true,
            speed: 3000,
            smartSpeed: 2000,
            nav: false,
            dots: false,
            margin: 0,

            autoplayHoverPause: true,
            responsive: {
                0: {
                    nav: false,
                    items: 2,
                },
                768: {
                    nav: false,
                    items: 3,
                }
            }
        });
    }
    // ***************************
    // :: 3.0 Single Project Slide
    // ***************************

    $(".single-project-slide").on("mouseenter", function () {
        $(".single-project-slide").removeClass("active");
        $(this).addClass("active");
    });

    // ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** *
    // :: 7.0 Rooms Slides Active Code
    // *******************************
    if ($.fn.owlCarousel) {
        var roomSlides = $('.rooms-slides');
        roomSlides.owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            autoplay: true,
            smartSpeed: 1500,
            nav: true,
            navText: [('<i class="fa fa-long-arrow-left" aria-hidden="true"></i> Previous'), ('Next <i class="fa fa-long-arrow-right" aria-hidden="true"></i>')]
        });

        roomSlides.on('translate.owl.carousel', function () {
            var layer = $("[data-animation]");
            layer.each(function () {
                var anim_name = $(this).data('animation');
                $(this).removeClass('animated ' + anim_name).css('opacity', '0');
            });
        });

        $("[data-delay]").each(function () {
            var anim_del = $(this).data('delay');
            $(this).css('animation-delay', anim_del);
        });

        $("[data-duration]").each(function () {
            var anim_dur = $(this).data('duration');
            $(this).css('animation-duration', anim_dur);
        });

        roomSlides.on('translated.owl.carousel', function () {
            var layer = roomSlides.find('.owl-item.active').find("[data-animation]");
            layer.each(function () {
                var anim_name = $(this).data('animation');
                $(this).addClass('animated ' + anim_name).css('opacity', '1');
            });
        });
    }


    //------- Mailchimp js --------//  
    function mailChimp() {
        $('#mc_embed_signup').find('form').ajaxChimp();
    }
    mailChimp();



    // Search Toggle
    $("#search_input_box").hide();
    $("#search").on("click", function () {
        $("#search_input_box").slideToggle();
        $("#search_input").focus();
    });
    $("#close_search").on("click", function () {
        $('#search_input_box').slideUp(500);
    });
    // Search Toggle
    $("#search_input_box").hide();
    $("#search_1").on("click", function () {
        $("#search_input_box").slideToggle();
        $("#search_input").focus();
    });

})(jQuery);