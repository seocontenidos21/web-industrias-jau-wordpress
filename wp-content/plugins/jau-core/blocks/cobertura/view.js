/* JAU Core · mapa de cobertura: al pasar el mouse (o tocar) un estado se ve su nombre y se resalta
   también en la lista; al pasar por la lista se resalta en el mapa. */
( function () {
	document.querySelectorAll( '.jau-cobertura-mapa' ).forEach( function ( caja ) {
		var figura = caja.querySelector( '.jau-cobertura-mapa__mapa' );
		var etiqueta = caja.querySelector( '.jau-cobertura-mapa__etiqueta' );
		var fijo = null;
		if ( ! figura || ! etiqueta ) {
			return;
		}

		function elementos( nombre ) {
			return caja.querySelectorAll( '[data-estado="' + nombre.replace( /"/g, '\\"' ) + '"]' );
		}
		function resaltar( nombre, si ) {
			elementos( nombre ).forEach( function ( el ) {
				el.classList.toggle( 'is-resaltado', si );
			} );
		}
		function mostrar( nombre, x, y ) {
			var r = figura.getBoundingClientRect();
			etiqueta.textContent = nombre;
			etiqueta.style.left = ( x - r.left ) + 'px';
			etiqueta.style.top = ( y - r.top ) + 'px';
			etiqueta.hidden = false;
		}
		function centro( nombre ) {
			var forma = figura.querySelector( 'svg [data-estado="' + nombre.replace( /"/g, '\\"' ) + '"]' );
			var b = forma ? forma.getBoundingClientRect() : null;
			return b ? [ b.left + b.width / 2, b.top + b.height / 2 ] : null;
		}
		function ocultar() {
			etiqueta.hidden = true;
		}

		caja.querySelectorAll( 'svg [data-estado]' ).forEach( function ( el ) {
			var nombre = el.getAttribute( 'data-estado' );
			el.addEventListener( 'pointermove', function ( e ) {
				if ( e.pointerType === 'mouse' ) {
					mostrar( nombre, e.clientX, e.clientY );
				}
			} );
			el.addEventListener( 'pointerenter', function ( e ) {
				if ( e.pointerType === 'mouse' ) {
					resaltar( nombre, true );
				}
			} );
			el.addEventListener( 'pointerleave', function ( e ) {
				if ( e.pointerType === 'mouse' ) {
					resaltar( nombre, false );
					ocultar();
				}
			} );
			// En pantallas táctiles: tocar muestra el nombre hasta tocar otro lugar.
			el.addEventListener( 'click', function ( e ) {
				if ( fijo ) {
					resaltar( fijo, false );
				}
				fijo = nombre;
				resaltar( nombre, true );
				mostrar( nombre, e.clientX, e.clientY );
				e.stopPropagation();
			} );
		} );

		document.addEventListener( 'click', function () {
			if ( fijo ) {
				resaltar( fijo, false );
				fijo = null;
				ocultar();
			}
		} );

		caja.querySelectorAll( 'li[data-estado]' ).forEach( function ( li ) {
			var nombre = li.getAttribute( 'data-estado' );
			li.addEventListener( 'pointerenter', function () {
				var c = centro( nombre );
				resaltar( nombre, true );
				if ( c ) {
					mostrar( nombre, c[ 0 ], c[ 1 ] );
				}
			} );
			li.addEventListener( 'pointerleave', function () {
				resaltar( nombre, false );
				ocultar();
			} );
		} );
	} );
} )();
