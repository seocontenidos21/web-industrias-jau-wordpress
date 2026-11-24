"""Simplifica el SVG de SimpleMaps (Venezuela, admin1) a un JSON liviano: {viewBox, estados: {id: {nombre, d, cx, cy}}}."""
import json, math, re, sys

origen, destino, eps = sys.argv[1], sys.argv[2], float(sys.argv[3])
svg = open(origen, encoding="utf-8").read()
paths = re.findall(r'<path d="([^"]*)" id="(\w+)" name="([^"]*)"', svg)
TOK = re.compile(r"[MmLlZz]|-?\d*\.?\d+(?:[eE][-+]?\d+)?")

def anillos(d):
    toks = TOK.findall(d)
    i, cmd, cur, ini, ring, out = 0, None, (0.0, 0.0), (0.0, 0.0), [], []
    while i < len(toks):
        t = toks[i]
        if t in "MmLlZz":
            cmd = t; i += 1
            if t in "Zz":
                if ring: out.append(ring)
                ring = []; cur = ini
            continue
        x, y = float(toks[i]), float(toks[i + 1]); i += 2
        if cmd in "Mm":
            if ring: out.append(ring)
            cur = (x, y) if cmd == "M" else (cur[0] + x, cur[1] + y)
            ini = cur; ring = [cur]
            cmd = "L" if cmd == "M" else "l"
        elif cmd == "L":
            cur = (x, y); ring.append(cur)
        else:
            cur = (cur[0] + x, cur[1] + y); ring.append(cur)
    if ring: out.append(ring)
    return out

def rdp(pts, e):
    if len(pts) < 3: return pts
    (x1, y1), (x2, y2) = pts[0], pts[-1]
    dx, dy = x2 - x1, y2 - y1
    n = math.hypot(dx, dy)
    best, idx = -1.0, 0
    for k in range(1, len(pts) - 1):
        px, py = pts[k]
        dist = abs(dy * px - dx * py + x2 * y1 - y2 * x1) / n if n else math.hypot(px - x1, py - y1)
        if dist > best: best, idx = dist, k
    if best > e:
        return rdp(pts[: idx + 1], e)[:-1] + rdp(pts[idx:], e)
    return [pts[0], pts[-1]]

def simplificar_anillo(r, e):
    if len(r) < 4: return r
    # Se parte el anillo en dos mitades para que RDP no colapse polígonos cerrados.
    m = len(r) // 2
    a = rdp(r[: m + 1], e); b = rdp(r[m:] + [r[0]], e)
    return a[:-1] + b[:-1]

def area(r):
    return abs(sum(r[k][0] * r[k - 1][1] - r[k - 1][0] * r[k][1] for k in range(len(r)))) / 2

estados, x0, y0, x1, y1 = {}, 1e9, 1e9, -1e9, -1e9
for d, ident, nombre in paths:
    rs = anillos(d)
    rs.sort(key=area, reverse=True)
    grande = area(rs[0])
    piezas = []
    for k, r in enumerate(rs):
        xs = [p[0] for p in r]; ys = [p[1] for p in r]
        # Se descartan islotes diminutos (pero nunca la pieza principal ni las islas de estados insulares).
        insular = ident in ("VEO", "VEW")
        if k and max(max(xs) - min(xs), max(ys) - min(ys)) < (0.8 if insular else 2.0): continue
        s = simplificar_anillo(r, eps)
        if len(s) < 3: continue
        piezas.append(s)
    partes = []
    for s in piezas:
        q = [(round(x, 1), round(y, 1)) for x, y in s]
        txt = "M%g %g" % q[0] + "l" + " ".join("%g %g" % (round(q[j][0] - q[j - 1][0], 1), round(q[j][1] - q[j - 1][1], 1)) for j in range(1, len(q))) + "z"
        partes.append(txt)
        for x, y in q:
            x0, y0, x1, y1 = min(x0, x), min(y0, y), max(x1, x), max(y1, y)
    principal = piezas[0]
    xs = [p[0] for p in principal]; ys = [p[1] for p in principal]
    estados[ident] = {"nombre": nombre, "d": "".join(partes), "cx": round((min(xs) + max(xs)) / 2, 1), "cy": round((min(ys) + max(ys)) / 2, 1)}

m = 6
vb = [math.floor(x0 - m), math.floor(y0 - m), math.ceil(x1 - x0 + 2 * m), math.ceil(y1 - y0 + 2 * m)]
datos = {"fuente": "Mapa base: SimpleMaps.com (Venezuela, nivel 1), libre para uso comercial. Simplificado para la web.", "viewBox": " ".join(map(str, vb)), "estados": estados}
open(destino, "w", encoding="utf-8").write(json.dumps(datos, ensure_ascii=False, separators=(",", ":")))
print("estados", len(estados), "bytes", len(json.dumps(datos, ensure_ascii=False, separators=(",", ":")).encode()), "viewBox", vb)
