<?php
/**
 * Set de íconos propio de Industrias JAU (trazos 24×24, stroke = currentColor).
 * Origen: prototipo A (jau-data.js → JAU.iconos) + íconos nuevos para teléfono, visión y planta.
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

/**
 * Devuelve el catálogo de íconos: clave => [ 'nombre' => etiqueta, 'd' => trazo SVG ].
 *
 * @return array<string, array{nombre: string, d: string}>
 */
function jau_tema_iconos() {
	return array(
		'caja'     => array( 'nombre' => 'Caja / portafolio', 'd' => 'M3 7.5 12 3l9 4.5v9L12 21l-9-4.5z M3 7.5 12 12l9-4.5 M12 12v9' ),
		'pin'      => array( 'nombre' => 'Ubicación', 'd' => 'M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21z M12 7.5a2 2 0 1 0 0 4 2 2 0 0 0 0-4z' ),
		'doc'      => array( 'nombre' => 'Documento', 'd' => 'M6 3h9l4 4v14H6z M14 3v5h5 M9 13h7 M9 17h7' ),
		'chat'     => array( 'nombre' => 'Conversación', 'd' => 'M4 5h16v11H10l-6 4z M8 10h8' ),
		'mail'     => array( 'nombre' => 'Correo', 'd' => 'M3 6h18v12H3z M3 6l9 7 9-7' ),
		'red'      => array( 'nombre' => 'Redes / web', 'd' => 'M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18z M3 12h18 M12 3c3 3.5 3 14.5 0 18 M12 3c-3 3.5-3 14.5 0 18' ),
		'reloj'    => array( 'nombre' => 'Reloj / historia', 'd' => 'M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18z M12 7v5l3 2' ),
		'meta'     => array( 'nombre' => 'Diana / misión', 'd' => 'M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18z M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8z' ),
		'vision'   => array( 'nombre' => 'Ojo / visión', 'd' => 'M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12z M12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6z' ),
		'valores'  => array( 'nombre' => 'Corazón / valores', 'd' => 'M12 20s-7-4.5-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.5-7 10-7 10z' ),
		'camion'   => array( 'nombre' => 'Camión / despacho', 'd' => 'M2 6h12v10H2z M14 10h4l3 3v3h-7 M6 18.5a1.5 1.5 0 1 0 0 .01 M17 18.5a1.5 1.5 0 1 0 0 .01' ),
		'fabrica'  => array( 'nombre' => 'Planta / fábrica', 'd' => 'M3 21V10l5 3v-3l5 3v-3l5 3V4h3v17z M7 17h2 M12 17h2 M17 17h2' ),
		'telefono' => array( 'nombre' => 'Teléfono', 'd' => 'M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2' ),
		'flecha'   => array( 'nombre' => 'Flecha', 'd' => 'M5 12h14 M13 6l6 6-6 6' ),
		'wa'       => array( 'nombre' => 'WhatsApp', 'd' => 'M5 19.5l1.2-3.7A8 8 0 1 1 9 18.7z M9 9.5c.3 2.2 2.3 4.2 4.5 4.5l1-1.2 2 .9' ),
		'check'    => array( 'nombre' => 'Confirmación', 'd' => 'M5 12.5l4.5 4.5L19 7.5' ),
	);
}

/**
 * SVG en línea de un ícono.
 *
 * @param string $clave  Clave del ícono.
 * @param int    $tamano Tamaño en px.
 * @param float  $trazo  Grosor del trazo.
 * @return string
 */
function jau_tema_svg( $clave, $tamano = 24, $trazo = 1.7 ) {
	$iconos = jau_tema_iconos();
	if ( ! isset( $iconos[ $clave ] ) ) {
		return '';
	}
	return sprintf(
		'<svg class="jau-svg" width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%2$s" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="%3$s"></path></svg>',
		(int) $tamano,
		esc_attr( (string) $trazo ),
		esc_attr( $iconos[ $clave ]['d'] )
	);
}
