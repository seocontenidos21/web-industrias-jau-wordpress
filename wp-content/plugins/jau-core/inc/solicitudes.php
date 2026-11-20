<?php
/**
 * Solicitudes «Quiero ser distribuidor» (DWIJ-18): se guardan en WordPress (menú «Distribuidores»),
 * se exportan a CSV y se envían por correo cuando hay destinatario en «Datos de la empresa».
 *
 * @package jau-core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Campos del formulario (mismos del prototipo: jau-data.js → JAU.formulario).
 *
 * @return array<string, array{label: string, tipo: string, req: bool, opciones?: string[]}>
 */
function jau_form_campos() {
	return array(
		'nombre'   => array( 'label' => 'Nombre y apellido', 'tipo' => 'text', 'req' => true ),
		'empresa'  => array( 'label' => 'Empresa o negocio', 'tipo' => 'text', 'req' => true ),
		'ciudad'   => array( 'label' => 'Ciudad o zona', 'tipo' => 'text', 'req' => true ),
		'telefono' => array( 'label' => 'Teléfono o WhatsApp', 'tipo' => 'tel', 'req' => true ),
		'correo'   => array( 'label' => 'Correo electrónico', 'tipo' => 'email', 'req' => true ),
		'tipo'     => array(
			'label'    => 'Tipo de negocio',
			'tipo'     => 'select',
			'req'      => true,
			'opciones' => array( 'Bodega o abasto', 'Supermercado', 'Mayorista', 'Distribuidor', 'Otro' ),
		),
		'mensaje'  => array( 'label' => 'Mensaje (opcional)', 'tipo' => 'textarea', 'req' => false ),
	);
}

/**
 * Registra el tipo de contenido privado «Solicitud».
 */
