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
		'escudo'   => array( 'nombre' => 'Escudo / integridad', 'd' => 'M12 3l7 3v5.5c0 4.3-2.9 8-7 9.5-4.1-1.5-7-5.2-7-9.5V6z M9 12l2 2 4-4' ),
		'manos'    => array( 'nombre' => 'Apretón de manos / confianza', 'd' => 'M11 17l2 2a1 1 0 1 0 3-3 M14 14l2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4 M21 3l1 11h-2 M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3 M3 4h8' ),
		'estrella' => array( 'nombre' => 'Estrella / excelencia', 'd' => 'M12 3.5l2.6 5.3 5.9.9-4.3 4.1 1 5.8L12 16.8l-5.2 2.8 1-5.8-4.3-4.1 5.9-.9z' ),
		'sonrisa'  => array( 'nombre' => 'Sonrisa / alegría', 'd' => 'M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18z M8.5 14a4.5 4.5 0 0 0 7 0 M9 9.5h.01 M15 9.5h.01' ),
		// JAU Maquila (DWIJ-83).
		'burbujas'   => array( 'nombre' => 'Burbujas / gaseosa', 'd' => 'M4.5 16a3.5 3.5 0 1 0 7 0 3.5 3.5 0 1 0-7 0z M13 8.5a3 3 0 1 0 6 0 3 3 0 1 0-6 0z M14.5 17.5a2 2 0 1 0 4 0 2 2 0 1 0-4 0z M6 6.5a2 2 0 1 0 4 0 2 2 0 1 0-4 0z' ),
		'citrico'    => array( 'nombre' => 'Fruta / saborizada', 'd' => 'M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18z M12 6a6 6 0 1 0 0 12 6 6 0 0 0 0-12z M12 6v12 M6 12h12 M7.8 7.8l8.4 8.4 M16.2 7.8l-8.4 8.4' ),
		'ajustes'    => array( 'nombre' => 'Ajustes / a la medida', 'd' => 'M4 6h9 M17 6h3 M15 4v4 M4 12h3 M11 12h9 M9 10v4 M4 18h11 M19 18h1 M17 16v4' ),
		'botella'    => array( 'nombre' => 'Botella / empaque', 'd' => 'M10 2.5h4 M10.5 2.5v3L9 8.5V20a1.5 1.5 0 0 0 1.5 1.5h3A1.5 1.5 0 0 0 15 20V8.5l-1.5-3v-3 M9 12h6 M9 16h6' ),
		'maletin'    => array( 'nombre' => 'Maletín / trabaja con nosotros', 'd' => 'M3 8h18v12H3z M8 8V5.5A1.5 1.5 0 0 1 9.5 4h5A1.5 1.5 0 0 1 16 5.5V8 M3 13h18 M10.5 13v2h3v-2' ),
		'calendario' => array( 'nombre' => 'Calendario / coordinación', 'd' => 'M4 5h16v15H4z M4 9h16 M8 3v4 M16 3v4 M8 13h3 M13 13h3 M8 16.5h3' ),
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
