/* Vista previa en el editor (renderizado en el servidor) y selector de tipo/variante. */
( function ( wp ) {
	var el = wp.element.createElement;
	var be = wp.blockEditor;
	var c = wp.components;
	wp.blocks.registerBlockType( 'jau/contactos', {
		edit: function ( props ) {
			var a = props.attributes;
			return el(
				'div',
				be.useBlockProps(),
				el(
					be.InspectorControls,
					null,
					el(
						c.PanelBody,
						{ title: 'Contactos' },
						el( c.SelectControl, {
							label: 'Tipo de contacto',
							value: a.tipo,
							options: [
								{ label: 'Todos', value: 'todos' },
								{ label: 'Distribuidores', value: 'distribuidores' },
								{ label: 'Cliente directo', value: 'cliente' },
								{ label: 'Atención al consumidor', value: 'consumidor' },
								{ label: 'Trabaja con nosotros', value: 'talento' }
							],
							onChange: function ( v ) { props.setAttributes( { tipo: v } ); }
						} ),
						el( c.SelectControl, {
							label: 'Variante',
							value: a.variante,
							options: [
								{ label: 'Tarjeta (Contacto)', value: 'tarjeta' },
								{ label: 'Compacta (footer)', value: 'compacta' }
							],
							onChange: function ( v ) { props.setAttributes( { variante: v } ); }
						} ),
						el( 'p', { className: 'components-base-control__help' }, 'Los números y el correo se editan en Ajustes › Datos de la empresa.' )
					)
				),
				el( wp.serverSideRender, { block: 'jau/contactos', attributes: a } )
			);
		},
		save: function () {
			return null;
		}
	} );
} )( window.wp );
