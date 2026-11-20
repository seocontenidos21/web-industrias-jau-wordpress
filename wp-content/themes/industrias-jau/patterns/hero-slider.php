<?php
/**
 * Title: Slider del inicio
 * Slug: industrias-jau/hero-slider
 * Categories: industrias-jau, banner
 * Description: Banner principal en 4 diapositivas: institucional, Drink Cola, Frugy y distribuidores (DWIJ-53). Solo el primer titular es H1.
 * Keywords: slider, hero, banner, carrusel
 * Viewport Width: 1440
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;
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
<div class="wp-block-column is-vertically-aligned-center jau-slide__visual"><!-- wp:group {"className":"jau-composicion","layout":{"type":"default"}} -->
<div class="wp-block-group jau-composicion"><?php echo jau_tema_bloque_imagen( 'frugy-familia', 'jau-composicion__a' ); // phpcs:ignore ?>

<?php echo jau_tema_bloque_imagen( 'drinkcola-recorte', 'jau-composicion__b' ); // phpcs:ignore ?></div>
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
<div class="wp-block-column is-vertically-aligned-center jau-slide__visual"><?php echo jau_tema_bloque_imagen( 'drinkcola-recorte', 'jau-slide__producto' ); // phpcs:ignore ?></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"dimRatio":100,"overlayColor":"frugy","isUserOverlayColor":true,"isDark":false,"className":"jau-slide","layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light jau-slide"><span aria-hidden="true" class="wp-block-cover__background has-frugy-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","className":"jau-slide__cols"} -->
<div class="wp-block-columns are-vertically-aligned-center jau-slide__cols"><!-- wp:column {"verticalAlignment":"center","className":"jau-slide__texto"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__texto"><!-- wp:paragraph {"className":"jau-ojo"} -->
<p class="jau-ojo">Bebidas saborizadas</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2 class="wp-block-heading">Frugy</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Bebidas saborizadas a frutas · 6 sabores: manzana, naranja, pera, durazno, mango y limón-coco.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"jau-btn-flecha","backgroundColor":"ink","textColor":"white"} -->
<div class="wp-block-button jau-btn-flecha"><a class="wp-block-button__link has-white-color has-ink-background-color has-text-color has-background wp-element-button" href="/productos/?marca=frugy">Ver sabores</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"jau-slide__visual"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__visual"><?php echo jau_tema_bloque_imagen( 'frugy-familia', 'jau-slide__producto' ); // phpcs:ignore ?></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"dimRatio":100,"overlayColor":"ink","isUserOverlayColor":true,"isDark":true,"className":"jau-slide jau-slide--distribuidores","layout":{"type":"constrained"}} -->
<div class="wp-block-cover jau-slide jau-slide--distribuidores"><span aria-hidden="true" class="wp-block-cover__background has-ink-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","className":"jau-slide__cols"} -->
<div class="wp-block-columns are-vertically-aligned-center jau-slide__cols"><!-- wp:column {"verticalAlignment":"center","width":"66.66%","className":"jau-slide__texto"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__texto" style="flex-basis:66.66%"><!-- wp:paragraph {"className":"jau-ojo"} -->
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

<!-- wp:column {"verticalAlignment":"center","width":"33.33%","className":"jau-slide__visual"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__visual" style="flex-basis:33.33%"><!-- wp:paragraph {"className":"jau-slide__nota"} -->
<p class="jau-slide__nota"><span class="jau-pc">Foto de producto en anaquel por confirmar</span></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->
