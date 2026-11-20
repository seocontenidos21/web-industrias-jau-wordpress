/* JAU Core · validación del formulario «Quiero ser distribuidor» (misma lógica que JAU.validar del prototipo). */
( function () {
	var EMAIL = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

	document.querySelectorAll( '.jau-form' ).forEach( function ( form ) {
		function campos() {
			return form.querySelectorAll( 'input[data-tipo], select[data-tipo], textarea[data-tipo]' );
		}
		function marcar( el, mensaje ) {
			var caja = el.closest( '.jau-form__campo' );
			var err = document.getElementById( el.id + '-error' );
			if ( caja ) {
				caja.classList.toggle( 'is-error', !! mensaje );
			}
			if ( err ) {
				err.textContent = mensaje;
			}
			if ( mensaje ) {
				el.setAttribute( 'aria-invalid', 'true' );
			} else {
				el.removeAttribute( 'aria-invalid' );
			}
		}
		function validar( el ) {
			var v = ( el.value || '' ).trim();
			if ( el.required && ! v ) {
				return 'Campo obligatorio';
			}
			if ( el.getAttribute( 'data-tipo' ) === 'email' && v && ! EMAIL.test( v ) ) {
				return 'Correo no válido';
			}
			return '';
		}

		form.addEventListener( 'submit', function ( e ) {
			var primero = null;
			campos().forEach( function ( el ) {
				var m = validar( el );
				marcar( el, m );
				if ( m && ! primero ) {
					primero = el;
				}
			} );
			if ( primero ) {
				e.preventDefault();
				primero.focus();
				return;
			}
			var boton = form.querySelector( '.jau-form__enviar' );
			if ( boton ) {
				boton.disabled = true;
				boton.textContent = 'Enviando…';
			}
		} );

		campos().forEach( function ( el ) {
			el.addEventListener( 'input', function () {
				if ( el.closest( '.is-error' ) ) {
					marcar( el, '' );
				}
			} );
			el.addEventListener( 'change', function () {
				if ( el.closest( '.is-error' ) ) {
					marcar( el, validar( el ) );
				}
			} );
		} );
	} );

	var exito = document.querySelector( '.jau-form-exito' );
	if ( exito ) {
		exito.focus();
	}
} )();
