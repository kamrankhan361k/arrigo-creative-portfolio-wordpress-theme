(function ($) {

'use strict';

/*!==========================================================================
 * ==========================================================================
 * ==========================================================================
 *
 * Arrigo – Contemporary Creative Portfolio Elementor WordPress Theme
 *
 * [Table of Contents]
 *
 * 1. Animations
 * 2. Burger
 * 3. Button
 * 4. Circle
 * 5. Elementor-preview
 * 6. Elementor
 * 7. Figure Feature
 * 8. Figure Post
 * 9. Figure Portfolio
 * 10. Figure Service
 * 11. Form
 * 12. Grid
 * 13. Gmap
 * 14. Lazy Load
 * 15. Header
 * 16. Is Anchor
 * 17. Menu
 * 18. Parallax
 * 19. Preloader
 * 20. Section CTA
 * 21. Section Features
 * 22. Section Fullscreen
 * 23. Section Intro
 * 24. Section Header
 * 25. Section Logos
 * 26. Section Masthead
 * 27. Section Steps
 * 28. Slider Fullscreen4
 * 29. Slider Portfolio Item
 * 30. Slider
 * 31. Slider Fullscreen
 * 32. Slider Services
 * 33. Split Text
 * 34. Social
 * 35. Slider Testimonials
 * 36. Debounce
 * 37. Fix Mobile Bar Height
 * 38. Get Admin Bar Height
 * 39. Load Swiper
 * 40. Run On High Performance GPU
 *
 * ==========================================================================
 * ==========================================================================
 * ==========================================================================
 */

/**
 * Try to use high performance GPU on dual-GPU systems
 */
runOnHighPerformanceGPU();

gsap.config({
	nullTargetWarn: false
});

/**
 * Default Theme Options
 * Used to prevent errors if there is
 * no data from WordPress backend
 */

if (typeof window.theme === 'undefined') {
	window.theme = {
		colors: {
			accentPrimary: '#b68c70',
			accentSecondary: '#9b724d'
		},
		typography: {
			fontPrimary: 'Poppins',
			fontSecondary: 'Playfair Display'
		},
		contactForm7: {
			customModals: true
		}
	}
}

/**
 * ScrollMagic Setup
 */
window.SMController = new ScrollMagic.Controller();
window.SMController.enabled(false);
window.SMSceneTriggerHook = 0.85;
window.SMSceneReverse = false;

/**
 * Load common components
 */
$(document).ready(function () {
	new LazyLoad({
		scope: $(document)
	});
	new Social();
	new Form();
	new Burger();
	new Button();
	new Menu();
	fixMobileBarHeight();
	getAdminBarHeight();
});

/**
 * Enable on-scroll animations
 * once preloader animation is complete
 */
Preloader().then(function () {
	setTimeout(function () {
		window.SMController.enabled(true);
		window.SMController.update(true);
	}, 200);
});

/*!========================================================================
	1. Animations
	======================================================================!*/
function createOSScene($el, tl, $customTrigger, noReveal) {
	let $trigger = $el;

	if ($customTrigger && $customTrigger.length) {
		$trigger = $customTrigger;
	}

	if (!noReveal) {
		// reveal hidden element first
		tl.add([gsap.set($el, {
			autoAlpha: 1
		})], '0');
	}

	new $.ScrollMagic.Scene({
		triggerElement: $trigger,
		triggerHook: window.SMSceneTriggerHook,
		reverse: window.SMSceneReverse
	})
		.setTween(tl)
		.addTo(SMController);
}

function animateCurtainImg($curtain, $img) {
	const tl = gsap.timeline();

	return tl.to($curtain, {
		x: '0%',
		duration: 0.3,
		ease: 'expo.inOut',
	}).to($curtain, {
		y: '0%',
		duration: 0.4,
		ease: 'expo.inOut',
	}).set($img, {
		autoAlpha: 1
	}).to($img, {
		scale: 1,
		duration: 1,
		ease: 'power4.out',
	}).to($curtain, {
		y: '102%',
		duration: 0.3,
		ease: 'expo.inOut'
	}, '-=1');
}

function animateCurtainContent($curtain, $content) {
	const tl = gsap.timeline();

	return tl.to($curtain, {
		x: '0%',
		duration: 0.3,
		ease: 'expo.inOut'
	}).to($curtain, {
		y: '0%',
		duration: 0.4,
		ease: 'expo.inOut',
	}).set($content, {
		autoAlpha: 1
	}).to($curtain, {
		y: '102%',
		duration: 0.3,
		ease: 'expo.inOut'
	});
}

function setCurtainImg($curtain, $img) {
	gsap.set($img, {
		scale: 1.1,
		autoAlpha: 0,
	});

	gsap.set($curtain, {
		y: '-99%',
		x: '-100%'
	});
}

function setCurtainContent($curtain, $content) {
	gsap.set($content, {
		autoAlpha: 0,
	});

	gsap.set($curtain, {
		y: '-99%',
		x: '-100%'
	});
}

/*!========================================================================
	2. Burger
	======================================================================!*/
const Burger = function () {
	const
		OPEN_CLASS = 'burger_opened',
		$overlay = $('.header__wrapper-overlay-menu');

	const header = new Header();

	$(document).on('click', '.js-burger', function (e) {
		e.preventDefault();

		if (!$overlay.hasClass('in-transition')) {
			const $burger = $(this);

			if ($burger.hasClass(OPEN_CLASS)) {
				$burger.removeClass(OPEN_CLASS);
				header.closeOverlayMenu();
			} else {
				$burger.addClass(OPEN_CLASS);
				header.openOverlayMenu();
			}
		}
	});
}

/*!========================================================================
	3. Button
	======================================================================!*/
const Button = function () {
	$('.button-square').each(function () {
		let
			$el = $(this),
			delay = 0;

		const $rect = $el.find('.rect');

		if ($el.not('a')) {
			$el = $el.closest('a');
			delay = 0.15;
		}

		gsap.set($rect, {
			drawSVG: 0,
			stroke: window.theme.colors.accentPrimary,
		});

		$el.on('mouseenter touchstart', function () {
			gsap.to($rect, {
				drawSVG: true,
				duration: 0.6,
				ease: 'power4.inOut',
				delay
			});

		}).on('mouseleave touchend', function () {
			gsap.to($rect, {
				drawSVG: false,
				duration: 0.6,
				ease: 'power4.inOut',
			});
		});
	});
}

/*!========================================================================
	4. Circle
	======================================================================!*/
const Circle = function () {
	this.animate = function ($el) {
		const $circle = $el.find('.circle');

		if (!$circle.length) {
			return;
		}

		gsap.set($circle, {
			drawSVG: 0,
			stroke: window.theme.colors.accentPrimary,
		});

		$el.on('mouseenter touchstart', function () {
			gsap.to($circle, {
				drawSVG: true,
				duration: 0.6,
				ease: 'power4.inOut'
			});

		}).on('mouseleave touchend', function () {
			gsap.to($circle, {
				drawSVG: false,
				duration: 0.6,
				ease: 'power4.inOut'
			});
		});
	}
}

/*!========================================================================
	5. Elementor-preview
	======================================================================!*/
/**
 * Elementor Document Settings
 * Live Preview & Editing
 */
jQuery(window).on('elementor/frontend/init', function () {
	if (typeof elementor !== 'undefined') {
		elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
			new LazyLoad({
				scope: $scope
			});
		});

		/**
		 * Version Compare
		 */
		function compareVersion(v1, v2) {
			if (typeof v1 !== 'string') return false;
			if (typeof v2 !== 'string') return false;
			v1 = v1.split('.');
			v2 = v2.split('.');
			const k = Math.min(v1.length, v2.length);
			for (let i = 0; i < k; ++i) {
				v1[i] = parseInt(v1[i], 10);
				v2[i] = parseInt(v2[i], 10);
				if (v1[i] > v2[i]) return 1;
				if (v1[i] < v2[i]) return -1;
			}
			return v1.length == v2.length ? 0 : (v1.length < v2.length ? -1 : 1);
		}

		/**
		 * Reload Preview & Open Panel
		 */
		function updatePreview(openedPageAfter, openedTabAfter, openedSectionAfter) {
			elementor.reloadPreview();
			elementor.once('preview:loaded', () => {
				if (openedPageAfter) {
					elementor.getPanelView().setPage(openedPageAfter);
				}

				if (openedTabAfter) {
					elementor.getPanelView().getCurrentPageView().activeTab = openedTabAfter;
				}

				if (openedSectionAfter) {
					elementor.getPanelView().getCurrentPageView().activateSection(openedSectionAfter);
				}

				elementor.getPanelView().getCurrentPageView().render();
			});
		}

		/**
		 * Reload Elementor Preview
		 */
		function reloadPreview(openedPageAfter, openedTabAfter, openedSectionAfter) {
			// Backward Compatibility for Elementor 2.8.5 or earlier
			if (compareVersion(elementor.config.version, '2.9.0') <= 0) {
				elementor.saver.update({
					onSuccess: () => {
						updatePreview(openedPageAfter, openedTabAfter, openedSectionAfter);
					}
				});
			} else {
				elementor.saver.update().then(() => {
					updatePreview(openedPageAfter, openedTabAfter, openedSectionAfter)
				});
			}
		}

		const
			$header = jQuery('.header'),
			$sectionMasthead = jQuery('.section-masthead'),
			$portfolioDetails = jQuery('.portfolio-details'),
			header = new Header(),
			headerInitialClasses = $header.attr('class'), // cache classes from WP Customizer
			defaultOptions = elementor.settings.page.getSettings().controls, // cache settings from WP Customizer
			currentOptions = elementor.settings.page.model.attributes; // current settings

		/**
		 * Update Masthead
		 */
		function updateMasthead(newval) {
			if (newval == 'yes') {
				$sectionMasthead.addClass('d-none');
			} else {
				$sectionMasthead.removeClass('d-none');
			}
		}

		/**
		 * Update Page Header Settings
		 */
		function updateHeaderSettings(newval) {
			if (newval == 'yes') {
				updateHeaderTheme(currentOptions.page_header_theme);
				updateHeaderPosition(currentOptions.page_header_position);
				updateHeaderSticky(currentOptions.page_header_sticky);
			} else { // reset settings to defaults
				$header.removeAttr('class').addClass(headerInitialClasses);
				updateHeaderTheme(defaultOptions.page_header_theme.default);
				updateHeaderPosition(defaultOptions.page_header_position.default);
				updateHeaderSticky(defaultOptions.page_header_sticky.default);
			}

			// reload preview if menu style was changed to render menu
			if (defaultOptions.page_menu_style.default != currentOptions.page_menu_style) {
				reloadPreview('page_settings', 'settings', 'header_section');
			}
		}

		/**
		 * Update Header Color Theme
		 */
		function updateHeaderTheme(newval) {
			$header.removeClass('header_dark header_light header_accent').addClass(newval);
		}

		/**
		 * Update Header Position
		 */
		function updateHeaderPosition(newval) {
			$header.removeClass('header_relative header_absolute').addClass(newval);
			header.enableSticky(false);
			header.enableSticky(true);
		}

		/**
		 * Update Header Sticky
		 */
		function updateHeaderSticky(newval) {
			if (newval == 'yes') {
				$header.addClass('js-header-sticky');
				header.enableSticky(true);
			} else {
				$header.removeClass('js-header-sticky header_fixed');
				header.enableSticky(false);
			}
		}
		/**
		 * Page Header Settings
		 */
		elementor.settings.page.addChangeCallback('page_header_settings', function (newval) {
			updateHeaderSettings(newval);
		});

		/**
		 * Header Theme
		 */
		elementor.settings.page.addChangeCallback('page_header_theme', function (newval) {
			updateHeaderTheme(newval);
		});

		/**
		 * Header Position
		 */
		elementor.settings.page.addChangeCallback('page_header_position', function (newval) {
			updateHeaderPosition(newval);
		});

		/**
		 * Header Sticky
		 */
		elementor.settings.page.addChangeCallback('page_header_sticky', function (newval) {
			updateHeaderSticky(newval);
		});

		/**
		 * Menu Style
		 */
		elementor.settings.page.addChangeCallback('page_menu_style', function (newval) {
			reloadPreview('page_settings', 'settings', 'header_section');
		});

		/**
		 * Minimal Header (for Portfolio Item post type)
		 */
		elementor.settings.page.addChangeCallback('page_header_minimal', function (newval) {
			reloadPreview('page_settings', 'settings', 'header_section');
		});

		/**
		 * Header Logo Version
		 */
		elementor.settings.page.addChangeCallback('page_header_logo_version', function (newval) {
			reloadPreview('page_settings', 'settings', 'header_section');
		});

		/**
		 * Page Featured Image
		 */
		elementor.settings.page.addChangeCallback('post_featured_image', function (newval) {
			reloadPreview('page_settings', 'settings', 'document_settings');
		});

		/**
		 * Hide Title
		 */
		elementor.settings.page.addChangeCallback('hide_title', function (newval) {
			updateMasthead(newval);
		});

		/**
		 * Page Preloader
		 */
		elementor.settings.page.addChangeCallback('page_preloader_settings', function (newval) {
			reloadPreview('page_settings', 'settings', 'preloader_section');
		});

		/**
		 * Preloader Type
		 */
		elementor.settings.page.addChangeCallback('page_preloader_type', function (newval) {
			reloadPreview('page_settings', 'settings', 'preloader_section');
		});

		/**
		 * Page Footer
		 */
		elementor.settings.page.addChangeCallback('page_footer_settings', function (newval) {
			reloadPreview('page_settings', 'settings', 'footer_section');
		});

		/**
		 * Hide Footer
		 */
		elementor.settings.page.addChangeCallback('page_footer_hide', function (newval) {
			reloadPreview('page_settings', 'settings', 'footer_section');
		});

		/**
		 * Portfolio Item Color Theme
		 */
		elementor.settings.page.addChangeCallback('portfolio_item_color_theme', function (newval) {
			$portfolioDetails.removeClass('bg-dark bg-light bg-white bg-black').addClass(newval);
		});

		/**
		 * Portfolio Next Item
		 */
		elementor.settings.page.addChangeCallback('portfolio_item_show_next', function (newval) {
			reloadPreview('page_settings', 'settings', 'footer_section');
		});
	}
});

