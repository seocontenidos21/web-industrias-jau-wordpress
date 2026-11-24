<?php
/**
 * Title: JAU Maquila (página Servicios)
 * Slug: industrias-jau/maquila
 * Categories: industrias-jau
 * Description: Servicio de fabricación de bebidas para otras marcas (DWIJ-83) y su formulario «Contáctanos» (DWIJ-84), distinto del de distribuidores. Cierra con una tarjeta azul en la misma línea del bloque de distribuidores. Ancla #maquila.
 * Keywords: maquila, fabricación, marcas
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

// Textos del documento del cliente (24/11/2026).
$jau_soluciones = array(
	array( 'burbujas', 'Bebidas gaseosas' ),
	array( 'citrico', 'Bebidas saborizadas' ),
);
$jau_razones    = array(
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
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"46%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:46%"><!-- wp:group {"className":"is-style-tarjeta jau-maquila__soluciones","style":{"spacing":{"padding":{"top":"26px","bottom":"10px","left":"26px","right":"26px"},"blockGap":"6px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-tarjeta jau-maquila__soluciones" style="padding-top:26px;padding-right:26px;padding-bottom:10px;padding-left:26px"><!-- wp:heading {"level":3,"fontSize":"lg"} -->
<h3 class="wp-block-heading has-lg-font-size">Soluciones para tu marca</h3>
<!-- /wp:heading --><?php foreach ( $jau_soluciones as $jau_s ) : ?>

<!-- wp:group {"className":"jau-maquila__solucion","style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group jau-maquila__solucion"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_s[0] ); ?>","tamano":52,"estilo":"caja"} /-->

<!-- wp:heading {"level":4,"fontSize":"lg"} -->
<h4 class="wp-block-heading has-lg-font-size"><?php echo esc_html( $jau_s[1] ); ?></h4>
<!-- /wp:heading --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"className":"jau-maquila__razones","style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group jau-maquila__razones"><!-- wp:heading {"level":3,"fontSize":"subtitulo"} -->
<h3 class="wp-block-heading has-subtitulo-font-size">¿Por qué trabajar con nosotros?</h3>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"blockGap":"32px"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"240px"}} -->
<div class="wp-block-group"><?php foreach ( $jau_razones as $jau_i => $jau_r ) : ?><?php echo $jau_i ? "\n\n" : ''; ?><!-- wp:group {"className":"jau-razon","style":{"spacing":{"blockGap":"10px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group jau-razon"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_r[0] ); ?>","tamano":34} /-->

<!-- wp:heading {"level":4,"fontSize":"lg"} -->
<h4 class="wp-block-heading has-lg-font-size"><?php echo esc_html( $jau_r[1] ); ?></h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-2","fontSize":"sm"} -->
<p class="has-ink-2-color has-text-color has-sm-font-size"><?php echo esc_html( $jau_r[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"jau-cierre jau-cierre--maquila","style":{"spacing":{"padding":{"top":"clamp(28px, 4vw, 48px)","bottom":"clamp(28px, 4vw, 48px)","left":"clamp(24px, 4vw, 48px)","right":"clamp(24px, 4vw, 48px)"}}},"backgroundColor":"primary","textColor":"white","layout":{"type":"default"}} -->
<div class="wp-block-group jau-cierre jau-cierre--maquila has-white-color has-primary-background-color has-text-color has-background" style="padding-top:clamp(28px, 4vw, 48px);padding-right:clamp(24px, 4vw, 48px);padding-bottom:clamp(28px, 4vw, 48px);padding-left:clamp(24px, 4vw, 48px)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"28px","left":"48px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"36%","className":"jau-cierre__texto","style":{"spacing":{"blockGap":"14px"}}} -->
<div class="wp-block-column is-vertically-aligned-center jau-cierre__texto" style="flex-basis:36%"><!-- wp:heading {"fontSize":"destacado"} -->
<h2 class="wp-block-heading has-destacado-font-size">Contáctanos</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Ofrecemos soluciones de maquila adaptadas a las necesidades de cada proyecto, con el compromiso de establecer relaciones comerciales sólidas y duraderas.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"64%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:64%"><!-- wp:jau/formulario-distribuidor {"formulario":"maquila"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
