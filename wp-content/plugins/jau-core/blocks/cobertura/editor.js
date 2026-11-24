/* Vista previa en el editor (renderizado en el servidor) y casillas para marcar los estados. */
( function ( wp ) {
	var el = wp.element.createElement;
	var be = wp.blockEditor;
	var c = wp.components;
	var ESTADOS = [ 'Amazonas', 'Anzoátegui', 'Apure', 'Aragua', 'Barinas', 'Bolívar', 'Carabobo', 'Cojedes', 'Delta Amacuro', 'Dependencias Federales', 'Distrito Capital', 'Falcón', 'Guárico', 'La Guaira', 'Lara', 'Mérida', 'Miranda', 'Monagas', 'Nueva Esparta', 'Portuguesa', 'Sucre', 'Táchira', 'Trujillo', 'Yaracuy', 'Zulia' ];

	wp.blocks.registerBlockType( 'jau/cobertura', {
		edit: function ( props ) {
			var elegidos = props.attributes.estados || [];
			function cambiar( nombre, marcado ) {
				var lista = elegidos.filter( function ( e ) { return e !== nombre; } );
				if ( marcado ) {
					lista.push( nombre );
				}
				props.setAttributes( { estados: lista } );
			}
			return el(
				'div',
				be.useBlockProps(),
				el(
					be.InspectorControls,
					null,
					el(
						c.PanelBody,
						{ title: 'Estados con presencia (' + elegidos.length + ')' },
						el( 'p', { className: 'components-base-control__help' }, 'Los estados marcados se pintan de azul en el mapa y aparecen en la lista.' ),
						ESTADOS.map( function ( nombre ) {
							return el( c.CheckboxControl, {
								key: nombre,
								label: nombre,
								checked: elegidos.indexOf( nombre ) !== -1,
								onChange: function ( v ) { cambiar( nombre, v ); }
							} );
						} )
					)
				),
				el( wp.serverSideRender, { block: 'jau/cobertura', attributes: props.attributes } )
			);
		},
		save: function () {
			return null;
		}
	} );
} )( window.wp );
