#!/bin/sh
# Industrias JAU · arranque del contenedor.
set -e

# Apache con mod_php solo admite mpm_prefork. Si aparece otro MPM activo, Apache no arranca
# («AH00534: More than one MPM loaded»): se deja únicamente prefork.
for mpm in mpm_event mpm_worker; do
	rm -f "/etc/apache2/mods-enabled/${mpm}.load" "/etc/apache2/mods-enabled/${mpm}.conf"
done
if [ ! -e /etc/apache2/mods-enabled/mpm_prefork.load ]; then
	a2enmod mpm_prefork >/dev/null
fi
echo "MPM activos: $(ls /etc/apache2/mods-enabled/ | grep '^mpm_' | tr '\n' ' ')"

# El volumen de Railway se monta como root: se le da permiso a Apache (www-data) para subir imágenes.
mkdir -p /var/www/html/wp-content/uploads
chown -R www-data:www-data /var/www/html/wp-content/uploads

# Apache escucha en el puerto que indique Railway (80 por defecto).
if [ -n "$PORT" ] && [ "$PORT" != "80" ]; then
	sed -i "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf
	sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf
fi

# Carga de contenido en segundo plano (solo si cambió herramientas/version-contenido.txt).
# La salida va al log del contenedor.
if [ -f /opt/jau/herramientas/auto-preparar.sh ]; then
	( sh /opt/jau/herramientas/auto-preparar.sh > /proc/1/fd/1 2>&1 & )
fi

exec docker-entrypoint.sh "$@"
