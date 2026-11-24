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
<!-- wp:group {"align":"full","className":"jau-maquila-teaser","style":{"spacing":{"padding":{"top":"52px","bottom":"52px"}}},"backgroundColor":"primary-tint","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull jau-maquila-teaser has-primary-tint-background-color has-background" style="padding-top:52px;padding-bottom:52px"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"28px","left":"48px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"56%","style":{"spacing":{"blockGap":"14px"}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:56%"><!-- wp:paragraph {"className":"jau-kicker"} -->
<p class="jau-kicker">JAU Maquila</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"fontSize":"destacado"} -->
<h2 class="wp-block-heading has-destacado-font-size">Tu marca, nuestra experiencia.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"ink-2","fontSize":"md"} -->
<p class="has-ink-2-color has-text-color has-md-font-size">En Industrias JAU ponemos nuestra experiencia en la industria de bebidas al servicio de empresas y marcas que buscan un aliado para la fabricación de sus productos.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"8px"}}}} -->
<div class="wp-block-buttons" style="margin-top:8px"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/servicios/#maquila">Conocer JAU Maquila</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"44%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:44%"><!-- wp:group {"className":"jau-maquila__soluciones","style":{"spacing":{"blockGap":"14px"}},"layout":{"type":"grid","columnCount":2,"minimumColumnWidth":"150px"}} -->
<div class="wp-block-group jau-maquila__soluciones"><?php foreach ( $jau_soluciones as $jau_i => $jau_s ) : ?><?php echo $jau_i ? "\n\n" : ''; ?><!-- wp:group {"className":"is-style-tarjeta","style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"20px","right":"20px"},"blockGap":"14px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group is-style-tarjeta" style="padding-top:24px;padding-right:20px;padding-bottom:24px;padding-left:20px"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_s[0] ); ?>","tamano":52,"estilo":"caja"} /-->

<!-- wp:heading {"level":3,"textAlign":"center","fontSize":"lg"} -->
<h3 class="wp-block-heading has-text-align-center has-lg-font-size"><?php echo esc_html( $jau_s[1] ); ?></h3>
<!-- /wp:heading --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
