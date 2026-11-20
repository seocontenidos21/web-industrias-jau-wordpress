<?php
/**
 * Render del bloque «Ícono JAU».
 *
 * @package industrias-jau
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$jau_clave  = isset( $attributes['icono'] ) ? sanitize_key( $attributes['icono'] ) : 'caja';
$jau_tamano = isset( $attributes['tamano'] ) ? max( 12, min( 96, (int) $attributes['tamano'] ) ) : 40;
$jau_estilo = ( isset( $attributes['estilo'] ) && 'caja' === $attributes['estilo'] ) ? 'caja' : 'simple';
$jau_svg    = jau_tema_svg( $jau_clave, 'caja' === $jau_estilo ? (int) round( $jau_tamano * 0.48 ) : $jau_tamano, 'caja' === $jau_estilo ? 1.7 : 1.6 );

if ( '' === $jau_svg ) {
	return;
}

$jau_wrapper = get_block_wrapper_attributes(
	array(
		'class' => 'jau-icono jau-icono--' . $jau_estilo,
		'style' => 'caja' === $jau_estilo ? sprintf( '--jau-icono-caja:%dpx;', $jau_tamano ) : '',
	)
);

printf( '<span %s>%s</span>', $jau_wrapper, $jau_svg ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- SVG generado y escapado en jau_tema_svg().
