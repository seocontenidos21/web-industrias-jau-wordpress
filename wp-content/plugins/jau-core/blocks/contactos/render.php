<?php
/**
 * Contactos de la empresa (DWIJ-81): distribuidores, cliente directo por ciudad y atención al
 * consumidor, con enlaces tel:, WhatsApp y mailto:. Los datos salen de «Datos de la empresa».
 * Cada número se muestra una sola vez y abre WhatsApp (o llama, si no tiene WhatsApp).
 * - «tarjeta»: filas con ícono para las tarjetas de Contacto.
 * - «compacta»: líneas cortas para el footer.
 *
 * @package jau-core
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$jau_grupos   = jau_contactos();
$jau_tipo     = isset( $attributes['tipo'] ) ? (string) $attributes['tipo'] : 'todos';
$jau_variante = ( isset( $attributes['variante'] ) && 'compacta' === $attributes['variante'] ) ? 'compacta' : 'tarjeta';

if ( 'todos' !== $jau_tipo ) {
	$jau_grupos = isset( $jau_grupos[ $jau_tipo ] ) ? array( $jau_tipo => $jau_grupos[ $jau_tipo ] ) : array();
}
if ( ! $jau_grupos ) {
	return;
}

$jau_svg = function ( $clave, $tamano = 18 ) {
	return function_exists( 'jau_tema_svg' ) ? jau_tema_svg( $clave, $tamano, 1.8 ) : '';
};
// Correo con un punto de corte después de «@» (en columnas angostas no se parte a mitad de palabra).
$jau_correo = function ( $correo ) {
	$partes = explode( '@', $correo, 2 );
	return 2 === count( $partes ) ? esc_html( $partes[0] ) . '@<wbr>' . esc_html( $partes[1] ) : esc_html( $correo );
};
// Un solo enlace por número: abre WhatsApp si el número lo tiene; si no, llama (tel:).
$jau_numero = function ( $grupo, $fila, $tamano ) use ( $jau_svg ) {
	$es_wa   = '' !== $fila['wa'];
	$destino = '' !== $fila['lugar'] ? $fila['lugar'] : $grupo['titulo'];
	return sprintf(
		'<a class="jau-contactos__num%1$s" href="%2$s"%3$s aria-label="%4$s">%5$s<span>%6$s</span></a>',
		$es_wa ? ' is-wa' : '',
		esc_url( $es_wa ? $fila['wa'] : $fila['tel'], array( 'https', 'tel' ) ),
		$es_wa ? ' target="_blank" rel="noopener"' : '',
		esc_attr( $fila['telefono'] . ( $es_wa ? ' (WhatsApp, ' : ' (llamar, ' ) . $destino . ')' ),
		$jau_svg( $es_wa ? 'wa' : 'telefono', $tamano ),
		esc_html( $fila['telefono'] )
	);
};
$jau_correo_enlace = function ( $correo, $tamano ) use ( $jau_svg, $jau_correo ) {
	return sprintf(
		'<a class="jau-contactos__correo" href="%1$s">%2$s<span>%3$s</span></a>',
		esc_url( 'mailto:' . $correo ),
		$jau_svg( 'mail', $tamano ),
		$jau_correo( $correo )
	);
};

$jau_wrap = get_block_wrapper_attributes( array( 'class' => 'jau-contactos jau-contactos--' . $jau_variante ) );
echo '<div ' . $jau_wrap . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

foreach ( $jau_grupos as $jau_clave => $jau_g ) {
	if ( 'compacta' === $jau_variante ) {
		echo '<div class="jau-contactos__grupo jau-contactos__grupo--' . esc_attr( $jau_clave ) . '">';
		echo '<p class="jau-contactos__titulo">' . esc_html( $jau_g['titulo'] ) . '</p>';
		foreach ( $jau_g['filas'] as $jau_f ) {
			echo '<p class="jau-contactos__linea">';
			if ( '' !== $jau_f['lugar'] ) {
				echo '<span class="jau-contactos__lugar">' . esc_html( $jau_f['lugar'] ) . '</span>';
			}
			echo $jau_numero( $jau_g, $jau_f, 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '</p>';
		}
		if ( '' !== $jau_g['correo'] ) {
			echo '<p class="jau-contactos__linea">' . $jau_correo_enlace( $jau_g['correo'], 16 ) . '</p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		echo '</div>';
		continue;
	}

	if ( 'todos' === $jau_tipo ) {
		echo '<p class="jau-contactos__titulo">' . esc_html( $jau_g['titulo'] ) . '</p>';
	}
	if ( '' !== $jau_g['nota'] ) {
		echo '<p class="jau-contactos__nota">' . $jau_svg( 'pin', 16 ) . '<span>' . esc_html( $jau_g['nota'] ) . '</span></p>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	echo '<ul class="jau-contactos__lista">';
	foreach ( $jau_g['filas'] as $jau_f ) {
		echo '<li class="jau-contactos__fila">';
		if ( '' !== $jau_f['lugar'] ) {
			echo '<span class="jau-contactos__lugar">' . esc_html( $jau_f['lugar'] ) . '</span>';
		}
		echo $jau_numero( $jau_g, $jau_f, 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</li>';
	}
	if ( '' !== $jau_g['correo'] ) {
		echo '<li class="jau-contactos__fila">' . $jau_correo_enlace( $jau_g['correo'], 18 ) . '</li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	echo '</ul>';
}

echo '</div>';
