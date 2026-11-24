/* Vista previa en el editor (renderizado en el servidor). */
( function ( wp ) {
	var el = wp.element.createElement;
	function idActual() {
		var ed = wp.data.select( 'core/editor' );
		var id = ed ? ed.getCurrentPostId() : null;
		return typeof id === 'number' ? { post_id: id } : {};
	}
	wp.blocks.registerBlockType( 'jau/formulario-distribuidor', {
		edit: function ( props ) {
			var blockProps = wp.blockEditor.useBlockProps();
			return el( 'div', blockProps, el( wp.serverSideRender, { block: 'jau/formulario-distribuidor', attributes: props.attributes, urlQueryArgs: idActual() } ) );
		},
		save: function () {
			return null;
		}
	} );
} )( window.wp );
