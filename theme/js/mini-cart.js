( function( $, window, document ) {
	const drawer = document.getElementById( 'okp-mini-cart' );

	if ( ! drawer ) {
		return;
	}

	const body = document.body;
	const panel = drawer.querySelector( '.okp-mini-cart__drawer' );
	const config = window.okpMiniCart || null;
	let lastTrigger = null;
	let quantityRequest = null;

	const getTriggers = function() {
		return document.querySelectorAll( 'a.cart-contents[data-open-mini-cart]' );
	};

	const syncTriggerState = function( open ) {
		getTriggers().forEach( function( trigger ) {
			trigger.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		} );

		drawer.setAttribute( 'aria-hidden', open ? 'false' : 'true' );
	};

	const openDrawer = function( trigger ) {
		if ( trigger ) {
			lastTrigger = trigger;
		}

		drawer.classList.add( 'is-open' );
		body.classList.add( 'okp-mini-cart-open' );
		syncTriggerState( true );

		window.requestAnimationFrame( function() {
			const closeButton = drawer.querySelector( '.okp-mini-cart__close' );

			if ( closeButton ) {
				closeButton.focus();
			} else if ( panel ) {
				panel.focus();
			}
		} );
	};

	const closeDrawer = function() {
		drawer.classList.remove( 'is-open' );
		body.classList.remove( 'okp-mini-cart-open' );
		syncTriggerState( false );

		if ( lastTrigger && typeof lastTrigger.focus === 'function' ) {
			lastTrigger.focus();
		}
	};

	const applyFragments = function( fragments ) {
		if ( ! fragments ) {
			return;
		}

		Object.keys( fragments ).forEach( function( selector ) {
			const html = fragments[ selector ];

			document.querySelectorAll( selector ).forEach( function( element ) {
				element.outerHTML = html;
			} );
		} );

		syncTriggerState( drawer.classList.contains( 'is-open' ) );
	};

	const setQuantityLoadingState = function( cartItemKey, loading ) {
		drawer.querySelectorAll( '[data-cart-item-key="' + cartItemKey + '"]' ).forEach( function( control ) {
			if ( loading ) {
				if ( control.disabled ) {
					control.setAttribute( 'data-was-disabled', 'true' );
				}

				control.disabled = true;
			} else if ( control.hasAttribute( 'data-was-disabled' ) ) {
				control.disabled = true;
				control.removeAttribute( 'data-was-disabled' );
			} else {
				control.disabled = false;
			}
		} );

		const item = drawer.querySelector( '.okp-mini-cart-item__qty-button[data-cart-item-key="' + cartItemKey + '"]' );

		if ( item ) {
			const card = item.closest( '.okp-mini-cart-item' );

			if ( card ) {
				card.classList.toggle( 'is-updating', loading );
			}
		}
	};

	const updateQuantity = function( cartItemKey, quantity ) {
		if ( ! $ || ! config || ! config.ajaxUrl ) {
			return;
		}

		if ( quantityRequest && typeof quantityRequest.abort === 'function' ) {
			quantityRequest.abort();
		}

		setQuantityLoadingState( cartItemKey, true );

		quantityRequest = $.ajax( {
			url: config.ajaxUrl,
			method: 'POST',
			dataType: 'json',
			data: {
				action: 'okperformance_mini_cart_update_qty',
				nonce: config.nonce,
				cart_item_key: cartItemKey,
				quantity: quantity
			}
		} ).done( function( response ) {
			if ( response && response.success && response.data && response.data.fragments ) {
				applyFragments( response.data.fragments );

				if ( $ && $.fn && $.fn.trigger ) {
					$( document.body ).trigger( 'wc_fragments_refreshed' );
				}
			}
		} ).always( function() {
			setQuantityLoadingState( cartItemKey, false );
			quantityRequest = null;
		} );
	};

	document.addEventListener( 'click', function( event ) {
		const trigger = event.target.closest( 'a.cart-contents[data-open-mini-cart]' );

		if ( trigger ) {
			if ( event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || 0 !== event.button ) {
				return;
			}

			event.preventDefault();
			openDrawer( trigger );
			return;
		}

		if ( event.target.closest( '[data-close-mini-cart]' ) ) {
			event.preventDefault();
			closeDrawer();
			return;
		}

		const quantityButton = event.target.closest( '[data-mini-cart-qty-change]' );

		if ( quantityButton ) {
			event.preventDefault();

			if ( quantityButton.disabled ) {
				return;
			}

			const cartItemKey = quantityButton.getAttribute( 'data-cart-item-key' );
			const currentQty = parseInt( quantityButton.getAttribute( 'data-current-qty' ), 10 );
			const delta = parseInt( quantityButton.getAttribute( 'data-mini-cart-qty-change' ), 10 );

			if ( ! cartItemKey || Number.isNaN( currentQty ) || Number.isNaN( delta ) ) {
				return;
			}

			updateQuantity( cartItemKey, Math.max( 0, currentQty + delta ) );
		}
	} );

	document.addEventListener( 'keydown', function( event ) {
		if ( 'Escape' === event.key && drawer.classList.contains( 'is-open' ) ) {
			closeDrawer();
		}
	} );

	if ( $ && $.fn && $.fn.on ) {
		$( document.body ).on( 'added_to_cart', function( event, fragments, cartHash, button ) {
			const trigger = button && button.length ? button.get( 0 ) : document.querySelector( 'a.cart-contents[data-open-mini-cart]' );

			openDrawer( trigger || null );
		} );

		$( document.body ).on( 'removed_from_cart wc_fragments_refreshed', function() {
			syncTriggerState( drawer.classList.contains( 'is-open' ) );
		} );
	}
}( window.jQuery, window, document ) );
