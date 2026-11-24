/* Vista previa en el editor (renderizado en el servidor) y selector de formulario. */
( function ( wp ) {
	var el = wp.element.createElement;
	var be = wp.blockEditor;
	var c = wp.components;
	function idActual() {
		var ed = wp.data.select( 'core/editor' );
		var id = ed ? ed.getCurrentPostId() : null;
		return typeof id === 'number' ? { post_id: id } : {};
	}
	wp.blocks.registerBlockType( 'jau/formulario-distribuidor', {
		edit: function ( props ) {
			var blockProps = be.useBlockProps();
			return el(
				'div',
				blockProps,
				el(
					be.InspectorControls,
					null,
					el(
						c.PanelBody,
						{ title: 'Formulario' },
						el( c.SelectControl, {
							label: 'Tipo de formulario',
							value: props.attributes.formulario,
							options: [
								{ label: 'Quiero ser distribuidor', value: 'distribuidor' },
								{ label: 'Contáctanos (JAU Maquila)', value: 'maquila' }
							],
							onChange: function ( v ) { props.setAttributes( { formulario: v } ); }
						} )
					)
				),
				el( wp.serverSideRender, { block: 'jau/formulario-distribuidor', attributes: props.attributes, urlQueryArgs: idActual() } )
			);
		},
		save: function () {
			return null;
		}
	} );
} )( window.wp );
