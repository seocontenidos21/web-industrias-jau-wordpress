<?php
/**
 * Title: Sobre nosotros: foto, misión, visión y bloques
 * Slug: industrias-jau/nosotros-contenido
 * Categories: industrias-jau
 * Description: Foto de la empresa, misión y visión oficiales en bloques destacados (DWIJ-54, DWIJ-60) y bloques de historia, valores y capacidad.
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
$jau_foto = jau_tema_bloque_imagen( 'ambiente-almacen', 'jau-img-redonda jau-nos-banner', 'full' );
?>
<!-- wp:group {"tagName":"section","className":"jau-nosotros","style":{"spacing":{"padding":{"top":"40px","bottom":"52px"},"blockGap":"28px"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group jau-nosotros" style="padding-top:40px;padding-bottom:52px"><?php echo $jau_foto; // phpcs:ignore ?>

<!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"300px"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"jau-destacado-card","style":{"spacing":{"padding":{"top":"28px","bottom":"28px","left":"28px","right":"28px"},"blockGap":"14px"}},"backgroundColor":"primary","textColor":"white","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group jau-destacado-card has-white-color has-primary-background-color has-text-color has-background" style="padding-top:28px;padding-right:28px;padding-bottom:28px;padding-left:28px"><!-- wp:industrias-jau/icono {"icono":"meta","tamano":44,"textColor":"white"} /-->

<!-- wp:heading {"fontSize":"subtitulo"} -->
<h2 class="wp-block-heading has-subtitulo-font-size">Misión</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"md"} -->
<p class="has-md-font-size">Resaltar lo hecho en Venezuela a través de cada sorbo de nuestras bebidas, dejando una huella de alegría que nos convierta en la marca preferida de todos los venezolanos.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"jau-destacado-card","style":{"spacing":{"padding":{"top":"28px","bottom":"28px","left":"28px","right":"28px"},"blockGap":"14px"}},"backgroundColor":"ink","textColor":"white","layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group jau-destacado-card has-white-color has-ink-background-color has-text-color has-background" style="padding-top:28px;padding-right:28px;padding-bottom:28px;padding-left:28px"><!-- wp:industrias-jau/icono {"icono":"vision","tamano":44,"textColor":"white"} /-->

<!-- wp:heading {"fontSize":"subtitulo"} -->
<h2 class="wp-block-heading has-subtitulo-font-size">Visión</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"md"} -->
<p class="has-md-font-size">Ser reconocidos como los líderes en producción de bebidas de la más alta calidad en el país; así como la mejor opción nacional para nuestros aliados comerciales, creadores de grandes empresas rentables y eficientes en el campo de la distribución elevando continuamente su crecimiento.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"240px"}} -->
<div class="wp-block-group"><?php foreach ( $jau_bloques as $jau_b ) : ?><!-- wp:group {"className":"is-style-tarjeta-hover","style":{"spacing":{"padding":{"top":"22px","bottom":"22px","left":"22px","right":"22px"},"blockGap":"12px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group is-style-tarjeta-hover" style="padding-top:22px;padding-right:22px;padding-bottom:22px;padding-left:22px"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_b[0] ); ?>","tamano":40} /-->

<!-- wp:heading {"fontSize":"lg"} -->
<h2 class="wp-block-heading has-lg-font-size"><?php echo esc_html( $jau_b[1] ); ?> <span class="jau-pc">Por confirmar</span></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-2","style":{"typography":{"fontSize":"15px"}}} -->
<p class="has-ink-2-color has-text-color" style="font-size:15px"><?php echo esc_html( $jau_b[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
