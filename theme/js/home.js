( function() {
	'use strict';

	var glow = document.getElementById( 'okp-mouse-glow' );

	if ( glow ) {
		var coarse = window.matchMedia && window.matchMedia( '(pointer: coarse)' ).matches;
		var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

		if ( ! coarse && ! reduceMotion ) {
			window.addEventListener(
				'mousemove',
				function( event ) {
					glow.style.left = event.clientX + 'px';
					glow.style.top = event.clientY + 'px';
				},
				{ passive: true }
			);
		} else {
			glow.style.display = 'none';
		}
	}

	function initSlider( sliderRoot, config ) {
		var sliderSection = sliderRoot.closest( '.okp-home__shell' );
		var viewport = sliderRoot.querySelector( config.viewportSelector );
		var track = sliderRoot.querySelector( config.trackSelector );
		var prevBtn = sliderSection ? sliderSection.querySelector( config.prevSelector ) : null;
		var nextBtn = sliderSection ? sliderSection.querySelector( config.nextSelector ) : null;

		if ( ! viewport || ! track || ! prevBtn || ! nextBtn ) {
			return;
		}

		function getGap() {
			var styles = window.getComputedStyle( track );
			var gap = parseFloat( styles.columnGap || styles.gap || '0' );

			return Number.isNaN( gap ) ? 0 : gap;
		}

		function getScrollAmount() {
			var card = track.querySelector( config.cardSelector );

			if ( ! card ) {
				return viewport.clientWidth;
			}

			return card.getBoundingClientRect().width + getGap();
		}

		function updateNavState() {
			var maxScroll = viewport.scrollWidth - viewport.clientWidth;
			var canScroll = maxScroll > 2;

			prevBtn.disabled = ! canScroll || viewport.scrollLeft <= 2;
			nextBtn.disabled = ! canScroll || viewport.scrollLeft >= maxScroll - 2;
		}

		function scrollByCard( direction ) {
			var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

			viewport.scrollBy(
				{
					left: direction * getScrollAmount(),
					behavior: reduceMotion ? 'auto' : 'smooth',
				}
			);
		}

		prevBtn.addEventListener( 'click', function() {
			scrollByCard( -1 );
		} );

		nextBtn.addEventListener( 'click', function() {
			scrollByCard( 1 );
		} );

		viewport.addEventListener( 'keydown', function( event ) {
			if ( event.key === 'ArrowLeft' ) {
				event.preventDefault();
				scrollByCard( -1 );
			}

			if ( event.key === 'ArrowRight' ) {
				event.preventDefault();
				scrollByCard( 1 );
			}
		} );

		viewport.addEventListener( 'scroll', updateNavState, { passive: true } );
		window.addEventListener( 'resize', updateNavState, { passive: true } );

		updateNavState();
	}

	function initServicesSwitcher( switcherRoot ) {
		var panels = switcherRoot.querySelectorAll( '[data-okp-service-panel]' );
		var tabs = switcherRoot.querySelectorAll( '[data-okp-service-tab]' );

		if ( ! panels.length || ! tabs.length ) {
			return;
		}

		function setActiveService( targetIndex, shouldFocus ) {
			var activeTab = null;
			var indexString = String( targetIndex );

			for ( var panelIndex = 0; panelIndex < panels.length; panelIndex++ ) {
				var isActivePanel = panels[ panelIndex ].getAttribute( 'data-okp-service-panel' ) === indexString;

				panels[ panelIndex ].classList.toggle( 'is-active', isActivePanel );
				panels[ panelIndex ].setAttribute( 'aria-hidden', isActivePanel ? 'false' : 'true' );
			}

			for ( var tabIndex = 0; tabIndex < tabs.length; tabIndex++ ) {
				var isActive = tabs[ tabIndex ].getAttribute( 'data-okp-service-tab' ) === indexString;

				tabs[ tabIndex ].classList.toggle( 'is-active', isActive );
				tabs[ tabIndex ].setAttribute( 'aria-selected', isActive ? 'true' : 'false' );
				tabs[ tabIndex ].setAttribute( 'tabindex', isActive ? '0' : '-1' );

				if ( isActive ) {
					activeTab = tabs[ tabIndex ];
				}
			}

			switcherRoot.setAttribute( 'data-active-service', indexString );

			if ( shouldFocus && activeTab ) {
				activeTab.focus();
			}
		}

		function moveActiveService( event, direction ) {
			var currentIndex = Array.prototype.indexOf.call( tabs, event.currentTarget );
			var nextIndex = currentIndex + direction;

			if ( nextIndex < 0 ) {
				nextIndex = tabs.length - 1;
			}

			if ( nextIndex >= tabs.length ) {
				nextIndex = 0;
			}

			event.preventDefault();
			setActiveService( tabs[ nextIndex ].getAttribute( 'data-okp-service-tab' ), true );
		}

		for ( var serviceIndex = 0; serviceIndex < tabs.length; serviceIndex++ ) {
			tabs[ serviceIndex ].addEventListener( 'click', function( event ) {
				setActiveService( event.currentTarget.getAttribute( 'data-okp-service-tab' ), false );
			} );

			tabs[ serviceIndex ].addEventListener( 'keydown', function( event ) {
				if ( event.key === 'ArrowRight' || event.key === 'ArrowDown' ) {
					moveActiveService( event, 1 );
				}

				if ( event.key === 'ArrowLeft' || event.key === 'ArrowUp' ) {
					moveActiveService( event, -1 );
				}

				if ( event.key === 'Home' ) {
					event.preventDefault();
					setActiveService( tabs[ 0 ].getAttribute( 'data-okp-service-tab' ), true );
				}

				if ( event.key === 'End' ) {
					event.preventDefault();
					setActiveService( tabs[ tabs.length - 1 ].getAttribute( 'data-okp-service-tab' ), true );
				}
			} );
		}

		setActiveService( tabs[ 0 ].getAttribute( 'data-okp-service-tab' ), false );
	}

	var serviceSwitchers = document.querySelectorAll( '[data-okp-services-switcher]' );
	for ( var serviceSwitcherIndex = 0; serviceSwitcherIndex < serviceSwitchers.length; serviceSwitcherIndex++ ) {
		initServicesSwitcher( serviceSwitchers[ serviceSwitcherIndex ] );
	}

	var productSliderRoots = document.querySelectorAll( '[data-okp-products-slider]' );
	for ( var i = 0; i < productSliderRoots.length; i++ ) {
		initSlider(
			productSliderRoots[ i ],
			{
				viewportSelector: '.okp-products-slider__viewport',
				trackSelector: '.okp-products-slider__track',
				prevSelector: '.okp-products-slider__nav--prev',
				nextSelector: '.okp-products-slider__nav--next',
				cardSelector: '.okp-product-card',
			}
		);
	}

	var aboutSliderRoots = document.querySelectorAll( '[data-okp-about-slider]' );
	for ( var j = 0; j < aboutSliderRoots.length; j++ ) {
		initSlider(
			aboutSliderRoots[ j ],
			{
				viewportSelector: '.okp-about-slider__viewport',
				trackSelector: '.okp-about-slider__track',
				prevSelector: '.okp-about-slider__nav--prev',
				nextSelector: '.okp-about-slider__nav--next',
				cardSelector: '.okp-about-card-mobile',
			}
		);
	}
}() );
