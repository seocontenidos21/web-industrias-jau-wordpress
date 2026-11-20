<?php
/**
 * «Datos de la empresa»: fuente única de teléfono, WhatsApp, dirección, horario, correo y redes
 * (DWIJ-55, DWIJ-62, DWIJ-63, DWIJ-64). Los bloques los leen con Block Bindings (`jau/empresa`).
 *
 * @package jau-core
 */

defined( 'ABSPATH' ) || exit;

const JAU_OPCION_EMPRESA = 'jau_empresa';

/**
 * Campos de la página de ajustes.
 *
 * @return array<string, array{label: string, tipo: string, ayuda?: string}>
 */
function jau_empresa_campos() {
	return array(
		'telefono'            => array( 'label' => 'Distribuidores: teléfono', 'tipo' => 'text', 'ayuda' => 'Tal como se muestra en la web. Ej.: +58 422-5051007' ),
		'whatsapp'            => array( 'label' => 'Distribuidores: WhatsApp', 'tipo' => 'text', 'ayuda' => 'Solo dígitos con código de país, sin «+». Ej.: 584225051007. Es el del botón flotante, el slider y las fichas de producto.' ),
		'whatsapp_mensaje'    => array( 'label' => 'Distribuidores: mensaje predefinido de WhatsApp', 'tipo' => 'textarea' ),
		'clientes_directos'   => array( 'label' => 'Cliente directo: teléfonos por ciudad', 'tipo' => 'textarea', 'ayuda' => 'Una línea por ciudad, con el formato «Ciudad: teléfono». Ej.: Maracaibo: +58 414-6582455' ),
		'clientes_nota'       => array( 'label' => 'Cliente directo: nota visible', 'tipo' => 'text', 'ayuda' => 'Ej.: Solo atención en Maracaibo, Caracas, Maracay y Valencia' ),
		'consumidor_telefono' => array( 'label' => 'Atención al consumidor: teléfono', 'tipo' => 'text' ),
		'consumidor_correo'   => array( 'label' => 'Atención al consumidor: correo', 'tipo' => 'email' ),
		'whatsapp_contactos'  => array( 'label' => 'WhatsApp en cliente directo y atención al consumidor', 'tipo' => 'checkbox', 'ayuda' => 'Marcar si esos números tienen WhatsApp: al tocar cada número se abre WhatsApp (si no, llama) y el botón flotante muestra un menú con los tres tipos de contacto.' ),
		'direccion'        => array( 'label' => 'Dirección de la planta', 'tipo' => 'textarea' ),
		'mapa'             => array( 'label' => 'Punto del mapa (opcional)', 'tipo' => 'text', 'ayuda' => 'Coordenadas «latitud,longitud» o texto de búsqueda. Si se deja vacío, el mapa usa la dirección.' ),
		'horario'          => array( 'label' => 'Horario de atención', 'tipo' => 'text' ),
		'correo'           => array( 'label' => 'Correo que recibe las solicitudes de distribuidores', 'tipo' => 'email', 'ayuda' => 'No se muestra en la web. Si está vacío, las solicitudes se guardan en «Distribuidores» pero no se envía correo.' ),
		'instagram'        => array( 'label' => 'Instagram (URL)', 'tipo' => 'url' ),
		'facebook'         => array( 'label' => 'Facebook (URL)', 'tipo' => 'url' ),
		'tiktok'           => array( 'label' => 'TikTok (URL)', 'tipo' => 'url' ),
	);
}

/**
 * Datos guardados, completos (todas las claves existen).
 *
 * @return array<string, string>
 */
function jau_empresa() {
	$guardado = get_option( JAU_OPCION_EMPRESA, array() );
	$datos    = array();
	foreach ( array_keys( jau_empresa_campos() ) as $clave ) {
		$datos[ $clave ] = isset( $guardado[ $clave ] ) ? trim( (string) $guardado[ $clave ] ) : '';
	}
	return $datos;
}

/**
 * Solo dígitos.
 *
 * @param string $valor Texto.
 * @return string
 */
function jau_digitos( $valor ) {
	return preg_replace( '/\D+/', '', (string) $valor );
}

/**
 * URL de WhatsApp con mensaje.
 *
 * @param string $mensaje Mensaje opcional (si no, el predefinido).
 * @return string
 */
function jau_whatsapp_url( $mensaje = '' ) {
	$d      = jau_empresa();
	$numero = jau_digitos( $d['whatsapp'] );
	if ( '' === $numero ) {
		return '';
	}
	$mensaje = '' !== $mensaje ? $mensaje : $d['whatsapp_mensaje'];
	return 'https://wa.me/' . $numero . ( '' !== $mensaje ? '?text=' . rawurlencode( $mensaje ) : '' );
}

