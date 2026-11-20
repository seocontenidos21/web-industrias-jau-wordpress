<?php
/**
 * Catálogo: tipo de contenido «Producto» con marca, presentación y sabor (DWIJ-56, DWIJ-66, DWIJ-67).
 * Una ficha por producto o sabor, con sus presentaciones. Sumar productos = crear fichas.
 *
 * @package jau-core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registra el tipo de contenido y las taxonomías.
 */
function jau_registrar_productos() {
	register_post_type(
		'producto',
		array(
			'labels'        => array(
				'name'               => 'Productos',
				'singular_name'      => 'Producto',
				'add_new'            => 'Añadir producto',
				'add_new_item'       => 'Añadir producto',
				'edit_item'          => 'Editar producto',
				'new_item'           => 'Nuevo producto',
				'view_item'          => 'Ver producto',
				'search_items'       => 'Buscar productos',
				'not_found'          => 'No hay productos',
				'not_found_in_trash' => 'No hay productos en la papelera',
				'all_items'          => 'Todos los productos',
				'menu_name'          => 'Productos',
				'featured_image'     => 'Foto del producto (botella)',
				'set_featured_image' => 'Elegir foto del producto',
			),
			'public'        => true,
			'has_archive'   => 'productos',
			'rewrite'       => array(
				'slug'       => 'productos',
				'with_front' => false,
			),
			'menu_icon'     => 'dashicons-products',
			'menu_position' => 20,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'custom-fields' ),
			'show_in_rest'  => true,
			'template'      => array(
				array( 'core/paragraph', array( 'placeholder' => 'Opcional: galería de presentaciones, fotos de ambiente o descripción ampliada.' ) ),
			),
		)
	);

	$taxonomias = array(
		'marca'        => array( 'Marcas', 'Marca' ),
		'presentacion' => array( 'Presentaciones', 'Presentación' ),
		'sabor'        => array( 'Sabores', 'Sabor' ),
	);
	foreach ( $taxonomias as $slug => $nombres ) {
		register_taxonomy(
			$slug,
			'producto',
			array(
				'labels'            => array(
					'name'          => $nombres[0],
					'singular_name' => $nombres[1],
					'add_new_item'  => 'Añadir ' . strtolower( $nombres[1] ),
					'edit_item'     => 'Editar ' . strtolower( $nombres[1] ),
					'search_items'  => 'Buscar ' . strtolower( $nombres[0] ),
					'all_items'     => 'Todas',
					'menu_name'     => $nombres[0],
				),
				'hierarchical'      => true,
				'public'            => true,
				'show_in_rest'      => true,
				'show_admin_column' => true,
				// Sin query var: ?marca=… queda libre para los filtros del catálogo (no convierte /productos/ en archivo de término).
				'query_var'         => false,
				'rewrite'           => array( 'slug' => $slug ),
			)
		);
	}

	register_post_meta(
		'producto',
		'jau_destacado',
		array(
			'type'          => 'boolean',
			'single'        => true,
			'default'       => false,
			'show_in_rest'  => true,
			'auth_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
		)
	);
	register_term_meta(
		'marca',
		'jau_logo_id',
		array(
			'type'              => 'integer',
			'single'            => true,
			'show_in_rest'      => true,
			'sanitize_callback' => 'absint',
		)
	);
}
add_action( 'init', 'jau_registrar_productos' );

/* Catálogo completo en /productos/, en el orden de «Atributos › Orden». */
add_action(
	'pre_get_posts',
	function ( $q ) {
		if ( is_admin() || ! $q->is_main_query() ) {
			return;
		}
		if ( $q->is_post_type_archive( 'producto' ) ) {
			$q->set( 'posts_per_page', 200 );
			$q->set( 'orderby', array( 'menu_order' => 'ASC', 'title' => 'ASC' ) );
		}
	}
);

/* Las páginas de marca, presentación y sabor llevan al catálogo ya filtrado. */
add_action(
	'template_redirect',
	function () {
		foreach ( array( 'marca', 'presentacion', 'sabor' ) as $tax ) {
			if ( is_tax( $tax ) ) {
				$term = get_queried_object();
				wp_safe_redirect( add_query_arg( $tax, $term->slug, get_post_type_archive_link( 'producto' ) ), 302 );
				exit;
			}
		}
	}
);

