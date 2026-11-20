/* Editor del bloque «Ícono JAU» (sin compilación: usa los globales de WordPress). */
( function ( wp ) {
	var el = wp.element.createElement;
	var be = wp.blockEditor;
	var c = wp.components;
	var iconos = ( window.jauTemaIconos || {} );

	function svg( clave, tamano ) {
		var ic = iconos[ clave ];
		if ( ! ic ) {
			return null;
		}
		return el( 'svg', { width: tamano, height: tamano, viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor', strokeWidth: 1.7, strokeLinecap: 'round', strokeLinejoin: 'round', 'aria-hidden': true },
			el( 'path', { d: ic.d } )
		);
	}

	wp.blocks.registerBlockType( 'industrias-jau/icono', {
		edit: function ( props ) {
			var a = props.attributes;
			var caja = a.estilo === 'caja';
			var blockProps = be.useBlockProps( {
				className: 'jau-icono jau-icono--' + ( caja ? 'caja' : 'simple' ),
				style: caja ? { '--jau-icono-caja': a.tamano + 'px' } : {}
			} );
			var opciones = Object.keys( iconos ).map( function ( k ) {
				return { value: k, label: iconos[ k ].nombre };
			} );
			return el( wp.element.Fragment, null,
				el( be.InspectorControls, null,
					el( c.PanelBody, { title: 'Ícono' },
						el( c.SelectControl, { label: 'Ícono', value: a.icono, options: opciones, onChange: function ( v ) { props.setAttributes( { icono: v } ); } } ),
						el( c.RangeControl, { label: 'Tamaño (px)', value: a.tamano, min: 16, max: 96, onChange: function ( v ) { props.setAttributes( { tamano: v } ); } } ),
						el( c.SelectControl, { label: 'Estilo', value: a.estilo, options: [ { value: 'simple', label: 'Solo ícono' }, { value: 'caja', label: 'Ícono en recuadro de color' } ], onChange: function ( v ) { props.setAttributes( { estilo: v } ); } } )
					)
				),
				el( 'span', blockProps, svg( a.icono, caja ? Math.round( a.tamano * 0.48 ) : a.tamano ) )
			);
		},
		save: function () {
			return null;
		}
	} );
} )( window.wp );
