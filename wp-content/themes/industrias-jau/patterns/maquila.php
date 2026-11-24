<?php
/**
 * Title: JAU Maquila (página Servicios)
 * Slug: industrias-jau/maquila
 * Categories: industrias-jau
 * Description: Servicio de fabricación de bebidas para otras marcas (DWIJ-83); cierra con su propio formulario «Contáctanos» (DWIJ-84), distinto del de distribuidores. Ancla #maquila.
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
<!-- wp:group {"tagName":"section","anchor":"maquila","align":"full","className":"jau-maquila","style":{"spacing":{"padding":{"top":"56px","bottom":"60px"},"blockGap":"44px"}},"backgroundColor":"primary-tint","layout":{"type":"constrained"}} -->
<section id="maquila" class="wp-block-group alignfull jau-maquila has-primary-tint-background-color has-background" style="padding-top:56px;padding-bottom:60px"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"28px","left":"48px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"56%","style":{"spacing":{"blockGap":"14px"}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:56%"><!-- wp:heading {"fontSize":"destacado"} -->
<h2 class="wp-block-heading has-destacado-font-size">JAU Maquila</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"jau-lema"} -->
<p class="jau-lema">Tu marca, nuestra experiencia.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-2","fontSize":"md"} -->
<p class="has-ink-2-color has-text-color has-md-font-size">En Industrias JAU ponemos nuestra experiencia en la industria de bebidas al servicio de empresas y marcas que buscan un aliado para la fabricación de sus productos.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-2","fontSize":"md"} -->
<p class="has-ink-2-color has-text-color has-md-font-size">Ofrecemos soluciones de maquila adaptadas a las necesidades de cada proyecto, con el compromiso de establecer relaciones comerciales sólidas y duraderas.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"44%","style":{"spacing":{"blockGap":"14px"}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:44%"><!-- wp:heading {"level":3,"fontSize":"lg"} -->
<h3 class="wp-block-heading has-lg-font-size">Soluciones para tu marca</h3>
<!-- /wp:heading -->

<!-- wp:group {"className":"jau-maquila__soluciones","style":{"spacing":{"blockGap":"14px"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"150px"}} -->
<div class="wp-block-group jau-maquila__soluciones"><?php foreach ( $jau_soluciones as $jau_i => $jau_s ) : ?><?php echo $jau_i ? "\n\n" : ''; ?><!-- wp:group {"className":"is-style-tarjeta","style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"20px","right":"20px"},"blockGap":"14px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group is-style-tarjeta" style="padding-top:24px;padding-right:20px;padding-bottom:24px;padding-left:20px"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_s[0] ); ?>","tamano":52,"estilo":"caja"} /-->

<!-- wp:heading {"level":4,"textAlign":"center","fontSize":"lg"} -->
<h4 class="wp-block-heading has-text-align-center has-lg-font-size"><?php echo esc_html( $jau_s[1] ); ?></h4>
<!-- /wp:heading --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:group {"className":"jau-maquila__razones","style":{"spacing":{"blockGap":"18px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group jau-maquila__razones"><!-- wp:heading {"level":3,"fontSize":"subtitulo"} -->
<h3 class="wp-block-heading has-subtitulo-font-size">¿Por qué trabajar con nosotros?</h3>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"240px"}} -->
<div class="wp-block-group"><?php foreach ( $jau_razones as $jau_i => $jau_r ) : ?><?php echo $jau_i ? "\n\n" : ''; ?><!-- wp:group {"className":"is-style-tarjeta-hover","style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"},"blockGap":"12px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group is-style-tarjeta-hover" style="padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_r[0] ); ?>","tamano":40} /-->

<!-- wp:heading {"level":4,"fontSize":"lg"} -->
<h4 class="wp-block-heading has-lg-font-size"><?php echo esc_html( $jau_r[1] ); ?></h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-2","fontSize":"sm"} -->
<p class="has-ink-2-color has-text-color has-sm-font-size"><?php echo esc_html( $jau_r[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:jau/formulario-distribuidor {"formulario":"maquila"} /--></section>
<!-- /wp:group -->