/*!========================================================================
	6. Elementor
	======================================================================!*/
/**
 * Elementor Widgets
 */
$(window).on('elementor/frontend/init', function () {
	elementorFrontend.hooks
		/**
		 * Feature
		 */
		.addAction('frontend/element_ready/arrigo-widget-feature.default', function ($scope) {
			function loadComponent() {
				new FigureFeature($scope);
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * Portfolio Slider Fullscreen 1
		 */
		.addAction('frontend/element_ready/arrigo-widget-portfolio-slider-fullscreen-1.default', function ($scope) {
			function loadComponent() {
				new Button();
				new SliderFullscreen1($scope);
				new SectionFullscreen1($scope);
			}

			if (typeof Swiper === 'undefined' && typeof elementorFrontend.utils.swiper !== 'undefined') {
				elementorFrontend.utils.assetsLoader.load('script', 'swiper').then(() => {
					document.fonts.ready.then(loadComponent, loadComponent);
				});
			} else {
				document.fonts.ready.then(loadComponent, loadComponent);
			}
		})

		/**
		 * Portfolio Slider Fullscreen 2
		 */
		.addAction('frontend/element_ready/arrigo-widget-portfolio-slider-fullscreen-2.default', function ($scope) {
			function loadComponent() {
				new Button();
				new SliderFullscreen4($scope);
				new SectionFullscreen4($scope);
				new Social();
			}

			if (typeof Swiper === 'undefined' && typeof elementorFrontend.utils.swiper !== 'undefined') {
				elementorFrontend.utils.assetsLoader.load('script', 'swiper').then(() => {
					document.fonts.ready.then(loadComponent, loadComponent);
				});
			} else {
				document.fonts.ready.then(loadComponent, loadComponent);
			}
		})

		/**
		 * Figure Portfolio
		 */
		.addAction('frontend/element_ready/arrigo-widget-portfolio-grid-irregular.default', function ($scope) {
			function loadComponent() {
				new FigurePortfolio($scope);
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * Masonry Grid
		 */
		.addAction('frontend/element_ready/arrigo-widget-masonry-grid.default', function ($scope) {
			function loadComponent() {
				new Grid($scope);
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * Masonry Grid Portfolio
		 */
		.addAction('frontend/element_ready/arrigo-widget-portfolio-masonry-grid.default', function ($scope) {
			function loadComponent() {
				new Grid($scope);
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * Shortcode
		 */
		.addAction('frontend/element_ready/shortcode.default', function ($scope) {
			function loadComponent() {
				new Form();
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * Services Grid
		 */
		.addAction('frontend/element_ready/arrigo-widget-services-grid.default', function ($scope) {
			function loadComponent() {
				new SectionFeatures($scope);
				new FigureFeature($scope);
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * Services Slider
		 */
		.addAction('frontend/element_ready/arrigo-widget-services-slider.default', function ($scope) {
			function loadComponent() {
				new SliderServices($scope);
				new FigureService($scope);
			}

			if (typeof Swiper === 'undefined' && typeof elementorFrontend.utils.swiper !== 'undefined') {
				elementorFrontend.utils.assetsLoader.load('script', 'swiper').then(() => {
					document.fonts.ready.then(loadComponent, loadComponent);
				});
			} else {
				document.fonts.ready.then(loadComponent, loadComponent);
			}
		})

		/**
		 * Google Map
		 */
		.addAction('frontend/element_ready/arrigo-widget-google-map.default', function ($scope) {
			function loadComponent() {
				new GMap($scope);
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * CTA
		 */
		.addAction('frontend/element_ready/arrigo-widget-cta.default', function ($scope) {
			function loadComponent() {
				new Parallax($scope);
				new SectionCTA($scope);
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * Header Section
		 */
		.addAction('frontend/element_ready/arrigo-widget-header-section.default', function ($scope) {
			function loadComponent() {
				new SectionHeader($scope);
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * Masthead Intro
		 */
		.addAction('frontend/element_ready/arrigo-widget-masthead-intro.default', function ($scope) {
			function loadComponent() {
				new SectionIntro($scope);
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * Parallax Background
		 */
		.addAction('frontend/element_ready/arrigo-widget-parallax-background.default', function ($scope) {
			function loadComponent() {
				new Parallax($scope);
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * Step
		 */
		.addAction('frontend/element_ready/arrigo-widget-step.default', function ($scope) {
			function loadComponent() {
				new SectionSteps($scope);
				new Parallax($scope);
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * Testimonials Slider
		 */
		.addAction('frontend/element_ready/arrigo-widget-testimonials-slider.default', function ($scope) {
			function loadComponent() {
				new SliderTestimonials($scope);
			}

			if (typeof Swiper === 'undefined' && typeof elementorFrontend.utils.swiper !== 'undefined') {
				elementorFrontend.utils.assetsLoader.load('script', 'swiper').then(() => {
					document.fonts.ready.then(loadComponent, loadComponent);
				});
			} else {
				document.fonts.ready.then(loadComponent, loadComponent);
			}
		})

		/**
		 * Latest Posts
		 */
		.addAction('frontend/element_ready/arrigo-widget-latest-posts.default', function ($scope) {
			function loadComponent() {
				new FigurePost($scope);
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * Team Member
		 */
		.addAction('frontend/element_ready/arrigo-widget-team-member.default', function ($scope) {
			function loadComponent() {
				new Social();
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		})

		/**
		 * Images Slider
		 */
		.addAction('frontend/element_ready/arrigo-widget-images-slider.default', function ($scope) {
			function loadComponent() {
				new SliderPortfolioItem($scope);
			}

			if (typeof Swiper === 'undefined' && typeof elementorFrontend.utils.swiper !== 'undefined') {
				elementorFrontend.utils.assetsLoader.load('script', 'swiper').then(() => {
					document.fonts.ready.then(loadComponent, loadComponent);
				});
			} else {
				document.fonts.ready.then(loadComponent, loadComponent);
			}
		})

		/**
		 * Featured Image
		 */
		.addAction('frontend/element_ready/arrigo-widget-featured-image.default', function ($scope) {
			function loadComponent() {
				new Parallax($scope);
			}

			document.fonts.ready.then(loadComponent, loadComponent);
		});
});

/*!========================================================================
	7. Figure Feature
	======================================================================!*/
const FigureFeature = function ($scope) {
	const
		$link = $scope.find('a.figure-feature'),
		$target = $scope.find('.figure-feature[data-os-animation]'),
		tl = gsap.timeline(),
		$heading = $target.find('.figure-feature__header h3'),
		$descr = $target.find('.figure-feature__header p'),
		splitHeading = splitLines($heading),
		splitDescr = splitLines($descr),
		circle = new Circle();

	prepare();
	animate();

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines(splitHeading.words);
		setLines(splitDescr.words);
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		tl
			.add(animateLines(splitHeading.words))
			.add(animateLines(splitDescr.words), '-=0.6')

		createOSScene($target, tl);
	}

	$link.each(function () {
		circle.animate($(this));
	});
}

/*!========================================================================
	8. Figure Post
	======================================================================!*/
const FigurePost = function ($scope) {
	const
		$target = $scope.find('.figure-post[data-os-animation]'),
		$heading = $target.find('.figure-post__content h3'),
		$text = $target.find('.figure-post__content p'),
		splitHeading = splitLines($heading),
		splitDescr = splitLines($text);

	prepare();
	animate();

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines(splitHeading.words);

		if (splitDescr) {
			setLines(splitDescr.lines);
		}
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		$target.each(function () {
			const
				tl = gsap.timeline(),
				$el = $(this),
				$elHeading = $el.find($heading),
				elSplitDescr = $elHeading.find(splitDescr.lines),
				elSplitHeading = $elHeading.find(splitHeading.words);

			tl.add(animateLines(elSplitHeading));

			if (splitDescr) {
				tl.add(animateLines(elSplitDescr, 1, 0.1));
			}

			createOSScene($el, tl);
		});
	}
}

/*!========================================================================
	9. Figure Portfolio
	======================================================================!*/
const FigurePortfolio = function ($scope) {
	const $target = $scope.find('.figure-portfolio[data-os-animation]'),
		$img = $target.find('.overflow__content'),
		$curtain = $target.find('.overflow__curtain'),
		$heading = $target.find('.figure-portfolio__header h2'),
		$headline = $target.find('.figure-portfolio__headline'),
		$info = $target.find('.figure-portfolio__info'),
		splitHeading = splitLines($heading),
		splitInfo = splitLines($info);

	setHover();
	prepare();
	animate();

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines(splitHeading.words);
		setLines(splitInfo.words);

		gsap.set($headline, {
			scaleX: 0,
			transformOrigin: 'left center'
		});

		setCurtainImg($curtain, $img);
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		$target.each(function () {
			const
				tl = gsap.timeline(),
				$el = $(this),
				$elImg = $el.find($img),
				$elCurtain = $el.find($curtain),
				$elHeadline = $el.find($headline),
				elSplitInfo = $el.find(splitInfo.words),
				elSplitHeading = $el.find(splitHeading.words);

			tl
				.add(animateCurtainImg($elCurtain, $elImg))
				.to($elHeadline, {
					scaleX: 1,
					duration: 0.6,
					ease: 'power4.out'
				}, '-=1')
				.add(animateLines(elSplitInfo), '-=0.8')
				.add(animateLines(elSplitHeading), '-=0.8');

			createOSScene($el, tl);
		});
	}

	function setHover() {
		const
			$targetHover = $scope.find('.figure-portfolio'),
			$img = $targetHover.find('.figure-portfolio__wrapper-img img'),
			$heading = $targetHover.find('.figure-portfolio__header h2'),
			$headline = $targetHover.find('.figure-portfolio__headline');

		$targetHover.each(function () {
			const
				$el = $(this),
				$elLink = $el.find('.figure-portfolio__link'),
				$elImg = $el.find('img'),
				$elHeading = $el.find($heading),
				$elHeadline = $el.find($headline);

			$elLink
				.on('mouseenter touchstart', function () {
					gsap.to($elImg, {
						duration: 0.3,
						scale: 1.1,
						ease: 'power3.inOut',
					});

					gsap.to($elHeadline, {
						duration: 0.3,
						scaleX: 0.8,
						ease: 'power3.inOut',
						transformOrigin: 'right center'
					});

					gsap.to($elHeading, {
						duration: 0.3,
						x: 10,
						ease: 'power3.inOut',
					});
				})
				.on('mouseleave touchend', function () {
					gsap.to($elImg, {
						duration: 0.3,
						scale: 1,
						ease: 'power2.inOut',
					});

					gsap.to($elHeadline, {
						duration: 0.3,
						scaleX: 1,
						ease: 'power2.inOut',
						transformOrigin: 'right center'
					});

					gsap.to($elHeading, {
						duration: 0.3,
						x: '0px',
						ease: 'power2.inOut',
					});
				});
		});
	}
}

/*!========================================================================
	10. Figure Service
	======================================================================!*/
const FigureService = function ($scope) {
	const $target = $scope.find('.figure-service');

	if (!$target.length) {
		return;
	}

	const
		circle = new Circle(),
		$icons = $target.find('.figure-service__icon'),
		$headlines = $target.find('.figure-service__headline'),
		$numbers = $target.find('.figure-service__number'),
		$texts = $target.find('.figure-service__header p'),
		splitDescr = splitLines($texts);

	setLines(splitDescr.words);

	$target.each(function () {
		const
			tl = gsap.timeline(),
			$el = $(this),
			$elIcon = $el.find($icons),
			$elHeadline = $el.find($headlines),
			$elNumber = $el.find($numbers),
			elDescr = $el.find(splitDescr.words);

		circle.animate($el);

		$el
			.on('mouseenter touchstart', function () {
				tl
					.clear()
					.to($elHeadline, {
						duration: 0.6,
						scaleX: 2,
						ease: 'power4.out'
					})
					.to($elNumber, {
						duration: 0.3,
						y: -50,
						autoAlpha: 0
					}, '-=0.6')
					.to($elIcon, {
						duration: 0.6,
						y: -50,
						ease: 'power4.out'
					}, '-=0.6')
					.add(animateLines(elDescr, 0.6, 0.005), '-=0.6');
			})
			.on('mouseleave touchend', function () {
				tl
					.clear()
					.to($elHeadline, {
						duration: 0.3,
						scaleX: 1
					})
					.to($elNumber, {
						duration: 0.3,
						y: 0,
						autoAlpha: 1
					}, '-=0.3')
					.to($elIcon, {
						duration: 0.3,
						y: 0
					}, '-=0.3')
					.add(hideLines(elDescr, 0.6, 0.005), '-=0.6');
			});
	});
}

/*!========================================================================
	11. Form
	======================================================================!*/
const Form = function () {
	const
		INPUT_CLASS = '.input-float__input',
		INPUT_NOT_EMPTY = 'input-float__input_not-empty',
		INPUT_FOCUSED = 'input-float__input_focused';

	floatLabels();
	ajaxForm();

	if (typeof window.theme !== 'undefined' && window.theme.contactForm7.customModals) {
		attachModalsEvents();
	}

	function floatLabels() {
		if (!$(INPUT_CLASS).length) {
			return;
		}

		$(INPUT_CLASS).each(function () {
			const
				$currentField = $(this),
				$currentControlWrap = $currentField.parent('.wpcf7-form-control-wrap');

			// not empty value
			if ($currentField.val()) {
				$currentField.addClass(INPUT_NOT_EMPTY);
				$currentControlWrap.addClass(INPUT_NOT_EMPTY);
				// empty value
			} else {
				$currentField.removeClass([INPUT_FOCUSED, INPUT_NOT_EMPTY]);
				$currentControlWrap.removeClass([INPUT_FOCUSED, INPUT_NOT_EMPTY]);
			}

			// has placeholder & empty value
			if ($currentField.attr('placeholder') && !$currentField.val()) {
				$currentField.addClass(INPUT_NOT_EMPTY);
				$currentControlWrap.addClass(INPUT_NOT_EMPTY);
			}
		});

		$(document).on('focusin', INPUT_CLASS, function () {
			const
				$currentField = $(this),
				$currentControlWrap = $currentField.parent('.wpcf7-form-control-wrap');

			$currentField.addClass(INPUT_FOCUSED).removeClass(INPUT_NOT_EMPTY);
			$currentControlWrap.addClass(INPUT_FOCUSED).removeClass(INPUT_NOT_EMPTY);

		}).on('focusout', INPUT_CLASS, function () {
			const
				$currentField = $(this),
				$currentControlWrap = $currentField.parent('.wpcf7-form-control-wrap');

			// not empty value
			if ($currentField.val()) {
				$currentField.removeClass(INPUT_FOCUSED).addClass(INPUT_NOT_EMPTY);
				$currentControlWrap.removeClass(INPUT_FOCUSED).addClass(INPUT_NOT_EMPTY);
			} else {
				// has placeholder & empty value
				if ($currentField.attr('placeholder')) {
					$currentField.addClass(INPUT_NOT_EMPTY);
					$currentControlWrap.addClass(INPUT_NOT_EMPTY);
				}
				$currentField.removeClass(INPUT_FOCUSED);
				$currentControlWrap.removeClass(INPUT_FOCUSED);
			}
		});
	}

	function ajaxForm() {
		const $form = $('.js-ajax-form');

		if (!$form.length) {
			return;
		}

		$form.validate({
			errorElement: 'span',
			errorPlacement: function (error, element) {
				error.appendTo(element.parent()).addClass('form__error');
			},
			submitHandler: function (form) {
				ajaxSubmit(form);
			}
		});

		function ajaxSubmit(form) {
			$.ajax({
				type: $form.attr('method'),
				url: $form.attr('action'),
				data: $form.serialize()
			}).done(function () {
				alert($form.attr('data-message-success'));
				$form.trigger('reset');
				floatLabels();
			}).fail(function () {
				alert($form.attr('data-message-error'));
			});
		}
	}

	function attachModalsEvents() {
		$(document).on('wpcf7submit', function (e) {
			const $modal = $('#modalContactForm7');

			$modal.modal('dispose').remove();

			if (e.detail.apiResponse.status === 'mail_sent') {
				createModalTemplate({
					icon: 'icon-success.svg',
					message: e.detail.apiResponse.message,
					onHide: function () {
						$(e.srcElement).find(INPUT_CLASS).parent().val('').removeClass(INPUT_FOCUSED).removeClass(INPUT_NOT_EMPTY);
					}
				});
			}

			if (e.detail.apiResponse.status === 'mail_failed') {
				createModalTemplate({
					icon: 'icon-error.svg',
					message: e.detail.apiResponse.message
				});
			}
		});
	}

	function createModalTemplate({
		icon,
		message,
		onHide
	}) {
		$('body').append(`
			<div class="modal fade" id="modalContactForm7">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content radius-img">
						<div class="modal__close" data-dismiss="modal"><img src="${window.theme.themeURL}/img/general/icon-close.svg"/></div>
							<header class="text-center modal__header">
								<img src="${window.theme.themeURL}/img/general/${icon}" width="80px" height="80px" alt=""/>
								<h3 class="modal__message"><strong>${message}</strong></h3>
							</header>
							<button type="button" class="button button_solid button_accent" data-dismiss="modal"><span>OK</span></button>
					</div>
				</div>
			</div>
		`);
		const $modal = $('#modalContactForm7');

		$modal.modal('show');
		$modal.on('hidden.bs.modal', function () {
			$modal.modal('dispose').remove();

			if (typeof onHide === 'function') {
				onHide();
			}

			$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
		});
	}
}

/*!========================================================================
	12. Grid
	======================================================================!*/
const Grid = function ($scope) {
	const
		$grid = $('.js-grid'),
		$filter = $('.js-filter'),
		$filterItems = $filter.find('.js-filter__item'),
		$target = $scope.find('.js-grid[data-os-animation]'),
		$items = $target.find('.grid__item'),
		$heading = $target.find('.grid__item-header h3'),
		$meta = $target.find('.grid__item-header .post-meta li'),
		splitHeading = splitLines($heading),
		splitMeta = splitLines($meta),
		circle = new Circle();

	if (!$grid.length) {
		return;
	}

	createGrid();
	prepare();
	animate();

	function createGrid() {
		const
			$links = $grid.find('.grid__item-link'),
			masonryGrid = $grid.masonry({
				itemSelector: '.js-grid__item',
				columnWidth: '.js-grid__sizer',
				horizontalOrder: true
			});

		$grid.imagesLoaded({
			background: true
		}, function () {
			masonryGrid.masonry('layout');
		});

		if ($links.length) {
			$links.each(function () {
				let $el = $(this);

				circle.animate($el);
			});
		}

		if ($filter.length) {
			$grid.isotope();

			$filterItems.on('click', function (e) {
				const
					$el = $(this),
					filterBy = $el.data('filter');

				e.preventDefault();

				$filterItems.removeClass('filter__item_active');
				$el.addClass('filter__item_active');

				masonryGrid.isotope({
					itemSelector: '.js-grid__item',
					columnWidth: '.js-grid__sizer',
					horizontalOrder: true,
					filter: filterBy
				});
			});
		}
	}

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines(splitHeading.words);
		setLines(splitMeta.words);

		gsap.set($items, {
			visibility: 'visible',
			opacity: 0,
			y: 50,
			scaleY: 1.2,
			transformOrigin: 'top center'
		});
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		const
			colsDesktop = parseInt($target.data('grid-columns'), 10),
			colsTablet = parseInt($target.data('grid-columns-tablet'), 10),
			colsMobile = parseInt($target.data('grid-columns-mobile'), 10),
			lg = elementorFrontend.config.breakpoints.lg - 1 || 1024,
			md = elementorFrontend.config.breakpoints.md - 1 || 767;

		let cols = colsDesktop;

		if (Modernizr.mq('(max-width: ' + lg + 'px)')) {
			cols = colsTablet;
		}

		if (Modernizr.mq('(max-width: ' + md + 'px)')) {
			cols = colsMobile;
		}

		for (let index = 0; index < $items.length; index = index + cols) {
			const
				$array = $items.slice(index, index + cols),
				elHeading = $array.find(splitHeading.words),
				elMeta = $array.find(splitMeta.words),
				tl = gsap.timeline();

			tl
				.to($array, {
					opacity: 1,
					y: 0,
					duration: 0.9,
					stagger: 0.15,
					scaleY: 1,
				})
				.add(animateLines(elHeading), '0.6')
				.add(animateLines(elMeta), '0.9');

			createOSScene($array[0], tl, false, true);
		}
	}
}

/*!========================================================================
	13. Gmap
	======================================================================!*/
const GMap = function ($scope) {
	const
		$wrapper = $scope.find('.gmap'),
		prevInfoWindow = false;

	if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
		return;
	}

	createMap($wrapper);

	/**
	 * 
	 * @param {Map jQuery Object} $wrapper 
	 */
	function createMap($wrapper) {
		const $mapContainer = $wrapper.find('.gmap__container');

		if (!$mapContainer.length) {
			return;
		}

		const
			$markers = $wrapper.find('.gmap__marker'),
			ZOOM = parseInt($wrapper.attr('data-gmap-zoom'));

		let SNAZZY_STYLES = $wrapper.attr('data-gmap-snazzy-styles');

		const argsMap = {
			center: new google.maps.LatLng(0, 0),
			zoom: ZOOM,
		};

		if (SNAZZY_STYLES) {
			try {
				SNAZZY_STYLES = JSON.parse(SNAZZY_STYLES);
				$.extend(argsMap, {
					styles: SNAZZY_STYLES
				});
			} catch (err) {
				console.error('Google Map: Invalid Snazzy Styles');
			}
		};

		const map = new google.maps.Map($mapContainer[0], argsMap);

		map.markers = [];

		$markers.each(function () {
			createMarker($(this), map);
		});

		centerMap(ZOOM, map);
	}

	/**
	 * 
	 * @param {Marker jQuery object} $marker 
	 * @param {Google Map Instance} map
	 */
	function createMarker($marker, map) {
		if (!$marker.length) {
			return;
		}

		const
			MARKER_LAT = parseFloat($marker.attr('data-marker-lat')),
			MARKER_LON = parseFloat($marker.attr('data-marker-lon')),
			MARKER_IMG = $marker.attr('data-marker-img'),
			MARKER_WIDTH = $marker.attr('data-marker-width'),
			MARKER_HEIGHT = $marker.attr('data-marker-height'),
			MARKER_CONTENT = $marker.attr('data-marker-content');

		/**
		 * Marker
		 */
		const argsMarker = {
			position: new google.maps.LatLng(MARKER_LAT, MARKER_LON),
			map: map
		};

		if (MARKER_IMG) {
			$.extend(argsMarker, {
				icon: {
					url: MARKER_IMG
				}
			});
		}

		if (MARKER_IMG && MARKER_WIDTH && MARKER_HEIGHT) {
			$.extend(argsMarker.icon, {
				scaledSize: new google.maps.Size(MARKER_WIDTH, MARKER_HEIGHT),
				origin: new google.maps.Point(0, 0), // origin
				anchor: new google.maps.Point(0, 0) // anchor
			});
		}

		const marker = new google.maps.Marker(argsMarker)

		map.markers.push(marker);

		/**
		 * Info Window (Content)
		 */
		if (MARKER_CONTENT) {
			const infoWindow = new google.maps.InfoWindow({
				content: MARKER_CONTENT
			});

			marker.addListener('click', function () {
				if (prevInfoWindow) {
					prevInfoWindow.close();
				}

				prevInfoWindow = infoWindow;
				infoWindow.open(map, marker);
			});
		}
	}

	/**
	 * 
	 * @param {Map Zoom} zoom 
	 * @param {Google Map Instance} map
	 */
	function centerMap(zoom, map) {
		const bounds = new google.maps.LatLngBounds();
		let newZoom;

		$.each(map.markers, function () {
			const item = this;

			newZoom = new google.maps.LatLng(item.position.lat(), item.position.lng());
			bounds.extend(newZoom);
		});

		if (map.markers.length == 1) {
			map.setCenter(bounds.getCenter());
			map.setZoom(zoom);
		} else {
			map.fitBounds(bounds);
		}
	}
}

/*!========================================================================
	14. Lazy Load
	======================================================================!*/
class LazyLoad {
	constructor({
		scope = $(document),
		run = true
	}) {
		this.$scope = scope;
		this.$images = this.$scope.find('img[data-src]:not(.swiper-lazy)');
		this.$backgrounds = this.$scope.find('.lazy-bg[data-src], .lazy-bg img.of-cover[data-src]');

		if (run) {
			this.run();
		}
	}

	run() {
		this.loadImages({
			target: this.$images
		});
		this.loadBackgrounds({
			target: this.$backgrounds
		});
	}

	loadBackgrounds({
		target,
		callback
	}) {
		if (target && target.length) {
			const instance = target.Lazy({
				threshold: 800,
				chainable: false,
				afterLoad: (el) => {
					$(el).closest('.lazy, .lazy-bg').addClass('lazy_loaded');

					if (typeof callback === 'function') {
						callback();
					}
				}
			});
			setTimeout(() => {
				instance.update();
			}, 50);
		}
	}

	loadImages({
		target,
		callback
	}) {
		if (target && target.length) {
			const instance = target.Lazy({
				threshold: 800,
				chainable: false,
				afterLoad: (el) => {
					$(el).closest('.lazy, .lazy-bg').addClass('lazy_loaded');

					if (typeof callback === 'function') {
						callback();
					}
				}
			});
			setTimeout(() => {
				instance.update();
			}, 50);
		}
	}
}

/*!========================================================================
	15. Header
	======================================================================!*/
const Header = function () {
	const
		self = this,
		$burger = $('.js-burger'),
		$overlay = $('.header__wrapper-overlay-menu'),
		$menuLinks = $('.overlay-menu > li > a .overlay-menu__item-wrapper'),
		$overlayLinks = $('.overlay-menu > li a'),
		$submenu = $('.overlay-sub-menu'),
		$submenuButton = $('.js-submenu-back'),
		$submenuLinks = $submenu.find('> li > a .overlay-menu__item-wrapper');

	stickHeader();

	if (!$overlay.length) {
		return;
	}

	setOverlayMenu();

	if (window.stickyScene) {
		/**
		 * Use debounce from lodash if possible
		 * to improve performance
		 */
		if (typeof _ === 'function') {
			$(window).on(getResponsiveResizeEvent(), _.debounce(function () {
				resetSticky();
			}, 200));
		} else {
			$(window).on(getResponsiveResizeEvent(), function () {
				resetSticky();
			});
		}
	}

	this.enableSticky = function (value) {
		stickHeader();

		if (value != true && window.stickyScene) {
			window.stickyScene = window.stickyScene.destroy(true);
		}
	}

	function resetSticky() {
		if (window.stickyScene) {
			let admin_bar_mobile = Modernizr.mq('(max-width: 600px)') && $('body').hasClass('admin-bar');

			if (admin_bar_mobile) {
				window.stickyScene.offset('46px');
				window.stickyScene.update();
			}
		}
	}

	function getResponsiveResizeEvent() {
		return window.Modernizr.touchevents ? 'orientationchange' : 'resize';
	}

	function stickHeader() {
		const $header = $('.js-header-sticky');
		let admin_bar_mobile = false;

		if (!$header.length) {
			return false;
		}

		if (Modernizr.mq('(max-width: 600px)') && $('body').hasClass('admin-bar')) {
			admin_bar_mobile = true;
		}

		if (!window.stickyScene) {
			window.stickyScene = new $.ScrollMagic.Scene({
				offset: admin_bar_mobile ? '46px' : '1px',
			})
				.setPin($header, {
					pushFollowers: false
				})
				.setClassToggle($header, 'header_sticky')
				.addTo(SMController);
		}
	}

	function setOverlayMenu() {
		if ($overlay.length) {
			gsap.set($overlay, {
				autoAlpha: 1,
				y: '100%'
			});
		}

		if ($menuLinks.length) {
			gsap.set($menuLinks, {
				y: '100%'
			});
		}

		if ($submenuLinks.length) {
			gsap.set($submenuLinks, {
				y: '100%'
			});
		}

		if ($submenu.length) {
			gsap.set($submenu, {
				autoAlpha: 0,
				y: 10
			});
		}

		if ($submenuButton.length) {
			gsap.set($submenuButton, {
				autoAlpha: 0,
				y: 10
			});
		}
	}

	this.closeOverlayMenu = function () {
		const tl = gsap.timeline({
			onStart: () => {
				$overlay.addClass('in-transition');
			},
			onComplete: () => {
				$overlay.removeClass('in-transition');
				setOverlayMenu();
			}
		});

		tl.timeScale(2);

		if ($menuLinks.length) {
			tl.to($menuLinks, {
				y: '-100%',
				duration: 0.6,
				ease: 'power4.in'
			}, 'start');
		}

		if ($submenuLinks.length) {
			tl.to($submenuLinks, {
				y: '-100%',
				duration: 0.6,
				ease: 'power4.in'
			}, 'start');
		}

		tl
			.to($submenuButton, {
				y: -10,
				duration: 0.6,
				autoAlpha: 0
			})
			.to($overlay, {
				y: '-100%',
				duration: 1,
				ease: 'expo.inOut'
			});
	};

	this.openOverlayMenu = function () {
		const tl = gsap.timeline({
			onStart: () => {
				$overlay.addClass('in-transition');
			},
			onComplete: () => {
				$overlay.removeClass('in-transition');
			}
		});

		tl
			.to($overlay, {
				duration: 1,
				y: '0%',
				ease: 'expo.inOut',
			})
			.to($menuLinks, {
				duration: 0.6,
				stagger: 0.05,
				y: '0%',
				ease: 'power4.out',
			}, '-=0.3');
	};

	$overlayLinks.on('click', function () {
		const $el = $(this);

		if (checkIsAnchor($el) == true) {
			$burger.removeClass('burger_opened');
			self.closeOverlayMenu();
		}
	});
}

/*!========================================================================
	16. Is Anchor
	======================================================================!*/
function checkIsAnchor($el) {
	const link = $el.attr('href');

	if ($el.length && link.length && link !== '#' && link !== '#pll_switcher') {
		return true;
	}

	return false;
}

/*!========================================================================
	17. Menu
	======================================================================!*/
const Menu = function () {
	const $menu = $('.js-overlay-menu');

	if (!$menu.length) {
		return;
	}

	const
		$overlay = $('.header__wrapper-overlay-menu'),
		$links = $menu.find('.menu-item-has-children > a'),
		$submenus = $menu.find('.overlay-sub-menu'),
		$submenuButton = $('.js-submenu-back'),
		OPEN_CLASS = 'opened',
		tl = gsap.timeline();

	function openSubmenu($submenu, $currentMenu) {
		const
			$currentLinks = $currentMenu.find('> li > a .overlay-menu__item-wrapper'),
			$submenuLinks = $submenu.find('> li > a .overlay-menu__item-wrapper');

		tl
			.pause()
			.clear()
			.play()
			.set($submenu, {
				autoAlpha: 1,
				zIndex: 100,
				y: 0
			})
			.to($currentLinks, {
				y: '-100%',
				duration: 0.6,
				ease: 'power4.in'
			}, '-=0.3')
			.to($submenuLinks, {
				duration: 0.6,
				stagger: 0.05,
				y: '0%',
				ease: 'power4.out'
			});

		$submenus.removeClass(OPEN_CLASS);
		$submenu.not($menu).addClass(OPEN_CLASS);

		if ($submenus.hasClass(OPEN_CLASS)) {
			tl.to($submenuButton, {
				duration: 0.3,
				autoAlpha: 1,
				y: 0
			}, '-=0.6');
		} else {
			tl.to($submenuButton, {
				duration: 0.3,
				autoAlpha: 0,
				y: 10
			}, '-=0.6');
		}
	}

	function closeSubmenu($submenu, $currentMenu) {
		const
			$currentLinks = $currentMenu.find('> li > a .overlay-menu__item-wrapper'),
			$submenuLinks = $submenu.find('> li > a .overlay-menu__item-wrapper');

		tl
			.pause()
			.clear()
			.play()
			.set($submenu, {
				zIndex: -1
			})
			.to($submenuLinks, {
				y: '100%',
				duration: 0.6,
				ease: 'power4.in'
			}, '-=0.3')
			.to($currentLinks, {
				duration: 0.6,
				stagger: 0.05,
				y: '0%',
				ease: 'power4.out'
			})
			.set($submenu, {
				autoAlpha: 0,
				y: 10
			});

		$submenus.removeClass(OPEN_CLASS);
		$currentMenu.not($menu).addClass(OPEN_CLASS);

		if ($submenus.hasClass(OPEN_CLASS)) {
			tl.to($submenuButton, {
				duration: 0.3,
				autoAlpha: 1,
				y: 0
			}, '-=0.6');
		} else {
			tl.to($submenuButton, {
				duration: 0.3,
				autoAlpha: 0,
				y: 10
			}, '-=0.6');
		}
	}

	$links.on('click', function (e) {
		e.preventDefault();

		if (!$overlay.hasClass('in-transition')) {
			const
				$el = $(this),
				$currentMenu = $el.parents('ul'),
				$submenu = $el.next('.overlay-sub-menu');

			openSubmenu($submenu, $currentMenu);
		}
	});

	$submenuButton.on('click', function (e) {
		e.preventDefault();

		if (!$overlay.hasClass('in-transition')) {
			const
				$openedMenu = $submenus.filter('.' + OPEN_CLASS),
				$prevMenu = $openedMenu.parent('li').parent('ul');

			closeSubmenu($openedMenu, $prevMenu);
		}
	});
}

/*!========================================================================
	18. Parallax
	======================================================================!*/
const Parallax = function ($scope) {
	const $target = $scope.find('.jarallax');

	if (!$target.length) {
		return;
	}

	$target.jarallax();
};

/*!========================================================================
	19. Preloader
	======================================================================!*/
function Preloader() {
	const
		$pageWrapper = $('.page-wrapper'),
		$preloader = $('.preloader'),
		$curtain = $preloader.find('.preloader__curtain'),
		$logo = $preloader.find('.preloader__logo'),
		$rect = $logo.find('.rect'),
		tl = gsap.timeline();

	function finish() {
		return new Promise(function (resolve) {
			tl
				.clear()
				.to($rect, {
					drawSVG: true,
					duration: 1,
					ease: 'expo.inOut'
				})
				.to($logo, 0.3, {
					autoAlpha: 0,
				}, '-=0.3')
				.to($curtain, {
					y: '-100%',
					duration: 1,
					stagger: 0.05,
					ease: 'expo.inOut'
				}, '-=0.3')
				.set($preloader, {
					autoAlpha: 0
				})
				.add(function () {
					return resolve();
				}, '-=0.6');
		});
	}

	function drawLoading() {
		let lineColor = window.theme.colors.accentPrimary;

		if ($preloader.hasClass('preloader_accent')) {
			lineColor = '#ffffff'
		}

		tl.fromTo($rect, {
			drawSVG: 0,
			stroke: lineColor,
		}, {
			duration: 15,
			ease: {
				'_p': 0.7,
				'_p1': 0.15,
				'_p2': 0.7,
				'_p3': 0.85,
				'_calcEnd': false
			},
			drawSVG: true,
		});
	}

	return new Promise(function (resolve, reject) {
		if ($preloader.length) {
			drawLoading();
		}

		$pageWrapper.imagesLoaded().always(load());

		function load() {
			setTimeout(function () {
				$pageWrapper.removeClass('page-wrapper_hidden');
			}, 150);

			if (!$preloader.length) {
				return resolve();
			} else {
				finish().then(function () {
					return resolve();
				});
			}
		}
	});
}

/*!========================================================================
	20. Section CTA
	======================================================================!*/
const SectionCTA = function ($scope) {
	const
		$target = $scope.find('.section-cta[data-os-animation]'),
		$header = $target.find('.section-cta__header'),
		$headline = $target.find('.section-cta__headline'),
		$heading = $header.find('h2'),
		$subheading = $header.find('h4'),
		$button = $target.find('.section-cta__wrapper-button'),
		splitHeading = splitLines($heading),
		splitSubheading = splitLines($subheading),
		tl = gsap.timeline();

	prepare();
	animate();

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines(splitHeading.words);
		setLines(splitSubheading.words);

		if ($button.length) {
			gsap.set($button, {
				autoAlpha: 0,
				y: 30
			});
		}

		if ($headline.length) {
			gsap.set($headline, {
				scaleX: 0,
				transformOrigin: 'left center'
			});
		}
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		tl
			.add(animateLines(splitHeading.words))
			.add(animateLines(splitSubheading.words), '-=0.6');

		if ($button.length) {
			tl.to($button, {
				duration: 0.6,
				autoAlpha: 1,
				y: 0
			}, '-=0.6')
		}

		if ($headline.length) {
			tl.to($headline, {
				duration: 0.6,
				scaleX: 1,
				ease: 'expo.inOut'
			}, '-=0.6');
		}

		createOSScene($target, tl);
	}
}

/*!========================================================================
	21. Section Features
	======================================================================!*/
const SectionFeatures = function ($scope) {
	const
		$target = $scope.find('.section-features[data-os-animation]'),
		$heading = $('.figure-feature__header h3'),
		$text = $('.figure-feature__header p'),
		$icon = $('.figure-feature__icon'),
		splitDescr = splitLines($text),
		splitHeading = splitLines($heading),
		tl = gsap.timeline();

	prepare();
	animate();

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines(splitHeading.words);
		setLines(splitDescr.words);

		gsap.set($icon, {
			autoAlpha: 0,
			y: 30
		});
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		tl.to($icon, {
			duration: 0.6,
			stagger: 0.05,
			autoAlpha: 1,
			y: '0px',
			ease: 'power4.out'
		})
		tl.add(animateLines(splitHeading.words), '-=0.6')
		tl.add(animateLines(splitDescr.words), '-=0.6')

		createOSScene($target, tl);
	}
}

/*!========================================================================
	22. Section Fullscreen
	======================================================================!*/
const SectionFullscreen4 = function ($scope) {
	const $target = $scope.find('.section-fullscreen_4[data-os-animation]'),
		tl = gsap.timeline(),
		$headline = $target.find('.slider-fullscreen4__slide-headline'),
		$heading = $target.find('.slider-fullscreen4__slide-header h2'),
		$description = $target.find('.slider-fullscreen4__slide-header p'),
		$categories = $target.find('.slider__wrapper-categories li'),
		splitHeading = splitLines($heading),
		splitDescription = splitLines($description),
		splitCategories = splitLines($categories);

	prepare();
	animate();

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines(splitHeading.words);
		setLines(splitDescription.words);
		setLines(splitCategories.words);

		gsap.set($headline, {
			scaleX: 0,
			transformOrigin: 'center center',
		});
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		tl
			.to($headline, {
				scaleX: 1,
				duration: 0.6,
				stagger: 0.05,
				ease: 'expo.inOut'
			})
			.add(animateLines(splitCategories.words), '-=0.6')
			.add(animateLines(splitHeading.words), '-=0.6')
			.add(animateLines(splitDescription.words), '-=0.6');

		createOSScene($target, tl);
	}
}

const SectionFullscreen1 = function ($scope) {
	const
		tl = gsap.timeline(),
		$target = $scope.find('.section-fullscreen_1[data-os-animation]'),
		$bg = $target.find('.section-fullscreen__inner-bg'),
		$headline = $target.find('.slider-fullscreen__slide-headline'),
		$heading = $target.find('.slider-fullscreen__slide-header h2'),
		$description = $target.find('.slider-fullscreen__slide-header p'),
		$categories = $target.find('.slider__wrapper-categories li'),
		$button = $target.find('.slider-fullscreen__slide-wrapper-button'),
		$img = $target.find('.overflow__content'),
		$curtain = $target.find('.overflow__curtain'),
		splitHeading = splitLines($heading),
		splitDescription = splitLines($description),
		splitCategories = splitLines($categories);

	prepare();
	animate();

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines(splitHeading.words);
		setLines(splitDescription.words);
		setLines(splitCategories.words);

		gsap.set($headline, {
			scaleX: 0,
			transformOrigin: 'left center',
		});

		gsap.set($bg, {
			scaleY: 0,
			transformOrigin: 'bottom center'
		});

		gsap.set($img, {
			scale: 1.1,
			autoAlpha: 0,
		});

		gsap.set($button, {
			y: 10,
			autoAlpha: 0
		});

		gsap.set($curtain, {
			y: '100%',
		});
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		const
			activeHeading = $target.find('.swiper-slide-active .slider-fullscreen__slide-header h2 .split-word'),
			activeDescription = $target.find('.swiper-slide-active .slider-fullscreen__slide-header p .split-word'),
			activeCategories = $target.find('.swiper-slide-active .slider__wrapper-categories li .split-word');

		tl
			.to($bg, {
				scaleY: 1,
				duration: 0.6,
				stagger: 0.05,
				ease: 'expo.inOut'
			})
			.to($curtain, {
				y: '0%',
				duration: 0.3,
				ease: 'expo.inOut',
			}, '-=0.6')
			.set($img, {
				autoAlpha: 1
			})
			.to($img, {
				scale: 1,
				duration: 0.6,
				ease: 'power4.out'
			})
			.to($curtain, {
				y: '-102%',
				duration: 0.3,
				ease: 'expo.inOut',
			}, '-=0.6')
			.to($headline, {
				scaleX: 1,
				duration: 0.6,
				ease: 'expo.inOut'
			}, '-=1')
			.add(animateLines(activeHeading), '-=0.6')
			.to($button, {
				autoAlpha: 1,
				duration: 0.6,
				y: 0
			}, '-=0.6')
			.add([
				animateLines(activeDescription),
				animateLines(activeCategories)
			], '-=0.6');

		createOSScene($target, tl);
	}
}

/*!========================================================================
	23. Section Intro
	======================================================================!*/
const SectionIntro = function ($scope) {
	const
		$target = $scope.find('.section-intro[data-os-animation]'),
		$wrapper = $target.closest('.elementor-section'),
		tl = gsap.timeline(),
		$heading = $target.find('h1'),
		$subheading = $target.find('.section-intro__subheading'),
		$highlightWrapper = $heading.find('.highlight'),
		$highlight = $heading.find('.highlight__bg'),
		$button = $target.find('.section-intro__wrapper-button'),
		$headline = $target.find('.section-intro__line'),
		splitHeading = splitLines($heading),
		splitSubheading = splitLines($subheading),
		wrapperProperties = $wrapper.css([
			'background-color',
			'background-image'
		]);

	prepare();
	animate();

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines(splitHeading.words);
		setLines(splitSubheading.words);

		if (wrapperHasBackground()) {
			gsap.set($wrapper, {
				scaleY: 0,
				transformOrigin: 'bottom center'
			});
		}

		if ($highlight.length) {
			gsap.set($highlight, {
				x: '-100%',
				y: '98%'
			});
		}

		if ($button.length) {
			gsap.set($button, {
				autoAlpha: 0,
				y: 30
			});
		}
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		let $trigger = $target;

		tl
			.set($wrapper, {
				autoAlpha: 1,
			});

		if (wrapperHasBackground()) {
			tl.to($wrapper, {
				duration: 0.6,
				scaleY: 1,
				ease: 'expo.inOut'
			});
		} else {
			tl.set($wrapper, {
				scaleY: 1
			});
		}

		tl.add(animateLines(splitHeading.words, 0.6, 0.03));

		if ($button.length) {
			tl.to($button, {
				autoAlpha: 1,
				duration: 0.6,
				y: 0
			}, '-=0.3')
		}

		tl.add(animateLines(splitSubheading.words, 0.6, 0.03), '-=0.3');

		if ($highlightWrapper.length && $highlight.length) {
			tl
				.to($highlight, {
					x: '0%',
					duration: 0.6,
					stagger: 0.15,
					ease: 'expo.inOut'
				}, '-=0.6')
				.to([$highlightWrapper, $highlight], {
					duration: 0.6,
					stagger: 0.15,
					y: '0%',
					color: '#ffffff',
					ease: 'expo.inOut'
				}, '-=0.3');
		}

		if ($target.data('os-animation') == 'force') {
			$trigger = $('body');
		}

		if (wrapperHasBackground()) {
			tl.to($wrapper, {
				duration: 0.6,
				scaleY: 1,
				ease: 'expo.inOut',
			}, '0');
		}

		createOSScene($target, tl, $trigger);
	}

	function wrapperHasBackground() {
		return wrapperProperties['background-color'] !== 'rgba(0, 0, 0, 0)' && wrapperProperties['background-color'] !== 'rgb(0, 0, 0)' && wrapperProperties['background-image'] === 'none';
	}
}

/*!========================================================================
	24. Section Header
	======================================================================!*/
const SectionHeader = function ($scope) {
	const
		$target = $scope.find('.section-header[data-os-animation]'),
		$square = $target.find('.section-header__square'),
		$label = $target.find('.section-header__label span'),
		$footer = $target.find('.section-header__quote-author'),
		$heading = $target.find('h2'),
		splitHeading = splitLines($heading),
		splitLabel = splitLines($label),
		splitFooter = splitLines($footer);

	prepare();
	animate();

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines([splitHeading.words, splitLabel.words, splitFooter.words]);

		if ($square.length) {
			gsap.set($square, {
				transformOrigin: 'left center',
				scaleX: 0
			});
		}
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		const
			tl = gsap.timeline(),
			$elSquare = $target.find($square),
			elSplitHeading = $target.find(splitHeading.words),
			elSplitLabel = $target.find(splitLabel.words),
			elSplitFooter = $target.find(splitFooter.words);

		if ($elSquare.length) {
			tl
				.to($elSquare, {
					scaleX: 1,
					duration: 0.6,
					ease: 'power4.out'
				});
		}

		tl.add(animateLines(elSplitLabel), '-=1')
			.add(animateLines(elSplitHeading), '-=0.8')
			.add(animateLines(elSplitFooter), '-=0.6');

		createOSScene($target, tl);
	}
}

/*!========================================================================
	25. Section Logos
	======================================================================!*/
const SectionLogos = function () {
	const
		$target = $('.section-logos[data-os-animation] .section-logos__wrapper-items'),
		tl = gsap.timeline(),
		$logos = $target.find('.section-logos__item');

	prepare();
	animate();

	function prepare() {
		if (!$target.length) {
			return;
		}

		gsap.set($logos, {
			y: 30,
			autoAlpha: 0
		});
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		tl
			.to($logos, {
				autoAlpha: 1,
				duration: 1,
				stagger: 0.1,
				y: 0,
				ease: 'power4.out'
			});

		createOSScene($target, tl);
	}
}

/*!========================================================================
	26. Section Masthead
	======================================================================!*/
const SectionMasthead = function ($scope) {
	const
		$target = $scope.find('.section-masthead[data-os-animation]'),
		$heading = $target.find('h1'),
		$meta = $target.find('.post-meta li'),
		$headline = $target.find('.section-masthead__line'),
		splitMeta = splitLines($meta),
		splitHeading = splitLines($heading);

	prepare();
	animate();

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines(splitHeading.words);
		setLines(splitMeta.lines);

		gsap.set($headline, {
			scaleY: 0,
			transformOrigin: 'top center'
		});
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		$target.each(function () {
			const
				$el = $(this),
				elMeta = $el.find(splitMeta.lines),
				elHeading = $el.find(splitHeading.words),
				$elHeadline = $el.find($headline),
				tl = gsap.timeline();

			tl
				.add(animateLines(elHeading))
				.add(animateLines(elMeta), '-=0.3')
				.to($elHeadline, {
					duration: 0.6,
					ease: 'expo.inOut',
					scaleY: 1,
				}, '-=0.6');

			createOSScene($el, tl);
		});
	}
}

/*!========================================================================
	27. Section Steps
	======================================================================!*/
const SectionSteps = function ($scope) {
	const
		$target = $scope.find('.section-steps[data-os-animation]'),
		$heading = $target.find('.section-steps__content h2'),
		$text = $target.find('.section-steps__content p'),
		$headline = $target.find('.section-steps__headline'),
		$number = $target.find('.section-steps__number'),
		splitDescr = splitLines($text),
		splitHeading = splitLines($heading);

	prepare();
	animate();

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines(splitHeading.words);
		setLines(splitDescr.words);

		gsap.set($headline, {
			scaleX: 0,
			transformOrigin: 'left center'
		});

		gsap.set($number, {
			autoAlpha: 0,
			y: 30
		});
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		$target.each(function () {
			const
				$el = $(this),
				$elNumber = $el.find($number),
				$elHeadline = $el.find($headline),
				elDescr = $el.find(splitDescr.words),
				elHeading = $el.find(splitHeading.words),
				tl = gsap.timeline();

			tl
				.to($elNumber, {
					autoAlpha: 1,
					duration: 0.6,
					y: 0,
					ease: 'power4.out'
				})
				.add(animateLines(elHeading), '-=0.4')
				.add(animateLines(elDescr), '-=0.4')
				.to($elHeadline, {
					scale: 1,
					duration: 0.6,
					ease: 'power4.out'
				}, '-=0.8');

			createOSScene($el, tl);
		});
	}
}

/*!========================================================================
	28. Slider Fullscreen4
	======================================================================!*/
const SliderFullscreen4 = function ($scope) {
	if (!$scope.find('.js-slider-fullscreen4').length) {
		return;
	}

	createSlider();

	function createSlider() {
		const $slider = $scope.find('.js-slider-fullscreen4');

		if (!$slider.length) {
			return;
		}

		const
			lg = elementorFrontend.config.breakpoints.lg - 1 || 1024,
			md = elementorFrontend.config.breakpoints.md - 1 || 767;

		const slider = new Swiper($slider[0], {
			slidesPerView: $slider.data('slides-per-view') || 4,
			slidesPerGroup: 1, // compatibility with Swiper 5.x
			speed: $slider.data('speed') || 800,
			autoplay: {
				enabled: $slider.data('autoplay-enabled') || false,
				delay: $slider.data('autoplay-delay') || 6000,
			},
			pagination: {
				el: '.js-slider-fullscreen4-progress',
				type: 'progressbar',
				progressbarFillClass: 'slider__progressbar-fill',
				renderProgressbar: function (progressbarFillClass) {
					return '<div class="slider__progressbar"><div class="' + progressbarFillClass + '"></div></div>'
				}
			},
			navigation: {
				prevEl: '.js-slider-fullscreen4-arrow-left',
				nextEl: '.js-slider-fullscreen4-arrow-right',
			},
			mousewheel: {
				eventsTarged: '.section-fullscreen',
				sensitivity: 1
			},
			keyboard: {
				enabled: true
			},
			breakpointsInverse: true, // compatibility with both Swiper 4.x and 5.x
			lazy: {
				loadPrevNextAmount: 2,
				loadPrevNext: true,
				loadOnTransitionStart: true
			},
		});

		slider.params.breakpoints = {
			[lg]: {
				slidesPerView: $slider.data('slides-per-view') || 4,
			},
			[md]: {
				slidesPerView: $slider.data('slides-per-view-tablet') || 2
			},
			0: {
				slidesPerView: $slider.data('slides-per-view-mobile') || 1
			}
		};
		slider.update();

		renderSliderCounter(
			slider,
			$scope.find('.js-slider-fullscreen4-counter-current'),
			'',
			$scope.find('.js-slider-fullscreen4-counter-total')
		);
	}
}

/*!========================================================================
	29. Slider Portfolio Item
	======================================================================!*/
const SliderPortfolioItem = function ($scope) {
	const $slider = $scope.find('.js-slider-portfolio-item');

	createSlider();

	function createSlider() {
		if (!$slider.length) {
			return;
		}

		const
			lg = elementorFrontend.config.breakpoints.lg - 1 || 1024,
			md = elementorFrontend.config.breakpoints.md - 1 || 767;

		const
			slider = new Swiper($slider[0], {
				slidesPerView: $slider.data('slides-per-view') || 1,
				slidesPerGroup: 1, // compatibility with Swiper 5.x
				simulateTouch: false,
				autoplay: {
					enabled: $slider.data('autoplay-enabled') || false,
					delay: $slider.data('autoplay-delay') || 6000,
				},
				spaceBetween: $slider.data('space-between') || 0,
				centeredSlides: $slider.data('centered-slides') || false,
				autoHeight: true,
				speed: $slider.data('speed') || 800,
				pagination: {
					el: '.js-slider-portfolio-item-progress',
					type: 'progressbar',
					progressbarFillClass: 'slider__progressbar-fill',
					renderProgressbar: function (progressbarFillClass) {
						return '<div class="slider__progressbar"><div class="' + progressbarFillClass + '"></div></div>'
					}
				},
				navigation: {
					prevEl: '.js-slider-portfolio-item__arrow-left',
					nextEl: '.js-slider-portfolio-item__arrow-right',
				},
				watchSlidesProgress: true,
				breakpointsInverse: true, // compatibility with both Swiper 4.x and 5.x
				lazy: {
					loadPrevNextAmount: 2,
					loadPrevNext: true,
					loadOnTransitionStart: true
				}
			});

		slider.params.breakpoints = {
			[lg]: {
				slidesPerView: $slider.data('slides-per-view') || 1,
				spaceBetween: $slider.data('space-between') || 0,
				centeredSlides: $slider.data('centered-slides') || false,
			},
			[md]: {
				slidesPerView: $slider.data('slides-per-view-tablet') || 2,
				spaceBetween: $slider.data('space-between-tablet') || 0,
				centeredSlides: $slider.data('centered-slides-tablet') || 0,
			},
			0: {
				slidesPerView: $slider.data('slides-per-view-mobile') || 1,
				spaceBetween: $slider.data('space-between-mobile') || 0,
				centeredSlides: $slider.data('centered-slides-mobile') || 0,
			}
		};
		slider.update();

		renderSliderCounter(
			slider,
			$slider.find('.js-slider-portfolio-item-counter-current'),
			'',
			$slider.find('.js-slider-portfolio-item-counter-total')
		);
	}
}

/*!========================================================================
	30. Slider
	======================================================================!*/
function renderSliderCounter(sliderMain, sliderCounter, slideClass, elTotal, sliderSecondary) {
	if ($(sliderMain).length && $(sliderSecondary).length && !$(sliderCounter)) {
		sliderSecondary.controller.control = sliderMain;
		sliderMain.controller.control = sliderSecondary;
	}

	if (!$(sliderMain).length || !$(sliderCounter).length || !$(elTotal).length) {
		return;
	}

	const
		numOfSlides = sliderMain.slides.length,
		startSlides = parseInt(sliderMain.params.slidesPerView, 10);

	const counter = new Swiper(sliderCounter[0], {
		direction: 'vertical',
		simulateTouch: false,
	});

	if (numOfSlides <= startSlides) {
		counter.appendSlide('<div class="swiper-slide"><div class="' + slideClass + '">0' + numOfSlides + '</div></div>');
	} else {
		for (let index = startSlides; index <= numOfSlides; index++) {
			counter.appendSlide('<div class="swiper-slide"><div class="' + slideClass + '">0' + index + '</div></div>');
		}
	}

	$(elTotal).html('0' + numOfSlides);

	sliderMain.controller.control = counter;
	counter.controller.control = sliderMain;

	if ($(sliderSecondary).length) {
		sliderSecondary.controller.control = counter;
		counter.controller.control = sliderSecondary;
	}
}

/*!========================================================================
	31. Slider Fullscreen
	======================================================================!*/
const SliderFullscreen1 = function ($scope) {
	if (!$scope.find('.js-slider-fullscreen').length) {
		return;
	}

	createSlider();

	function createSlider() {
		const $sliderImg = $scope.find('.js-slider-fullscreen__slider-img');

		if (!$sliderImg.length) {
			return;
		}

		/**
		 * Images Slider
		 */
		const
			overlapFactor = $sliderImg.data('overlap-factor') || 0,
			sliderImg = new Swiper($sliderImg[0], {
				autoplay: {
					enabled: $sliderImg.data('autoplay-enabled') || false,
					delay: $sliderImg.data('autoplay-delay') || 6000,
					disableOnInteraction: true
				},
				allowTouchMove: false,
				direction: 'vertical',
				speed: $sliderImg.data('speed') || 800,
				pagination: {
					el: '.js-slider-fullscreen__dots',
					type: 'bullets',
					bulletElement: 'div',
					clickable: true,
					bulletClass: 'slider__dot',
					bulletActiveClass: 'slider__dot_active'
				},
				navigation: {
					prevEl: '.js-slider-fullscreen-arrow-left',
					nextEl: '.js-slider-fullscreen-arrow-right',
				},
				mousewheel: {
					eventsTarged: '.section-fullscreen',
					sensitivity: 1
				},
				keyboard: {
					enabled: true
				},
				watchSlidesProgress: true,
				on: {
					progress: function () {
						const swiper = this;

						for (let i = 0; i < swiper.slides.length; i++) {
							const
								slideProgress = swiper.slides[i].progress,
								innerOffset = swiper.width * overlapFactor,
								innerTranslate = slideProgress * innerOffset;

							try {
								gsap.set(swiper.slides[i].querySelector('img'), {
									y: innerTranslate,
									transition: swiper.params.speed + 'ms'
								});
							} catch (error) {

							}

						}
					},
					touchStart: function () {
						const swiper = this;

						for (let i = 0; i < swiper.slides.length; i++) {
							try {
								gsap.set(swiper.slides[i].querySelector('img'), {
									transition: ''
								});
							} catch (error) {

							}
						}
					},
				},
				lazy: {
					loadPrevNextAmount: 2,
					loadPrevNext: true,
					loadOnTransitionStart: true
				},
			});

		const
			tl = gsap.timeline(),
			breakpoints = {},
			fadeEffect = {},
			lg = elementorFrontend.config.breakpoints.lg - 1 || 1024;

		if (!$('.section-fullscreen_1').data('os-animation')) {
			fadeEffect.crossFade = true
		}

		/**
		 * Content Slider
		 */
		const sliderContent = new Swiper('.js-slider-fullscreen__slider-content', {
			speed: $sliderImg.data('speed') || 800,
			effect: 'fade',
			fadeEffect: fadeEffect,
			allowTouchMove: false,
			breakpoints: breakpoints,
		});

		sliderContent.on('slideChange', function () {
			const
				slider = this,
				$activeSlide = $(slider.slides[slider.activeIndex]),
				$slides = $(slider.slides),
				$heading = $slides.find('.slider-fullscreen__slide-header h2 .split-word'),
				$description = $slides.find('.slider-fullscreen__slide-header p .split-word'),
				$categories = $slides.find('.slider__wrapper-categories .split-word'),
				$button = $slides.find('.slider-fullscreen__slide-wrapper-button'),
				$activeHeading = $activeSlide.find($heading),
				$activeDescription = $activeSlide.find($description),
				$activeButton = $activeSlide.find($button);

			let duration = NaN;

			if ($sliderImg.data('speed')) {
				duration = parseFloat($sliderImg.data('speed') / 1000);
			}

			tl.clear();

			$heading.each(function () {
				tl.add(hideLines($(this), 0.4), 'start');
			});

			$description.each(function () {
				tl.add(hideLines($(this), 0.4), 'start');
			});

			$categories.each(function () {
				tl.add(hideLines($(this), 0.4), 'start');
			});

			$button.each(function () {
				tl.to($(this), {
					autoAlpha: 0,
					duration: 0.4,
					y: 10
				}, 'start');
			});

			tl
				.add(animateLines($activeHeading, 0.4))
				.add([
					animateLines($activeDescription, 0.4),
					animateLines($categories, 0.4)
				], '-=0.2')
				.to($activeButton, {
					autoAlpha: 1,
					duration: 0.4,
					y: 0
				}, '-=0.2');

			tl.totalDuration(duration);
		});

		renderSliderCounter(
			sliderImg,
			$scope.find('.js-slider-fullscreen__counter-current'),
			'',
			$scope.find('.js-slider-fullscreen__counter-total'),
			sliderContent
		);
	}
}

/*!========================================================================
	32. Slider Services
	======================================================================!*/
const SliderServices = function ($scope) {
	const
		$target = $scope.find('.slider-services[data-os-animation]'),
		tl = gsap.timeline(),
		$headline = $target.find('.figure-service__headline'),
		$heading = $target.find('.figure-service__header h3'),
		$counters = $target.find('.figure-service__number'),
		$icons = $target.find('.figure-service__icon'),
		splitHeading = splitLines($heading);

	prepare();
	animate();
	createSlider();

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines(splitHeading.words);

		if ($headline.length) {
			gsap.set($headline, {
				scaleX: 0,
				transformOrigin: 'center center',
			});
		}

		if ($counters.length) {
			gsap.set($counters, {
				y: 30,
				autoAlpha: 0
			});
		}

		if ($icons.length) {
			gsap.set($icons, {
				y: 30,
				autoAlpha: 0
			});
		}
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		tl
			.to($headline, {
				scaleX: 1,
				duration: 0.6,
				stagger: 0.05,
				ease: 'expo.inOut'
			})
			.add(animateLines(splitHeading.words), '-=0.6')
			.to($counters, {
				y: 0,
				duration: 0.6,
				stagger: 0.1,
				autoAlpha: 1
			}, '-=0.6')
			.to($icons, {
				y: 0,
				duration: 0.6,
				stagger: 0.1,
				autoAlpha: 1
			}, '-=0.9');

		createOSScene($target, tl);
	}

	function createSlider() {
		const $slider = $scope.find('.js-slider-services');

		if (!$slider.length) {
			return;
		}

		const
			lg = elementorFrontend.config.breakpoints.lg - 1 || 991,
			md = elementorFrontend.config.breakpoints.md - 1 || 767;

		const slider = new Swiper($slider[0], {
			slidesPerView: $slider.data('slides-per-view') || 4,
			slidesPerGroup: 1, // compatibility with Swiper 5.x
			speed: $slider.data('speed') || 800,
			autoplay: {
				enabled: $slider.data('autoplay-enabled') || false,
				delay: $slider.data('autoplay-delay') || 6000,
			},
			spaceBetween: $slider.data('space-between') || 0,
			centeredSlides: $slider.data('centered-slides') || false,
			pagination: {
				el: '.js-slider-services-progress',
				type: 'progressbar',
				progressbarFillClass: 'slider__progressbar-fill',
				renderProgressbar: function (progressbarFillClass) {
					return '<div class="slider__progressbar"><div class="' + progressbarFillClass + '"></div></div>'
				}
			},
			navigation: {
				prevEl: '.js-slider-services__arrow-left',
				nextEl: '.js-slider-services__arrow-right',
			},
			simulateTouch: false,
			breakpointsInverse: true // compatibility with both Swiper 4.x and 5.x
		});

		slider.params.breakpoints = {
			[lg]: {
				slidesPerView: $slider.data('slides-per-view') || 4,
				spaceBetween: $slider.data('space-between') || 0,
				centeredSlides: $slider.data('centered-slides') || false,
			},
			[md]: {
				slidesPerView: $slider.data('slides-per-view-tablet') || 2,
				spaceBetween: $slider.data('space-between-tablet') || 0,
				centeredSlides: $slider.data('centered-slides-tablet') || 0
			},
			0: {
				slidesPerView: $slider.data('slides-per-view-mobile') || 1,
				spaceBetween: $slider.data('space-between-mobile') || 0,
				centeredSlides: $slider.data('centered-slides-mobile') || 0
			}
		};
		slider.update();

		renderSliderCounter(
			slider,
			$slider.find('.js-slider-services-counter-current'),
			'',
			$slider.find('.js-slider-services-counter-total')
		);
	}
}

/*!========================================================================
	33. Split Text
	======================================================================!*/
function splitLines($el) {
	if (!($el).length) {
		return false;
	}

	return new SplitText($el, {
		type: 'words, lines',
		linesClass: 'split-line',
		wordsClass: 'split-word',
	});
};


function setLines(el) {
	const tl = gsap.timeline();

	if (!$(el).length) {
		return tl;
	}

	return tl.set(el, {
		y: '100%',
	});
}

function animateLines(el, customDuration, customStagger) {
	const tl = gsap.timeline();

	if (!$(el).length) {
		return tl;
	}

	const
		duration = customDuration ? customDuration : 0.8,
		stagger = customStagger ? customStagger : 0.01;

	return tl.to(el, {
		y: '0%',
		duration,
		stagger,
		ease: 'power4.out'
	});
}

function hideLines(el, customDuration, customStagger) {
	const tl = gsap.timeline();

	if (!$(el).length) {
		return tl;
	}

	const
		duration = customDuration ? customDuration : 0.8,
		stagger = customStagger ? customStagger : 0.01;

	return tl.to(el, {
		y: '100%',
		duration,
		stagger,
		ease: 'power4.in'
	});
}

/*!========================================================================
	34. Social
	======================================================================!*/
const Social = function () {
	const $elements = $('.social__item a');

	if (!$elements.length) {
		return;
	}

	const circle = new Circle();

	$elements.each(function () {
		circle.animate($(this));
	});
}

/*!========================================================================
	35. Slider Testimonials
	======================================================================!*/
const SliderTestimonials = function ($scope) {
	const
		$target = $scope.find('.slider-testimonials[data-os-animation]'),
		tl = gsap.timeline(),
		$text = $target.find('.slider-testimonials__text, .slider-testimonials__text > *'),
		splitTestimonial = splitLines($text);

	prepare();
	animate();
	createSlider();

	function prepare() {
		if (!$target.length) {
			return;
		}

		setLines(splitTestimonial.words);
	}

	function animate() {
		if (!$target.length) {
			return;
		}

		$text.each(function () {
			const
				$el = $(this),
				$elWords = $el.find('.split-word');

			tl.add(animateLines($elWords), 'start');
		});

		createOSScene($target, tl);
	}

	function createSlider() {
		const $slider = $scope.find('.js-slider-testimonials');

		if (!$slider.length) {
			return;
		}

		const slider = new Swiper($slider[0], {
			autoHeight: true,
			speed: $slider.data('speed') || 800,
			autoplay: {
				enabled: $slider.data('autoplay-enabled') || false,
				delay: $slider.data('autoplay-delay') || 6000,
			},
			navigation: {
				prevEl: $scope.find('.js-slider-testimonials__arrow-prev').get(0),
				nextEl: $scope.find('.js-slider-testimonials__arrow-next').get(0)
			},
			pagination: {
				el: $scope.find('.js-slider-testimonials__dots').get(0),
				type: 'bullets',
				bulletElement: 'div',
				clickable: true,
				bulletClass: 'slider__dot',
				bulletActiveClass: 'slider__dot_active'
			},
			simulateTouch: false,
			lazy: {
				loadPrevNextAmount: 1,
				loadPrevNext: true,
				loadOnTransitionStart: true
			}
		});

		renderSliderCounter(
			slider,
			$scope.find('.js-slider-testimonials-counter-current'),
			'slider-testimonials__counter-current',
			$scope.find('.js-slider-testimonials-counter-total')
		);
	}
}

/*!========================================================================
	36. Debounce
	======================================================================!*/
function debounce(func, wait, immediate) {
	let timeout;

	return function () {
		const
			context = this,
			args = arguments;

		const later = function () {
			timeout = null;

			if (!immediate) {
				func.apply(context, args)
			};
		};

		const callNow = immediate && !timeout;

		clearTimeout(timeout);

		timeout = setTimeout(later, wait);

		if (callNow) {
			func.apply(context, args)
		}
	}
}

/*!========================================================================
	37. Fix Mobile Bar Height
	======================================================================!*/
function fixMobileBarHeight() {
	let vh;

	/**
	 * Initial set
	 */
	createStyleElement();
	setVh();

	/**
	 * Resize handling (with debounce)
	 */
	$(window).on('resize', debounce(function () {
		setVh();
	}, 250));

	/**
	 * 100vh elements height correction
	 */
	function setVh() {
		vh = window.innerHeight * 0.01;

		$('#arrigo-fix-bar').html(':root { --fix-bar-vh: ' + vh + 'px; }');
	}

	function createStyleElement() {
		if (!$('#arrigo-fix-bar').length) {
			$('head').append('<style id=\"arrigo-fix-bar\"></style>');
		}
	}
}

/*!========================================================================
	38. Get Admin Bar Height
	======================================================================!*/
function getAdminBarHeight() {
	const adminBar = document.getElementById('wpadminbar');

	if (adminBar) {
		/**
		 * Resize handling (with debounce)
		 */
		$(window).on('resize', debounce(() => {
			update();
		}, 250));

		update();

		function update() {
			let offsetDistance = '0px';

			if (window.getComputedStyle(adminBar)['position'] === 'fixed') {
				offsetDistance = getComputedStyle(document.documentElement).marginTop;
			}

			document.documentElement.style.setProperty('--admin-bar-offset', `${offsetDistance}`);
		}
	}
}

/*!========================================================================
	39. Load Swiper
	======================================================================!*/
function loadSwiper() {
	return new Promise((resolve) => {
		if (typeof Swiper === 'undefined' && typeof elementorFrontend.utils.swiper !== 'undefined') {
			elementorFrontend.utils.assetsLoader.load('script', 'swiper').then(() => resolve(true));
		} else {
			resolve(true);
		}
	});
}

/*!========================================================================
	40. Run On High Performance GPU
	======================================================================!*/
function runOnHighPerformanceGPU() {
	const webGLCanvas = document.getElementById('js-webgl');

	if (!window.Modernizr.touchevents && webGLCanvas) {
		webGLCanvas.getContext('webgl', {
			powerPreference: 'high-performance'
		});
	}
}


})(jQuery);
