<?php
/**
 * Industrias JAU · funciones del tema.
 *
 * El tema solo se ocupa del diseño: estilos, plantillas, patrones, íconos, menú y slider.
 * Productos, formulario y datos de la empresa viven en el plugin «JAU Core».
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/inc/iconos.php';

/**
 * Versión de un archivo del tema según su fecha de modificación (para romper caché).
 *
 * @param string $ruta Ruta relativa al tema.
 * @return string
 */
function jau_tema_version( $ruta ) {
	$archivo = get_theme_file_path( $ruta );
	return file_exists( $archivo ) ? (string) filemtime( $archivo ) : wp_get_theme()->get( 'Version' );
}

/* Soportes del tema. */
add_action(
	'after_setup_theme',
	function () {
		add_editor_style( 'assets/css/tema.css' );
		add_post_type_support( 'page', 'excerpt' );
		remove_theme_support( 'core-block-patterns' );
	}
);

/* Estilos y scripts del frontend. */
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'industrias-jau', get_theme_file_uri( 'assets/css/tema.css' ), array(), jau_tema_version( 'assets/css/tema.css' ) );
		wp_enqueue_script(
			'industrias-jau-menu',
			get_theme_file_uri( 'assets/js/menu.js' ),
			array(),
			jau_tema_version( 'assets/js/menu.js' ),
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
		wp_register_script(
			'industrias-jau-fotos',
			get_theme_file_uri( 'assets/js/fotos.js' ),
			array(),
			jau_tema_version( 'assets/js/fotos.js' ),
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
		wp_register_script(
			'industrias-jau-slider',
			get_theme_file_uri( 'assets/js/slider.js' ),
			array(),
			jau_tema_version( 'assets/js/slider.js' ),
			array(
				'strategy'  => 'defer',
				'in_footer' => true,
			)
		);
	}
);

/* El slider solo se carga en las páginas que lo tienen. */
add_filter(
	'render_block_core/group',
	function ( $html, $block ) {
		if ( ! empty( $block['attrs']['className'] ) && str_contains( $block['attrs']['className'], 'jau-slider' ) ) {
			wp_enqueue_script( 'industrias-jau-slider' );
		}
		return $html;
	},
	10,
	2
);

/* Bloque «Ícono JAU» y catálogo de íconos para el editor. */
add_action(
	'init',
	function () {
		register_block_type( __DIR__ . '/blocks/icono' );
		register_block_pattern_category( 'industrias-jau', array( 'label' => __( 'Industrias JAU', 'industrias-jau' ) ) );
	}
);

add_action(
	'enqueue_block_editor_assets',
	function () {
		wp_add_inline_script( 'industrias-jau-icono-editor-script', 'window.jauTemaIconos = ' . wp_json_encode( jau_tema_iconos() ) . ';', 'before' );
	}
);

/* Estilos de bloque propios (se dibujan en tema.css). */
add_action(
	'init',
	function () {
		$estilos = array(
			'core/button'     => array(
				'blanco'         => 'Blanco',
				'contorno-claro' => 'Contorno claro (sobre color)',
				'contorno'       => 'Contorno',
				'whatsapp'       => 'WhatsApp',
				'enlace'         => 'Enlace con flecha',
			),
			'core/group'      => array(
				'tarjeta'       => 'Tarjeta',
				'tarjeta-hover' => 'Tarjeta con elevación',
			),
			'core/post-terms' => array(
				'pildoras' => 'Píldoras',
				'etiqueta' => 'Etiqueta en mayúsculas',
			),
		);
		foreach ( $estilos as $bloque => $lista ) {
			foreach ( $lista as $nombre => $etiqueta ) {
				register_block_style(
					$bloque,
					array(
						'name'  => $nombre,
						'label' => $etiqueta,
					)
				);
			}
		}
	}
);

/* En Contacto no se muestra el botón del header (el formulario ya está en la página). */
add_filter(
	'body_class',
	function ( $clases ) {
		if ( is_page( 'contacto' ) ) {
			$clases[] = 'jau-sin-cta';
		}
		return $clases;
	}
);

/**
 * Menú: marca como activo el enlace de la sección actual (incluye las fichas dentro de Productos)
 * y añade el botón de menú móvil a la navegación principal.
 */
$jau_tema_menu_activo = function ( $html, $block ) {
	$url = isset( $block['attrs']['url'] ) ? $block['attrs']['url'] : '';
	// Las anclas dentro de una página (p. ej. Servicios › JAU Maquila) no marcan la sección: la marca el padre.
	if ( '' === $url || ( 'core/navigation-link' === $block['blockName'] && str_contains( $url, '#' ) ) ) {
		return $html;
	}
	$ruta_enlace = trailingslashit( (string) wp_parse_url( $url, PHP_URL_PATH ) );
	$ruta_actual = trailingslashit( (string) wp_parse_url( home_url( add_query_arg( array() ) ), PHP_URL_PATH ) );
	$base        = trailingslashit( (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ) );

	$activo = ( $ruta_enlace === $ruta_actual )
		|| ( $ruta_enlace !== $base && str_starts_with( $ruta_actual, $ruta_enlace ) );

	if ( $activo ) {
		$p = new WP_HTML_Tag_Processor( $html );
		if ( $p->next_tag( 'li' ) ) {
			$p->add_class( 'current-menu-item' );
		}
		if ( $p->next_tag( 'a' ) ) {
			$p->set_attribute( 'aria-current', 'page' );
		}
		$html = $p->get_updated_html();
	}
	return $html;
};
add_filter( 'render_block_core/navigation-link', $jau_tema_menu_activo, 10, 2 );
add_filter( 'render_block_core/navigation-submenu', $jau_tema_menu_activo, 10, 2 );

