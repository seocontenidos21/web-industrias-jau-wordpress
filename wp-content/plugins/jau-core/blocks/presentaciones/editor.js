/* Editor del bloque «Presentaciones del producto»: vista previa con el producto del contexto. */
( function ( wp ) {
	var el = wp.element.createElement;
	var be = wp.blockEditor;
	var c = wp.components;
	wp.blocks.registerBlockType( 'jau/presentaciones', {
		edit: function ( props ) {
			var blockProps = be.useBlockProps();
			var id = props.context && props.context.postId;
			return el( wp.element.Fragment, null,
				el( be.InspectorControls, null,
					el( c.PanelBody, { title: 'Presentaciones' },
						el( c.SelectControl, {
							label: 'Modo',
							value: props.attributes.modo,
							options: [ { value: 'selector', label: 'Selector (ficha del producto)' }, { value: 'chips', label: 'Etiquetas (tarjetas)' } ],
							onChange: function ( v ) { props.setAttributes( { modo: v } ); }
						} )
					)
				),
				el( 'div', blockProps, el( wp.serverSideRender, { block: 'jau/presentaciones', attributes: props.attributes, urlQueryArgs: typeof id === 'number' ? { post_id: id } : {} } ) )
			);
		},
		save: function () {
			return null;
		}
	} );
} )( window.wp );
