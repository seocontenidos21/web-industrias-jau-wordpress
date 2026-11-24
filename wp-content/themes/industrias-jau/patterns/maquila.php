<?php
/**
 * Title: JAU Maquila (página Servicios)
 * Slug: industrias-jau/maquila
 * Categories: industrias-jau
 * Description: Servicio de fabricación de bebidas para otras marcas (DWIJ-83) y su formulario «Contáctanos» (DWIJ-84), distinto del de distribuidores. Cierra con «Contáctanos»: cabecera azul en la línea del bloque de distribuidores unida al formulario sobre blanco (referencia del cliente: celema.co). Ancla #maquila.
 * Keywords: maquila, fabricación, marcas
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

// Textos del documento del cliente (24/11/2026).
$jau_razones = array(
	array( 'ajustes', 'Soluciones adaptadas a cada cliente.', 'Estudiamos las necesidades particulares de cada proyecto para ofrecer una propuesta de maquila acorde con sus requerimientos.' ),
	array( 'botella', 'Asesoría en requerimientos de empaque.', 'Orientación sobre las características y necesidades de presentación de cada producto.' ),
	array( 'calendario', 'Coordinación de la producción y el suministro.', 'Buscamos establecer acuerdos de trabajo que permitan organizar las condiciones de fabricación y entrega de cada proyecto.' ),
);
?>
<!-- wp:group {"tagName":"section","anchor":"maquila","align":"full","className":"jau-maquila","style":{"spacing":{"padding":{"top":"64px","bottom":"64px"},"blockGap":"56px"}},"backgroundColor":"primary-tint","layout":{"type":"constrained"}} -->
<section id="maquila" class="wp-block-group alignfull jau-maquila has-primary-tint-background-color has-background" style="padding-top:64px;padding-bottom:64px"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"32px","left":"56px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"54%","style":{"spacing":{"blockGap":"14px"}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:54%"><!-- wp:heading {"fontSize":"destacado"} -->
<h2 class="wp-block-heading has-destacado-font-size">JAU Maquila</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"jau-lema"} -->
<p class="jau-lema">Tu marca, nuestra experiencia.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-2","fontSize":"md"} -->
<p class="has-ink-2-color has-text-color has-md-font-size">En Industrias JAU ponemos nuestra experiencia en la industria de bebidas al servicio de empresas y marcas que buscan un aliado para la fabricación de sus productos.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"className":"jau-razones-titulo","fontSize":"xl"} -->
<h3 class="wp-block-heading jau-razones-titulo has-xl-font-size">¿Por qué trabajar con nosotros?</h3>
<!-- /wp:heading -->

<!-- wp:group {"className":"jau-razones-lista","style":{"spacing":{"blockGap":"18px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group jau-razones-lista"><?php foreach ( $jau_razones as $jau_i => $jau_r ) : ?><?php echo $jau_i ? "

" : ''; ?><!-- wp:group {"className":"jau-razon-fila","style":{"spacing":{"blockGap":"14px"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group jau-razon-fila"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_r[0] ); ?>","tamano":44,"estilo":"caja"} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"4px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"fontSize":"md"} -->
<h4 class="wp-block-heading has-md-font-size"><?php echo esc_html( $jau_r[1] ); ?></h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-2","fontSize":"sm"} -->
<p class="has-ink-2-color has-text-color has-sm-font-size"><?php echo esc_html( $jau_r[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"46%","style":{"spacing":{"blockGap":"6px"}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:46%"><!-- wp:heading {"level":3,"textAlign":"center","className":"jau-maquila__soluciones-titulo","fontSize":"lg"} -->
<h3 class="wp-block-heading has-text-align-center jau-maquila__soluciones-titulo has-lg-font-size">Soluciones para tu marca</h3>
<!-- /wp:heading -->

<?php echo jau_tema_escena_maquila(); // phpcs:ignore ?></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"className":"jau-maquila-contacto","style":{"spacing":{"blockGap":"0px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group jau-maquila-contacto"><!-- wp:group {"className":"jau-cierre jau-maquila-contacto__cabecera","style":{"spacing":{"padding":{"top":"clamp(28px, 3.5vw, 40px)","bottom":"clamp(28px, 3.5vw, 40px)","left":"clamp(22px, 4vw, 48px)","right":"clamp(22px, 4vw, 48px)"},"blockGap":"10px"}},"backgroundColor":"primary","textColor":"white","layout":{"type":"default"}} -->
<div class="wp-block-group jau-cierre jau-maquila-contacto__cabecera has-white-color has-primary-background-color has-text-color has-background" style="padding-top:clamp(28px, 3.5vw, 40px);padding-right:clamp(22px, 4vw, 48px);padding-bottom:clamp(28px, 3.5vw, 40px);padding-left:clamp(22px, 4vw, 48px)"><!-- wp:heading {"fontSize":"destacado"} -->
<h2 class="wp-block-heading has-destacado-font-size">Contáctanos</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Ofrecemos soluciones de maquila adaptadas a las necesidades de cada proyecto, con el compromiso de establecer relaciones comerciales sólidas y duraderas.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"jau-maquila-contacto__cuerpo","style":{"spacing":{"padding":{"top":"32px","bottom":"36px","left":"clamp(18px, 4vw, 48px)","right":"clamp(18px, 4vw, 48px)"}}},"backgroundColor":"white","layout":{"type":"default"}} -->
<div class="wp-block-group jau-maquila-contacto__cuerpo has-white-background-color has-background" style="padding-top:32px;padding-right:clamp(18px, 4vw, 48px);padding-bottom:36px;padding-left:clamp(18px, 4vw, 48px)"><!-- wp:jau/formulario-distribuidor {"formulario":"maquila"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
