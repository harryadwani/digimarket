/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color without header media background.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a:not( .absolute-header .site-title a ), .site-description:not( .absolute-header .site-description )' ).css( {
					'color': to
				} );
			}
		} );
	} );

	var style = $( '#my-music-band-color-scheme-css' ),
		api = wp.customize;

	if ( ! style.length ) {
		style = $( 'head' ).append( '<style type="text/css" id="my-music-band-color-scheme-css" />' )
		                    .find( '#my-music-band-color-scheme-css' );
	}

	// Color Scheme CSS.
	api.bind( 'preview-ready', function() {
		api.preview.bind( 'update-color-scheme-css', function( css ) {
			style.html( css );
		} );
	} );
} )( jQuery );
