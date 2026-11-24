/* Industrias JAU · razones de JAU Maquila desplegables: por defecto solo el título; la descripción
   se muestra al pasar el mouse por la fila (escritorio) o al tocar/hacer clic en el título, que es
   un botón accesible (aria-expanded). Sin JavaScript se ve todo el texto. */
( function () {
	var conHover = window.matchMedia( '(hover: hover) and (pointer: fine)' ).matches;

	document.querySelectorAll( '.jau-razones-lista' ).forEach( function ( lista, n ) {
		lista.classList.add( 'es-desplegable' );

		lista.querySelectorAll( '.jau-razon-fila' ).forEach( function ( fila, i ) {
			var titulo = fila.querySelector( 'h4' );
			var texto = fila.querySelector( 'p' );
			if ( ! titulo || ! texto ) {
				return;
			}
			var id = 'jau-razon-' + n + '-' + i;
			var boton = document.createElement( 'button' );
			var fijo = false;

			texto.id = id;
			boton.type = 'button';
			boton.className = 'jau-razon__boton';
			boton.setAttribute( 'aria-expanded', 'false' );
			boton.setAttribute( 'aria-controls', id );
			while ( titulo.firstChild ) {
				boton.appendChild( titulo.firstChild );
			}
			titulo.appendChild( boton );

			function abrir( si ) {
				fila.classList.toggle( 'is-abierta', si );
				boton.setAttribute( 'aria-expanded', si ? 'true' : 'false' );
			}

			// Clic o toque: abre y deja fijo, o cierra.
			boton.addEventListener( 'click', function () {
				fijo = ! fijo;
				abrir( fijo );
			} );

			// Mouse: se despliega mientras está encima (si no se fijó con clic).
			if ( conHover ) {
				fila.addEventListener( 'mouseenter', function () {
					if ( ! fijo ) {
						abrir( true );
					}
				} );
				fila.addEventListener( 'mouseleave', function () {
					if ( ! fijo ) {
						abrir( false );
					}
				} );
			}
		} );
	} );
} )();
