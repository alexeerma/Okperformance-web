( function( $, window ) {
	if ( ! $ || ! window.wp || ! window.wp.media ) {
		return;
	}

	const config = window.okpPageOptionsMedia || {};

	$( document ).on( 'click', '[data-okp-media-open]', function( event ) {
		event.preventDefault();

		const $button = $( this );
		const $field = $button.closest( '[data-okp-media-field]' );
		const $input = $field.find( '[data-okp-media-input]' );
		const $preview = $field.find( '[data-okp-media-preview]' );
		const $remove = $field.find( '[data-okp-media-remove]' );

		const frame = window.wp.media( {
			title: config.title || 'Choose image',
			button: {
				text: config.button || 'Use this image'
			},
			library: {
				type: 'image'
			},
			multiple: false
		} );

		frame.on( 'select', function() {
			const attachment = frame.state().get( 'selection' ).first().toJSON();

			if ( ! attachment || ! attachment.id ) {
				return;
			}

			const imageUrl = attachment.sizes && attachment.sizes.medium_large
				? attachment.sizes.medium_large.url
				: attachment.url;

			$input.val( attachment.id );
			$preview.html(
				'<img src="' + imageUrl + '" alt="" style="display:block;max-width:min(100%,420px);height:auto;border-radius:16px;border:1px solid #dcdcde;background:#111827;" />'
			).prop( 'hidden', false );
			$remove.prop( 'hidden', false );
			$button.text( config.replaceLabel || 'Replace image' );
		} );

		frame.open();
	} );

	$( document ).on( 'click', '[data-okp-media-remove]', function( event ) {
		event.preventDefault();

		const $button = $( this );
		const $field = $button.closest( '[data-okp-media-field]' );
		const $input = $field.find( '[data-okp-media-input]' );
		const $preview = $field.find( '[data-okp-media-preview]' );
		const $open = $field.find( '[data-okp-media-open]' );

		$input.val( '' );
		$preview.empty().prop( 'hidden', true );
		$button.prop( 'hidden', true );
		$open.text( $open.data( 'defaultLabel' ) || config.title || 'Choose image' );
	} );

	$( function() {
		$( '[data-okp-media-open]' ).each( function() {
			const $button = $( this );

			if ( ! $button.data( 'defaultLabel' ) ) {
				$button.data( 'defaultLabel', $button.text() );
			}
		} );
	} );
}( window.jQuery, window ) );
