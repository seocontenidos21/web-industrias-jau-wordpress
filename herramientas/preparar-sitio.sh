#!/bin/sh
# Industrias JAU · prepara el WordPress del entorno de pruebas (Railway) después del instalador.
#
# Uso (desde tu computadora, con el proyecto de Railway vinculado):
#   railway ssh -s wordpress -- sh /opt/jau/herramientas/preparar-sitio.sh
#
# Requisito: WordPress ya instalado (asistente en /wp-admin/install.php).
# Es idempotente: se puede volver a correr. OJO: el paso «contenido» regenera las páginas
# desde los patrones; si el cliente ya editó textos en el admin, usa solo los pasos necesarios.
set -e
cd /var/www/html
WP="wp --allow-root --path=/var/www/html"

if ! $WP core is-installed; then
	echo "WordPress todavía no está instalado. Completa el asistente en /wp-admin/install.php y vuelve a correr este script."
	exit 1
fi

$WP language core install es_ES --activate || true
$WP option update timezone_string "America/Caracas"
$WP option update date_format 'j \d\e F \d\e Y'
$WP option update time_format 'g:i a'
$WP option update start_of_week 1
$WP option update blog_public 0
$WP rewrite structure '/%postname%/'

$WP theme activate industrias-jau
$WP plugin activate jau-core

# Contenido de ejemplo de WordPress (solo si existe).
for id in $($WP post list --post_type=post,page --post_status=any --post_name__in=hola-mundo,hello-world,pagina-ejemplo,sample-page,politica-privacidad,privacy-policy --format=ids); do
	$WP post delete "$id" --force
done

# Pasos de carga (mismos que en local).
$WP eval-file /opt/jau/herramientas/sembrar-contenido.php medios
$WP eval-file /opt/jau/herramientas/sembrar-contenido.php contenido
if [ -f /opt/jau/herramientas/asignar-imagenes.php ]; then
	$WP eval-file /opt/jau/herramientas/asignar-imagenes.php
fi

$WP rewrite flush
chown -R www-data:www-data /var/www/html/wp-content/uploads
echo "Listo: $($WP option get home)"
