<?php
/**
 * Industrias JAU · configuración extra para el contenedor (se incluye desde wp-config.php).
 *
 * @package industrias-jau
 */

// HTTPS detrás del proxy de Railway.
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO'] ) {
	$_SERVER['HTTPS'] = 'on';
}

// Dominio público: el que asigna Railway, o uno propio en JAU_DOMINIO.
$jau_dominio = getenv( 'JAU_DOMINIO' ) ? getenv( 'JAU_DOMINIO' ) : getenv( 'RAILWAY_PUBLIC_DOMAIN' );
if ( $jau_dominio && ! defined( 'WP_HOME' ) ) {
	define( 'WP_HOME', 'https://' . $jau_dominio );
	define( 'WP_SITEURL', 'https://' . $jau_dominio );
}

if ( ! defined( 'WP_ENVIRONMENT_TYPE' ) ) {
	define( 'WP_ENVIRONMENT_TYPE', getenv( 'WP_ENVIRONMENT_TYPE' ) ? getenv( 'WP_ENVIRONMENT_TYPE' ) : 'staging' );
}

// El código viene del repo: no se editan ni instalan archivos desde el admin
// (se perderían en el próximo despliegue). Las versiones las fija el Dockerfile.
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', true );
define( 'AUTOMATIC_UPDATER_DISABLED', true );

// Entorno de pruebas: que los buscadores no lo indexen.
if ( 'production' !== WP_ENVIRONMENT_TYPE && ! headers_sent() && 'cli' !== PHP_SAPI ) {
	header( 'X-Robots-Tag: noindex, nofollow' );
}
