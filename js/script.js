(function ($) {
	
	$(document).ready( function() {
		// fitvids
		$( '.entry-content' ).fitVids(  
			{ customSelector: "iframe[src^='www.slideshare.net']" }
		);
		
		// match height
		$( '.match-height, .gallery-item' ).matchHeight();
		
		// primary navigation toggle
		$( '#nav-toggle' ).click( function( e ) {
			$( '#primary-nav .menu' ).slideToggle();
			e.preventDefault();
		} );
		
		// window resize
		$( window ).resize( function() {
			$( '#primary-nav .sub-menu' ).hide();
			
			if( $( window ).width() >= 960 ) {
				$( '#primary-nav .menu' ).show();
				$( '#nav-toggle' ).hide();
			}
			else {
				if( ! $( '#primary-nav .menu').is(':visible' ) ) {
					$( '#primary-nav .menu' ).hide();
					$( '#nav-toggle' ).show();
				}
			}
		} );
		
		// sub menu toggle
		$( '#primary-nav .menu-item-has-children > a' ).click( function( e ) {
			$( this ).next( '.sub-menu' ).slideToggle();
			e.preventDefault();
		} );
		
		// madmimi form
		$( '.mimi-form input[name*=email]' ).each( function() {
			$(this).attr( 'placeholder', 'Enter your email' );
		} );
		
		// scrollto
		$( 'a[href^="#"]' ).click( function( e ) {
			e.preventDefault();
			$( window ).stop( true ).scrollTo( this.hash, { duration:1000, interrupt:true } );
		} );
	} );
	
}(jQuery));