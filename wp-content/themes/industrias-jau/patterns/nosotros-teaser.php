<?php
/**
 * Title: Sobre nosotros (resumen oscuro)
 * Slug: industrias-jau/nosotros-teaser
 * Categories: industrias-jau
 * Description: Bloque oscuro con foto, presentación de la empresa y enlace a Sobre nosotros.
 * Keywords: nosotros, empresa
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"align":"full","className":"jau-dark","style":{"spacing":{"padding":{"top":"52px","bottom":"52px"}}},"backgroundColor":"ink","textColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull jau-dark has-white-color has-ink-background-color has-text-color has-background" style="padding-top:52px;padding-bottom:52px"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"36px","top":"28px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"className":"jau-fotos","style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"120px"}} -->
<div class="wp-block-group jau-fotos"><?php echo jau_tema_bloque_imagen( 'frugy-desayuno-4', '', 'large' ) . "

" . jau_tema_bloque_imagen( 'frugy-kids-1', '', 'large' ); // phpcs:ignore ?></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"fontSize":"destacado"} -->
<h2 class="wp-block-heading has-destacado-font-size">Sobre nosotros</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#c9ccd3"}},"fontSize":"md"} -->
<p class="has-text-color has-md-font-size" style="color:#c9ccd3">Somos una empresa venezolana que produce Drink Cola y Frugy en su planta del Zulia, con la misión de resaltar lo hecho en Venezuela a través de cada sorbo de nuestras bebidas.</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"jau-valores-chips"} -->
<ul class="wp-block-list jau-valores-chips"><!-- wp:list-item -->
<li>Integridad</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Confianza</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Excelencia</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Alegría</li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li>Pasión por el bien</li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-contorno"} -->
<div class="wp-block-button is-style-contorno"><a class="wp-block-button__link wp-element-button" href="/sobre-nosotros/">Conocer la empresa</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