function jau_registrar_solicitudes() {
	register_post_type(
		'jau_solicitud',
		array(
			'labels'          => array(
				'name'          => 'Solicitudes de distribuidores',
				'singular_name' => 'Solicitud',
				'menu_name'     => 'Distribuidores',
				'all_items'     => 'Solicitudes',
				'edit_item'     => 'Solicitud de distribuidor',
				'search_items'  => 'Buscar solicitudes',
				'not_found'     => 'Todavía no hay solicitudes',
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'menu_position'   => 21,
			'menu_icon'       => 'dashicons-groups',
			'supports'        => array( 'title' ),
			'capability_type' => 'post',
			'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'    => true,
			'show_in_rest'    => false,
		)
	);
}
add_action( 'init', 'jau_registrar_solicitudes' );

/**
 * Valida y limpia los valores enviados.
 *
 * @param array $entrada Datos crudos.
 * @return array{0: array<string,string>, 1: array<string,string>} [ valores, errores ]
 */
function jau_form_validar( $entrada ) {
	$valores = array();
	$errores = array();
	foreach ( jau_form_campos() as $id => $c ) {
		$v = isset( $entrada[ $id ] ) ? wp_unslash( $entrada[ $id ] ) : '';
		$v = 'textarea' === $c['tipo'] ? sanitize_textarea_field( $v ) : sanitize_text_field( $v );
		$v = trim( mb_substr( $v, 0, 'textarea' === $c['tipo'] ? 2000 : 200 ) );

		if ( 'select' === $c['tipo'] && '' !== $v && ! in_array( $v, $c['opciones'], true ) ) {
			$v = '';
		}
		if ( $c['req'] && '' === $v ) {
			$errores[ $id ] = 'Campo obligatorio';
		} elseif ( 'email' === $c['tipo'] && '' !== $v && ! is_email( $v ) ) {
			$errores[ $id ] = 'Correo no válido';
		}
		$valores[ $id ] = $v;
	}
	return array( $valores, $errores );
}

/**
 * Firma del sello de tiempo del formulario (antispam: tiempo mínimo de llenado).
 *
 * @param string $ts Sello de tiempo.
 * @return string
 */
function jau_form_firma( $ts ) {
	return substr( wp_hash( 'jau_form|' . $ts, 'nonce' ), 0, 16 );
}

/* Procesa el envío (usuarios anónimos y conectados). */
add_action( 'admin_post_nopriv_jau_solicitud', 'jau_form_procesar' );
add_action( 'admin_post_jau_solicitud', 'jau_form_procesar' );

/**
 * Procesa una solicitud y redirige de vuelta al formulario.
 */
function jau_form_procesar() {
	// phpcs:disable WordPress.Security.NonceVerification.Missing -- se verifica abajo.
	$volver = isset( $_POST['volver'] ) ? esc_url_raw( wp_unslash( $_POST['volver'] ) ) : '';
	$volver = wp_validate_redirect( $volver, home_url( '/contacto/' ) );
	$volver = remove_query_arg( array( 'enviado', 'jau_f', 'interes' ), $volver );

	$exito = add_query_arg( 'enviado', '1', $volver ) . '#formulario';

	// Trampa para robots: el campo oculto debe llegar vacío; si no, se finge éxito.
	if ( ! empty( $_POST['sitio_web'] ) ) {
		wp_safe_redirect( $exito );
		exit;
	}
	$ts    = isset( $_POST['jau_ts'] ) ? sanitize_text_field( wp_unslash( $_POST['jau_ts'] ) ) : '';
	$firma = isset( $_POST['jau_tf'] ) ? sanitize_text_field( wp_unslash( $_POST['jau_tf'] ) ) : '';
	if ( '' === $ts || ! hash_equals( jau_form_firma( $ts ), $firma ) || ( time() - (int) $ts ) < 3 ) {
		wp_safe_redirect( $exito );
		exit;
	}
	$nonce_ok = isset( $_POST['jau_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['jau_nonce'] ) ), 'jau_solicitud' );

	list( $valores, $errores ) = jau_form_validar( $_POST );
	// phpcs:enable

	if ( ! $nonce_ok ) {
		$errores['_form'] = 'La sesión del formulario expiró. Revisa los datos y envía de nuevo.';
	}
	if ( $errores ) {
		$token = wp_generate_password( 12, false );
		set_transient( 'jau_f_' . $token, array( $valores, $errores ), 15 * MINUTE_IN_SECONDS );
		wp_safe_redirect( add_query_arg( 'jau_f', $token, $volver ) . '#formulario' );
		exit;
	}

	$post_id = wp_insert_post(
		array(
			'post_type'   => 'jau_solicitud',
			'post_status' => 'publish',
			'post_title'  => sprintf( '%s · %s', $valores['empresa'], $valores['nombre'] ),
		),
		true
	);
	if ( ! is_wp_error( $post_id ) ) {
		foreach ( $valores as $id => $v ) {
			update_post_meta( $post_id, 'jau_' . $id, $v );
		}
		update_post_meta( $post_id, 'jau_origen', $volver );
		jau_form_notificar( $valores );
	}

	wp_safe_redirect( $exito );
	exit;
}

/**
 * Envía la solicitud por correo si hay destinatario configurado.
 *
 * @param array<string,string> $v Valores.
 */
function jau_form_notificar( $v ) {
	$para = jau_dato( 'correo' );
	if ( '' === $para || ! is_email( $para ) ) {
		return;
	}
	$lineas = array();
	foreach ( jau_form_campos() as $id => $c ) {
		$lineas[] = rtrim( str_replace( ' (opcional)', '', $c['label'] ) ) . ': ' . ( '' !== $v[ $id ] ? $v[ $id ] : '—' );
	}
	$lineas[] = '';
	$lineas[] = 'Ver todas las solicitudes: ' . admin_url( 'edit.php?post_type=jau_solicitud' );

	wp_mail(
		$para,
		sprintf( 'Nueva solicitud de distribuidor: %s', $v['empresa'] ),
		implode( "\n", $lineas ),
		array( 'Reply-To: ' . $v['nombre'] . ' <' . $v['correo'] . '>' )
	);
}

/* ---------------------------------------------------------------------------
 * Admin: columnas, detalle de la solicitud y exportación a CSV
 * ------------------------------------------------------------------------- */
add_filter(
	'manage_jau_solicitud_posts_columns',
	function () {
		return array(
			'cb'           => '<input type="checkbox" />',
			'title'        => 'Solicitud',
			'jau_ciudad'   => 'Ciudad o zona',
			'jau_telefono' => 'Teléfono',
			'jau_correo'   => 'Correo',
			'jau_tipo'     => 'Tipo de negocio',
			'date'         => 'Fecha',
		);
	}
);
add_action(
	'manage_jau_solicitud_posts_custom_column',
	function ( $col, $post_id ) {
		$v = (string) get_post_meta( $post_id, $col, true );
		if ( 'jau_correo' === $col && '' !== $v ) {
			printf( '<a href="mailto:%1$s">%2$s</a>', esc_attr( $v ), esc_html( $v ) );
		} elseif ( 'jau_telefono' === $col && '' !== $v ) {
			printf( '<a href="%1$s" target="_blank" rel="noopener">%2$s</a>', esc_url( 'https://wa.me/' . jau_digitos( $v ) ), esc_html( $v ) );
		} else {
			echo esc_html( $v );
		}
	},
	10,
	2
);

add_action(
	'add_meta_boxes_jau_solicitud',
	function () {
		remove_meta_box( 'submitdiv', 'jau_solicitud', 'side' );
		add_meta_box(
			'jau-solicitud-datos',
			'Datos de la solicitud',
			function ( $post ) {
				echo '<table class="widefat striped"><tbody>';
				foreach ( jau_form_campos() as $id => $c ) {
					printf(
						'<tr><th style="width:220px">%1$s</th><td>%2$s</td></tr>',
						esc_html( str_replace( ' (opcional)', '', $c['label'] ) ),
						nl2br( esc_html( (string) get_post_meta( $post->ID, 'jau_' . $id, true ) ) )
					);
				}
				printf( '<tr><th>Recibida</th><td>%s</td></tr>', esc_html( get_the_date( 'j \d\e F \d\e Y, g:i a', $post ) ) );
				echo '</tbody></table>';
			},
			'jau_solicitud',
			'normal',
			'high'
		);
	}
);

add_filter(
	'views_edit-jau_solicitud',
	function ( $views ) {
		$url             = wp_nonce_url( admin_url( 'admin-post.php?action=jau_exportar_solicitudes' ), 'jau_exportar' );
		$views['export'] = '<a href="' . esc_url( $url ) . '" class="button button-primary" style="margin-left:8px">Exportar CSV</a>';
		return $views;
	}
);

add_action(
	'admin_post_jau_exportar_solicitudes',
	function () {
		if ( ! current_user_can( 'edit_others_posts' ) ) {
			wp_die( 'No tienes permiso para exportar las solicitudes.', 403 );
		}
		check_admin_referer( 'jau_exportar' );

		$campos = jau_form_campos();
		$ids    = get_posts(
			array(
				'post_type'      => 'jau_solicitud',
				'post_status'    => 'any',
				'posts_per_page' => -1,
				'fields'         => 'ids',
				'orderby'        => 'date',
				'order'          => 'DESC',
			)
		);

		nocache_headers();
		header( 'Content-Type: text/csv; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=solicitudes-distribuidores-' . wp_date( 'Y-m-d' ) . '.csv' );

		$salida = fopen( 'php://output', 'w' ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fopen
		fwrite( $salida, "\xEF\xBB\xBF" ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fwrite -- BOM para que Excel lea los acentos.
		$cabecera = array( 'Fecha' );
		foreach ( $campos as $c ) {
			$cabecera[] = str_replace( ' (opcional)', '', $c['label'] );
		}
		fputcsv( $salida, $cabecera, ';' );
		foreach ( $ids as $id ) {
			$fila = array( get_the_date( 'Y-m-d H:i', $id ) );
			foreach ( array_keys( $campos ) as $campo ) {
				$v = (string) get_post_meta( $id, 'jau_' . $campo, true );
				// Evita fórmulas al abrir el CSV en Excel.
				$fila[] = preg_match( '/^[=+\-@]/', $v ) ? "'" . $v : $v;
			}
			fputcsv( $salida, $fila, ';' );
		}
		fclose( $salida ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fclose
		exit;
	}
);
