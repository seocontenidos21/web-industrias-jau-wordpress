<?php
/**
 * Plugin Name: JAU Core
 * Description: Funcionalidad del sitio de Industrias JAU: catálogo de productos (marcas, presentaciones y sabores), formulario «Quiero ser distribuidor» con registro de solicitudes y «Datos de la empresa» como fuente única de contacto.
 * Version: 1.0.0
 * Requires at least: 6.7
 * Requires PHP: 8.1
 * Author: SEO Contenidos
 * License: GPL-2.0-or-later
 * Text Domain: jau-core
 *
 * @package jau-core
 */

defined( 'ABSPATH' ) || exit;

define( 'JAU_CORE_VERSION', '1.0.0' );
define( 'JAU_CORE_DIR', __DIR__ );
define( 'JAU_CORE_URL', plugin_dir_url( __FILE__ ) );

require_once JAU_CORE_DIR . '/inc/empresa.php';
require_once JAU_CORE_DIR . '/inc/productos.php';
require_once JAU_CORE_DIR . '/inc/solicitudes.php';

/* Bloques dinámicos del plugin (sin compilación). */
add_action(
	'init',
	function () {
		foreach ( array( 'formulario-distribuidor', 'filtros-catalogo', 'ficha-datos', 'mapa', 'presentaciones' ) as $jau_bloque ) {
			register_block_type( JAU_CORE_DIR . '/blocks/' . $jau_bloque );
		}
	}
);

/* Al activar: registrar tipos de contenido y regenerar enlaces permanentes. */
register_activation_hook(
	__FILE__,
	function () {
		jau_registrar_productos();
		jau_registrar_solicitudes();
		flush_rewrite_rules();
	}
);
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );

/**
 * Marcador visible «por confirmar» (DWIJ-1).
 *
 * @param string $texto Texto del marcador.
 * @return string
 */
function jau_pc( $texto = 'Por confirmar' ) {
	return '<span class="jau-pc">' . esc_html( $texto ) . '</span>';
}
