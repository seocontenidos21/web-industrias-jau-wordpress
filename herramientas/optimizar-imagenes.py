"""Industrias JAU · optimiza las imágenes del cliente antes de subirlas (DWIJ-71).

Uso (desde la raíz del sitio):
    python -I herramientas/optimizar-imagenes.py [origen] [destino]

Por defecto lee insumos-originales/ (la carpeta de Drive «Insumos Industrias JAU» descomprimida)
y escribe en insumos-optimizados/. Los originales no se modifican.

Reglas:
- Fotos de ambiente: WebP, máximo 1920 px de ancho, objetivo < 300 KB.
- Botellas y logos: WebP con fondo transparente (se recorta el borde vacío),
  botellas a ~800 px de alto y logos a 800 px de ancho como máximo, objetivo < 150 KB.
- Nombres sin espacios, acentos ni «Copia de» (p. ej. frugy-mango-1-5l.webp).
- Las fotos sin extensión se abren igual: Pillow detecta el formato por el contenido.
- Genera manifiesto.json con cada original, su versión optimizada, tamaño y tipo.
"""

from __future__ import annotations

import json
import re
import sys
import unicodedata
from io import BytesIO
from pathlib import Path

from PIL import Image, ImageOps, UnidentifiedImageError

RAIZ = Path(__file__).resolve().parent.parent
ORIGEN = Path(sys.argv[1]) if len(sys.argv) > 1 else RAIZ / "insumos-originales"
DESTINO = Path(sys.argv[2]) if len(sys.argv) > 2 else RAIZ / "insumos-optimizados"

LIMITE_AMBIENTE = 300 * 1024
LIMITE_RECORTE = 150 * 1024
ANCHO_AMBIENTE = 1920
ALTO_BOTELLA = 800
ANCHO_LOGO = 800

# Nombres conocidos (inventario de DWIJ-70 a DWIJ-77). La clave es el nombre normalizado del original.
NOMBRES = {
    "ivbj-azul": "logo-industrias-jau-azul",
    "logotipo-frugy-blanco-y-verde-mr": "logo-frugy-blanco-verde",
    "logotipo-frugy-verde-y-blanco-mr": "logo-frugy-verde-blanco",
    "logotipo-drink-cola": "logo-drink-cola",
    "botella-limon-coco-1-5l": "frugy-limon-coco-1-5l",
    "mango-1-5l": "frugy-mango-1-5l",
    "jugo-de-manzana-gotas": "frugy-manzana",
    "jugo-de-naranja-gotas": "frugy-naranja",
    "jugo-de-pera-con-gotas": "frugy-pera",
    "jugo-de-durazno-con-gotas": "frugy-durazno",
    "botella-400ml": "drink-cola-400-ml",
    "botella-actualizada-2026": "drink-cola-1-5-l",
}


def slug(texto: str) -> str:
    texto = unicodedata.normalize("NFKD", texto).encode("ascii", "ignore").decode()
    texto = re.sub(r"^\s*copia\s+de\s+", "", texto, flags=re.I)
    texto = texto.lower().replace("1.5", "1-5")
    texto = re.sub(r"[^a-z0-9]+", "-", texto)
    return texto.strip("-")


def tipo_de(ruta: Path) -> str:
    partes = [p.lower() for p in ruta.parts]
    if any("logotipo" in p or p == "inicio" for p in partes) or "logo" in ruta.stem.lower() or "ivbj" in ruta.stem.lower():
        return "logo"
    if any("botella" in p for p in partes):
        return "botella"
    return "ambiente"


def marca_de(ruta: Path) -> str:
    texto = " ".join(ruta.parts).lower()
    if "drink" in texto:
        return "drink-cola"
    if "frugy" in texto:
        return "frugy"
    return ""


def nombre_final(ruta: Path, tipo: str) -> str:
    base = slug(ruta.stem if ruta.suffix.lower() in {".png", ".jpg", ".jpeg", ".webp", ".heic"} else ruta.name)
    if base in NOMBRES:
        return NOMBRES[base]
    marca = marca_de(ruta)
    if tipo == "ambiente" and marca and not base.startswith(marca):
        return f"{marca}-{base}"
    if tipo == "botella" and marca and not base.startswith(marca):
        return f"{marca}-{base}"
    return base


