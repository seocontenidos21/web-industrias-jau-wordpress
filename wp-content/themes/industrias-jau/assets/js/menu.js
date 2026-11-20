/* Industrias JAU · menú móvil del header (panel bajo el header, por debajo de 1180 px). */
( function () {
	var header = document.querySelector( '.jau-header' );
	var boton = header && header.querySelector( '.jau-menu-toggle' );
	if ( ! boton ) {
		return;
	}
	var fondo = null;

	function abrir() {
		header.classList.add( 'is-menu-open' );
		boton.setAttribute( 'aria-expanded', 'true' );
		boton.setAttribute( 'aria-label', 'Cerrar menú' );
		fondo = document.createElement( 'div' );
		fondo.className = 'jau-menu-backdrop';
		fondo.addEventListener( 'click', cerrar );
		document.body.appendChild( fondo );
		var primero = header.querySelector( '.jau-nav a' );
		if ( primero ) {
			primero.focus();
		}
	}

	function cerrar() {
		header.classList.remove( 'is-menu-open' );
		boton.setAttribute( 'aria-expanded', 'false' );
		boton.setAttribute( 'aria-label', 'Abrir menú' );
		if ( fondo ) {
			fondo.remove();
			fondo = null;
		}
	}

	boton.addEventListener( 'click', function () {
		if ( header.classList.contains( 'is-menu-open' ) ) {
			cerrar();
		} else {
			abrir();
		}
	} );

	document.addEventListener( 'keydown', function ( e ) {
		if ( e.key === 'Escape' && header.classList.contains( 'is-menu-open' ) ) {
			cerrar();
			boton.focus();
		}
	} );

	header.addEventListener( 'click', function ( e ) {
		if ( e.target.closest( '.jau-nav a' ) ) {
			cerrar();
		}
	} );

	window.matchMedia( '(min-width: 1180px)' ).addEventListener( 'change', function ( mq ) {
		if ( mq.matches ) {
			cerrar();
		}
	} );
} )();
