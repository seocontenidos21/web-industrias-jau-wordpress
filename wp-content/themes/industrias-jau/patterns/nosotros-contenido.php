<?php
/**
 * Title: Sobre nosotros: fotos, misión, visión y bloques
 * Slug: industrias-jau/nosotros-contenido
 * Categories: industrias-jau
 * Description: Fotos de consumo, misión y visión oficiales en dos tarjetas grandes (DWIJ-54, DWIJ-60) y bloques de historia, valores y capacidad.
 * Keywords: nosotros, misión, visión, valores, historia
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

$jau_bloques = array(
	array( 'reloj', 'Historia', 'Cómo nació Industrias JAU y cómo llegó a producir sus propias bebidas.' ),
	array( 'valores', 'Valores', 'Los principios que guían el trabajo de la planta y la relación con los aliados comerciales.' ),
	array( 'fabrica', 'Capacidad', 'Capacidad de producción de la planta y alcance de la distribución.' ),
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

<!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"240px"}} -->
<div class="wp-block-group"><?php foreach ( $jau_bloques as $jau_b ) : ?><!-- wp:group {"className":"is-style-tarjeta-hover","style":{"spacing":{"padding":{"top":"22px","bottom":"22px","left":"22px","right":"22px"},"blockGap":"12px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group is-style-tarjeta-hover" style="padding-top:22px;padding-right:22px;padding-bottom:22px;padding-left:22px"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_b[0] ); ?>","tamano":40} /-->

<!-- wp:heading {"fontSize":"lg"} -->
<h2 class="wp-block-heading has-lg-font-size"><?php echo esc_html( $jau_b[1] ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-2","style":{"typography":{"fontSize":"15px"}}} -->
<p class="has-ink-2-color has-text-color" style="font-size:15px"><?php echo esc_html( $jau_b[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
