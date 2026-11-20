#!/bin/sh
# Industrias JAU · preparación automática del entorno de pruebas al arrancar el contenedor.
#
# Corre preparar-sitio.sh una sola vez por versión de contenido: solo si el número de
# herramientas/version-contenido.txt es distinto del guardado en WordPress (opción jau_version_contenido).
# Para volver a cargar el contenido en Railway: subir ese número en el repo y hacer push a main.
# OJO: la carga regenera las páginas desde los patrones; si el cliente ya editó textos en el admin, no subir la versión.
WP="wp --allow-root --path=/var/www/html"
VERSION=$(tr -d ' \r\n' < /opt/jau/herramientas/version-contenido.txt)

# Espera a que WordPress esté copiado, con base de datos e instalado (hasta ~10 minutos).
i=0
until $WP core is-installed >/dev/null 2>&1; do
	i=$((i + 1))
	if [ "$i" -ge 60 ]; then
		echo "[jau] WordPress no está instalado: se omite la carga de contenido (completa /wp-admin/install.php y reinicia)."
		exit 0
	fi
	sleep 10
done

ACTUAL=$($WP option get jau_version_contenido 2>/dev/null || echo "")
if [ "$ACTUAL" = "$VERSION" ]; then
	echo "[jau] Contenido al día (versión $VERSION)."
	exit 0
fi

echo "[jau] Cargando contenido versión $VERSION (antes: ${ACTUAL:-ninguna})…"
if sh /opt/jau/herramientas/preparar-sitio.sh; then
	$WP option update jau_version_contenido "$VERSION" >/dev/null
	echo "[jau] Contenido versión $VERSION cargado."
else
	echo "[jau] ERROR al cargar el contenido; se reintentará en el próximo arranque."
fi
