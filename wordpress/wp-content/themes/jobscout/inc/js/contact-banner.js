( function( $ ) {
	'use strict';

	function setupMediaFrame( field ) {
		let frame;

		field.on( 'click', '.jobscout-contact-banner-upload', function( event ) {
			event.preventDefault();

			if ( frame ) {
				frame.open();
				return;
			}

			frame = wp.media( {
				title: field.data( 'title' ),
				button: {
					text: field.data( 'button' )
				},
				multiple: false
			} );

			frame.on( 'select', function() {
				const attachment = frame.state().get( 'selection' ).first().toJSON();
				field.find( '#jobscout_contact_banner_image' ).val( attachment.id );
				field.find( '.jobscout-contact-banner-preview' )
					.removeClass( 'jobscout-hidden' )
					.html( '<img src="' + attachment.url + '" alt="">' );
				field.find( '.jobscout-contact-banner-remove' ).removeClass( 'jobscout-hidden' );
			} );

			frame.open();
		} );

		field.on( 'click', '.jobscout-contact-banner-remove', function( event ) {
			event.preventDefault();

			field.find( '#jobscout_contact_banner_image' ).val( '' );
			field.find( '.jobscout-contact-banner-preview' )
				.addClass( 'jobscout-hidden' )
				.empty();
			$( this ).addClass( 'jobscout-hidden' );
		} );
	}

	$( function() {
		const bannerField = $( '.jobscout-contact-banner-image-field' );

		if ( ! bannerField.length || ! wp || ! wp.media ) {
			return;
		}

		setupMediaFrame( bannerField );
	} );
}( jQuery ) );

