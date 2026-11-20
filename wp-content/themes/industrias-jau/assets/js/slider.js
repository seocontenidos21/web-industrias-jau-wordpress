/* Industrias JAU · slider del inicio (DWIJ-53 / DWIJ-58).
   Avance automático cada 5,5 s que se detiene con el cursor o el foco encima, flechas,
   indicadores sin números, teclado, swipe y respeto a «movimiento reducido». Sin librerías. */
( function () {
	var INTERVALO = 5500;
	var reducido = window.matchMedia( '(prefers-reduced-motion: reduce)' );

	function icono( d ) {
		return '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="' + d + '"></path></svg>';
	}

	function iniciar( slider ) {
		var slides = Array.prototype.slice.call( slider.children ).filter( function ( n ) {
			return n.classList.contains( 'jau-slide' );
		} );
		if ( slides.length < 2 ) {
			return;
		}
		var actual = 0;
		var timer = null;
		var pausadoUsuario = reducido.matches;
		var pausadoHover = false;

		slider.setAttribute( 'role', 'region' );
		slider.setAttribute( 'aria-roledescription', 'carrusel' );
		if ( ! slider.getAttribute( 'aria-label' ) ) {
			slider.setAttribute( 'aria-label', 'Presentación de Industrias JAU' );
		}

		var titulos = slides.map( function ( s, i ) {
			var h = s.querySelector( 'h1, h2' );
			var t = h ? h.textContent.trim() : 'Diapositiva';
			s.setAttribute( 'role', 'group' );
			s.setAttribute( 'aria-roledescription', 'diapositiva' );
			s.setAttribute( 'aria-label', t );
			s.id = s.id || 'jau-slide-' + i;
			return t;
		} );

		var controles = document.createElement( 'div' );
		controles.className = 'jau-slider__controles';
		controles.innerHTML =
			'<button type="button" class="jau-slider__flecha" data-dir="-1" aria-label="Diapositiva anterior">' + icono( 'M15 6l-6 6 6 6' ) + '</button>' +
			'<div class="jau-slider__puntos"></div>' +
			'<button type="button" class="jau-slider__flecha" data-dir="1" aria-label="Diapositiva siguiente">' + icono( 'M9 6l6 6-6 6' ) + '</button>';
		var puntos = controles.querySelector( '.jau-slider__puntos' );

		titulos.forEach( function ( t, i ) {
			var b = document.createElement( 'button' );
			b.type = 'button';
			b.className = 'jau-slider__punto';
			b.setAttribute( 'aria-label', 'Ir a: ' + t );
			b.setAttribute( 'aria-controls', slides[ i ].id );
			b.addEventListener( 'click', function () {
				ir( i, true );
			} );
			puntos.appendChild( b );
		} );
		slider.appendChild( controles );

		function ir( i, delUsuario ) {
			actual = ( i + slides.length ) % slides.length;
			slides.forEach( function ( s, n ) {
				var activo = n === actual;
				s.classList.toggle( 'is-active', activo );
				s.setAttribute( 'aria-hidden', activo ? 'false' : 'true' );
				if ( activo ) {
					s.removeAttribute( 'inert' );
				} else {
					s.setAttribute( 'inert', '' );
				}
			} );
			Array.prototype.forEach.call( puntos.children, function ( p, n ) {
				p.setAttribute( 'aria-current', n === actual ? 'true' : 'false' );
			} );
			if ( delUsuario ) {
				programar();
			}
		}

		function programar() {
			clearInterval( timer );
			timer = null;
			if ( pausadoUsuario || pausadoHover || document.hidden ) {
				return;
			}
			timer = setInterval( function () {
				ir( actual + 1 );
			}, INTERVALO );
		}

		controles.addEventListener( 'click', function ( e ) {
			var f = e.target.closest( '[data-dir]' );
			if ( f ) {
				ir( actual + parseInt( f.getAttribute( 'data-dir' ), 10 ), true );
			}
		} );
		slider.addEventListener( 'mouseenter', function () { pausadoHover = true; programar(); } );
		slider.addEventListener( 'mouseleave', function () { pausadoHover = false; programar(); } );
		slider.addEventListener( 'focusin', function () { pausadoHover = true; programar(); } );
		slider.addEventListener( 'focusout', function ( e ) {
			if ( ! slider.contains( e.relatedTarget ) ) {
				pausadoHover = false;
				programar();
			}
		} );
		slider.addEventListener( 'keydown', function ( e ) {
			if ( e.key === 'ArrowLeft' ) {
				ir( actual - 1, true );
			} else if ( e.key === 'ArrowRight' ) {
				ir( actual + 1, true );
			}
		} );
		document.addEventListener( 'visibilitychange', programar );
		reducido.addEventListener( 'change', function ( mq ) {
			pausadoUsuario = mq.matches;
			programar();
		} );

		/* Deslizar con el dedo */
		var x0 = null;
		var y0 = null;
		slider.style.touchAction = 'pan-y';
		slider.addEventListener( 'pointerdown', function ( e ) {
			if ( e.pointerType === 'mouse' ) {
				return;
			}
			x0 = e.clientX;
			y0 = e.clientY;
		} );
		slider.addEventListener( 'pointerup', function ( e ) {
			if ( x0 === null ) {
				return;
			}
			var dx = e.clientX - x0;
			var dy = e.clientY - y0;
			x0 = null;
			if ( Math.abs( dx ) > 45 && Math.abs( dx ) > Math.abs( dy ) ) {
				ir( actual + ( dx < 0 ? 1 : -1 ), true );
			}
		} );
		slider.addEventListener( 'pointercancel', function () { x0 = null; } );

		slider.classList.add( 'is-ready' );
		ir( 0 );
		programar();
	}

	document.querySelectorAll( '.jau-slider' ).forEach( iniciar );
} )();
