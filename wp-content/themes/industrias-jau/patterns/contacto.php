<?php
/**
 * Title: Contacto: tipos de contacto, formulario y mapa
 * Slug: industrias-jau/contacto
 * Categories: industrias-jau
 * Description: Tres tarjetas separadas (distribuidores, cliente directo por ciudad y atención al consumidor, DWIJ-81), horario, formulario «Quiero ser distribuidor» y mapa de la planta (DWIJ-55, DWIJ-62 a DWIJ-64).
 * Keywords: contacto, formulario, distribuidor, cliente, consumidor, mapa, whatsapp
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

// Ícono, título, descripción opcional, tipo del bloque jau/contactos y si lleva el botón al formulario.
$jau_tipos = array(
	array( 'camion', 'Distribuidores', '', 'distribuidores', true ),
	array( 'caja', 'Cliente directo', '', 'cliente', false ),
	array( 'chat', 'Atención al consumidor', 'Dudas, reclamos o comentarios sobre los productos.', 'consumidor', false ),
);
?>
<!-- wp:group {"tagName":"section","className":"jau-contacto","style":{"spacing":{"padding":{"top":"36px","bottom":"52px"},"blockGap":"28px"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group jau-contacto" style="padding-top:36px;padding-bottom:52px"><!-- wp:group {"className":"jau-tipos-contacto","style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"220px"}} -->
<div class="wp-block-group jau-tipos-contacto"><?php foreach ( $jau_tipos as $jau_t ) : ?><!-- wp:group {"className":"is-style-tarjeta jau-tipo-contacto","style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"22px","right":"22px"},"blockGap":"14px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group is-style-tarjeta jau-tipo-contacto" style="padding-top:24px;padding-right:22px;padding-bottom:24px;padding-left:22px"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_t[0] ); ?>","tamano":44,"estilo":"caja"} /-->

<!-- wp:heading {"fontSize":"lg"} -->
<h2 class="wp-block-heading has-lg-font-size"><?php echo esc_html( $jau_t[1] ); ?></h2>
<!-- /wp:heading -->

<?php if ( '' !== $jau_t[2] ) : ?><!-- wp:paragraph {"className":"jau-tipo-contacto__desc"} -->
<p class="jau-tipo-contacto__desc"><?php echo esc_html( $jau_t[2] ); ?></p>
<!-- /wp:paragraph -->

<?php endif; ?><!-- wp:jau/contactos {"tipo":"<?php echo esc_attr( $jau_t[3] ); ?>"} /-->
<?php if ( $jau_t[4] ) : ?>

<!-- wp:buttons {"className":"jau-tipo-contacto__cta"} -->
<div class="wp-block-buttons jau-tipo-contacto__cta"><!-- wp:button {"className":"is-style-enlace"} -->
<div class="wp-block-button is-style-enlace"><a class="wp-block-button__link wp-element-button" href="#formulario">Quiero ser distribuidor</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --><?php endif; ?></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group -->

<!-- wp:group {"className":"jau-contacto__info","style":{"spacing":{"blockGap":{"top":"10px","left":"28px"}}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group jau-contacto__info"><!-- wp:group {"className":"jau-contacto__dato","style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group jau-contacto__dato"><!-- wp:industrias-jau/icono {"icono":"reloj","tamano":20} /-->

<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"jau/empresa","args":{"key":"horario","etiqueta":"Horario de atención"}}}}} -->
<p>Horario de atención</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"jau-contacto__dato","style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group jau-contacto__dato"><!-- wp:industrias-jau/icono {"icono":"red","tamano":20} /-->

<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"jau/empresa","args":{"key":"redes","etiqueta":"Redes"}}}}} -->
<p>Redes sociales</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:columns {"className":"jau-contacto__cols","style":{"spacing":{"blockGap":{"left":"24px","top":"28px"}}}} -->
<div class="wp-block-columns jau-contacto__cols"><!-- wp:column {"width":"58%"} -->
<div class="wp-block-column" style="flex-basis:58%"><!-- wp:jau/formulario-distribuidor /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"42%","style":{"spacing":{"blockGap":"16px"}}} -->
<div class="wp-block-column" style="flex-basis:42%"><!-- wp:heading {"style":{"typography":{"fontSize":"24px"}}} -->
<h2 class="wp-block-heading" style="font-size:24px">Cómo llegar a la planta</h2>
<!-- /wp:heading -->

<!-- wp:jau/mapa /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
