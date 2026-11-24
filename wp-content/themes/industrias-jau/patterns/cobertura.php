<?php
/**
 * Title: Cobertura · estados con presencia
 * Slug: industrias-jau/cobertura
 * Categories: industrias-jau
 * Description: Los 16 estados donde están los productos (DWIJ-85), como etiquetas sin numeración. Ancla #cobertura.
 * Keywords: cobertura, estados, presencia
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

// Orden del documento del cliente (24/11/2026), sin los números.
$jau_estados = array( 'Zulia', 'Falcón', 'Barinas', 'Carabobo', 'Lara', 'Nueva Esparta', 'Delta Amacuro', 'Miranda', 'La Guaira', 'Sucre', 'Bolívar', 'Distrito Capital', 'Portuguesa', 'Anzoátegui', 'Trujillo', 'Monagas' );
?>
<!-- wp:group {"tagName":"section","anchor":"cobertura","className":"jau-cobertura","style":{"spacing":{"padding":{"top":"24px","bottom":"56px"}}},"layout":{"type":"constrained"}} -->
<section id="cobertura" class="wp-block-group jau-cobertura" style="padding-top:24px;padding-bottom:56px"><!-- wp:group {"className":"is-style-tarjeta","style":{"spacing":{"padding":{"top":"28px","bottom":"28px","left":"28px","right":"28px"},"blockGap":"22px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-tarjeta" style="padding-top:28px;padding-right:28px;padding-bottom:28px;padding-left:28px"><!-- wp:group {"className":"jau-cobertura__cabecera","style":{"spacing":{"blockGap":"14px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group jau-cobertura__cabecera"><!-- wp:industrias-jau/icono {"icono":"pin","tamano":44,"estilo":"caja"} /-->

<!-- wp:heading {"fontSize":"subtitulo"} -->
<h2 class="wp-block-heading has-subtitulo-font-size">Estados en donde se encuentran nuestros productos</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:list {"className":"jau-estados"} -->
<ul class="wp-block-list jau-estados"><?php foreach ( $jau_estados as $jau_i => $jau_e ) : ?><?php echo $jau_i ? "\n\n" : ''; ?><!-- wp:list-item -->
<li><?php echo esc_html( $jau_e ); ?></li>
<!-- /wp:list-item --><?php endforeach; ?></ul>
<!-- /wp:list --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
