<?php
/**
 * Cobertura (DWIJ-85): mapa de Venezuela con los estados donde están los productos en el azul de
 * la marca y, al lado, la lista de esos estados (sin numeración). El mapa base es de SimpleMaps.com
 * (libre para uso comercial), simplificado con herramientas/simplificar-mapa.py → venezuela.json.
 *
 * @package jau-core
 * @var array $attributes
 */

defined( 'ABSPATH' ) || exit;

$jau_datos = wp_json_file_decode( __DIR__ . '/venezuela.json', array( 'associative' => true ) );
if ( empty( $jau_datos['estados'] ) ) {
	return;
}

// Estados elegidos, en el orden en que se cargaron (solo los que existen en el mapa).
$jau_ids = array();
foreach ( $jau_datos['estados'] as $jau_id => $jau_e ) {
	$jau_ids[ $jau_e['nombre'] ] = $jau_id;
}
$jau_elegidos = array();
foreach ( (array) ( $attributes['estados'] ?? array() ) as $jau_nombre ) {
	if ( isset( $jau_ids[ $jau_nombre ] ) && ! in_array( $jau_nombre, $jau_elegidos, true ) ) {
		$jau_elegidos[] = $jau_nombre;
	}
}

// Primero los estados sin presencia y después los marcados, para que su borde quede encima.
$jau_estados = $jau_datos['estados'];
uasort(
	$jau_estados,
	function ( $a, $b ) use ( $jau_elegidos ) {
		return (int) in_array( $a['nombre'], $jau_elegidos, true ) <=> (int) in_array( $b['nombre'], $jau_elegidos, true );
	}
);
// Estados muy pequeños a esta escala: además del área llevan un punto para que se vean y se puedan tocar.
$jau_con_punto = array( 'VEA', 'VEX' );
$jau_titulo_id = wp_unique_id( 'jau-cobertura-' );

// «mini»: solo el mapa, para la franja del inicio.
$jau_mini = isset( $attributes['variante'] ) && 'mini' === $attributes['variante'];
$jau_wrap = get_block_wrapper_attributes( array( 'class' => 'jau-cobertura-mapa' . ( $jau_mini ? ' jau-cobertura-mapa--mini' : '' ) ) );
?>
<div <?php echo $jau_wrap; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<figure class="jau-cobertura-mapa__mapa">
		<svg viewBox="<?php echo esc_attr( $jau_datos['viewBox'] ); ?>" role="img" aria-labelledby="<?php echo esc_attr( $jau_titulo_id ); ?>" focusable="false">
			<title id="<?php echo esc_attr( $jau_titulo_id ); ?>"><?php echo esc_html( 'Mapa de Venezuela. En azul, los estados donde se encuentran nuestros productos: ' . implode( ', ', $jau_elegidos ) . '.' ); ?></title>
			<?php foreach ( $jau_estados as $jau_id => $jau_e ) : ?>
				<?php $jau_activo = in_array( $jau_e['nombre'], $jau_elegidos, true ); ?>
				<path class="jau-estado<?php echo $jau_activo ? ' is-activo' : ''; ?>" d="<?php echo esc_attr( $jau_e['d'] ); ?>"<?php echo $jau_activo ? ' data-estado="' . esc_attr( $jau_e['nombre'] ) . '"' : ''; ?>></path>
			<?php endforeach; ?>
			<?php foreach ( $jau_con_punto as $jau_id ) : ?>
				<?php
				$jau_e = $jau_datos['estados'][ $jau_id ] ?? null;
				if ( ! $jau_e || ! in_array( $jau_e['nombre'], $jau_elegidos, true ) ) {
					continue;
				}
				?>
				<circle class="jau-estado-punto" cx="<?php echo esc_attr( $jau_e['cx'] ); ?>" cy="<?php echo esc_attr( $jau_e['cy'] ); ?>" r="6" data-estado="<?php echo esc_attr( $jau_e['nombre'] ); ?>"></circle>
			<?php endforeach; ?>
		</svg>
		<span class="jau-cobertura-mapa__etiqueta" aria-hidden="true" hidden></span>
	</figure>
	<?php if ( $jau_elegidos && ! $jau_mini ) : ?>
		<ul class="jau-estados">
			<?php foreach ( $jau_elegidos as $jau_nombre ) : ?>
				<li data-estado="<?php echo esc_attr( $jau_nombre ); ?>"><?php echo esc_html( $jau_nombre ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div>