/**
 * Los tres tipos de contacto (DWIJ-81): distribuidores, cliente directo por ciudad y atención
 * al consumidor. Solo incluye los grupos con datos.
 *
 * @return array<string, array{titulo: string, filas: array<int, array{lugar: string, telefono: string, tel: string, wa: string}>, correo: string, nota: string}>
 */
function jau_contactos() {
	$d      = jau_empresa();
	$con_wa = '1' === $d['whatsapp_contactos'];
	$fila   = function ( $lugar, $telefono, $mensaje ) use ( $con_wa ) {
		$num = jau_digitos( $telefono );
		return array(
			'lugar'    => $lugar,
			'telefono' => $telefono,
			'tel'      => '' !== $num ? 'tel:+' . $num : '',
			'wa'       => ( $con_wa && '' !== $num ) ? 'https://wa.me/' . $num . '?text=' . rawurlencode( $mensaje ) : '',
		);
	};
	$grupos = array();

	if ( '' !== $d['telefono'] ) {
		$distribuidor       = $fila( '', $d['telefono'], '' );
		$distribuidor['wa'] = jau_whatsapp_url();
		$grupos['distribuidores'] = array(
			'titulo' => 'Distribuidores',
			'filas'  => array( $distribuidor ),
			'correo' => '',
			'nota'   => '',
		);
	}

	$filas = array();
	foreach ( preg_split( '/\R/', $d['clientes_directos'] ) as $linea ) {
		if ( preg_match( '/^\s*(.+?)\s*[:|]\s*(\+?[\d][\d\s().-]{5,})\s*$/u', $linea, $m ) ) {
			$filas[] = $fila( $m[1], $m[2], 'Hola, quiero ser cliente directo de Industrias JAU en ' . $m[1] . '.' );
		}
	}
	if ( $filas ) {
		$grupos['cliente'] = array(
			'titulo' => 'Cliente directo',
			'filas'  => $filas,
			'correo' => '',
			'nota'   => $d['clientes_nota'],
		);
	}

	if ( '' !== $d['consumidor_telefono'] || '' !== $d['consumidor_correo'] ) {
		$grupos['consumidor'] = array(
			'titulo' => 'Atención al consumidor',
			'filas'  => '' !== $d['consumidor_telefono'] ? array( $fila( '', $d['consumidor_telefono'], 'Hola, escribo a Atención al consumidor de Industrias JAU.' ) ) : array(),
			'correo' => $d['consumidor_correo'],
			'nota'   => '',
		);
	}

	return $grupos;
}

/**
 * Un dato de la empresa listo para usar (texto plano o URL).
 *
 * @param string $clave Clave.
 * @return string|array
 */
function jau_dato( $clave ) {
	$d     = jau_empresa();
	$lugar = '' !== $d['mapa'] ? $d['mapa'] : $d['direccion'];

	switch ( $clave ) {
		case 'tel_url':
			return '' !== $d['telefono'] ? 'tel:+' . jau_digitos( $d['telefono'] ) : '';
		case 'whatsapp':
			if ( '' === $d['whatsapp'] ) {
				return '';
			}
			// Si el WhatsApp es el mismo teléfono, se muestra con el formato del teléfono.
			return jau_digitos( $d['whatsapp'] ) === jau_digitos( $d['telefono'] ) ? $d['telefono'] : '+' . jau_digitos( $d['whatsapp'] );
		case 'whatsapp_url':
			return jau_whatsapp_url();
		case 'correo_url':
			return '' !== $d['correo'] ? 'mailto:' . $d['correo'] : '';
		case 'como_llegar_url':
			return '' !== $lugar ? 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode( $lugar ) : '';
		case 'mapa_embed_url':
			return '' !== $lugar ? 'https://www.google.com/maps?q=' . rawurlencode( $lugar ) . '&z=16&hl=es&output=embed' : '';
		case 'redes':
			return array_filter(
				array(
					'Instagram' => $d['instagram'],
					'Facebook'  => $d['facebook'],
					'TikTok'    => $d['tiktok'],
				)
			);
		case 'copyright':
			return '© ' . wp_date( 'Y' ) . ' ' . get_bloginfo( 'name' );
		default:
			return isset( $d[ $clave ] ) ? $d[ $clave ] : '';
	}
}

