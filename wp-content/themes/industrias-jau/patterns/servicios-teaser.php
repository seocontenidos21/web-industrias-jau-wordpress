<?php
/**
 * Title: Servicios para distribuidores (resumen)
 * Slug: industrias-jau/servicios-teaser
 * Categories: industrias-jau
 * Description: Banda blanca con los 4 servicios para distribuidores e íconos, y enlace a Servicios (DWIJ-28).
 * Keywords: servicios, distribuidores
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

$jau_servicios = array(
	array( 'caja', 'Portafolio de productos', 'Acceso a todas las bebidas que produce Industrias JAU, con un catálogo que crecerá el próximo año.' ),
	array( 'pin', 'Cobertura', 'Zonas de despacho y frecuencia de entrega para cada distribuidor.' ),
	array( 'doc', 'Condiciones comerciales', 'Pedido mínimo, formas de pago y lista de precios para distribuidores.' ),
	array( 'chat', 'Atención directa de ventas', 'Un canal de WhatsApp con el equipo de ventas para pedidos y consultas.' ),
);
?>
<!-- wp:group {"align":"full","className":"jau-banda-blanca","style":{"spacing":{"padding":{"top":"52px","bottom":"52px"},"blockGap":"24px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull jau-banda-blanca" style="padding-top:52px;padding-bottom:52px"><!-- wp:group {"className":"jau-seccion-head","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
<div class="wp-block-group jau-seccion-head"><!-- wp:group {"style":{"spacing":{"blockGap":"8px"},"layout":{"selfStretch":"fit"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading -->
<h2 class="wp-block-heading">Servicios para distribuidores</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-2"} -->
<p class="has-ink-2-color has-text-color">Lo que ofrece Industrias JAU a los negocios que se suman como distribuidores de sus bebidas.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-enlace"} -->
<div class="wp-block-button is-style-enlace"><a class="wp-block-button__link wp-element-button" href="/servicios/">Ver servicios</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","minimumColumnWidth":"250px"}} -->
<div class="wp-block-group"><?php foreach ( $jau_servicios as $jau_s ) : ?><!-- wp:group {"className":"is-style-tarjeta-hover","style":{"spacing":{"padding":{"top":"22px","bottom":"22px","left":"22px","right":"22px"},"blockGap":"12px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group is-style-tarjeta-hover" style="padding-top:22px;padding-right:22px;padding-bottom:22px;padding-left:22px"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_s[0] ); ?>","tamano":40} /-->

<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"18px"}}} -->
<h3 class="wp-block-heading" style="font-size:18px"><?php echo esc_html( $jau_s[1] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-2","fontSize":"sm"} -->
<p class="has-ink-2-color has-text-color has-sm-font-size"><?php echo esc_html( $jau_s[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group -->

<!-- wp:group {"className":"jau-cobertura-tira","style":{"spacing":{"padding":{"top":"14px","bottom":"14px","left":"18px","right":"18px"},"blockGap":"12px"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group jau-cobertura-tira" style="padding-top:14px;padding-right:18px;padding-bottom:14px;padding-left:18px"><!-- wp:industrias-jau/icono {"icono":"pin","tamano":22} /-->

<!-- wp:paragraph {"className":"jau-cobertura-tira__texto"} -->
<p class="jau-cobertura-tira__texto"><strong>Presentes en 16 estados</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"jau-mas"} -->
<p class="jau-mas"><a href="/servicios/#cobertura">Ver estados</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
