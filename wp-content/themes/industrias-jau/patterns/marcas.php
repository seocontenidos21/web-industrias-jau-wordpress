<?php
/**
 * Title: Nuestras marcas
 * Slug: industrias-jau/marcas
 * Categories: industrias-jau
 * Description: Tarjetas de las marcas (Drink Cola y Frugy) que llevan al catálogo filtrado. Reemplaza a «Líneas de producto».
 * Keywords: marcas, líneas, productos
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","className":"jau-marcas","style":{"spacing":{"padding":{"top":"48px","bottom":"8px"},"blockGap":"20px"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group jau-marcas" style="padding-top:48px;padding-bottom:8px"><!-- wp:heading -->
<h2 class="wp-block-heading">Nuestras marcas</h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"240px"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"is-style-tarjeta-hover jau-card-link jau-marca-card jau-marca--drink-cola","style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"},"blockGap":"10px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group is-style-tarjeta-hover jau-card-link jau-marca-card jau-marca--drink-cola" style="padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><?php echo jau_tema_bloque_imagen( 'logo-drink-cola', 'jau-marca-logo', 'medium' ); // phpcs:ignore ?>

<!-- wp:heading {"level":3,"fontSize":"lg"} -->
<h3 class="wp-block-heading has-lg-font-size"><a href="/productos/?marca=drink-cola">Drink Cola</a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"sm"} -->
<p class="has-muted-color has-text-color has-sm-font-size">Bebida gaseosa de cola negra, en presentaciones de 400 mL y 1.5 L.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"jau-mas","fontSize":"sm"} -->
<p class="jau-mas has-sm-font-size">Ver productos</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"is-style-tarjeta-hover jau-card-link jau-marca-card jau-marca--frugy","style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"},"blockGap":"10px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group is-style-tarjeta-hover jau-card-link jau-marca-card jau-marca--frugy" style="padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px"><?php echo jau_tema_bloque_imagen( 'logo-frugy-verde-blanco', 'jau-marca-logo', 'medium' ); // phpcs:ignore ?>

<!-- wp:heading {"level":3,"fontSize":"lg"} -->
<h3 class="wp-block-heading has-lg-font-size"><a href="/productos/?marca=frugy">Frugy</a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","fontSize":"sm"} -->
<p class="has-muted-color has-text-color has-sm-font-size">Bebidas saborizadas a frutas en 6 sabores: manzana, naranja, pera, durazno, mango y limón-coco. En 250 mL, 500 mL y 1.5 L.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"jau-mas","fontSize":"sm"} -->
<p class="jau-mas has-sm-font-size">Ver sabores</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