add_filter(
	'render_block_core/navigation',
	function ( $html, $block ) {
		if ( empty( $block['attrs']['className'] ) || ! str_contains( $block['attrs']['className'], 'jau-nav' ) ) {
			return $html;
		}
		$boton = '<button type="button" class="jau-menu-toggle" aria-expanded="false" aria-controls="jau-menu" aria-label="' . esc_attr__( 'Abrir menú', 'industrias-jau' ) . '">'
			. '<svg class="jau-menu-toggle__abrir" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16 M4 12h16 M4 17h16"></path></svg>'
			. '<svg class="jau-menu-toggle__cerrar" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12 M18 6L6 18"></path></svg>'
			. '</button>';
		$p = new WP_HTML_Tag_Processor( $html );
		if ( $p->next_tag( 'nav' ) ) {
			$p->set_attribute( 'id', 'jau-menu' );
		}
		return $boton . $p->get_updated_html();
	},
	10,
	2
);

/* Botón flotante de WhatsApp de ventas (DWIJ-19), con el número de «Datos de la empresa». */
add_action(
	'wp_footer',
	function () {
		if ( ! function_exists( 'jau_dato' ) ) {
			return;
		}
		$url = jau_dato( 'whatsapp_url' );
		if ( '' === $url ) {
			return;
		}

		/* Con WhatsApp en cliente directo y atención al consumidor (DWIJ-81), el botón abre un menú
		   con los tres tipos de contacto para que nadie escriba al número equivocado. */
		$grupos   = function_exists( 'jau_contactos' ) ? jau_contactos() : array();
		$opciones = array();
		foreach ( $grupos as $clave => $grupo ) {
			foreach ( $grupo['filas'] as $fila ) {
				if ( '' === $fila['wa'] ) {
					continue;
				}
				$opciones[ $clave ][] = array(
					'texto' => 'distribuidores' === $clave ? 'Quiero ser distribuidor' : ( '' !== $fila['lugar'] ? $fila['lugar'] : $grupo['titulo'] ),
					'url'   => $fila['wa'],
				);
			}
		}
		if ( count( $opciones ) > 1 ) {
			echo '<details class="jau-wa-menu"><summary class="jau-wa-flotante" aria-label="' . esc_attr__( 'Escríbenos por WhatsApp', 'industrias-jau' ) . '">' . jau_tema_svg( 'wa', 28, 1.8 ) . '</summary>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<div class="jau-wa-menu__panel"><p class="jau-wa-menu__titulo">' . esc_html__( 'Escríbenos por WhatsApp', 'industrias-jau' ) . '</p>';
			foreach ( $opciones as $clave => $lista ) {
				$con_grupo = 'cliente' === $clave;
				echo '<div class="jau-wa-menu__grupo">';
				if ( $con_grupo ) {
					echo '<p class="jau-wa-menu__subtitulo">' . esc_html( $grupos[ $clave ]['titulo'] ) . '</p>';
				}
				foreach ( $lista as $op ) {
					printf(
						'<a class="jau-wa-menu__opcion" href="%1$s" target="_blank" rel="noopener"%3$s>%2$s</a>',
						esc_url( $op['url'] ),
						esc_html( $op['texto'] ),
						$con_grupo ? ' aria-label="' . esc_attr( $grupos[ $clave ]['titulo'] . ': ' . $op['texto'] ) . '"' : ''
					);
				}
				echo '</div>';
			}
			echo '</div></details>';
			wp_print_inline_script_tag(
				"(function(){var m=document.querySelector('.jau-wa-menu');if(!m)return;" .
				"document.addEventListener('click',function(e){if(m.open&&!m.contains(e.target))m.open=false;});" .
				"document.addEventListener('keydown',function(e){if(e.key==='Escape'&&m.open){m.open=false;m.querySelector('summary').focus();}});" .
				"m.addEventListener('click',function(e){if(e.target.closest('a'))m.open=false;});})();"
			);
			return;
		}

		printf(
			'<a class="jau-wa-flotante" href="%1$s" target="_blank" rel="noopener" aria-label="%2$s" title="%2$s">%3$s</a>',
			esc_url( $url ),
			esc_attr__( 'Escríbenos por WhatsApp', 'industrias-jau' ),
			jau_tema_svg( 'wa', 28, 1.8 ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
);

/**
 * URL de una imagen para los patrones: primero la de la biblioteca de medios
 * (importada con la clave indicada), si no existe, cadena vacía.
 *
 * @param string $clave Clave guardada en el meta `_jau_clave` del adjunto.
 * @return array{url: string, id: int, alt: string}
 */
function jau_tema_img( $clave ) {
	static $cache = array();
	if ( isset( $cache[ $clave ] ) ) {
		return $cache[ $clave ];
	}
	$ids = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_key'       => '_jau_clave', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => $clave, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
		)
	);
	$id = $ids ? (int) $ids[0] : 0;

	$cache[ $clave ] = array(
		'url' => $id ? (string) wp_get_attachment_image_url( $id, 'full' ) : '',
		'id'  => $id,
		'alt' => $id ? (string) get_post_meta( $id, '_wp_attachment_image_alt', true ) : '',
	);
	return $cache[ $clave ];
}

/**
 * Marcado de un bloque Imagen con un adjunto de la biblioteca (por clave). Vacío si no existe.
 *
 * @param string $clave Clave `_jau_clave` del adjunto.
 * @param string $clase Clase CSS del bloque.
 * @param string $tam   Tamaño registrado (full, large…).
 * @return string
 */
function jau_tema_bloque_imagen( $clave, $clase = '', $tam = 'full' ) {
	$img = jau_tema_img( $clave );
	if ( ! $img['id'] ) {
		return '';
	}
	$url   = (string) wp_get_attachment_image_url( $img['id'], $tam );
	$attrs = array(
		'id'              => $img['id'],
		'sizeSlug'        => $tam,
		'linkDestination' => 'none',
	);
	if ( '' !== $clase ) {
		$attrs['className'] = $clase;
	}
	return sprintf(
		'<!-- wp:image %1$s -->' . "\n" . '<figure class="wp-block-image size-%2$s%3$s"><img src="%4$s" alt="%5$s" class="wp-image-%6$d"/></figure>' . "\n" . '<!-- /wp:image -->',
		wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ),
		esc_attr( $tam ),
		'' !== $clase ? ' ' . esc_attr( $clase ) : '',
		esc_url( $url ),
		esc_attr( $img['alt'] ),
		$img['id']
	);
}

