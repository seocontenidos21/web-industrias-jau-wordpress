<?php
/**
 * Formulario «Quiero ser distribuidor» (DWIJ-18). Envía a admin-post.php → jau_form_procesar().
 *
 * @package jau-core
 */

defined( 'ABSPATH' ) || exit;

// phpcs:disable WordPress.Security.NonceVerification.Recommended -- solo lectura de estado para mostrar el formulario.
$jau_enviado = isset( $_GET['enviado'] ) && '1' === $_GET['enviado'];
$jau_valores = array();
$jau_errores = array();
if ( isset( $_GET['jau_f'] ) ) {
	$jau_guardado = get_transient( 'jau_f_' . sanitize_key( wp_unslash( $_GET['jau_f'] ) ) );
	if ( is_array( $jau_guardado ) ) {
		list( $jau_valores, $jau_errores ) = $jau_guardado;
	}
}
if ( empty( $jau_valores['mensaje'] ) && ! empty( $_GET['interes'] ) ) {
	$jau_valores['mensaje'] = 'Me interesa: ' . sanitize_text_field( wp_unslash( $_GET['interes'] ) );
}
// phpcs:enable

$jau_volver = remove_query_arg( array( 'enviado', 'jau_f', 'interes' ), home_url( add_query_arg( array() ) ) );
$jau_ts     = (string) time();
$jau_wrap   = get_block_wrapper_attributes( array( 'class' => 'jau-form-caja' ) );
$jau_check  = '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"></path></svg>';
?>
<div <?php echo $jau_wrap; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<span id="formulario" class="jau-ancla"></span>
	<?php if ( $jau_enviado ) : ?>
		<div class="jau-form-exito" role="status" tabindex="-1">
			<span class="jau-form-exito__check"><?php echo $jau_check; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<h2 class="wp-block-heading">Solicitud enviada</h2>
			<p>Recibimos tu solicitud. El equipo de ventas te contactará pronto.</p>
			<a class="jau-form-exito__otra" href="<?php echo esc_url( remove_query_arg( 'enviado', $jau_volver ) . '#formulario' ); ?>">Enviar otra solicitud</a>
		</div>
	<?php else : ?>
		<form class="jau-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
			<h2 class="wp-block-heading jau-form__titulo">Quiero ser distribuidor</h2>
			<?php if ( $jau_errores ) : ?>
				<p class="jau-form__aviso" role="alert"><?php echo esc_html( isset( $jau_errores['_form'] ) ? $jau_errores['_form'] : 'Revisa los campos marcados.' ); ?></p>
			<?php endif; ?>
			<?php
			foreach ( jau_form_campos() as $jau_id => $jau_c ) :
				$jau_fid    = 'jau-f-' . $jau_id;
				$jau_val    = isset( $jau_valores[ $jau_id ] ) ? $jau_valores[ $jau_id ] : '';
				$jau_err    = isset( $jau_errores[ $jau_id ] ) ? $jau_errores[ $jau_id ] : '';
				$jau_attrs  = sprintf(
					'id="%1$s" name="%2$s" data-tipo="%3$s" aria-describedby="%1$s-error"%4$s%5$s',
					esc_attr( $jau_fid ),
					esc_attr( $jau_id ),
					esc_attr( $jau_c['tipo'] ),
					$jau_c['req'] ? ' required aria-required="true"' : '',
					$jau_err ? ' aria-invalid="true"' : ''
				);
				$jau_clases = 'jau-form__campo' . ( 'textarea' === $jau_c['tipo'] ? ' jau-form__campo--ancho' : '' ) . ( $jau_err ? ' is-error' : '' );
				$jau_label  = str_replace( ' (opcional)', '', $jau_c['label'] );
				?>
				<div class="<?php echo esc_attr( $jau_clases ); ?>">
					<label for="<?php echo esc_attr( $jau_fid ); ?>">
						<?php echo esc_html( $jau_c['req'] ? $jau_label : $jau_c['label'] ); ?>
						<?php if ( $jau_c['req'] ) : ?>
							<span class="jau-form__req" aria-hidden="true">*</span>
						<?php endif; ?>
					</label>
					<?php if ( 'select' === $jau_c['tipo'] ) : ?>
						<select <?php echo $jau_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<option value="">Selecciona una opción</option>
							<?php foreach ( $jau_c['opciones'] as $jau_o ) : ?>
								<option value="<?php echo esc_attr( $jau_o ); ?>" <?php selected( $jau_val, $jau_o ); ?>><?php echo esc_html( $jau_o ); ?></option>
							<?php endforeach; ?>
						</select>
					<?php elseif ( 'textarea' === $jau_c['tipo'] ) : ?>
						<textarea rows="4" maxlength="2000" <?php echo $jau_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_textarea( $jau_val ); ?></textarea>
					<?php else : ?>
						<input type="<?php echo esc_attr( $jau_c['tipo'] ); ?>" value="<?php echo esc_attr( $jau_val ); ?>" maxlength="200" <?php echo 'email' === $jau_c['tipo'] ? 'autocomplete="email"' : ( 'tel' === $jau_c['tipo'] ? 'autocomplete="tel"' : ( 'nombre' === $jau_id ? 'autocomplete="name"' : ( 'empresa' === $jau_id ? 'autocomplete="organization"' : '' ) ) ); ?> <?php echo $jau_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php endif; ?>
					<span class="jau-form__error" id="<?php echo esc_attr( $jau_fid ); ?>-error"><?php echo esc_html( $jau_err ); ?></span>
				</div>
			<?php endforeach; ?>

			<div class="jau-form__trampa" aria-hidden="true">
				<label for="jau-f-sitio">No llenar este campo</label>
				<input type="text" id="jau-f-sitio" name="sitio_web" tabindex="-1" autocomplete="off">
			</div>
			<input type="hidden" name="action" value="jau_solicitud">
			<input type="hidden" name="volver" value="<?php echo esc_url( $jau_volver ); ?>">
			<input type="hidden" name="jau_ts" value="<?php echo esc_attr( $jau_ts ); ?>">
			<input type="hidden" name="jau_tf" value="<?php echo esc_attr( jau_form_firma( $jau_ts ) ); ?>">
			<?php wp_nonce_field( 'jau_solicitud', 'jau_nonce', false ); ?>

			<div class="jau-form__pie">
				<span class="jau-form__nota"><?php echo wp_kses_post( 'Atención: ' . jau_dato_html( 'horario' ) ); ?></span>
				<button type="submit" class="jau-form__enviar">Enviar solicitud</button>
			</div>
		</form>
	<?php endif; ?>
</div>
