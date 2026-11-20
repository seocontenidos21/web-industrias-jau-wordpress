// Servidor estático mínimo para el entorno de prototipos de Industrias JAU.
// Sin dependencias: Railway lo arranca con `npm start` y le pasa el puerto en PORT.
const http = require('http');
const fs = require('fs');
const path = require('path');
const zlib = require('zlib');

const ROOT = __dirname;
const PORT = process.env.PORT || 3000;

const TYPES = {
  '.html': 'text/html; charset=utf-8',
  '.js': 'text/javascript; charset=utf-8',
  '.css': 'text/css; charset=utf-8',
  '.json': 'application/json; charset=utf-8',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
  '.jpeg': 'image/jpeg',
  '.webp': 'image/webp',
  '.svg': 'image/svg+xml',
  '.ico': 'image/x-icon',
  '.txt': 'text/plain; charset=utf-8'
};
const COMPRESSIBLE = new Set(['.html', '.js', '.css', '.json', '.svg', '.txt']);
// Archivos del servidor que no se publican.
const PRIVATE = new Set(['/server.js', '/package.json', '/railway.json', '/optimizar-imagenes.py']);

function send(res, status, body, headers) {
  res.writeHead(status, Object.assign({ 'X-Robots-Tag': 'noindex, nofollow' }, headers));
  res.end(body);
}

const server = http.createServer((req, res) => {
  if (req.method !== 'GET' && req.method !== 'HEAD') return send(res, 405, 'Method not allowed', { Allow: 'GET, HEAD' });

  let urlPath;
  try { urlPath = decodeURIComponent(new URL(req.url, 'http://x').pathname); }
  catch { return send(res, 400, 'Bad request'); }

  if (urlPath === '/robots.txt') return send(res, 200, 'User-agent: *\nDisallow: /\n', { 'Content-Type': TYPES['.txt'] });
  if (urlPath === '/' ) urlPath = '/index.html';
  if (PRIVATE.has(urlPath)) return send(res, 404, 'Not found');

  let file = path.normalize(path.join(ROOT, urlPath));
  if (!file.startsWith(ROOT + path.sep)) return send(res, 403, 'Forbidden');

  let ext = path.extname(file).toLowerCase();
  const vary = [];

  // Si el navegador acepta WebP y existe la versión optimizada, se sirve en lugar del PNG/JPG.
  if (ext === '.png' || ext === '.jpg' || ext === '.jpeg') {
    vary.push('Accept');
    const webp = file.slice(0, -ext.length) + '.webp';
    if ((req.headers.accept || '').includes('image/webp') && fs.existsSync(webp)) { file = webp; ext = '.webp'; }
  }

  fs.stat(file, (err, st) => {
    if (err || !st.isFile()) return send(res, 404, 'Not found', { 'Content-Type': TYPES['.txt'] });

    const headers = {
      'Content-Type': TYPES[ext] || 'application/octet-stream',
      // HTML y datos se revalidan siempre (para ver los ajustes al instante); imágenes, 1 día.
      'Cache-Control': ext === '.html' || ext === '.js' || ext === '.css' ? 'no-cache' : 'public, max-age=86400',
      'Last-Modified': st.mtime.toUTCString()
    };

    const ims = req.headers['if-modified-since'];
    if (ims && new Date(ims) >= new Date(st.mtime.toUTCString())) return send(res, 304, null, headers);

    const gzip = COMPRESSIBLE.has(ext) && /\bgzip\b/.test(req.headers['accept-encoding'] || '');
    if (COMPRESSIBLE.has(ext)) vary.push('Accept-Encoding');
    if (vary.length) headers.Vary = vary.join(', ');
    if (gzip) headers['Content-Encoding'] = 'gzip';
    else headers['Content-Length'] = st.size;

    res.writeHead(200, Object.assign({ 'X-Robots-Tag': 'noindex, nofollow' }, headers));
    if (req.method === 'HEAD') return res.end();
    const stream = fs.createReadStream(file);
    (gzip ? stream.pipe(zlib.createGzip()) : stream).pipe(res);
  });
});

server.listen(PORT, () => console.log('Prototipos JAU en http://localhost:' + PORT));