def guardar_webp(img: Image.Image, destino: Path, limite: int, calidad: int = 86) -> int:
    """Guarda en WebP bajando la calidad hasta quedar por debajo del límite."""
    datos = b""
    for q in range(calidad, 49, -6):
        buf = BytesIO()
        img.save(buf, "WEBP", quality=q, method=6)
        datos = buf.getvalue()
        if len(datos) <= limite:
            break
    destino.write_bytes(datos)
    return len(datos)


def procesar(ruta: Path) -> dict | None:
    try:
        img = Image.open(ruta)
        img.load()
    except (UnidentifiedImageError, OSError):
        return None

    tipo = tipo_de(ruta.relative_to(ORIGEN))
    nombre = nombre_final(ruta.relative_to(ORIGEN), tipo)
    img = ImageOps.exif_transpose(img)

    if tipo == "ambiente":
        img = img.convert("RGB")
        if img.width > ANCHO_AMBIENTE:
            img = img.resize((ANCHO_AMBIENTE, round(img.height * ANCHO_AMBIENTE / img.width)), Image.LANCZOS)
        limite = LIMITE_AMBIENTE
    else:
        img = img.convert("RGBA")
        caja = img.getchannel("A").getbbox()
        if caja:
            img = img.crop(caja)
        if tipo == "botella" and img.height > ALTO_BOTELLA:
            img = img.resize((round(img.width * ALTO_BOTELLA / img.height), ALTO_BOTELLA), Image.LANCZOS)
        if tipo == "logo" and img.width > ANCHO_LOGO:
            img = img.resize((ANCHO_LOGO, round(img.height * ANCHO_LOGO / img.width)), Image.LANCZOS)
        limite = LIMITE_RECORTE

    destino = DESTINO / f"{nombre}.webp"
    n = 2
    while destino.exists() and destino.name in VISTOS:
        destino = DESTINO / f"{nombre}-{n}.webp"
        n += 1
    VISTOS.add(destino.name)
    peso = guardar_webp(img, destino, limite)

    # Favicon: PNG cuadrado de 512 px a partir del logo de la empresa (DWIJ-72).
    if nombre == "logo-industrias-jau-azul":
        lado = max(img.width, img.height)
        lienzo = Image.new("RGBA", (lado, lado), (255, 255, 255, 0))
        lienzo.paste(img, ((lado - img.width) // 2, (lado - img.height) // 2), img)
        lienzo.resize((512, 512), Image.LANCZOS).save(DESTINO / "favicon-industrias-jau-512.png", optimize=True)

    return {
        "original": str(ruta.relative_to(ORIGEN)).replace("\\", "/"),
        "archivo": destino.name,
        "tipo": tipo,
        "marca": marca_de(ruta.relative_to(ORIGEN)),
        "ancho": img.width,
        "alto": img.height,
        "kb_original": round(ruta.stat().st_size / 1024),
        "kb": round(peso / 1024),
        "supera_limite": peso > limite,
    }


VISTOS: set[str] = set()


def main() -> None:
    if hasattr(sys.stdout, "reconfigure"):
        sys.stdout.reconfigure(encoding="utf-8")
    if not ORIGEN.is_dir():
        sys.exit(f"No existe la carpeta de originales: {ORIGEN}")
    DESTINO.mkdir(parents=True, exist_ok=True)
    resultados, omitidos = [], []
    for ruta in sorted(p for p in ORIGEN.rglob("*") if p.is_file()):
        r = procesar(ruta)
        if r:
            resultados.append(r)
            aviso = "  ⚠ supera el límite" if r["supera_limite"] else ""
            print(f"✓ {r['original']} → {r['archivo']} ({r['kb_original']} KB → {r['kb']} KB){aviso}")
        else:
            omitidos.append(str(ruta.relative_to(ORIGEN)))
    (DESTINO / "manifiesto.json").write_text(json.dumps(resultados, ensure_ascii=False, indent=2), encoding="utf-8")
    print(f"\n{len(resultados)} imágenes optimizadas en {DESTINO}")
    if omitidos:
        print("Omitidos (no son imágenes):", ", ".join(omitidos))


if __name__ == "__main__":
    main()