/**
 * Orden natural de presentaciones (250 mL, 400 mL, 500 mL, 1.5 L…).
 *
 * @param WP_Term $term Término.
 * @return float Mililitros.
 */
function jau_presentacion_ml( $term ) {
	if ( ! preg_match( '/([\d.,]+)\s*(m?l)/i', $term->name, $m ) ) {
		return PHP_INT_MAX;
	}
	$n = (float) str_replace( ',', '.', $m[1] );
	return 'l' === strtolower( $m[2] ) ? $n * 1000 : $n;
}

/**
 * Términos de una taxonomía usados por productos publicados, ordenados.
 *
 * @param string $tax Taxonomía.
 * @return WP_Term[]
 */
function jau_terminos( $tax ) {
	$terms = get_terms(
		array(
			'taxonomy'   => $tax,
			'hide_empty' => true,
		)
	);
	if ( is_wp_error( $terms ) ) {
		return array();
	}
	if ( 'presentacion' === $tax ) {
		usort(
			$terms,
			function ( $a, $b ) {
				return jau_presentacion_ml( $a ) <=> jau_presentacion_ml( $b );
			}
		);
	}
	return $terms;
}

/* ---------------------------------------------------------------------------
 * Consultas especiales del bloque Query Loop, por clase CSS:
 *   jau-q-destacados   → productos marcados como destacados (inicio)
 *   jau-q-relacionados → misma marca primero, sin la ficha actual
 * ------------------------------------------------------------------------- */
$GLOBALS['jau_q_modos'] = array();

add_filter(
	'pre_render_block',
	function ( $pre, $parsed ) {
		if ( 'core/query' === $parsed['blockName'] ) {
			$clases = isset( $parsed['attrs']['className'] ) ? $parsed['attrs']['className'] : '';
			$modo   = str_contains( $clases, 'jau-q-destacados' ) ? 'destacados' : ( str_contains( $clases, 'jau-q-relacionados' ) ? 'relacionados' : '' );
			$GLOBALS['jau_q_modos'][] = $modo;
		}
		return $pre;
	},
	10,
	2
);
add_filter(
	'render_block_core/query',
	function ( $html ) {
		array_pop( $GLOBALS['jau_q_modos'] );
		return $html;
	}
);
add_filter(
	'query_loop_block_query_vars',
	function ( $vars ) {
		$modo = end( $GLOBALS['jau_q_modos'] );
		if ( 'destacados' === $modo ) {
			$vars['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				array(
					'key'   => 'jau_destacado',
					'value' => '1',
				),
			);
			$vars['orderby']    = array( 'menu_order' => 'ASC', 'title' => 'ASC' );
		} elseif ( 'relacionados' === $modo ) {
			$actual = get_queried_object_id();
			$marcas = wp_get_post_terms( $actual, 'marca', array( 'fields' => 'ids' ) );
			$base   = array(
				'post_type'      => 'producto',
				'post_status'    => 'publish',
				'fields'         => 'ids',
				'posts_per_page' => 8,
				'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
				'post__not_in'   => array( $actual ),
			);
			$misma  = $marcas && ! is_wp_error( $marcas ) ? get_posts( $base + array( 'tax_query' => array( array( 'taxonomy' => 'marca', 'terms' => $marcas ) ) ) ) : array(); // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			$otras  = get_posts( array_merge( $base, array( 'post__not_in' => array_merge( array( $actual ), $misma ) ) ) );
			$ids    = array_slice( array_merge( $misma, $otras ), 0, (int) ( $vars['posts_per_page'] ?? 4 ) );

			$vars['post__in'] = $ids ? $ids : array( 0 );
			$vars['orderby']  = 'post__in';
		}
		return $vars;
	}
);

/* ---------------------------------------------------------------------------
 * Admin: casilla «Destacado en el inicio» y logo de cada marca
 * ------------------------------------------------------------------------- */
