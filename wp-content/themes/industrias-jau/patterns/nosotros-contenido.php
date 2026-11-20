<?php
/**
 * Title: Sobre nosotros: fotos, misión, visión y valores
 * Slug: industrias-jau/nosotros-contenido
 * Categories: industrias-jau
 * Description: Fotos de consumo, misión y visión oficiales en dos tarjetas grandes (DWIJ-54, DWIJ-60) y los cinco valores (DWIJ-80). Historia y capacidad se agregan cuando el cliente envíe los textos.
 * Keywords: nosotros, misión, visión, valores
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

// Valores oficiales (DWIJ-80), en el orden del cliente y sin numerar.
$jau_valores = array(
	array( 'escudo', 'Integridad' ),
	array( 'manos', 'Confianza' ),
	array( 'estrella', 'Excelencia' ),
	array( 'sonrisa', 'Alegría' ),
	array( 'valores', 'Pasión por el bien' ),
);
$jau_destacados = array(
	array( 'meta', 'Misión', 'Resaltar lo hecho en Venezuela a través de cada sorbo de nuestras bebidas, dejando una huella de alegría que nos convierta en la marca preferida de todos los venezolanos.' ),
	array( 'vision', 'Visión', 'Ser reconocidos como los líderes en producción de bebidas de la más alta calidad en el país; así como la mejor opción nacional para nuestros aliados comerciales, creadores de grandes empresas rentables y eficientes en el campo de la distribución elevando continuamente su crecimiento.' ),
);
$jau_fotos = array( 'frugy-desayuno-3', 'frugy-kids-3', 'frugy-casual-5', 'frugy-desayuno-8' );
?>
<!-- wp:group {"tagName":"section","className":"jau-nosotros","style":{"spacing":{"padding":{"top":"40px","bottom":"52px"},"blockGap":"28px"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group jau-nosotros" style="padding-top:40px;padding-bottom:52px"><!-- wp:group {"className":"jau-fotos","style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":"150px"}} -->
<div class="wp-block-group jau-fotos"><?php echo implode( "\n\n", array_filter( array_map( fn( $c ) => jau_tema_bloque_imagen( $c, '', 'large' ), $jau_fotos ) ) ); // phpcs:ignore ?></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"300px"}} -->
<div class="wp-block-group"><?php foreach ( $jau_destacados as $jau_d ) : ?><!-- wp:group {"className":"is-style-tarjeta-hover","style":{"spacing":{"padding":{"top":"28px","bottom":"28px","left":"28px","right":"28px"},"blockGap":"14px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group is-style-tarjeta-hover" style="padding-top:28px;padding-right:28px;padding-bottom:28px;padding-left:28px"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_d[0] ); ?>","tamano":44} /-->

<!-- wp:heading {"fontSize":"subtitulo"} -->
<h2 class="wp-block-heading has-subtitulo-font-size"><?php echo esc_html( $jau_d[1] ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-2","fontSize":"md"} -->
<p class="has-ink-2-color has-text-color has-md-font-size"><?php echo esc_html( $jau_d[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group -->

<!-- wp:group {"className":"jau-valores-seccion","style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group jau-valores-seccion"><!-- wp:heading {"fontSize":"subtitulo"} -->
<h2 class="wp-block-heading has-subtitulo-font-size">Nuestros valores</h2>
<!-- /wp:heading -->

<!-- wp:group {"className":"jau-valores","style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group jau-valores"><?php foreach ( $jau_valores as $jau_v ) : ?><!-- wp:group {"className":"is-style-tarjeta-hover jau-valor","style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"20px","right":"20px"},"blockGap":"12px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group is-style-tarjeta-hover jau-valor" style="padding-top:24px;padding-right:20px;padding-bottom:24px;padding-left:20px"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_v[0] ); ?>","tamano":48,"estilo":"caja"} /-->

<!-- wp:heading {"level":3,"fontSize":"lg"} -->
<h3 class="wp-block-heading has-lg-font-size"><?php echo esc_html( $jau_v[1] ); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
