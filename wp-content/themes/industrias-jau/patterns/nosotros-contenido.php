<?php
/**
 * Title: Sobre nosotros: historia, fotos, misión, visión y valores
 * Slug: industrias-jau/nosotros-contenido
 * Categories: industrias-jau
 * Description: Primer bloque «Nuestra historia» (DWIJ-93, texto del cliente del 25/11/2026): a la izquierda el título, el origen como entrada y el resto como una línea de tiempo discreta; a la derecha una foto de ambiente sobre el círculo azul de la marca con «2023 · Maracaibo, Venezuela» destacado. Después, fotos de consumo, misión y visión oficiales en dos tarjetas grandes (DWIJ-54, DWIJ-60) y los cinco valores (DWIJ-80).
 * Keywords: nosotros, historia, misión, visión, valores
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
// «Nuestra historia» (DWIJ-93), texto del cliente tal cual. El primero es la entrada; los demás van
// en la línea de tiempo (desde sus inicios → presencia en el país → hoy).
$jau_historia_entrada = 'Industria Venezolana de Bebidas JAU nació en Maracaibo, Venezuela, en 2023, por iniciativa de tres emprendedores con experiencia en el sector alimentario y una visión compartida: desarrollar bebidas de calidad que respondieran a los gustos y preferencias del consumidor venezolano.';
$jau_historia         = array(
	'Desde sus inicios, la empresa se ha dedicado a la producción de bebidas carbonatadas y no carbonatadas, desarrollando un portafolio de productos que incluye marcas como Drink Cola y Frugy.',
	'Con sus operaciones establecidas en Maracaibo, JAU ha extendido su presencia comercial a distintas regiones del país, fortaleciendo su participación en el mercado nacional de bebidas y su relación con aliados comerciales.',
	'Hoy, la empresa continúa trabajando en el desarrollo de sus marcas y en la consolidación de su presencia en Venezuela, manteniendo el compromiso con la calidad que impulsó su creación.',
);
// Foto de ambiente al lado (DWIJ-78: sin repetir las de la página): «Frugy es de aquí, y eso se nota».
$jau_historia_foto = 'frugy-casual-1';
?>
<!-- wp:group {"tagName":"section","anchor":"historia","align":"full","className":"jau-historia","style":{"spacing":{"padding":{"top":"64px","bottom":"64px"}}},"backgroundColor":"primary-tint","layout":{"type":"constrained"}} -->
<section id="historia" class="wp-block-group alignfull jau-historia has-primary-tint-background-color has-background" style="padding-top:64px;padding-bottom:64px"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"40px","left":"64px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"58%","className":"jau-historia__texto","style":{"spacing":{"blockGap":"18px"}}} -->
<div class="wp-block-column is-vertically-aligned-center jau-historia__texto" style="flex-basis:58%"><!-- wp:heading -->
<h2 class="wp-block-heading">Nuestra historia</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"jau-historia__entrada"} -->
<p class="jau-historia__entrada"><?php echo esc_html( $jau_historia_entrada ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"jau-historia__linea","style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group jau-historia__linea"><?php foreach ( $jau_historia as $jau_i => $jau_h ) : ?><?php echo $jau_i ? "\n\n" : ''; ?><!-- wp:paragraph {"textColor":"ink-2","fontSize":"md"} -->
<p class="has-ink-2-color has-text-color has-md-font-size"><?php echo esc_html( $jau_h ); ?></p>
<!-- /wp:paragraph --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"42%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:42%"><!-- wp:group {"className":"jau-escena jau-escena--foto jau-escena--historia","layout":{"type":"default"}} -->
<div class="wp-block-group jau-escena jau-escena--foto jau-escena--historia"><?php echo jau_tema_bloque_imagen( $jau_historia_foto, '', 'large' ); // phpcs:ignore ?>

<!-- wp:group {"className":"jau-escena__etiqueta jau-historia__dato","style":{"spacing":{"blockGap":"4px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group jau-escena__etiqueta jau-historia__dato"><!-- wp:paragraph {"className":"jau-historia__anio"} -->
<p class="jau-historia__anio">2023</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Maracaibo, Venezuela</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"jau-nosotros","style":{"spacing":{"padding":{"top":"48px","bottom":"52px"},"blockGap":"28px"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group jau-nosotros" style="padding-top:48px;padding-bottom:52px"><!-- wp:group {"className":"jau-fotos","style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":"150px"}} -->
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
