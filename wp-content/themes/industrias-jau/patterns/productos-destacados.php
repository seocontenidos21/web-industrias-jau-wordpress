<?php
/**
 * Title: Productos destacados
 * Slug: industrias-jau/productos-destacados
 * Categories: industrias-jau
 * Description: Los productos marcados como «Destacado en el inicio», en tarjetas con hover (DWIJ-27).
 * Keywords: productos, destacados, catálogo
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","className":"jau-destacados","style":{"spacing":{"padding":{"top":"44px","bottom":"52px"},"blockGap":"20px"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group jau-destacados" style="padding-top:44px;padding-bottom:52px"><!-- wp:group {"className":"jau-seccion-head","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group jau-seccion-head"><!-- wp:heading -->
<h2 class="wp-block-heading">Productos destacados</h2>
<!-- /wp:heading -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-enlace"} -->
<div class="wp-block-button is-style-enlace"><a class="wp-block-button__link wp-element-button" href="/productos/">Ver el catálogo completo</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":10,"query":{"perPage":4,"pages":0,"offset":0,"postType":"producto","order":"asc","orderBy":"menu_order","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"jau-productos jau-q-destacados"} -->
<div class="wp-block-query jau-productos jau-q-destacados"><!-- wp:post-template -->
<!-- wp:group {"className":"jau-producto","layout":{"type":"default"}} -->
<div class="wp-block-group jau-producto"><!-- wp:post-featured-image /-->

<!-- wp:group {"className":"jau-producto__cuerpo","layout":{"type":"default"}} -->
<div class="wp-block-group jau-producto__cuerpo"><!-- wp:post-terms {"term":"marca","className":"is-style-etiqueta"} /-->

<!-- wp:post-title {"level":3,"isLink":true} /-->

<!-- wp:jau/presentaciones {"modo":"chips"} /-->

<!-- wp:read-more {"content":"Ver producto"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></section>
<!-- /wp:group -->
