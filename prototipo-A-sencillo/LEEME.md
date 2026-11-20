# Industrias JAU · Prototipo A (Sencillo)

Código del prototipo sencillo de la web de Industrias JAU, con versión de escritorio y móvil.
Es la misma versión publicada en el entorno de prototipos (propuesta A).

## Verlo en tu computadora

Necesitas Node.js 18 o superior. Desde esta carpeta:

```bash
node server.js
```

Y abre http://localhost:3000

Hay que abrirlo con un servidor: si haces doble clic en el HTML, el navegador no carga la página.
También necesita internet para las fuentes de Google, la librería React y dos fotos de referencia.

Al cargar, la consola del navegador muestra avisos con `{{ … }}` (rutas 404 y trazos SVG).
Es el navegador leyendo la plantilla antes de que `support.js` la procese; no afecta la página.

## Archivos

| Archivo | Qué contiene |
|---|---|
| `JauA.dc.html` | El prototipo: estructura, estilos y comportamiento de todas las páginas (Inicio, Servicios, Sobre nosotros, Productos con la ficha de cada producto, y Contacto con el formulario «Quiero ser distribuidor»). Los ajustes de móvil están en el bloque `/* ===== Versión móvil (prototipo A) ===== */` y en las clases `ja-*`. |
| `jau-data.js` | Contenidos: productos (marcas, sabores, tamaños, fotos), textos, datos de contacto, formularios y lógica compartida de navegación. Para cambiar un texto o un producto, se edita aquí. |
| `jau-tema.css` | Colores, fuentes y radios. Es una marca provisional: cuando llegue la definitiva, solo cambia este archivo. |
| `support.js` | Motor que interpreta el archivo `.dc.html` (lo genera la herramienta de diseño; no hace falta editarlo). Carga React 18 desde unpkg.com. |
| `img/productos/` | Fotos de productos. Cada `.png` tiene una versión `.webp` más liviana; el servidor la entrega sola cuando el navegador la acepta. |
| `server.js` | Servidor estático sin dependencias (marca las páginas como `noindex` y comprime los archivos). |
| `index.html` | Redirige a `JauA.dc.html`. |

## Pendientes de contenido

- Las dos fotos de ambiente de Inicio y Nosotros son de referencia (Unsplash).
- Las unidades por bulto de cada presentación son datos de ejemplo por confirmar con el cliente.
- El botón de WhatsApp todavía no abre un chat real: falta el número de ventas.
