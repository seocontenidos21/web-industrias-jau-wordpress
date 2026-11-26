<?php
/**
 * Title: Slider del inicio
 * Slug: industrias-jau/hero-slider
 * Categories: industrias-jau, banner
 * Description: Banner principal en 4 diapositivas: institucional, Drink Cola, Frugy y distribuidores (DWIJ-53). Cada una con su escena (círculo + botellas o foto). Solo el primer titular es H1; en Drink Cola y Frugy el titular es el logo de la marca (DWIJ-98). Frugy en el verde de su logo, sin naranja (DWIJ-95). Distribuidores solo con el botón al formulario (DWIJ-96).
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

/**
 * Logo de la marca como titular de la diapositiva (DWIJ-98): un H2 con la imagen y el nombre de la
 * marca como texto alternativo. Se ve solo el logo, y la diapositiva conserva su título para
 * buscadores y lectores de pantalla.
 *
 * @param string $clave  Clave del adjunto.
 * @param string $nombre Nombre de la marca (texto alternativo).
 * @param string $clase  Clases del titular.
 * @return string
 */
$jau_logo_titulo = function ( $clave, $nombre, $clase ) {
	$img = jau_tema_img( $clave );
	if ( ! $img['id'] ) {
		return '';
	}
	return sprintf(
		'<!-- wp:heading {"className":"%1$s"} -->' . "\n" . '<h2 class="wp-block-heading %1$s"><img class="wp-image-%2$d" src="%3$s" alt="%4$s"></h2>' . "\n" . '<!-- /wp:heading -->',
		esc_attr( $clase ),
		$img['id'],
		esc_url( (string) wp_get_attachment_image_url( $img['id'], 'medium_large' ) ),
		esc_attr( $nombre )
	);
};
?>
<!-- wp:group {"align":"full","className":"jau-slider","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull jau-slider"><!-- wp:cover {"dimRatio":100,"overlayColor":"primary","isUserOverlayColor":true,"isDark":true,"className":"jau-slide","layout":{"type":"constrained"}} -->
<div class="wp-block-cover jau-slide"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","className":"jau-slide__cols"} -->
<div class="wp-block-columns are-vertically-aligned-center jau-slide__cols"><!-- wp:column {"verticalAlignment":"center","className":"jau-slide__texto"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__texto"><!-- wp:heading {"level":1} -->
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

<!-- wp:cover {"dimRatio":100,"overlayColor":"drink-cola-oscuro","isUserOverlayColor":true,"isDark":true,"className":"jau-slide","layout":{"type":"constrained"}} -->
<div class="wp-block-cover jau-slide"><span aria-hidden="true" class="wp-block-cover__background has-drink-cola-oscuro-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","className":"jau-slide__cols"} -->
<div class="wp-block-columns are-vertically-aligned-center jau-slide__cols"><!-- wp:column {"verticalAlignment":"center","className":"jau-slide__texto"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__texto"><?php echo $jau_logo_titulo( 'logo-drink-cola', 'Drink Cola', 'jau-slide__logo jau-slide__logo--alto' ); // phpcs:ignore ?>

<!-- wp:paragraph -->
<p>Bebida gaseosa de cola negra · 400 mL, 1.5 L y 2 L</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-blanco jau-btn-flecha"} -->
<div class="wp-block-button is-style-blanco jau-btn-flecha"><a class="wp-block-button__link wp-element-button" href="/productos/drink-cola/">Ver producto</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"jau-slide__visual"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__visual"><!-- wp:group {"className":"jau-escena jau-escena--rojo","layout":{"type":"default"}} -->
<div class="wp-block-group jau-escena jau-escena--rojo"><!-- wp:group {"className":"jau-botellas","layout":{"type":"default"}} -->
<div class="wp-block-group jau-botellas"><?php echo $jau_botella( 'drink-cola-1-5-l', 'centro' ) . "\n\n" . $jau_botella( 'drink-cola-400-ml', 'media' ); // phpcs:ignore ?></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"dimRatio":100,"overlayColor":"frugy-oscuro","isUserOverlayColor":true,"isDark":true,"className":"jau-slide","layout":{"type":"constrained"}} -->
<div class="wp-block-cover jau-slide"><span aria-hidden="true" class="wp-block-cover__background has-frugy-oscuro-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","className":"jau-slide__cols"} -->
<div class="wp-block-columns are-vertically-aligned-center jau-slide__cols"><!-- wp:column {"verticalAlignment":"center","className":"jau-slide__texto"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__texto"><?php echo $jau_logo_titulo( 'logo-frugy-verde-blanco', 'Frugy', 'jau-slide__logo' ); // phpcs:ignore ?>

<!-- wp:paragraph -->
<p>7 sabores: manzana, naranja, pera, durazno, mango, limón-coco y piña colada · 250 mL, 500 mL y 1.5 L</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-blanco jau-btn-flecha"} -->
<div class="wp-block-button is-style-blanco jau-btn-flecha"><a class="wp-block-button__link wp-element-button" href="/productos/?marca=frugy">Ver sabores</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"jau-slide__visual"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__visual"><!-- wp:group {"className":"jau-escena jau-escena--verde","layout":{"type":"default"}} -->
<div class="wp-block-group jau-escena jau-escena--verde"><!-- wp:group {"className":"jau-botellas","layout":{"type":"default"}} -->
<div class="wp-block-group jau-botellas"><?php echo $jau_botella( 'frugy-pera-botella' ) . "\n\n" . $jau_botella( 'frugy-durazno-botella', 'media' ) . "\n\n" . $jau_botella( 'frugy-limon-coco-botella', 'centro' ) . "\n\n" . $jau_botella( 'frugy-naranja-botella', 'media' ) . "\n\n" . $jau_botella( 'frugy-manzana-botella' ); // phpcs:ignore ?></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"dimRatio":100,"overlayColor":"ink","isUserOverlayColor":true,"isDark":true,"className":"jau-slide jau-slide--distribuidores","layout":{"type":"constrained"}} -->
<div class="wp-block-cover jau-slide jau-slide--distribuidores"><span aria-hidden="true" class="wp-block-cover__background has-ink-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"verticalAlignment":"center","className":"jau-slide__cols"} -->
<div class="wp-block-columns are-vertically-aligned-center jau-slide__cols"><!-- wp:column {"verticalAlignment":"center","className":"jau-slide__texto"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__texto"><!-- wp:heading -->
<h2 class="wp-block-heading">Quiero ser distribuidor</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Lleva Drink Cola y Frugy a tu negocio. Déjanos tus datos y el equipo de ventas te contactará con las condiciones para distribuidores.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-blanco jau-btn-flecha"} -->
<div class="wp-block-button is-style-blanco jau-btn-flecha"><a class="wp-block-button__link wp-element-button" href="/contacto/#formulario">Quiero ser distribuidor</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","className":"jau-slide__visual"} -->
<div class="wp-block-column is-vertically-aligned-center jau-slide__visual"><!-- wp:group {"className":"jau-escena jau-escena--foto-botellas","layout":{"type":"default"}} -->
<div class="wp-block-group jau-escena jau-escena--foto-botellas"><?php echo jau_tema_bloque_imagen( 'jau-distribuidora-circulo', 'jau-escena__foto', 'full' ); // phpcs:ignore ?>

<!-- wp:group {"className":"jau-botellas","layout":{"type":"default"}} -->
<div class="wp-block-group jau-botellas"><?php echo $jau_botella( 'frugy-durazno-botella' ) . "

" . $jau_botella( 'frugy-manzana-botella', 'media' ) . "

" . $jau_botella( 'drink-cola-1-5-l', 'centro' ) . "

" . $jau_botella( 'frugy-naranja-botella', 'media' ) . "

" . $jau_botella( 'drink-cola-400-ml' ); // phpcs:ignore ?></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->