/**
 * HTML de un dato para mostrar en un párrafo (con enlace y etiqueta opcionales).
 *
 * @param string $clave    Clave.
 * @param string $etiqueta Etiqueta en negrita delante del valor.
 * @param bool   $enlace   Si se enlaza (tel:, WhatsApp, mailto:, «Cómo llegar»).
 * @return string
 */
function jau_dato_html( $clave, $etiqueta = '', $enlace = false ) {
	$valor = jau_dato( $clave );
	$html  = '';

	if ( 'redes' === $clave ) {
		$enlaces = array();
		foreach ( (array) $valor as $red => $url ) {
			$enlaces[] = '<a href="' . esc_url( $url ) . '" target="_blank" rel="noopener">' . esc_html( $red ) . '</a>';
		}
		$html = $enlaces ? implode( ' · ', $enlaces ) : '';
	} elseif ( '' !== $valor ) {
		$texto = esc_html( $valor );
		if ( $enlace ) {
			switch ( $clave ) {
				case 'telefono':
					$texto = '<a href="' . esc_url( jau_dato( 'tel_url' ) ) . '">' . $texto . '</a>';
					break;
				case 'whatsapp':
					$texto = '<a href="' . esc_url( jau_dato( 'whatsapp_url' ) ) . '" target="_blank" rel="noopener">' . $texto . '</a>';
					break;
				case 'correo':
					$texto = '<a href="' . esc_url( jau_dato( 'correo_url' ) ) . '">' . $texto . '</a>';
					break;
				case 'direccion':
					$texto .= ' <a href="' . esc_url( jau_dato( 'como_llegar_url' ) ) . '" target="_blank" rel="noopener">Cómo llegar</a>';
					break;
			}
		}
		$html = $texto;
	}

	// Sin dato no se muestra nada (ni la etiqueta): el bloque se oculta solo.
	if ( '' === $html ) {
		return '';
	}
	if ( '' !== $etiqueta ) {
		$html = '<strong>' . esc_html( $etiqueta ) . ':</strong> ' . $html;
	}
	return $html;
}

/* ---------------------------------------------------------------------------
 * Block Bindings: jau/empresa (datos de contacto) y jau/producto (botones de la ficha)
 * ------------------------------------------------------------------------- */
add_action(
	'init',
	function () {
		if ( ! function_exists( 'register_block_bindings_source' ) ) {
			return;
		}

		register_block_bindings_source(
			'jau/empresa',
			array(
				'label'              => 'Datos de la empresa',
				'get_value_callback' => function ( array $args, $block_instance, string $attribute_name ) {
					$clave = isset( $args['key'] ) ? sanitize_key( $args['key'] ) : '';
					if ( '' === $clave ) {
						return null;
					}
					if ( in_array( $attribute_name, array( 'url' ), true ) ) {
						return (string) jau_dato( $clave );
					}
					return jau_dato_html( $clave, isset( $args['etiqueta'] ) ? (string) $args['etiqueta'] : '', ! empty( $args['enlace'] ) );
				},
			)
		);

		register_block_bindings_source(
			'jau/producto',
			array(
				'label'              => 'Producto actual',
				'uses_context'       => array( 'postId', 'postType' ),
				'get_value_callback' => function ( array $args, $block_instance ) {
					$post_id = isset( $block_instance->context['postId'] ) ? (int) $block_instance->context['postId'] : get_the_ID();
					// Nombre con la presentación elegida (p. ej. «Drink Cola 400 mL»).
					$nombre = $post_id ? jau_producto_nombre_sku( $post_id ) : '';
					switch ( isset( $args['key'] ) ? $args['key'] : '' ) {
						case 'consultar_url':
							return jau_producto_consultar_url( $nombre );
						case 'whatsapp_url':
							return jau_producto_whatsapp_url( $nombre );
					}
					return null;
				},
			)
		);
	}
);

/* En el editor, los bindings muestran el valor real (no solo «Datos de la empresa»). */
add_action(
	'enqueue_block_editor_assets',
	function () {
		$valores = array();
		foreach ( array( 'telefono', 'whatsapp', 'direccion', 'horario', 'correo', 'redes', 'copyright' ) as $clave ) {
			$valores[ $clave ] = wp_strip_all_tags( jau_dato_html( $clave ) );
			if ( '' === $valores[ $clave ] ) {
				$valores[ $clave ] = '(sin dato: se oculta en la web)';
			}
		}
		foreach ( array( 'whatsapp_url', 'tel_url', 'correo_url', 'como_llegar_url' ) as $clave ) {
			$valores[ $clave ] = (string) jau_dato( $clave );
		}
		wp_enqueue_script( 'jau-core-bindings', JAU_CORE_URL . 'assets/editor-bindings.js', array( 'wp-blocks' ), JAU_CORE_VERSION, true );
		wp_add_inline_script( 'jau-core-bindings', 'window.jauEmpresa = ' . wp_json_encode( $valores ) . ';', 'before' );
	}
);

