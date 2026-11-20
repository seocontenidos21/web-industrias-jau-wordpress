<?php
/**
 * Industrias JAU · carga inicial de contenido (idempotente: se puede correr varias veces).
 *
 * Uso (desde la raíz del sitio):
 *   studio wp eval-file herramientas/sembrar-contenido.php medios      ← 1) importa insumos-optimizados/ y retira las muestras
 *   studio wp eval-file herramientas/sembrar-contenido.php contenido   ← 2) términos, productos, páginas, ajustes
 *   studio wp eval-file herramientas/sembrar-contenido.php paginas     ← solo regenera las páginas desde los patrones
 *
 * Se corre en dos pasos porque los patrones del tema leen las imágenes de la biblioteca al registrarse.
 *
 * @package industrias-jau
 */

defined( 'ABSPATH' ) || exit;

require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$jau_modo = isset( $args[0] ) ? $args[0] : 'contenido';

// Como administrador: evita que KSES altere el marcado de los bloques al guardar.
$jau_admin = get_users( array( 'role' => 'administrator', 'number' => 1, 'fields' => 'ID' ) );
wp_set_current_user( $jau_admin ? (int) $jau_admin[0] : 1 );
$jau_raiz = dirname( __DIR__ );

/**
 * Mensaje en consola.
 *
 * @param string $m Texto.
 */
function jau_log( $m ) {
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( $m );
	} else {
		echo $m . PHP_EOL; // phpcs:ignore
	}
}

/**
 * Importa (o reutiliza) un adjunto identificado por una clave.
 *
 * @param string $clave   Clave única (meta `_jau_clave`).
 * @param string $archivo Ruta local o URL.
 * @param string $alt     Texto alternativo.
 * @param string $nombre  Nombre de archivo final (slug).
 * @return int ID del adjunto (0 si falla).
 */
function jau_importar( $clave, $archivo, $alt, $nombre = '' ) {
	$existe = get_posts(
		array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'fields'      => 'ids',
			'meta_key'    => '_jau_clave', // phpcs:ignore
			'meta_value'  => $clave, // phpcs:ignore
		)
	);
	if ( $existe ) {
		return (int) $existe[0];
	}
	if ( preg_match( '#^https?://#', $archivo ) ) {
		$tmp = download_url( $archivo, 60 );
		if ( is_wp_error( $tmp ) ) {
			jau_log( "  ✗ {$clave}: " . $tmp->get_error_message() );
			return 0;
		}
	} else {
		if ( ! file_exists( $archivo ) ) {
			jau_log( "  ✗ {$clave}: no existe {$archivo}" );
			return 0;
		}
		$tmp = wp_tempnam( $archivo );
		copy( $archivo, $tmp );
	}
	$ext  = pathinfo( '' !== $nombre ? $nombre : $archivo, PATHINFO_EXTENSION );
	$ext  = $ext ? $ext : 'jpg';
	$file = array(
		'name'     => ( '' !== $nombre ? pathinfo( $nombre, PATHINFO_FILENAME ) : $clave ) . '.' . $ext,
		'tmp_name' => $tmp,
	);
	$id = media_handle_sideload( $file, 0, $alt );
	if ( is_wp_error( $id ) ) {
		jau_log( "  ✗ {$clave}: " . $id->get_error_message() );
		return 0;
	}
	update_post_meta( $id, '_jau_clave', $clave );
	update_post_meta( $id, '_wp_attachment_image_alt', $alt );
	jau_log( "  ✓ {$clave} → #{$id}" );
	return (int) $id;
}

/**
 * ID de un adjunto por clave.
 *
 * @param string $clave Clave.
 * @return int
 */
function jau_adjunto( $clave ) {
	$ids = get_posts(
		array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'fields'      => 'ids',
			'meta_key'    => '_jau_clave', // phpcs:ignore
			'meta_value'  => $clave, // phpcs:ignore
		)
	);
	return $ids ? (int) $ids[0] : 0;
}

/* Catálogo oficial (DWIJ-56): Drink Cola 400 mL y 1.5 L; Frugy 250 mL, 500 mL y 1.5 L en 6 sabores. */
$jau_sabores = array(
	'manzana'    => 'Manzana',
	'naranja'    => 'Naranja',
	'pera'       => 'Pera',
	'durazno'    => 'Durazno',
	'mango'      => 'Mango',
	'limon-coco' => 'Limón-coco',
);
$jau_ml = array(
	'250-ml' => array( '250 mL', '250' ),
	'400-ml' => array( '400 mL', '400' ),
	'500-ml' => array( '500 mL', '500' ),
	'1-5-l'  => array( '1.5 L', '1500' ),
);

