<?php
/**
 * Title: JAU Maquila (resumen para el inicio)
 * Slug: industrias-jau/maquila-teaser
 * Categories: industrias-jau
 * Description: Acceso a JAU Maquila desde el inicio (DWIJ-83), con enlace a Servicios › JAU Maquila.
 * Keywords: maquila, fabricación, marcas
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

$jau_soluciones = array(
	array( 'burbujas', 'Bebidas gaseosas' ),
	array( 'citrico', 'Bebidas saborizadas' ),
);
?>
<!-- wp:group {"align":"full","className":"jau-maquila-teaser","style":{"spacing":{"padding":{"top":"56px","bottom":"56px"}}},"backgroundColor":"primary-tint","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull jau-maquila-teaser has-primary-tint-background-color has-background" style="padding-top:56px;padding-bottom:56px"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"32px","left":"56px"}}}} -->
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

<!-- wp:buttons {"className":"jau-maquila-teaser__botones","style":{"spacing":{"margin":{"top":"28px"}}}} -->
<div class="wp-block-buttons jau-maquila-teaser__botones" style="margin-top:28px"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/servicios/#maquila">Conocer JAU Maquila</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
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
<!-- /wp:columns --></div>
<!-- /wp:group -->
