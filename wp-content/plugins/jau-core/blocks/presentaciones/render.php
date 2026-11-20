<?php
/**
 * Presentaciones del producto (como en el prototipo):
 * - «selector» (ficha): píldoras que cambian foto, título, datos y botones sin recargar.
 * - «chips» (tarjetas): enlaces a la ficha con esa presentación ya marcada.
 *
 * @package jau-core
 * @var array    $attributes
 * @var WP_Block $block
 */

defined( 'ABSPATH' ) || exit;

$jau_post_id = isset( $block->context['postId'] ) ? (int) $block->context['postId'] : (int) get_the_ID();
$jau_pres    = $jau_post_id ? jau_presentaciones_de( $jau_post_id ) : array();

if ( ! $jau_pres ) {
	if ( ! $jau_post_id && defined( 'REST_REQUEST' ) && REST_REQUEST ) {
		$jau_pres = array(
			'250-ml' => array( 'nombre' => '250 mL', 'img' => 0 ),
			'500-ml' => array( 'nombre' => '500 mL', 'img' => 0 ),
			'1-5-l'  => array( 'nombre' => '1.5 L', 'img' => 0 ),
		);
	} else {
		return;
	}
}

$jau_modo = ( isset( $attributes['modo'] ) && 'chips' === $attributes['modo'] ) ? 'chips' : 'selector';
$jau_url  = $jau_post_id ? get_permalink( $jau_post_id ) : '#';

if ( 'chips' === $jau_modo ) {
	$jau_wrap = get_block_wrapper_attributes( array( 'class' => 'jau-presentaciones jau-presentaciones--chips' ) );
	echo '<div ' . $jau_wrap . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	$jau_thumb = $jau_post_id ? (int) get_post_meta( $jau_post_id, '_thumbnail_id', true ) : 0;
	foreach ( $jau_pres as $jau_slug => $jau_p ) {
		// Si la presentación tiene foto propia, la tarjeta la muestra al filtrar por ella.
		$jau_img = ( $jau_p['img'] && $jau_p['img'] !== $jau_thumb ) ? (string) wp_get_attachment_image_url( $jau_p['img'], 'medium_large' ) : '';
		printf(
			'<a class="jau-chip" href="%1$s" data-presentacion="%2$s"%4$s>%3$s</a>',
			esc_url( add_query_arg( 'presentacion', $jau_slug, $jau_url ) ),
			esc_attr( $jau_slug ),
			esc_html( $jau_p['nombre'] ),
			$jau_img ? ' data-img="' . esc_url( $jau_img ) . '"' : ''
		);
	}
	echo '</div>';
	return;
}

$jau_actual = jau_presentacion_actual( $jau_post_id );
$jau_titulo = $jau_post_id ? get_the_title( $jau_post_id ) : '';
$jau_datos  = array();
foreach ( $jau_pres as $jau_slug => $jau_p ) {
	$jau_img = array();
	if ( $jau_p['img'] ) {
		$jau_src = wp_get_attachment_image_src( $jau_p['img'], 'large' );
		$jau_img = array(
			'src'    => $jau_src ? $jau_src[0] : '',
			'srcset' => (string) wp_get_attachment_image_srcset( $jau_p['img'], 'large' ),
			'alt'    => (string) get_post_meta( $jau_p['img'], '_wp_attachment_image_alt', true ),
		);
	}
	$jau_nombre_sku         = trim( $jau_titulo . ' ' . $jau_p['nombre'] );
	$jau_datos[ $jau_slug ] = array(
		'nombre'    => $jau_p['nombre'],
		'img'       => $jau_img,
		'consultar' => jau_producto_consultar_url( $jau_nombre_sku ),
		'whatsapp'  => jau_producto_whatsapp_url( $jau_nombre_sku ),
	);
}

$jau_wrap = get_block_wrapper_attributes(
	array(
		'class'    => 'jau-presentaciones jau-presentaciones--selector',
		'data-jau' => wp_json_encode( $jau_datos ),
	)
);
?>
<div <?php echo $jau_wrap; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<p class="jau-presentaciones__titulo">Presentaciones</p>
	<div class="jau-presentaciones__lista" role="group" aria-label="Presentaciones">
		<?php foreach ( $jau_pres as $jau_slug => $jau_p ) : ?>
			<a class="jau-pildora" href="<?php echo esc_url( add_query_arg( 'presentacion', $jau_slug, $jau_url ) ); ?>" data-presentacion="<?php echo esc_attr( $jau_slug ); ?>"<?php echo $jau_slug === $jau_actual ? ' aria-current="true"' : ''; ?>><?php echo esc_html( $jau_p['nombre'] ); ?></a>
		<?php endforeach; ?>
	</div>
</div>