/**
 * Texto alternativo a partir del nombre del archivo optimizado.
 *
 * @param string $clave   Nombre sin extensión.
 * @param array  $sabores Sabores (slug => nombre).
 * @return string
 */
function jau_alt_de( $clave, $sabores ) {
	$fijos = array(
		'logo-industrias-jau-azul'   => 'Industrias JAU',
		'isotipo-industrias-jau'     => 'Isotipo de Industrias JAU',
		'favicon-industrias-jau-512' => 'Isotipo de Industrias JAU',
		'logo-drink-cola'            => 'Drink Cola',
		'logo-frugy-verde-blanco'    => 'Frugy',
		'logo-frugy-blanco-verde'    => 'Frugy',
		'drink-cola-400-ml'          => 'Botella de Drink Cola 400 mL',
		'drink-cola-1-5-l'           => 'Botella de Drink Cola 1.5 L',
	);
	if ( isset( $fijos[ $clave ] ) ) {
		return $fijos[ $clave ];
	}
	if ( preg_match( '/^frugy-(.+)-botella$/', $clave, $m ) ) {
		return 'Botella de Frugy ' . ( $sabores[ $m[1] ] ?? ucfirst( $m[1] ) );
	}
	$series = array(
		'desayuno'     => 'Frugy en el desayuno',
		'casual'       => 'Frugy en el día a día',
		'kids'         => 'Frugy en la lonchera',
		'supermercado' => 'Frugy en el supermercado',
		'mango'        => 'Frugy Mango',
		'lc'           => 'Frugy Limón-coco',
		'frr'          => 'Frugy para la mesa y las reuniones',
	);
	foreach ( $series as $k => $texto ) {
		if ( str_starts_with( $clave, 'frugy-' . $k ) ) {
			return $texto;
		}
	}
	return 'Industrias JAU';
}

/* ---------------------------------------------------------------------------
 * 1) Medios: imágenes oficiales del cliente ya optimizadas (insumos-optimizados/)
 *    y retiro de las imágenes de muestra del prototipo (DWIJ-79).
 * ------------------------------------------------------------------------- */
if ( 'medios' === $jau_modo ) {
	$dir = $jau_raiz . '/insumos-optimizados/';
	jau_log( 'Importando imágenes oficiales…' );
	foreach ( array_merge( glob( $dir . '*.webp' ), glob( $dir . '*.png' ) ) as $archivo ) {
		$clave = pathinfo( $archivo, PATHINFO_FILENAME );
		jau_importar( $clave, $archivo, jau_alt_de( $clave, $jau_sabores ), basename( $archivo ) );
	}

	$muestras = array( 'frugy-familia', 'drinkcola-recorte', 'drinkcola-400', 'drinkcola-1500', 'ambiente-nosotros', 'ambiente-almacen' );
	foreach ( array_keys( $jau_sabores ) as $slug ) {
		foreach ( array( '250', '500', '1500' ) as $ml ) {
			$muestras[] = "frugy-{$slug}-{$ml}";
		}
	}
	foreach ( $muestras as $clave ) {
		$id = jau_adjunto( $clave );
		if ( $id ) {
			wp_delete_attachment( $id, true );
			jau_log( "  − muestra retirada: {$clave}" );
		}
	}
	jau_log( 'Listo. Ahora corre el paso «contenido».' );
	return;
}

/* ---------------------------------------------------------------------------
 * 2) Datos de la empresa (DWIJ-55): solo si aún no existen
 * ------------------------------------------------------------------------- */
