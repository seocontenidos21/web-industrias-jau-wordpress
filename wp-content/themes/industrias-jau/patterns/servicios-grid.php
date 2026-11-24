<?php
/**
 * Title: Servicios para distribuidores (página)
 * Slug: industrias-jau/servicios-grid
 * Categories: industrias-jau
 * Description: Los 4 servicios para distribuidores en tarjetas horizontales con ícono. «Cobertura» enlaza a los estados (DWIJ-85).
 * Keywords: servicios, distribuidores
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

$jau_servicios = array(
	array( 'caja', 'Portafolio de productos', 'Acceso a todas las bebidas que produce Industrias JAU: Drink Cola y Frugy, con un catálogo que crecerá el próximo año.', '/productos/', 'Ver productos' ),
	array( 'pin', 'Cobertura', 'Zonas de despacho y frecuencia de entrega para cada distribuidor.', '#cobertura', 'Ver estados' ),
	array( 'doc', 'Condiciones comerciales', 'Pedido mínimo, formas de pago y lista de precios para distribuidores.', '', '' ),
	array( 'chat', 'Atención directa de ventas', 'Un canal de WhatsApp con el equipo de ventas para pedidos y consultas.', '/contacto/', 'Escribir a ventas' ),
);
?>
<!-- wp:group {"tagName":"section","anchor":"distribuidores","className":"jau-servicios","style":{"spacing":{"padding":{"top":"40px","bottom":"24px"},"blockGap":"20px"}},"layout":{"type":"constrained"}} -->
<section id="distribuidores" class="wp-block-group jau-servicios" style="padding-top:40px;padding-bottom:24px"><!-- wp:group {"style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading -->
<h2 class="wp-block-heading">Servicios para distribuidores</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-2"} -->
<p class="has-ink-2-color has-text-color">Lo que ofrece Industrias JAU a los negocios que se suman como distribuidores de sus bebidas.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"18px"}},"layout":{"type":"grid","minimumColumnWidth":"420px"}} -->
<div class="wp-block-group"><?php foreach ( $jau_servicios as $jau_s ) : ?><!-- wp:group {"className":"is-style-tarjeta-hover","style":{"spacing":{"padding":{"top":"26px","bottom":"26px","left":"26px","right":"26px"},"blockGap":"18px"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group is-style-tarjeta-hover" style="padding-top:26px;padding-right:26px;padding-bottom:26px;padding-left:26px"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_s[0] ); ?>","tamano":44} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"fontSize":"xl"} -->
<h3 class="wp-block-heading has-xl-font-size"><?php echo esc_html( $jau_s[1] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-2"} -->
<p class="has-ink-2-color has-text-color"><?php echo esc_html( $jau_s[2] ); ?></p>
<!-- /wp:paragraph --><?php if ( $jau_s[3] ) : ?>

<!-- wp:paragraph {"className":"jau-mas"} -->
<p class="jau-mas"><a href="<?php echo esc_attr( $jau_s[3] ); ?>"><?php echo esc_html( $jau_s[4] ); ?></a></p>
<!-- /wp:paragraph --><?php endif; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
