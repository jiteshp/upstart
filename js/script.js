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