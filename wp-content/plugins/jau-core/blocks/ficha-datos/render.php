<?php
/**
 * Datos de la ficha de producto: solo datos confirmados; lo pendiente va con «por confirmar».
 *
 * @package jau-core
 * @var WP_Block $block
 */

defined( 'ABSPATH' ) || exit;

$jau_post_id = isset( $block->context['postId'] ) ? (int) $block->context['postId'] : (int) get_the_ID();

$jau_nombres = function ( $tax ) use ( $jau_post_id ) {
	$terms = $jau_post_id ? get_the_terms( $jau_post_id, $tax ) : false;
	if ( ! $terms || is_wp_error( $terms ) ) {
		return '';
	}
	if ( 'presentacion' === $tax ) {
		usort(
			$terms,
			function ( $a, $b ) {
				return jau_presentacion_ml( $a ) <=> jau_presentacion_ml( $b );
			}
		);
	}
	return implode( ', ', wp_list_pluck( $terms, 'name' ) );
};

$jau_filas = array(
	'Marca'              => esc_html( $jau_nombres( 'marca' ) ),
	'Sabor'              => esc_html( $jau_nombres( 'sabor' ) ),
	'Presentaciones'     => esc_html( $jau_nombres( 'presentacion' ) ),
);
$jau_filas = array_filter( $jau_filas, 'strlen' );

if ( ! $jau_post_id ) {
	$jau_filas = array(
		'Marca'          => 'Marca del producto',
		'Presentaciones' => 'Presentaciones disponibles',
	);
}
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'jau-ficha-datos' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<dl class="jau-ficha-datos__lista">
		<?php foreach ( $jau_filas as $jau_k => $jau_v ) : ?>
			<div class="jau-ficha-datos__fila">
				<dt><?php echo esc_html( $jau_k ); ?></dt>
				<dd><?php echo wp_kses_post( $jau_v ); ?></dd>
			</div>
		<?php endforeach; ?>
	</dl>
</div>
