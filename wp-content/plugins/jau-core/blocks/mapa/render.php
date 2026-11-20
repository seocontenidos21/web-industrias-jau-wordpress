<?php
/**
 * Mapa de la planta (DWIJ-62) con la dirección de «Datos de la empresa» y «Cómo llegar».
 *
 * @package jau-core
 */

defined( 'ABSPATH' ) || exit;

$jau_embed = jau_dato( 'mapa_embed_url' );
if ( '' === $jau_embed ) {
	return;
}
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'jau-mapa' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<iframe src="<?php echo esc_url( $jau_embed ); ?>" title="Mapa de la planta de Industrias JAU" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
	<div class="jau-mapa__pie">
		<span><?php echo wp_kses_post( jau_dato_html( 'direccion', 'Planta' ) ); ?></span>
		<a class="jau-mapa__ir" href="<?php echo esc_url( jau_dato( 'como_llegar_url' ) ); ?>" target="_blank" rel="noopener">Cómo llegar</a>
	</div>
</div>
