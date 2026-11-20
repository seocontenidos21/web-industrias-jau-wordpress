# Industrias JAU · Imagen del entorno de pruebas (Railway).
# Misma versión de WordPress y PHP que el sitio local de Studio (WP 7.1.5, PHP 8.4).
# El código (tema + plugin) sale del repo; las imágenes subidas viven en el volumen de Railway
# montado en /var/www/html/wp-content/uploads.
FROM wordpress:7.1.5-php8.4-apache

# WP-CLI (para preparar el sitio y correr los scripts de herramientas/) y cliente de MariaDB.
COPY --from=wordpress:cli-2.12.0-php8.4 /usr/local/bin/wp /usr/local/bin/wp
RUN apt-get update \
	&& apt-get install -y --no-install-recommends mariadb-client less \
	&& rm -rf /var/lib/apt/lists/* \
	&& a2enmod headers

# Configuración extra de wp-config (HTTPS detrás del proxy, dominio, entorno).
COPY docker/jau-config.php /usr/src/wordpress/jau-config.php
RUN sed -i "s#/\* That's all, stop editing! Happy publishing. \*/#require_once __DIR__ . '/jau-config.php';\n&#" /usr/src/wordpress/wp-config-docker.php \
	&& grep -q "jau-config.php" /usr/src/wordpress/wp-config-docker.php

# Código propio: el entrypoint de la imagen lo copia a /var/www/html en cada arranque.
COPY wp-content/themes/industrias-jau /usr/src/wordpress/wp-content/themes/industrias-jau
COPY wp-content/plugins/jau-core /usr/src/wordpress/wp-content/plugins/jau-core

# Recursos para los scripts de carga (fuera de la carpeta pública).
COPY herramientas /opt/jau/herramientas
COPY prototipo-A-sencillo/img /opt/jau/prototipo-A-sencillo/img
COPY insumos-optimizados /opt/jau/insumos-optimizados

COPY docker/jau-entrypoint.sh /usr/local/bin/jau-entrypoint.sh
RUN chmod +x /usr/local/bin/jau-entrypoint.sh

ENTRYPOINT ["jau-entrypoint.sh"]
CMD ["apache2-foreground"]
