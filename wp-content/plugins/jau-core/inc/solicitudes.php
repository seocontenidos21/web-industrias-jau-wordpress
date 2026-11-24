<?php
/**
 * Formulario «Contáctanos» de la página Contacto (DWIJ-18, DWIJ-84). Cada mensaje se guarda en
 * WordPress (menú «Contacto»), se exporta a CSV y se envía por correo cuando hay destinatario en
 * «Datos de la empresa». Queda como registro de formularios por si más adelante se suma otro.
 *
 * @package jau-core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Formularios disponibles y su configuración.
 *
 * @return array<string, array>
 */
function jau_formularios() {
	return array(
		'contacto' => array(
			'cpt'      => 'jau_solicitud',
			'titulo'   => 'Contáctanos',
			'ancla'    => 'formulario',
			'boton'    => 'Enviar mensaje',
			'exito'    => array( 'Mensaje enviado', 'Recibimos tu mensaje. Te contactaremos pronto.', 'Enviar otro mensaje' ),
			'correo'   => 'correo',
			'asunto'   => 'Nuevo mensaje de contacto: %s',
			'csv'      => 'mensajes-contacto',
			'columnas' => array( 'empresa', 'pais', 'ciudad', 'telefono', 'correo' ),
			'labels'   => array(
				'name'          => 'Mensajes de contacto',
				'singular_name' => 'Mensaje',
				'menu_name'     => 'Contacto',
				'all_items'     => 'Mensajes',
				'edit_item'     => 'Mensaje de contacto',
				'search_items'  => 'Buscar mensajes',
				'not_found'     => 'Todavía no hay mensajes',
			),
			'icono'    => 'dashicons-email-alt',
			'campos'   => array(
				// Campos del documento del cliente (24/11/2026), en su orden.
				'nombre'   => array( 'label' => 'Nombre y apellido', 'tipo' => 'text', 'req' => true ),
				'correo'   => array( 'label' => 'Correo electrónico', 'tipo' => 'email', 'req' => true ),
				'telefono' => array( 'label' => 'Teléfono', 'tipo' => 'tel', 'req' => true ),
				'empresa'  => array( 'label' => 'Empresa (opcional)', 'tipo' => 'text', 'req' => false ),
				'pais'     => array( 'label' => 'País', 'tipo' => 'text', 'req' => true ),
				'ciudad'   => array( 'label' => 'Ciudad', 'tipo' => 'text', 'req' => true ),
				'mensaje'  => array( 'label' => 'Mensaje', 'tipo' => 'textarea', 'req' => true ),
			),
		),
	);
}

/**
 * Configuración de un formulario (si no existe, el de contacto).
 *
 * @param string $tipo Clave del formulario.
 * @return array
 */
function jau_formulario( $tipo ) {
	$formularios = jau_formularios();
	return isset( $formularios[ $tipo ] ) ? $formularios[ $tipo ] : $formularios['contacto'];
}

/**
 * Clave del formulario que guarda un tipo de contenido.
 *
 * @param string $cpt Tipo de contenido.
 * @return string Clave o '' si no es de un formulario.
 */
function jau_formulario_de_cpt( $cpt ) {
	foreach ( jau_formularios() as $clave => $f ) {
		if ( $f['cpt'] === $cpt ) {
			return $clave;
		}
	}
	return '';
}

/**
 * Campos de un formulario.
 *
 * @param string $tipo Clave del formulario.
 * @return array<string, array{label: string, tipo: string, req: bool, opciones?: string[]}>
 */
function jau_form_campos( $tipo = 'contacto' ) {
	return jau_formulario( $tipo )['campos'];
}

/**
 * Etiqueta de un campo sin «(opcional)».
 *
 * @param array $campo Campo.
 * @return string
 */
function jau_form_etiqueta( $campo ) {
	return trim( str_replace( ' (opcional)', '', $campo['label'] ) );
}

/**
 * Registra un tipo de contenido privado por formulario.
 */
function jau_registrar_solicitudes() {
	$posicion = 21;
	foreach ( jau_formularios() as $f ) {
		register_post_type(
			$f['cpt'],
			array(
				'labels'          => $f['labels'],
				'public'          => false,
				'show_ui'         => true,
				'show_in_menu'    => true,
				'menu_position'   => $posicion++,
				'menu_icon'       => $f['icono'],
				'supports'        => array( 'title' ),
				'capability_type' => 'post',
				'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
				'map_meta_cap'    => true,
				'show_in_rest'    => false,
			)
		);
	}
}
add_action( 'init', 'jau_registrar_solicitudes' );

