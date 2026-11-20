/* JAU Core · muestra en el editor el valor real de «Datos de la empresa» y del producto. */
( function ( wp ) {
	if ( ! wp || ! wp.blocks || ! wp.blocks.registerBlockBindingsSource ) {
		return;
	}
	var datos = window.jauEmpresa || {};

	function texto( args ) {
		var v = datos[ args.key ] || '(sin dato)';
		return args.etiqueta ? args.etiqueta + ': ' + v : v;
	}

	wp.blocks.registerBlockBindingsSource( {
		name: 'jau/empresa',
		label: 'Datos de la empresa',
		getValues: function ( opciones ) {
			var salida = {};
			Object.keys( opciones.bindings ).forEach( function ( atributo ) {
				var args = opciones.bindings[ atributo ].args || {};
				salida[ atributo ] = atributo === 'url' ? ( datos[ args.key ] || '#' ) : texto( args );
			} );
			return salida;
		},
		canUserEditValue: function () {
			return false;
		}
	} );

	wp.blocks.registerBlockBindingsSource( {
		name: 'jau/producto',
		label: 'Producto actual',
		usesContext: [ 'postId', 'postType' ],
		getValues: function ( opciones ) {
			var salida = {};
			Object.keys( opciones.bindings ).forEach( function ( atributo ) {
				salida[ atributo ] = '#';
			} );
			return salida;
		},
		canUserEditValue: function () {
			return false;
		}
	} );
} )( window.wp );
