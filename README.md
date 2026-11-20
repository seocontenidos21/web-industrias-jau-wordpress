# Industrias JAU · Web corporativa (WordPress)

Web de 5 secciones (Inicio, Servicios, Sobre nosotros, Productos y Contacto) para mostrar el portafolio de Industrias JAU y captar distribuidores. Es la migración a WordPress del **Prototipo A · Sencillo** (`prototipo-A-sencillo/`), el que eligió el cliente. Requisitos y contenidos: Jira, proyecto **DWIJ** (épica DWIJ-52).

## Qué hay en este repo

| Ruta | Qué es |
|---|---|
| `wp-content/themes/industrias-jau/` | Tema de bloques: diseño (`theme.json`), plantillas, partes, patrones, CSS y JS (menú y slider). |
| `wp-content/plugins/jau-core/` | Funcionalidad: productos (marca, presentación y sabor), formulario «Quiero ser distribuidor» con registro y CSV, «Datos de la empresa» y bloques dinámicos. |
| `herramientas/` | Scripts de carga de contenido, optimización de imágenes y preparación del servidor. |
| `insumos-optimizados/` | Imágenes del cliente ya optimizadas (los originales no se versionan). |
| `prototipo-A-sencillo/` | Prototipo HTML aprobado (referencia). |
| `Dockerfile`, `docker/`, `railway.json` | Entorno de pruebas en Railway. |

No se versionan el núcleo de WordPress, la base de datos, `wp-config.php` ni `wp-content/uploads`.

## Dónde se cambia cada cosa

- **Colores, fuentes, tamaños:** `theme.json`. El primario es el azul del logo (#30406E); el resto de la paleta sigue provisional hasta el manual de marca.
- **Teléfono, WhatsApp, dirección, horario, correo y redes:** admin → *Ajustes › Datos de la empresa*. Se actualizan en todo el sitio.
- **Productos:** admin → *Productos*. Una ficha por producto o sabor, con marca, presentaciones y sabor; la casilla «Inicio» lo muestra en destacados. El logo de cada marca se elige en *Productos › Marcas*.
- **Solicitudes de distribuidores:** admin → *Distribuidores* (botón **Exportar CSV**). Se envía correo cuando hay un destinatario en Datos de la empresa.
- **Textos de las páginas:** se editan en cada página. Header, footer y bloque de cierre, en *Apariencia › Editor*.

## Desarrollo local (WordPress Studio)

```bash
studio start --skip-browser
studio wp eval-file herramientas/sembrar-contenido.php medios      # importa insumos-optimizados/ y retira las muestras
studio wp eval-file herramientas/sembrar-contenido.php contenido   # marcas, productos, páginas, datos
studio wp eval-file herramientas/sembrar-contenido.php paginas     # solo regenera páginas desde los patrones
```

> ⚠ `paginas` y `contenido` reescriben el contenido de las páginas con los patrones del tema.

Imágenes del cliente: descarga la carpeta de Drive «Insumos Industrias JAU» y corre (los originales no se versionan):

```bash
python -I herramientas/optimizar-imagenes.py "<carpeta descargada>/Insumos Industrias JAU" insumos-optimizados
```

## Entorno de pruebas (Railway)

El proyecto **[WEB] JAU WordPress - [Daiana]** construye el `Dockerfile` desde la rama `main`: WordPress 7.1.5 y PHP 8.4, más el tema y el plugin. Las imágenes subidas viven en un volumen montado en `wp-content/uploads`, y la base de datos en el servicio MariaDB.

- Se trabaja en la rama `desarrollo`; al cerrar una fase se hace merge a `main` y Railway redespliega.
- En el servidor no se instalan plugins ni se editan archivos desde el admin (`DISALLOW_FILE_MODS`): todo cambio de código entra por el repo.
- Primera vez: completar el instalador en `/wp-admin/install.php` y luego correr:
  `railway ssh -s wordpress -- sh /opt/jau/herramientas/preparar-sitio.sh`