/**
 * Valida y limpia los valores enviados.
 *
 * @param array  $entrada Datos crudos.
 * @param string $tipo    Clave del formulario.
 * @return array{0: array<string,string>, 1: array<string,string>} [ valores, errores ]
 */
function jau_form_validar( $entrada, $tipo = 'contacto' ) {
	$valores = array();
	$errores = array();
	foreach ( jau_form_campos( $tipo ) as $id => $c ) {
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
	$tipo = isset( $_POST['formulario'] ) ? sanitize_key( wp_unslash( $_POST['formulario'] ) ) : 'contacto';
	$tipo = array_key_exists( $tipo, jau_formularios() ) ? $tipo : 'contacto';
	$f    = jau_formulario( $tipo );

	$volver = isset( $_POST['volver'] ) ? esc_url_raw( wp_unslash( $_POST['volver'] ) ) : '';
	$volver = wp_validate_redirect( $volver, home_url( '/contacto/' ) );
	$volver = remove_query_arg( array( 'enviado', 'jau_f', 'interes' ), $volver );

	$exito = add_query_arg( 'enviado', '1', $volver ) . '#' . $f['ancla'];

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

	list( $valores, $errores ) = jau_form_validar( $_POST, $tipo );
	// phpcs:enable

	if ( ! $nonce_ok ) {
		$errores['_form'] = 'La sesión del formulario expiró. Revisa los datos y envía de nuevo.';
	}
	if ( $errores ) {
		$token = wp_generate_password( 12, false );
		set_transient( 'jau_f_' . $token, array( $valores, $errores ), 15 * MINUTE_IN_SECONDS );
		wp_safe_redirect( add_query_arg( 'jau_f', $token, $volver ) . '#' . $f['ancla'] );
		exit;
	}

	$post_id = wp_insert_post(
		array(
			'post_type'   => $f['cpt'],
			'post_status' => 'publish',
			'post_title'  => jau_form_titulo( $valores ),
		),
		true
	);
	if ( ! is_wp_error( $post_id ) ) {
		foreach ( $valores as $id => $v ) {
			update_post_meta( $post_id, 'jau_' . $id, $v );
		}
		update_post_meta( $post_id, 'jau_origen', $volver );
		jau_form_notificar( $valores, $tipo );
	}

	wp_safe_redirect( $exito );
	exit;
}

/**
 * Título del mensaje en el admin: «Empresa · Nombre», o solo el nombre si no indicó empresa.
 *
 * @param array<string,string> $v Valores.
 * @return string
 */
function jau_form_titulo( $v ) {
	$empresa = isset( $v['empresa'] ) ? $v['empresa'] : '';
	return '' !== $empresa ? $empresa . ' · ' . $v['nombre'] : $v['nombre'];
}

/**
 * Envía la solicitud por correo si hay destinatario configurado.
 *
 * @param array<string,string> $v    Valores.
 * @param string               $tipo Clave del formulario.
 */
function jau_form_notificar( $v, $tipo = 'contacto' ) {
	$f    = jau_formulario( $tipo );
	$para = jau_dato( $f['correo'] );
	if ( '' === $para || ! is_email( $para ) ) {
		return;
	}
	$lineas = array();
	foreach ( $f['campos'] as $id => $c ) {
		$lineas[] = jau_form_etiqueta( $c ) . ': ' . ( '' !== $v[ $id ] ? $v[ $id ] : '—' );
	}
	$lineas[] = '';
	$lineas[] = 'Ver todos los mensajes: ' . admin_url( 'edit.php?post_type=' . $f['cpt'] );

	wp_mail(
		$para,
		sprintf( $f['asunto'], jau_form_titulo( $v ) ),
		implode( "\n", $lineas ),
		array( 'Reply-To: ' . $v['nombre'] . ' <' . $v['correo'] . '>' )
	);
}

/* ---------------------------------------------------------------------------
 * Admin: columnas, detalle de la solicitud y exportación a CSV (uno por formulario)
 * ------------------------------------------------------------------------- */
add_action(
	'admin_init',
	function () {
		foreach ( jau_formularios() as $clave => $f ) {
			add_filter(
				'manage_' . $f['cpt'] . '_posts_columns',
				function () use ( $f ) {
					$cols = array(
						'cb'    => '<input type="checkbox" />',
						'title' => 'Nombre',
					);
					foreach ( $f['columnas'] as $id ) {
						$cols[ 'jau_' . $id ] = jau_form_etiqueta( $f['campos'][ $id ] );
					}
					$cols['date'] = 'Fecha';
					return $cols;
				}
			);
			add_action( 'manage_' . $f['cpt'] . '_posts_custom_column', 'jau_form_columna', 10, 2 );

			add_filter(
				'views_edit-' . $f['cpt'],
				function ( $views ) use ( $clave ) {
					$url             = wp_nonce_url( admin_url( 'admin-post.php?action=jau_exportar_solicitudes&formulario=' . $clave ), 'jau_exportar' );
					$views['export'] = '<a href="' . esc_url( $url ) . '" class="button button-primary" style="margin-left:8px">Exportar CSV</a>';
					return $views;
				}
			);
		}
	}
);

/**
 * Celda de una columna de la lista de solicitudes.
 *
 * @param string $col     Columna.
 * @param int    $post_id Solicitud.
 */
function jau_form_columna( $col, $post_id ) {
	$v = (string) get_post_meta( $post_id, $col, true );
	if ( 'jau_correo' === $col && '' !== $v ) {
		printf( '<a href="mailto:%1$s">%2$s</a>', esc_attr( $v ), esc_html( $v ) );
	} elseif ( 'jau_telefono' === $col && '' !== $v ) {
		printf( '<a href="%1$s" target="_blank" rel="noopener">%2$s</a>', esc_url( 'https://wa.me/' . jau_digitos( $v ) ), esc_html( $v ) );
	} else {
		echo esc_html( $v );
	}
}

add_action(
	'add_meta_boxes',
	function ( $post_type, $post ) {
		$clave = jau_formulario_de_cpt( $post_type );
		if ( '' === $clave ) {
			return;
		}
		$f = jau_formulario( $clave );
		remove_meta_box( 'submitdiv', $post_type, 'side' );
		add_meta_box(
			'jau-solicitud-datos',
			'Datos de la solicitud',
			function ( $post ) use ( $f ) {
				echo '<table class="widefat striped"><tbody>';
				foreach ( $f['campos'] as $id => $c ) {
					printf(
						'<tr><th style="width:220px">%1$s</th><td>%2$s</td></tr>',
						esc_html( jau_form_etiqueta( $c ) ),
						nl2br( esc_html( (string) get_post_meta( $post->ID, 'jau_' . $id, true ) ) )
					);
				}
				printf( '<tr><th>Recibida</th><td>%s</td></tr>', esc_html( get_the_date( 'j \d\e F \d\e Y, g:i a', $post ) ) );
				echo '</tbody></table>';
			},
			$post_type,
			'normal',
			'high'
		);
	},
	10,
	2
);

add_action(
	'admin_post_jau_exportar_solicitudes',
	function () {
		if ( ! current_user_can( 'edit_others_posts' ) ) {
			wp_die( 'No tienes permiso para exportar las solicitudes.', 403 );
		}
		check_admin_referer( 'jau_exportar' );

		$tipo   = isset( $_GET['formulario'] ) ? sanitize_key( wp_unslash( $_GET['formulario'] ) ) : 'contacto';
		$f      = jau_formulario( $tipo );
		$campos = $f['campos'];
		$ids    = get_posts(
			array(
				'post_type'      => $f['cpt'],
				'post_status'    => 'any',
				'posts_per_page' => -1,
				'fields'         => 'ids',
				'orderby'        => 'date',
				'order'          => 'DESC',
			)
		);

		nocache_headers();
		header( 'Content-Type: text/csv; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=' . $f['csv'] . '-' . wp_date( 'Y-m-d' ) . '.csv' );

		$salida = fopen( 'php://output', 'w' ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fopen
		fwrite( $salida, "\xEF\xBB\xBF" ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fwrite -- BOM para que Excel lea los acentos.
		$cabecera = array( 'Fecha' );
		foreach ( $campos as $c ) {
			$cabecera[] = jau_form_etiqueta( $c );
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
