/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	const siteNavigation = document.getElementById( 'site-navigation' );
	const masthead = document.getElementById( 'masthead' );

	if ( masthead ) {
		let ticking = false;
		const syncHeaderState = function() {
			masthead.classList.toggle( 'is-scrolled', window.scrollY > 18 );
			ticking = false;
		};

		syncHeaderState();

		window.addEventListener(
			'scroll',
			function() {
				if ( ticking ) {
					return;
				}

				ticking = true;
				window.requestAnimationFrame( syncHeaderState );
			},
			{ passive: true }
		);
	}

	// Return early if the navigation doesn't exist.
	if ( ! siteNavigation ) {
		return;
	}

	const button = siteNavigation.querySelector( '.menu-toggle' );

	// Return early if the button doesn't exist.
	if ( ! button ) {
		return;
	}

	const menuPanel = siteNavigation.querySelector( '.main-navigation__panel' );

	// Hide menu toggle button if menu is empty and return early.
	if ( ! menuPanel ) {
		button.style.display = 'none';
		return;
	}

	const menus = menuPanel.querySelectorAll( 'ul' );
	const body = document.body;
	const openLabel = button.getAttribute( 'aria-label' ) || 'Open menu';
	const closeLabel = 'Close menu';

	const setMenuState = function( open ) {
		siteNavigation.classList.toggle( 'toggled', open );
		body.classList.toggle( 'okp-menu-open', open );
		button.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		button.setAttribute( 'aria-label', open ? closeLabel : openLabel );
	};

	button.addEventListener( 'click', function( event ) {
		event.stopPropagation();
		setMenuState( ! siteNavigation.classList.contains( 'toggled' ) );
	} );

	const closeButtons = menuPanel.querySelectorAll( '.menu-close' );
	closeButtons.forEach( function( closeBtn ) {
		closeBtn.addEventListener( 'click', function( event ) {
			event.stopPropagation();
			setMenuState( false );
			button.focus();
		} );
	} );

	// Close with ESC.
	document.addEventListener( 'keydown', function( event ) {
		if ( event.key === 'Escape' && siteNavigation.classList.contains( 'toggled' ) ) {
			setMenuState( false );
			button.focus();
		}
	} );

	// Close when a menu link is clicked.
	menuPanel.addEventListener( 'click', function( event ) {
		if ( event.target.closest( 'a' ) ) {
			setMenuState( false );
		}
	} );

	// Close when clicking outside the nav (desktop legacy behavior).
	document.addEventListener( 'click', function( event ) {
		if ( ! siteNavigation.classList.contains( 'toggled' ) ) {
			return;
		}

		if ( ! siteNavigation.contains( event.target ) ) {
			setMenuState( false );
		}
	} );

	// Reset the menu if the viewport grows back to desktop.
	const desktopQuery = window.matchMedia( '(min-width: 1101px)' );
	const handleViewportChange = function( event ) {
		if ( event.matches ) {
			setMenuState( false );
		}
	};

	if ( typeof desktopQuery.addEventListener === 'function' ) {
		desktopQuery.addEventListener( 'change', handleViewportChange );
	} else if ( typeof desktopQuery.addListener === 'function' ) {
		desktopQuery.addListener( handleViewportChange );
	}

	// Get all the link elements within the navigation panel.
	const links = menuPanel.getElementsByTagName( 'a' );

	// Get all the link elements with children within the menu.
	const linksWithChildren = menuPanel.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

	for ( const menu of menus ) {
		if ( ! menu.classList.contains( 'nav-menu' ) ) {
			menu.classList.add( 'nav-menu' );
		}
	}

	// Toggle focus each time a menu link is focused or blurred.
	for ( const link of links ) {
		link.addEventListener( 'focus', toggleFocus, true );
		link.addEventListener( 'blur', toggleFocus, true );
	}

	// Toggle focus each time a menu link with children receive a touch event.
	for ( const link of linksWithChildren ) {
		link.addEventListener( 'touchstart', toggleFocus, false );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus( event ) {
		if ( event.type === 'focus' || event.type === 'blur' ) {
			let self = this;
			// Move up through the ancestors of the current link until we hit .nav-menu.
			while ( self && ! self.classList.contains( 'nav-menu' ) ) {
				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					self.classList.toggle( 'focus' );
				}
				self = self.parentNode;
			}
		}

		if ( event.type === 'touchstart' ) {
			const menuItem = this.parentNode;
			event.preventDefault();
			for ( const link of menuItem.parentNode.children ) {
				if ( menuItem !== link ) {
					link.classList.remove( 'focus' );
				}
			}
			menuItem.classList.toggle( 'focus' );
		}
	}
}() );
