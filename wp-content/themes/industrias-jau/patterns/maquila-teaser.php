<?php
/**
 * Title: JAU Maquila (resumen para el inicio)
 * Slug: industrias-jau/maquila-teaser
 * Categories: industrias-jau
 * Description: Acceso a JAU Maquila desde el inicio (DWIJ-83): textos del cliente, las tres razones como lista y una escena con botellas (gaseosa y saborizada) sobre el círculo azul, con las dos soluciones como etiquetas.
 * Keywords: maquila, fabricación, marcas
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

// Textos del documento del cliente (24/11/2026).
$jau_razones = array(
	'Soluciones adaptadas a cada cliente.',
	'Asesoría en requerimientos de empaque.',
	'Coordinación de la producción y el suministro.',
);
?>
<!-- wp:group {"align":"full","className":"jau-maquila-teaser","style":{"spacing":{"padding":{"top":"64px","bottom":"64px"}}},"backgroundColor":"primary-tint","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull jau-maquila-teaser has-primary-tint-background-color has-background" style="padding-top:64px;padding-bottom:64px"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"36px","left":"56px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"52%","style":{"spacing":{"blockGap":"14px"}}} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:52%"><!-- wp:heading {"fontSize":"destacado"} -->
<h2 class="wp-block-heading has-destacado-font-size">JAU Maquila</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"jau-lema"} -->
<p class="jau-lema">Tu marca, nuestra experiencia.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"ink-2","fontSize":"md"} -->
<p class="has-ink-2-color has-text-color has-md-font-size">En Industrias JAU ponemos nuestra experiencia en la industria de bebidas al servicio de empresas y marcas que buscan un aliado para la fabricación de sus productos.</p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"jau-checklist"} -->
<ul class="wp-block-list jau-checklist"><?php foreach ( $jau_razones as $jau_i => $jau_r ) : ?><?php echo $jau_i ? "\n\n" : ''; ?><!-- wp:list-item -->
<li><?php echo esc_html( $jau_r ); ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list -->

<!-- wp:buttons {"className":"jau-maquila-teaser__botones","style":{"spacing":{"margin":{"top":"28px"}}}} -->
<div class="wp-block-buttons jau-maquila-teaser__botones" style="margin-top:28px"><!-- wp:button {"className":"jau-btn-flecha"} -->
<div class="wp-block-button jau-btn-flecha"><a class="wp-block-button__link wp-element-button" href="/servicios/#maquila">Conocer JAU Maquila</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-contorno"} -->
<div class="wp-block-button is-style-contorno"><a class="wp-block-button__link wp-element-button" href="/servicios/#contacto-maquila">Contáctanos</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"48%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:48%"><?php echo jau_tema_escena_maquila(); // phpcs:ignore ?></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
