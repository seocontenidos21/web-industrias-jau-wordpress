<?php
/**
 * Filtros del catálogo (DWIJ-67): marca (con logo), presentación, sabor y buscador.
 * Filtra en el navegador las tarjetas del Query Loop vecino (clases marca-*, presentacion-*, sabor-*).
 *
 * @package jau-core
 */

defined( 'ABSPATH' ) || exit;

$jau_marcas = jau_terminos( 'marca' );
$jau_pres   = jau_terminos( 'presentacion' );
$jau_sabor  = jau_terminos( 'sabor' );

// phpcs:disable WordPress.Security.NonceVerification.Recommended -- estado de filtros en la URL.
$jau_sel = array(
	'marca'        => isset( $_GET['marca'] ) ? sanitize_title( wp_unslash( $_GET['marca'] ) ) : '',
	'presentacion' => isset( $_GET['presentacion'] ) ? sanitize_title( wp_unslash( $_GET['presentacion'] ) ) : '',
	'sabor'        => isset( $_GET['sabor'] ) ? sanitize_title( wp_unslash( $_GET['sabor'] ) ) : '',
	'q'            => isset( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '',
);
// phpcs:enable

$jau_wrap = get_block_wrapper_attributes( array( 'class' => 'jau-filtros-bloque' ) );
?>
<div <?php echo $jau_wrap; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="jau-filtros" role="search" aria-label="Filtrar productos">
		<div class="jau-filtros__marcas" role="group" aria-label="Marca">
			<button type="button" class="jau-filtros__marca" data-marca="" aria-pressed="<?php echo '' === $jau_sel['marca'] ? 'true' : 'false'; ?>">Todas</button>
			<?php foreach ( $jau_marcas as $jau_m ) : ?>
				<button type="button" class="jau-filtros__marca" data-marca="<?php echo esc_attr( $jau_m->slug ); ?>" aria-pressed="<?php echo $jau_sel['marca'] === $jau_m->slug ? 'true' : 'false'; ?>">
					<?php echo jau_marca_logo( $jau_m ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php echo esc_html( $jau_m->name ); ?></span>
				</button>
			<?php endforeach; ?>
		</div>
		<div class="jau-filtros__der">
			<label class="jau-sr" for="jau-filtro-presentacion">Presentación</label>
			<select id="jau-filtro-presentacion" data-filtro="presentacion">
				<option value="">Todas las presentaciones</option>
				<?php foreach ( $jau_pres as $jau_t ) : ?>
					<option value="<?php echo esc_attr( $jau_t->slug ); ?>" <?php selected( $jau_sel['presentacion'], $jau_t->slug ); ?>><?php echo esc_html( $jau_t->name ); ?></option>
				<?php endforeach; ?>
			</select>
			<?php if ( $jau_sabor ) : ?>
				<label class="jau-sr" for="jau-filtro-sabor">Sabor</label>
				<select id="jau-filtro-sabor" data-filtro="sabor">
					<option value="">Todos los sabores</option>
					<?php foreach ( $jau_sabor as $jau_t ) : ?>
						<option value="<?php echo esc_attr( $jau_t->slug ); ?>" <?php selected( $jau_sel['sabor'], $jau_t->slug ); ?>><?php echo esc_html( $jau_t->name ); ?></option>
					<?php endforeach; ?>
				</select>
			<?php endif; ?>
			<label class="jau-sr" for="jau-filtro-q">Buscar producto</label>
			<input type="search" id="jau-filtro-q" data-filtro="q" placeholder="Buscar producto" value="<?php echo esc_attr( $jau_sel['q'] ); ?>">
		</div>
	</div>
	<p class="jau-filtros__total" aria-live="polite"></p>
	<div class="jau-filtros__vacio" hidden>
		<span>No hay productos con esos filtros.</span>
		<button type="button" class="jau-filtros__limpiar">Limpiar filtros</button>
	</div>
</div>
