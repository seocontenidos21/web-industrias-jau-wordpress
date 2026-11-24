<?php
/**
 * Title: Contacto: formulario, tipos de contacto y mapa
 * Slug: industrias-jau/contacto
 * Categories: industrias-jau
 * Description: Formulario «Contáctanos» primero (campos del documento del cliente, DWIJ-84) y, a su lado, los tres tipos de contacto separados (distribuidores, cliente directo por ciudad y atención al consumidor, DWIJ-81), horario y redes; debajo, el mapa de la planta (DWIJ-55, DWIJ-62 a DWIJ-64).
 * Keywords: contacto, formulario, distribuidor, cliente, consumidor, mapa, whatsapp
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

// Ícono, título, descripción opcional y tipo del bloque jau/contactos.
$jau_tipos = array(
	array( 'camion', 'Distribuidores', '', 'distribuidores' ),
	array( 'caja', 'Cliente directo', '', 'cliente' ),
	array( 'chat', 'Atención al consumidor', 'Dudas, reclamos o comentarios sobre los productos.', 'consumidor' ),
);
// Líneas con un dato de «Datos de la empresa» al final de la columna: se ocultan solas si el dato está vacío.
$jau_datos = array(
	array( 'reloj', 'Horario de atención', 'horario' ),
	array( 'red', 'Redes sociales', 'redes' ),
);

/**
 * Cabecera de tarjeta: ícono en caja + título.
 *
 * @param string $icono  Ícono.
 * @param string $titulo Título.
 */
$jau_cabecera = function ( $icono, $titulo ) {
	?>
<!-- wp:group {"className":"jau-tipo-contacto__cabecera","style":{"spacing":{"blockGap":"12px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group jau-tipo-contacto__cabecera"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $icono ); ?>","tamano":40,"estilo":"caja"} /-->

<!-- wp:heading {"fontSize":"lg"} -->
<h2 class="wp-block-heading has-lg-font-size"><?php echo esc_html( $titulo ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->
	<?php
};
?>
<!-- wp:group {"tagName":"section","className":"jau-contacto","style":{"spacing":{"padding":{"top":"36px","bottom":"52px"},"blockGap":"40px"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group jau-contacto" style="padding-top:36px;padding-bottom:52px"><!-- wp:columns {"className":"jau-contacto__cols","style":{"spacing":{"blockGap":{"left":"20px","top":"20px"}}}} -->
<div class="wp-block-columns jau-contacto__cols"><!-- wp:column {"width":"62%"} -->
<div class="wp-block-column" style="flex-basis:62%"><!-- wp:jau/formulario-distribuidor /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"38%","className":"jau-contacto__lateral","style":{"spacing":{"blockGap":"12px"}}} -->
<div class="wp-block-column jau-contacto__lateral" style="flex-basis:38%"><?php foreach ( $jau_tipos as $jau_t ) : ?><!-- wp:group {"className":"is-style-tarjeta jau-tipo-contacto","style":{"spacing":{"padding":{"top":"18px","bottom":"18px","left":"18px","right":"18px"},"blockGap":"12px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group is-style-tarjeta jau-tipo-contacto" style="padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><?php $jau_cabecera( $jau_t[0], $jau_t[1] ); ?>

<?php if ( '' !== $jau_t[2] ) : ?><!-- wp:paragraph {"className":"jau-tipo-contacto__desc"} -->
<p class="jau-tipo-contacto__desc"><?php echo esc_html( $jau_t[2] ); ?></p>
<!-- /wp:paragraph -->

<?php endif; ?><!-- wp:jau/contactos {"tipo":"<?php echo esc_attr( $jau_t[3] ); ?>"} /--></div>
<!-- /wp:group -->

<?php endforeach; ?><?php foreach ( $jau_datos as $jau_d ) : ?><!-- wp:group {"className":"jau-contacto__dato","style":{"spacing":{"blockGap":"8px"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group jau-contacto__dato"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_d[0] ); ?>","tamano":18} /-->

<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"jau/empresa","args":{"key":"<?php echo esc_attr( $jau_d[2] ); ?>","etiqueta":"<?php echo esc_attr( $jau_d[1] ); ?>"}}}}} -->
<p><?php echo esc_html( $jau_d[1] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:heading -->
<h2 class="wp-block-heading">Cómo llegar a la planta</h2>
<!-- /wp:heading -->

<!-- wp:jau/mapa /--></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