if ( 'contenido' === $jau_modo ) {
	if ( ! get_option( 'jau_empresa' ) ) {
		update_option(
			'jau_empresa',
			array(
				'telefono'         => '+58 422-5051007',
				'whatsapp'         => '584225051007',
				'whatsapp_mensaje' => 'Hola, quiero información para ser distribuidor de Industrias JAU.',
				'direccion'        => 'Av. Circunvalación 3 y la Calle 148, Local #66-75, Zona Industrial, II Etapa, Sur América, Zulia. Zona postal 4004.',
				'mapa'             => '',
				'horario'          => 'De lunes a viernes, de 8:00 a.m. a 5:00 p.m.',
				'correo'           => '',
				'instagram'        => '',
				'facebook'         => '',
				'tiktok'           => '',
			)
		);
		jau_log( '✓ Datos de la empresa cargados' );
	}

	/* Términos */
	$term = function ( $tax, $slug, $nombre, $desc = '' ) {
		$t = get_term_by( 'slug', $slug, $tax );
		if ( $t ) {
			return (int) $t->term_id;
		}
		$r = wp_insert_term( $nombre, $tax, array( 'slug' => $slug, 'description' => $desc ) );
		return is_wp_error( $r ) ? 0 : (int) $r['term_id'];
	};
	$marca_dc = $term( 'marca', 'drink-cola', 'Drink Cola', 'Bebida gaseosa de cola negra.' );
	$marca_fr = $term( 'marca', 'frugy', 'Frugy', 'Bebidas saborizadas a frutas.' );
	$pres     = array();
	foreach ( $jau_ml as $slug => $d ) {
		$pres[ $slug ] = $term( 'presentacion', $slug, $d[0] );
	}
	$sab = array();
	foreach ( $jau_sabores as $slug => $nombre ) {
		$sab[ $slug ] = $term( 'sabor', $slug, $nombre );
	}
	jau_log( '✓ Marcas, presentaciones y sabores' );

	/* Productos: una ficha por producto o sabor (DWIJ-65, DWIJ-66) */
	$galeria = function ( $items, $titulo = 'Presentaciones', $clase = '' ) {
		$html = '';
		foreach ( $items as $it ) {
			list( $clave, $leyenda ) = $it;
			$id = jau_adjunto( $clave );
			if ( ! $id ) {
				continue;
			}
			$url   = wp_get_attachment_image_url( $id, 'medium_large' );
			$alt   = get_post_meta( $id, '_wp_attachment_image_alt', true );
			$html .= '<!-- wp:image {"id":' . $id . ',"sizeSlug":"medium_large","linkDestination":"none"} -->' . "\n"
				. '<figure class="wp-block-image size-medium_large"><img src="' . esc_url( $url ) . '" alt="' . esc_attr( $alt ) . '" class="wp-image-' . $id . '"/>' . ( '' !== $leyenda ? '<figcaption class="wp-element-caption">' . esc_html( $leyenda ) . '</figcaption>' : '' ) . '</figure>' . "\n"
				. '<!-- /wp:image -->' . "\n\n";
		}
		if ( '' === $html ) {
			return '';
		}
		$cols  = count( $items );
		$attrs = '"columns":' . $cols . ',"imageCrop":false,"linkTo":"none","sizeSlug":"medium_large"' . ( $clase ? ',"className":"' . $clase . '"' : '' );
		return '<!-- wp:heading {"fontSize":"subtitulo"} -->' . "\n" . '<h2 class="wp-block-heading has-subtitulo-font-size">' . esc_html( $titulo ) . '</h2>' . "\n" . '<!-- /wp:heading -->' . "\n\n"
			. '<!-- wp:gallery {' . $attrs . '} -->' . "\n"
			. '<figure class="wp-block-gallery has-nested-images columns-' . $cols . ( $clase ? ' ' . $clase : '' ) . '">' . $html . '</figure>' . "\n" . '<!-- /wp:gallery -->';
	};

	// Fotos de ambiente propias de cada sabor (DWIJ-76). Los demás sabores quedan solo con la botella.
	$jau_momentos = array(
		'mango'      => array( array( array( 'frugy-mango-1', '' ), array( 'frugy-mango-2', '' ), array( 'frugy-mango-3', '' ), array( 'frugy-mango-4', '' ) ), 'Momentos Frugy Mango', 'jau-fotos' ),
		'limon-coco' => array( array( array( 'frugy-lc-1', '' ) ), 'Momentos Frugy Limón-coco', 'jau-fotos' ),
	);

	$productos   = array();
	$productos[] = array(
		'slug'      => 'drink-cola',
		'titulo'    => 'Drink Cola',
		'extracto'  => 'Bebida gaseosa de cola negra.',
		'marca'     => $marca_dc,
		'pres'      => array( '400-ml', '1-5-l' ),
		'sabor'     => 0,
		'foto'      => 'drink-cola-1-5-l',
		'contenido' => array( array( array( 'drink-cola-400-ml', '400 mL' ), array( 'drink-cola-1-5-l', '1.5 L' ) ), 'Presentaciones', 'jau-galeria-botellas' ),
		'destacado' => true,
	);
	foreach ( $jau_sabores as $slug => $nombre ) {
		$productos[] = array(
			'slug'      => 'frugy-' . $slug,
			'titulo'    => 'Frugy ' . $nombre,
			'extracto'  => 'Bebida saborizada a frutas, sabor ' . mb_strtolower( $nombre ) . '.',
			'marca'     => $marca_fr,
			'pres'      => array( '250-ml', '500-ml', '1-5-l' ),
			'sabor'     => $sab[ $slug ],
			'foto'      => "frugy-{$slug}-botella",
			'contenido' => $jau_momentos[ $slug ] ?? null,
			'destacado' => in_array( $slug, array( 'naranja', 'manzana', 'mango' ), true ),
		);
	}

	foreach ( $productos as $orden => $p ) {
		$existente = get_page_by_path( $p['slug'], OBJECT, 'producto' );
		$datos     = array(
			'post_type'    => 'producto',
			'post_status'  => 'publish',
			'post_name'    => $p['slug'],
			'post_title'   => $p['titulo'],
			'post_excerpt' => $p['extracto'],
			'post_content' => $p['contenido'] ? $galeria( ...$p['contenido'] ) : '',
			'menu_order'   => $orden,
		);
		if ( $existente ) {
			$datos['ID'] = $existente->ID;
			$id          = wp_update_post( wp_slash( $datos ) );
		} else {
			$id = wp_insert_post( wp_slash( $datos ) );
		}
		wp_set_object_terms( $id, array( $p['marca'] ), 'marca' );
		wp_set_object_terms( $id, array_map( fn( $s ) => $pres[ $s ], $p['pres'] ), 'presentacion' );
		wp_set_object_terms( $id, $p['sabor'] ? array( $p['sabor'] ) : array(), 'sabor' );
		update_post_meta( $id, 'jau_destacado', $p['destacado'] );
		$foto = jau_adjunto( $p['foto'] );
		if ( $foto ) {
			set_post_thumbnail( $id, $foto );
		}
		jau_log( "✓ Producto {$p['titulo']} (#{$id})" );
	}

	// Logos de las marcas (DWIJ-74, DWIJ-77) y favicon (DWIJ-72).
	foreach ( array( 'drink-cola' => 'logo-drink-cola', 'frugy' => 'logo-frugy-verde-blanco' ) as $slug => $clave ) {
		$t = get_term_by( 'slug', $slug, 'marca' );
		if ( $t && jau_adjunto( $clave ) ) {
			update_term_meta( $t->term_id, 'jau_logo_id', jau_adjunto( $clave ) );
		}
	}
	if ( jau_adjunto( 'favicon-industrias-jau-512' ) ) {
		update_option( 'site_icon', jau_adjunto( 'favicon-industrias-jau-512' ) );
	}
	jau_log( '✓ Logos de marca y favicon' );
	$jau_modo = 'paginas';
}