/* ---------------------------------------------------------------------------
 * Página «Ajustes › Datos de la empresa»
 * ------------------------------------------------------------------------- */
add_action(
	'admin_init',
	function () {
		register_setting(
			'jau_empresa_grupo',
			JAU_OPCION_EMPRESA,
			array(
				'type'              => 'array',
				'sanitize_callback' => 'jau_empresa_sanitizar',
				'default'           => array(),
			)
		);
	}
);

/**
 * Limpia los datos enviados desde la página de ajustes.
 *
 * @param mixed $entrada Datos del formulario.
 * @return array<string, string>
 */
function jau_empresa_sanitizar( $entrada ) {
	$salida = array();
	foreach ( jau_empresa_campos() as $clave => $campo ) {
		$valor = isset( $entrada[ $clave ] ) ? wp_unslash( $entrada[ $clave ] ) : '';
		switch ( $campo['tipo'] ) {
			case 'textarea':
				$salida[ $clave ] = sanitize_textarea_field( $valor );
				break;
			case 'email':
				$salida[ $clave ] = sanitize_email( $valor );
				break;
			case 'url':
				$salida[ $clave ] = esc_url_raw( $valor );
				break;
			case 'checkbox':
				$salida[ $clave ] = '' !== $valor ? '1' : '';
				break;
			default:
				$salida[ $clave ] = sanitize_text_field( $valor );
		}
	}
	$salida['whatsapp'] = jau_digitos( $salida['whatsapp'] );
	return $salida;
}

add_action(
	'admin_menu',
	function () {
		add_options_page( 'Datos de la empresa', 'Datos de la empresa', 'manage_options', 'jau-empresa', 'jau_empresa_pagina' );
	}
);

/**
 * Página de ajustes.
 */
function jau_empresa_pagina() {
	$datos = jau_empresa();
	?>
	<div class="wrap">
		<h1>Datos de la empresa</h1>
		<p>Estos datos se muestran en el footer, Contacto, el bloque «Quiero ser distribuidor», el slider y el botón flotante de WhatsApp. Cambiarlos aquí los actualiza en todo el sitio. Un campo vacío no se muestra.</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'jau_empresa_grupo' ); ?>
			<table class="form-table" role="presentation">
				<?php foreach ( jau_empresa_campos() as $clave => $campo ) : ?>
					<?php $id = 'jau-empresa-' . $clave; ?>
					<tr>
						<th scope="row"><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $campo['label'] ); ?></label></th>
						<td>
							<?php if ( 'checkbox' === $campo['tipo'] ) : ?>
								<input type="checkbox" value="1" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( JAU_OPCION_EMPRESA . '[' . $clave . ']' ); ?>" <?php checked( '1', $datos[ $clave ] ); ?>>
							<?php elseif ( 'textarea' === $campo['tipo'] ) : ?>
								<textarea class="large-text" rows="3" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( JAU_OPCION_EMPRESA . '[' . $clave . ']' ); ?>"><?php echo esc_textarea( $datos[ $clave ] ); ?></textarea>
							<?php else : ?>
								<input class="<?php echo 'clientes_nota' === $clave ? 'large-text' : 'regular-text'; ?>" type="<?php echo esc_attr( 'email' === $campo['tipo'] ? 'email' : ( 'url' === $campo['tipo'] ? 'url' : 'text' ) ); ?>" id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( JAU_OPCION_EMPRESA . '[' . $clave . ']' ); ?>" value="<?php echo esc_attr( $datos[ $clave ] ); ?>">
							<?php endif; ?>
							<?php if ( ! empty( $campo['ayuda'] ) ) : ?>
								<p class="description"><?php echo esc_html( $campo['ayuda'] ); ?></p>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
			<?php submit_button( 'Guardar datos' ); ?>
		</form>
	</div>
	<?php
}

/* Párrafos enlazados a un dato vacío: no se imprimen (sin huecos ni etiquetas sueltas). */
add_filter(
	'render_block_core/paragraph',
	function ( $html, $block ) {
		$fuente = $block['attrs']['metadata']['bindings']['content']['source'] ?? '';
		if ( 'jau/empresa' === $fuente && '' === trim( wp_strip_all_tags( $html ) ) ) {
			return '';
		}
		return $html;
	},
	10,
	2
);
