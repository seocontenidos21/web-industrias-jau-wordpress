<?php
/**
 * Title: Contacto: formulario, canales y mapa
 * Slug: industrias-jau/contacto
 * Categories: industrias-jau
 * Description: Formulario «Quiero ser distribuidor», canales con los datos de la empresa, botón de WhatsApp y mapa de la planta (DWIJ-55, DWIJ-62 a DWIJ-64).
 * Keywords: contacto, formulario, distribuidor, mapa, whatsapp
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

$jau_canales = array(
	array( 'telefono', 'Teléfono y WhatsApp para distribuidores', 'telefono', true ),
	array( 'pin', 'Dirección de la planta', 'direccion', true ),
	array( 'reloj', 'Horario de atención', 'horario', false ),
	array( 'mail', 'Correo de solicitudes', 'correo', true ),
	array( 'red', 'Redes sociales', 'redes', false ),
);
?>
<!-- wp:group {"tagName":"section","className":"jau-contacto","style":{"spacing":{"padding":{"top":"36px","bottom":"52px"},"blockGap":"40px"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group jau-contacto" style="padding-top:36px;padding-bottom:52px"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"20px","top":"20px"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"width":"64%"} -->
<div class="wp-block-column" style="flex-basis:64%"><!-- wp:jau/formulario-distribuidor /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"36%","style":{"spacing":{"blockGap":"12px"}}} -->
<div class="wp-block-column" style="flex-basis:36%"><?php foreach ( $jau_canales as $jau_c ) : ?><!-- wp:group {"className":"is-style-tarjeta jau-canal","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group is-style-tarjeta jau-canal"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_c[0] ); ?>","tamano":44,"estilo":"caja"} /-->

<!-- wp:group {"className":"jau-canal__texto","layout":{"type":"default"}} -->
<div class="wp-block-group jau-canal__texto"><!-- wp:paragraph {"className":"jau-canal__titulo"} -->
<p class="jau-canal__titulo"><?php echo esc_html( $jau_c[1] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"jau-canal__valor","metadata":{"bindings":{"content":{"source":"jau/empresa","args":{"key":"<?php echo esc_attr( $jau_c[2] ); ?>"<?php echo $jau_c[3] ? ',"enlace":true' : ''; ?>}}}}} -->
<p class="jau-canal__valor"><?php echo esc_html( $jau_c[1] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php endforeach; ?><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"width":100,"className":"is-style-whatsapp","metadata":{"bindings":{"url":{"source":"jau/empresa","args":{"key":"whatsapp_url"}}}}} -->
<div class="wp-block-button has-custom-width wp-block-button__width-100 is-style-whatsapp"><a class="wp-block-button__link wp-element-button" href="#" target="_blank" rel="noreferrer noopener">Escríbenos por WhatsApp</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:heading -->
<h2 class="wp-block-heading">Cómo llegar a la planta</h2>
<!-- /wp:heading -->

<!-- wp:jau/mapa /--></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
