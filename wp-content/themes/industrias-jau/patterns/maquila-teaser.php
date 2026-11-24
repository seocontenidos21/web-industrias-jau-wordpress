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
$jau_etiquetas = array(
	array( 'burbujas', 'Bebidas gaseosas', 'jau-escena__etiqueta--arriba' ),
	array( 'citrico', 'Bebidas saborizadas', 'jau-escena__etiqueta--abajo' ),
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
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:48%"><!-- wp:group {"className":"jau-escena jau-escena--maquila","layout":{"type":"default"}} -->
<div class="wp-block-group jau-escena jau-escena--maquila"><!-- wp:group {"className":"jau-botellas","layout":{"type":"default"}} -->
<div class="wp-block-group jau-botellas"><?php echo jau_tema_bloque_imagen( 'drink-cola-1-5-l', 'jau-botella jau-botella--centro', 'full' ) . "\n\n" . jau_tema_bloque_imagen( 'frugy-pina-colada-botella', 'jau-botella jau-botella--media', 'full' ); // phpcs:ignore ?></div>
<!-- /wp:group --><?php foreach ( $jau_etiquetas as $jau_e ) : ?>

<!-- wp:group {"className":"jau-escena__etiqueta <?php echo esc_attr( $jau_e[2] ); ?>","style":{"spacing":{"blockGap":"10px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group jau-escena__etiqueta <?php echo esc_attr( $jau_e[2] ); ?>"><!-- wp:industrias-jau/icono {"icono":"<?php echo esc_attr( $jau_e[0] ); ?>","tamano":40,"estilo":"caja"} /-->

<!-- wp:paragraph -->
<p><?php echo esc_html( $jau_e[1] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --><?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