/**
 * Escena de JAU Maquila (DWIJ-83): círculo azul con una gaseosa y una saborizada, y las dos
 * soluciones del cliente («Bebidas gaseosas», «Bebidas saborizadas») como etiquetas flotantes.
 * La usan el inicio (maquila-teaser) y Servicios (maquila).
 *
 * @return string Marcado de bloques.
 */
function jau_tema_escena_maquila() {
	$etiquetas = array(
		array( 'burbujas', 'Bebidas gaseosas', 'jau-escena__etiqueta--arriba' ),
		array( 'citrico', 'Bebidas saborizadas', 'jau-escena__etiqueta--abajo' ),
	);
	$html = '<!-- wp:group {"className":"jau-escena jau-escena--maquila","layout":{"type":"default"}} -->' . "\n"
		. '<div class="wp-block-group jau-escena jau-escena--maquila"><!-- wp:group {"className":"jau-botellas","layout":{"type":"default"}} -->' . "\n"
		. '<div class="wp-block-group jau-botellas">' . jau_tema_bloque_imagen( 'drink-cola-1-5-l', 'jau-botella jau-botella--centro', 'full' ) . "\n\n" . jau_tema_bloque_imagen( 'frugy-pina-colada-botella', 'jau-botella jau-botella--media', 'full' ) . '</div>' . "\n"
		. '<!-- /wp:group -->';
	foreach ( $etiquetas as $e ) {
		$html .= "\n\n" . '<!-- wp:group {"className":"jau-escena__etiqueta ' . $e[2] . '","style":{"spacing":{"blockGap":"10px"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->' . "\n"
			. '<div class="wp-block-group jau-escena__etiqueta ' . $e[2] . '"><!-- wp:industrias-jau/icono {"icono":"' . $e[0] . '","tamano":40,"estilo":"caja"} /-->' . "\n\n"
			. '<!-- wp:paragraph -->' . "\n" . '<p>' . esc_html( $e[1] ) . '</p>' . "\n" . '<!-- /wp:paragraph --></div>' . "\n"
			. '<!-- /wp:group -->';
	}
	return $html . '</div>' . "\n" . '<!-- /wp:group -->';
}

/* Tamaños intermedios en WebP con más calidad (por defecto 82 ablanda las fotos en el slider). */
add_filter(
	'wp_editor_set_quality',
	function ( $calidad, $mime ) {
		return 'image/webp' === $mime ? 90 : $calidad;
	},
	10,
	2
);

/* Filas de fotos que rotan en móvil: el script solo se carga donde hay una. */
foreach ( array( 'core/group', 'core/gallery' ) as $jau_bloque_fotos ) {
	add_filter(
		'render_block_' . $jau_bloque_fotos,
		function ( $html, $block ) {
			if ( ! empty( $block['attrs']['className'] ) && str_contains( $block['attrs']['className'], 'jau-fotos' ) ) {
				wp_enqueue_script( 'industrias-jau-fotos' );
			}
			return $html;
		},
		10,
		2
	);
}