/* ---------------------------------------------------------------------------
 * 3) Páginas con el contenido de los patrones (editables por el cliente)
 * ------------------------------------------------------------------------- */
if ( 'paginas' === $jau_modo ) {
	$registro = WP_Block_Patterns_Registry::get_instance();
	$patron   = function ( $slug ) use ( $registro ) {
		$p = $registro->get_registered( 'industrias-jau/' . $slug );
		if ( ! $p ) {
			jau_log( "  ✗ patrón no encontrado: {$slug}" );
			return '';
		}
		return trim( $p['content'] );
	};

	$paginas = array(
		array(
			'slug'     => 'inicio',
			'titulo'   => 'Inicio',
			'extracto' => '',
			'orden'    => 0,
			'patrones' => array( 'hero-slider', 'marcas', 'productos-destacados', 'servicios-teaser', 'nosotros-teaser' ),
		),
		array(
			'slug'     => 'servicios',
			'titulo'   => 'Servicios para distribuidores',
			'extracto' => 'Lo que ofrece Industrias JAU a los negocios que se suman como distribuidores de sus bebidas.',
			'orden'    => 1,
			'patrones' => array( 'servicios-grid' ),
		),
		array(
			'slug'     => 'sobre-nosotros',
			'titulo'   => 'Sobre nosotros',
			'extracto' => 'Industrias JAU es una empresa venezolana que produce bebidas en su planta del estado Zulia. Hoy elabora Drink Cola y Frugy, y busca aliados comerciales para llevarlas a más negocios del país.',
			'orden'    => 2,
			'patrones' => array( 'nosotros-contenido' ),
		),
		array(
			'slug'     => 'contacto',
			'titulo'   => 'Contacto',
			'extracto' => 'Completa el formulario para ser distribuidor o escribe directo al equipo de ventas.',
			'orden'    => 4,
			'patrones' => array( 'contacto' ),
		),
	);

	foreach ( $paginas as $p ) {
		$contenido = implode( "\n\n", array_filter( array_map( $patron, $p['patrones'] ) ) );
		$existente = get_page_by_path( $p['slug'], OBJECT, 'page' );
		$datos     = array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_name'    => $p['slug'],
			'post_title'   => $p['titulo'],
			'post_excerpt' => $p['extracto'],
			'post_content' => $contenido,
			'menu_order'   => $p['orden'],
		);
		if ( $existente ) {
			$datos['ID'] = $existente->ID;
			$id          = wp_update_post( wp_slash( $datos ) );
		} else {
			$id = wp_insert_post( wp_slash( $datos ) );
		}
		jau_log( "✓ Página {$p['titulo']} (#{$id})" );
		if ( 'inicio' === $p['slug'] ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $id );
		}
	}

	update_option( 'blogdescription', 'Bebidas hechas en Venezuela' );
	flush_rewrite_rules();
	jau_log( 'Listo.' );
}
