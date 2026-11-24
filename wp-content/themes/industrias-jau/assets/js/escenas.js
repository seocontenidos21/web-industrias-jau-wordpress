/* Industrias JAU · animación de la escena de JAU Maquila: entra al aparecer en pantalla (círculo,
   botellas y etiquetas) y luego flota suavemente. Sin JavaScript o con «reducir movimiento» se ve
   quieta y completa. */
( function () {
	var escenas = document.querySelectorAll( '.jau-escena--maquila' );
	if ( ! escenas.length || ! ( 'IntersectionObserver' in window ) || window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
		return;
	}
	var observador = new IntersectionObserver(
		function ( entradas ) {
			entradas.forEach( function ( entrada ) {
				if ( entrada.isIntersecting ) {
					entrada.target.classList.add( 'is-visible' );
					observador.unobserve( entrada.target );
				}
			} );
		},
		{ threshold: 0.3 }
	);
	escenas.forEach( function ( escena ) {
		escena.classList.add( 'jau-anima' );
		observador.observe( escena );
	} );
} )();
