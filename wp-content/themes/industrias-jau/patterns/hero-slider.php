<?php
/**
 * Title: Slider del inicio
 * Slug: industrias-jau/hero-slider
 * Categories: industrias-jau, banner
 * Description: Banner principal en 4 diapositivas: institucional, Drink Cola, Frugy y distribuidores (DWIJ-53). Cada una con su escena (círculo + botellas o foto). Solo el primer titular es H1.
 * Keywords: slider, hero, banner, carrusel
 * Viewport Width: 1440
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

/**
 * Botella dentro de una escena.
 *
 * @param string $clave Clave del adjunto.
 * @param string $tipo  '', 'media' o 'centro' (altura relativa).
 * @return string
 */
$jau_botella = function ( $clave, $tipo = '' ) {
	return jau_tema_bloque_imagen( $clave, 'jau-botella' . ( $tipo ? ' jau-botella--' . $tipo : '' ), 'full' );
};
?>
<!-- wp:group {"align":"full","className":"jau-slider","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull jau-slider"><!-- wp:cover {"dimRatio":100,"overlayColor":"primary","isUserOverlayColor":true,"isDark":true,"className":"jau-slide","layout":{"type":"constrained"}} -->
<div class="wp-block-cover jau-slide"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","className":"jau-slide__cols"} -->
<div class="wp-block-columns are-vertically-aligned-center jau-slide__cols"><!-- wp:column {"verticalAlignment":"center","className":"jau-slide__texto"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__texto"><!-- wp:paragraph {"className":"jau-ojo"} -->
<p class="jau-ojo">Hecho en Venezuela</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Bebidas hechas en Venezuela para tu negocio</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>En Industrias JAU producimos Drink Cola y Frugy en nuestra planta del Zulia y buscamos aliados comerciales para llevarlas a más negocios.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-blanco jau-btn-flecha"} -->
<div class="wp-block-button is-style-blanco jau-btn-flecha"><a class="wp-block-button__link wp-element-button" href="/contacto/#formulario">Quiero ser distribuidor</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-contorno-claro"} -->
<div class="wp-block-button is-style-contorno-claro"><a class="wp-block-button__link wp-element-button" href="/productos/">Ver productos</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"jau-slide__visual"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__visual"><!-- wp:group {"className":"jau-escena jau-escena--primario","layout":{"type":"default"}} -->
<div class="wp-block-group jau-escena jau-escena--primario"><!-- wp:group {"className":"jau-botellas","layout":{"type":"default"}} -->
<div class="wp-block-group jau-botellas"><?php echo $jau_botella( 'frugy-naranja-botella' ) . "\n\n" . $jau_botella( 'frugy-manzana-botella', 'media' ) . "\n\n" . $jau_botella( 'drink-cola-1-5-l', 'centro' ) . "\n\n" . $jau_botella( 'frugy-limon-coco-botella', 'media' ) . "\n\n" . $jau_botella( 'frugy-mango-botella' ); // phpcs:ignore ?></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"dimRatio":100,"overlayColor":"drink-cola-fondo","isUserOverlayColor":true,"isDark":true,"className":"jau-slide","layout":{"type":"constrained"}} -->
<div class="wp-block-cover jau-slide"><span aria-hidden="true" class="wp-block-cover__background has-drink-cola-fondo-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","className":"jau-slide__cols"} -->
<div class="wp-block-columns are-vertically-aligned-center jau-slide__cols"><!-- wp:column {"verticalAlignment":"center","className":"jau-slide__texto"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__texto"><!-- wp:paragraph {"className":"jau-ojo"} -->
<p class="jau-ojo">Refresco de cola</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Drink Cola</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Bebida gaseosa de cola negra · 400 mL y 1.5 L</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-blanco jau-btn-flecha"} -->
<div class="wp-block-button is-style-blanco jau-btn-flecha"><a class="wp-block-button__link wp-element-button" href="/productos/drink-cola/">Ver producto</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"jau-slide__visual"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__visual"><!-- wp:group {"className":"jau-escena","layout":{"type":"default"}} -->
<div class="wp-block-group jau-escena"><!-- wp:group {"className":"jau-botellas","layout":{"type":"default"}} -->
<div class="wp-block-group jau-botellas"><?php echo $jau_botella( 'drink-cola-1-5-l', 'centro' ) . "\n\n" . $jau_botella( 'drink-cola-400-ml', 'media' ); // phpcs:ignore ?></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"dimRatio":100,"overlayColor":"frugy","isUserOverlayColor":true,"isDark":false,"className":"jau-slide","layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light jau-slide"><span aria-hidden="true" class="wp-block-cover__background has-frugy-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","className":"jau-slide__cols"} -->
<div class="wp-block-columns are-vertically-aligned-center jau-slide__cols"><!-- wp:column {"verticalAlignment":"center","className":"jau-slide__texto"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__texto"><?php echo jau_tema_bloque_imagen( 'logo-frugy-verde-blanco', 'jau-slide__logo', 'medium' ); // phpcs:ignore ?>

<!-- wp:heading -->
<h2 class="wp-block-heading">Bebidas saborizadas a frutas</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>6 sabores: manzana, naranja, pera, durazno, mango y limón-coco · 250 mL, 500 mL y 1.5 L</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"jau-btn-flecha","backgroundColor":"ink","textColor":"white"} -->
<div class="wp-block-button jau-btn-flecha"><a class="wp-block-button__link has-white-color has-ink-background-color has-text-color has-background wp-element-button" href="/productos/?marca=frugy">Ver sabores</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"jau-slide__visual"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__visual"><!-- wp:group {"className":"jau-escena jau-escena--claro","layout":{"type":"default"}} -->
<div class="wp-block-group jau-escena jau-escena--claro"><!-- wp:group {"className":"jau-botellas","layout":{"type":"default"}} -->
<div class="wp-block-group jau-botellas"><?php echo $jau_botella( 'frugy-pera-botella' ) . "\n\n" . $jau_botella( 'frugy-durazno-botella', 'media' ) . "\n\n" . $jau_botella( 'frugy-limon-coco-botella', 'centro' ) . "\n\n" . $jau_botella( 'frugy-naranja-botella', 'media' ) . "\n\n" . $jau_botella( 'frugy-manzana-botella' ); // phpcs:ignore ?></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"dimRatio":100,"overlayColor":"ink","isUserOverlayColor":true,"isDark":true,"className":"jau-slide jau-slide--distribuidores","layout":{"type":"constrained"}} -->
<div class="wp-block-cover jau-slide jau-slide--distribuidores"><span aria-hidden="true" class="wp-block-cover__background has-ink-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","className":"jau-slide__cols"} -->
<div class="wp-block-columns are-vertically-aligned-center jau-slide__cols"><!-- wp:column {"verticalAlignment":"center","className":"jau-slide__texto"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__texto"><!-- wp:paragraph {"className":"jau-ojo"} -->
<p class="jau-ojo">Distribuidores</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Quiero ser distribuidor</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Lleva Drink Cola y Frugy a tu negocio. Déjanos tus datos y el equipo de ventas te contactará con las condiciones para distribuidores.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"jau/empresa","args":{"key":"telefono","etiqueta":"Teléfono para distribuidores","enlace":true}}}}} -->
<p>Teléfono para distribuidores</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-blanco jau-btn-flecha"} -->
<div class="wp-block-button is-style-blanco jau-btn-flecha"><a class="wp-block-button__link wp-element-button" href="/contacto/#formulario">Quiero ser distribuidor</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-whatsapp","metadata":{"bindings":{"url":{"source":"jau/empresa","args":{"key":"whatsapp_url"}}}}} -->
<div class="wp-block-button is-style-whatsapp"><a class="wp-block-button__link wp-element-button" href="#" target="_blank" rel="noreferrer noopener">Escríbenos por WhatsApp</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"jau-slide__visual"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__visual"><!-- wp:group {"className":"jau-escena jau-escena--foto","layout":{"type":"default"}} -->
<div class="wp-block-group jau-escena jau-escena--foto"><?php echo jau_tema_bloque_imagen( 'frugy-supermercado-3', '', 'large' ); // phpcs:ignore ?></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->
