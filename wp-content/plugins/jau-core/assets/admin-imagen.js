/* JAU Core · selector de imagen de la biblioteca (logo de marca, foto por presentación). */
jQuery( function ( $ ) {
	$( document ).on( 'click', '.jau-imagen-elegir', function ( e ) {
		e.preventDefault();
		var campo = $( this ).closest( '.jau-imagen-campo' );
		var marco = wp.media( { title: 'Elegir imagen', button: { text: 'Usar esta imagen' }, library: { type: 'image' }, multiple: false } );
		marco.on( 'select', function () {
			var a = marco.state().get( 'selection' ).first().toJSON();
			var url = ( a.sizes && a.sizes.thumbnail ) ? a.sizes.thumbnail.url : a.url;
			campo.find( 'input[type=hidden]' ).val( a.id );
			campo.find( '.jau-imagen-vista' ).html( '<img src="' + url + '" alt="" style="max-height:80px;width:auto">' );
		} );
		marco.open();
	} );
	$( document ).on( 'click', '.jau-imagen-quitar', function ( e ) {
		e.preventDefault();
		var campo = $( this ).closest( '.jau-imagen-campo' );
		campo.find( 'input[type=hidden]' ).val( '' );
		campo.find( '.jau-imagen-vista' ).empty();
	} );
} );
