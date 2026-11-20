#!/bin/sh
# Industrias JAU · arranque del contenedor.
# El volumen de Railway se monta como root: se le da permiso a Apache (www-data) para subir imágenes.
set -e

mkdir -p /var/www/html/wp-content/uploads
chown -R www-data:www-data /var/www/html/wp-content/uploads

# Apache escucha en el puerto que indique Railway (80 por defecto).
if [ -n "$PORT" ] && [ "$PORT" != "80" ]; then
	sed -i "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
	sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf
fi

exec docker-entrypoint.sh "$@"