add_action(
	'add_meta_boxes_producto',
	function () {
		add_meta_box(
			'jau-destacado',
			'Inicio',
			function ( $post ) {
				wp_nonce_field( 'jau_destacado', 'jau_destacado_nonce' );
				printf(
					'<label><input type="checkbox" name="jau_destacado" value="1" %s> Mostrar en «Productos destacados» del inicio</label>',
					checked( (bool) get_post_meta( $post->ID, 'jau_destacado', true ), true, false )
				);
			},
			'producto',
			'side'
		);
	}
);
add_action(
	'save_post_producto',
	function ( $post_id ) {
		if ( ! isset( $_POST['jau_destacado_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['jau_destacado_nonce'] ) ), 'jau_destacado' ) ) {
			return;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE || ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		update_post_meta( $post_id, 'jau_destacado', ! empty( $_POST['jau_destacado'] ) );
	}
);

/**
 * Campo «Logo de la marca» en el formulario del término.
 *
 * @param WP_Term|string $term Término (al editar) o taxonomía (al crear).
 */
function jau_marca_campo_logo( $term ) {
	$logo_id = is_object( $term ) ? (int) get_term_meta( $term->term_id, 'jau_logo_id', true ) : 0;
	wp_enqueue_media();
	wp_enqueue_script( 'jau-core-marca', JAU_CORE_URL . 'assets/admin-marca.js', array( 'jquery' ), JAU_CORE_VERSION, true );
	$preview = $logo_id ? wp_get_attachment_image( $logo_id, 'medium', false, array( 'style' => 'max-height:80px;width:auto' ) ) : '';
	$campo   = '<input type="hidden" name="jau_logo_id" id="jau-logo-id" value="' . esc_attr( (string) $logo_id ) . '">'
		. '<div id="jau-logo-preview" style="margin:8px 0">' . $preview . '</div>'
		. '<button type="button" class="button" id="jau-logo-elegir">Elegir logo</button> '
		. '<button type="button" class="button-link-delete" id="jau-logo-quitar">Quitar</button>'
		. '<p class="description">Se usa en los filtros del catálogo y en las fichas.</p>';
	if ( is_object( $term ) ) {
		echo '<tr class="form-field"><th scope="row"><label>Logo de la marca</label></th><td>' . $campo . '</td></tr>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		echo '<div class="form-field"><label>Logo de la marca</label>' . $campo . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'marca_add_form_fields', 'jau_marca_campo_logo' );
add_action( 'marca_edit_form_fields', 'jau_marca_campo_logo' );

/**
 * Guarda el logo de la marca.
 *
 * @param int $term_id ID del término.
 */
function jau_marca_guardar_logo( $term_id ) {
	if ( ! current_user_can( 'manage_categories' ) || ! isset( $_POST['jau_logo_id'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing -- el formulario de términos ya valida su nonce.
		return;
	}
	update_term_meta( $term_id, 'jau_logo_id', absint( $_POST['jau_logo_id'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
}
add_action( 'created_marca', 'jau_marca_guardar_logo' );
add_action( 'edited_marca', 'jau_marca_guardar_logo' );

/**
 * HTML del logo de una marca (o vacío).
 *
 * @param WP_Term $term  Marca.
 * @param string  $clase Clase CSS.
 * @return string
 */
function jau_marca_logo( $term, $clase = '' ) {
	$logo_id = (int) get_term_meta( $term->term_id, 'jau_logo_id', true );
	return $logo_id ? wp_get_attachment_image(
		$logo_id,
		'medium',
		false,
		array(
			'class' => $clase,
			'alt'   => $term->name,
		)
	) : '';
}

/* Las presentaciones siempre de menor a mayor (250 mL, 500 mL, 1.5 L) en tarjetas, píldoras y filtros. */
add_filter(
	'get_the_terms',
	function ( $terms, $post_id, $taxonomy ) {
		if ( 'presentacion' === $taxonomy && is_array( $terms ) ) {
			usort(
				$terms,
				function ( $a, $b ) {
					return jau_presentacion_ml( $a ) <=> jau_presentacion_ml( $b );
				}
			);
		}
		return $terms;
	},
	10,
	3
);

/* La ficha toma el color de su marca (círculo detrás de la botella). */
add_filter(
	'body_class',
	function ( $clases ) {
		if ( is_singular( 'producto' ) ) {
			foreach ( (array) get_the_terms( get_queried_object_id(), 'marca' ) as $term ) {
				if ( $term instanceof WP_Term ) {
					$clases[] = 'marca-' . $term->slug;
				}
			}
		}
		return $clases;
	}
);
