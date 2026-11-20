/* Industrias JAU · en móvil, las filas de fotos (Sobre nosotros y «Momentos» de cada producto)
   muestran 2 fotos a la vez y rotan a las siguientes con un fundido. En escritorio se ven todas. */
( function () {
	var POR_VEZ = 2;
	var INTERVALO = 4500;
	var movil = window.matchMedia( '(max-width: 781px)' );
	var reducido = window.matchMedia( '(prefers-reduced-motion: reduce)' );

	document.querySelectorAll( '.jau-fotos' ).forEach( function ( caja ) {
		var fotos = Array.prototype.slice.call( caja.children ).filter( function ( n ) {
			return n.tagName === 'FIGURE';
		} );
		if ( fotos.length <= POR_VEZ ) {
			return;
		}
		var pagina = 0;
		var paginas = Math.ceil( fotos.length / POR_VEZ );
		var timer = null;
		var detenido = false;

		function mostrar() {
			fotos.forEach( function ( f, i ) {
				f.classList.toggle( 'is-visible', Math.floor( i / POR_VEZ ) === pagina );
			} );
		}

		function programar() {
			clearInterval( timer );
			timer = null;
			if ( ! caja.classList.contains( 'is-rotando' ) || detenido || reducido.matches || document.hidden ) {
				return;
			}
			timer = setInterval( function () {
				pagina = ( pagina + 1 ) % paginas;
				mostrar();
			}, INTERVALO );
		}

		function actualizar() {
			// Con «movimiento reducido» no rota: se ven todas las fotos.
			var activo = movil.matches && ! reducido.matches;
			caja.classList.toggle( 'is-rotando', activo );
			if ( activo ) {
				mostrar();
			}
			programar();
		}

		caja.addEventListener( 'mouseenter', function () { detenido = true; programar(); } );
		caja.addEventListener( 'mouseleave', function () { detenido = false; programar(); } );
		movil.addEventListener( 'change', actualizar );
		reducido.addEventListener( 'change', actualizar );
		document.addEventListener( 'visibilitychange', programar );
		actualizar();
	} );
} )();
