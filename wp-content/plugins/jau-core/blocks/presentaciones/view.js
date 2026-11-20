/* JAU Core · cambio de presentación en la ficha sin recargar (como en el prototipo). */
( function () {
	document.querySelectorAll( '.jau-presentaciones--selector' ).forEach( function ( caja ) {
		var datos = {};
		try {
			datos = JSON.parse( caja.getAttribute( 'data-jau' ) || '{}' );
		} catch ( e ) {
			return;
		}
		var ficha = caja.closest( '.jau-ficha' ) || document;
		var foto = ficha.querySelector( '.jau-ficha__foto img' );
		var titulo = ficha.querySelector( '.jau-ficha__presentacion' );
		var dato = ficha.querySelector( '[data-jau-presentacion-nombre]' );
		var consultar = ficha.querySelector( '.jau-btn-consultar a' );
		var whatsapp = ficha.querySelector( '.jau-btn-wa-producto a' );

		function aplicar( slug, enlace ) {
			var d = datos[ slug ];
			if ( ! d ) {
				return;
			}
			caja.querySelectorAll( '.jau-pildora' ).forEach( function ( p ) {
				p.removeAttribute( 'aria-current' );
			} );
			enlace.setAttribute( 'aria-current', 'true' );
			if ( foto && d.img && d.img.src ) {
				foto.src = d.img.src;
				if ( d.img.srcset ) {
					foto.srcset = d.img.srcset;
				} else {
					foto.removeAttribute( 'srcset' );
				}
				foto.alt = d.img.alt || '';
			}
			if ( titulo ) {
				titulo.textContent = d.nombre;
			}
			if ( dato ) {
				dato.textContent = d.nombre;
			}
			if ( consultar ) {
				consultar.href = d.consultar;
			}
			if ( whatsapp ) {
				whatsapp.href = d.whatsapp;
			}
			var url = new URL( window.location.href );
			url.searchParams.set( 'presentacion', slug );
			window.history.replaceState( null, '', url );
		}

		caja.addEventListener( 'click', function ( e ) {
			var enlace = e.target.closest( '.jau-pildora' );
			if ( ! enlace ) {
				return;
			}
			e.preventDefault();
			aplicar( enlace.getAttribute( 'data-presentacion' ), enlace );
		} );
	} );
} )();
