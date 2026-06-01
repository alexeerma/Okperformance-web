( function() {
	const selector = '[data-okp-quantity-change]';

	const numberFromAttribute = function( input, attributeName, fallback ) {
		const value = input.getAttribute( attributeName );

		if ( value === null || value === '' || value === 'any' ) {
			return fallback;
		}

		const parsedValue = parseFloat( value );

		return Number.isNaN( parsedValue ) ? fallback : parsedValue;
	};

	const decimalPlaces = function( value ) {
		const textValue = String( value );

		if ( textValue.indexOf( '.' ) === -1 ) {
			return 0;
		}

		return textValue.split( '.' )[ 1 ].length;
	};

	const normalizeValue = function( value, step ) {
		const decimals = Math.max( decimalPlaces( value ), decimalPlaces( step ) );

		if ( decimals === 0 ) {
			return String( Math.round( value ) );
		}

		return value.toFixed( decimals ).replace( /\.?0+$/, '' );
	};

	const updateButtonStates = function( quantity ) {
		const input = quantity.querySelector( 'input.qty' );

		if ( ! input ) {
			return;
		}

		const value = parseFloat( input.value );
		const min = numberFromAttribute( input, 'min', 0 );
		const max = numberFromAttribute( input, 'max', null );
		const minusButton = quantity.querySelector( '[data-okp-quantity-change="-1"]' );
		const plusButton = quantity.querySelector( '[data-okp-quantity-change="1"]' );

		if ( minusButton ) {
			minusButton.disabled = input.disabled || input.readOnly || ( ! Number.isNaN( value ) && value <= min );
		}

		if ( plusButton ) {
			plusButton.disabled = input.disabled || input.readOnly || ( max !== null && ! Number.isNaN( value ) && value >= max );
		}
	};

	const updateAllButtonStates = function() {
		document.querySelectorAll( '.quantity' ).forEach( updateButtonStates );
	};

	document.addEventListener( 'click', function( event ) {
		const button = event.target.closest( selector );

		if ( ! button || button.disabled ) {
			return;
		}

		const quantity = button.closest( '.quantity' );
		const input = quantity ? quantity.querySelector( 'input.qty' ) : null;

		if ( ! input || input.disabled || input.readOnly ) {
			return;
		}

		const delta = parseFloat( button.getAttribute( 'data-okp-quantity-change' ) );
		const step = numberFromAttribute( input, 'step', 1 );
		const min = numberFromAttribute( input, 'min', 0 );
		const max = numberFromAttribute( input, 'max', null );
		const currentValue = parseFloat( input.value );
		let nextValue = ( Number.isNaN( currentValue ) ? min : currentValue ) + ( delta * step );

		nextValue = Math.max( nextValue, min );

		if ( max !== null ) {
			nextValue = Math.min( nextValue, max );
		}

		input.value = normalizeValue( nextValue, step );
		input.dispatchEvent( new Event( 'change', { bubbles: true } ) );
		updateButtonStates( quantity );
	} );

	document.addEventListener( 'input', function( event ) {
		const quantity = event.target.closest( '.quantity' );

		if ( quantity ) {
			updateButtonStates( quantity );
		}
	} );

	document.addEventListener( 'change', function( event ) {
		const quantity = event.target.closest( '.quantity' );

		if ( quantity ) {
			updateButtonStates( quantity );
		}
	} );

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', updateAllButtonStates );
	} else {
		updateAllButtonStates();
	}
}() );
