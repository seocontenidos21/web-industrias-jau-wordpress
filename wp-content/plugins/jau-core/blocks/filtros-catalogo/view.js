/* JAU Core · filtros del catálogo en el navegador (marca, presentación, sabor y buscador). */
( function () {
	var bloque = document.querySelector( '.jau-filtros-bloque' );
	if ( ! bloque ) {
		return;
	}
	var zona = bloque.closest( '.jau-catalogo' ) || document;
	var tarjetas = Array.prototype.slice.call( zona.querySelectorAll( '.jau-productos .wp-block-post' ) );
	var total = bloque.querySelector( '.jau-filtros__total' );
	var vacio = bloque.querySelector( '.jau-filtros__vacio' );
	var marcas = bloque.querySelectorAll( '[data-marca]' );
	var selects = bloque.querySelectorAll( 'select[data-filtro]' );
	var buscador = bloque.querySelector( 'input[data-filtro="q"]' );

	function normal( t ) {
		return ( t || '' ).normalize( 'NFD' ).replace( /[̀-ͯ]/g, '' ).toLowerCase().trim();
	}

	var params = new URLSearchParams( window.location.search );
	var estado = {
		marca: params.get( 'marca' ) || '',
		presentacion: params.get( 'presentacion' ) || '',
		sabor: params.get( 'sabor' ) || '',
		q: params.get( 'q' ) || ''
	};

	var datos = tarjetas.map( function ( t ) {
		var titulo = t.querySelector( '.wp-block-post-title' );
		return { el: t, texto: normal( titulo ? titulo.textContent : t.textContent ) };
	} );

	function aplicar() {
		var q = normal( estado.q );
		var visibles = 0;
		datos.forEach( function ( d ) {
			var c = d.el.classList;
			var ok = ( ! estado.marca || c.contains( 'marca-' + estado.marca ) ) &&
				( ! estado.presentacion || c.contains( 'presentacion-' + estado.presentacion ) ) &&
				( ! estado.sabor || c.contains( 'sabor-' + estado.sabor ) ) &&
				( ! q || d.texto.indexOf( q ) > -1 );
			d.el.classList.toggle( 'is-oculto', ! ok );
			if ( ok ) {
				visibles++;
			}
		} );
		total.textContent = visibles === 1 ? '1 producto' : visibles + ' productos';
		vacio.hidden = visibles !== 0;

		Array.prototype.forEach.call( marcas, function ( b ) {
			b.setAttribute( 'aria-pressed', b.getAttribute( 'data-marca' ) === estado.marca ? 'true' : 'false' );
		} );
		Array.prototype.forEach.call( selects, function ( s ) {
			s.value = estado[ s.getAttribute( 'data-filtro' ) ];
		} );
		if ( buscador && buscador.value !== estado.q ) {
			buscador.value = estado.q;
		}

		var p = new URLSearchParams();
		Object.keys( estado ).forEach( function ( k ) {
			if ( estado[ k ] ) {
				p.set( k, estado[ k ] );
			}
		} );
		var qs = p.toString();
		window.history.replaceState( null, '', window.location.pathname + ( qs ? '?' + qs : '' ) );
	}

	Array.prototype.forEach.call( marcas, function ( b ) {
		b.addEventListener( 'click', function () {
			estado.marca = b.getAttribute( 'data-marca' );
			aplicar();
		} );
	} );
	Array.prototype.forEach.call( selects, function ( s ) {
		s.addEventListener( 'change', function () {
			estado[ s.getAttribute( 'data-filtro' ) ] = s.value;
			aplicar();
		} );
	} );
	if ( buscador ) {
		buscador.addEventListener( 'input', function () {
			estado.q = buscador.value;
			aplicar();
		} );
	}
	bloque.querySelector( '.jau-filtros__limpiar' ).addEventListener( 'click', function () {
		estado = { marca: '', presentacion: '', sabor: '', q: '' };
		aplicar();
	} );

	aplicar();
} )();
