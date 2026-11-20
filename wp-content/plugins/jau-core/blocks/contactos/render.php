<?php
/**
 * Contactos de la empresa (DWIJ-81): distribuidores, cliente directo por ciudad y atención al
 * consumidor, con enlaces tel:, WhatsApp y mailto:. Los datos salen de «Datos de la empresa».
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
// Nombre accesible del enlace de WhatsApp: empieza por el texto visible.
$jau_wa_label = function ( $grupo, $fila ) {
	return 'WhatsApp de ' . ( '' !== $fila['lugar'] ? $fila['lugar'] : $grupo['titulo'] ) . ': ' . $fila['telefono'];
};

$jau_wrap = get_block_wrapper_attributes( array( 'class' => 'jau-contactos jau-contactos--' . $jau_variante ) );
echo '<div ' . $jau_wrap . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

foreach ( $jau_grupos as $jau_g ) {
	if ( 'compacta' === $jau_variante ) {
		echo '<div class="jau-contactos__grupo">';
		echo '<p class="jau-contactos__titulo">' . esc_html( $jau_g['titulo'] ) . '</p>';
		foreach ( $jau_g['filas'] as $jau_f ) {
			echo '<p class="jau-contactos__linea">';
			if ( '' !== $jau_f['lugar'] ) {
				echo esc_html( $jau_f['lugar'] ) . ': ';
			}
			printf( '<a href="%s">%s</a>', esc_url( $jau_f['tel'], array( 'tel' ) ), esc_html( $jau_f['telefono'] ) );
			if ( '' !== $jau_f['wa'] ) {
				printf(
					' <a class="jau-contactos__wa-mini" href="%1$s" target="_blank" rel="noopener" aria-label="%2$s" title="%2$s">%3$s</a>',
					esc_url( $jau_f['wa'] ),
					esc_attr( $jau_wa_label( $jau_g, $jau_f ) ),
					$jau_svg( 'wa', 16 ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}
			echo '</p>';
		}
		if ( '' !== $jau_g['correo'] ) {
			printf( '<p class="jau-contactos__linea"><a href="%s">%s</a></p>', esc_url( 'mailto:' . $jau_g['correo'] ), $jau_correo( $jau_g['correo'] ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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
		echo '<span class="jau-contactos__acciones">';
		printf(
			'<a class="jau-contactos__tel" href="%1$s">%2$s<span>%3$s</span></a>',
			esc_url( $jau_f['tel'], array( 'tel' ) ),
			$jau_svg( 'telefono' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			esc_html( $jau_f['telefono'] )
		);
		if ( '' !== $jau_f['wa'] ) {
			printf(
				'<a class="jau-contactos__wa" href="%1$s" target="_blank" rel="noopener" aria-label="%2$s">%3$s<span>WhatsApp</span></a>',
				esc_url( $jau_f['wa'] ),
				esc_attr( $jau_wa_label( $jau_g, $jau_f ) ),
				$jau_svg( 'wa', 16 ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}
		echo '</span></li>';
	}
	if ( '' !== $jau_g['correo'] ) {
		printf(
			'<li class="jau-contactos__fila"><a class="jau-contactos__correo" href="%1$s">%2$s<span>%3$s</span></a></li>',
			esc_url( 'mailto:' . $jau_g['correo'] ),
			$jau_svg( 'mail' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			$jau_correo( $jau_g['correo'] ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
	echo '</ul>';
}

echo '</div>';
