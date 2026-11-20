/* JAU Core · selector de logo en el formulario de la marca. */
jQuery( function ( $ ) {
	var marco;
	$( '#jau-logo-elegir' ).on( 'click', function ( e ) {
		e.preventDefault();
		if ( ! marco ) {
			marco = wp.media( { title: 'Logo de la marca', button: { text: 'Usar este logo' }, library: { type: 'image' }, multiple: false } );
			marco.on( 'select', function () {
				var a = marco.state().get( 'selection' ).first().toJSON();
				var url = ( a.sizes && a.sizes.medium ) ? a.sizes.medium.url : a.url;
				$( '#jau-logo-id' ).val( a.id );
				$( '#jau-logo-preview' ).html( '<img src="' + url + '" alt="" style="max-height:80px;width:auto">' );
			} );
		}
		marco.open();
	} );
	$( '#jau-logo-quitar' ).on( 'click', function ( e ) {
		e.preventDefault();
		$( '#jau-logo-id' ).val( '' );
		$( '#jau-logo-preview' ).empty();
	} );
} );
