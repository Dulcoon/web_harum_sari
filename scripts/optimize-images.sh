#!/usr/bin/env bash
# Generate responsive AVIF + WebP variants for hero banners.
#
# Usage:
#   bash scripts/optimize-images.sh
#
# Requires: python3 + Pillow (WebP), ImageMagick `convert` with AVIF support.
# Output: public/assets/<name>-<width>.{avif,webp}
set -e

ASSETS_DIR="$(cd "$(dirname "$0")/.." && pwd)/public/assets"

python3 - "$ASSETS_DIR" <<'PY'
import os
import subprocess
import sys

from PIL import Image

assets = sys.argv[1]

# name -> widths to generate
TARGETS = {
    'hero.webp': [640, 1024, 1536, 1920],
    'gemini-banner.webp': [640, 1024, 1536],
    'bg-fix.webp': [640, 1024, 1536, 1920],
}

AVIF_QUALITY = 55
WEBP_QUALITY = 80


def generate(src_path, base, widths):
    image = Image.open(src_path).convert('RGB')
    ow, oh = image.size
    print(f'--- {os.path.basename(src_path)} ({ow}x{oh}) ---')

    for width in widths:
        if width > ow:
            continue

        height = round(oh * width / ow)
        resized = image.resize((width, height), Image.LANCZOS)

        tmp_png = f'/tmp/_imgopt_{base}_{width}.png'
        resized.save(tmp_png, 'PNG')

        avif = os.path.join(assets, f'{base}-{width}.avif')
        webp = os.path.join(assets, f'{base}-{width}.webp')

        subprocess.run(
            ['convert', tmp_png, '-quality', str(AVIF_QUALITY), avif],
            check=True,
        )
        resized.save(webp, 'WEBP', quality=WEBP_QUALITY, method=6)
        os.remove(tmp_png)

        avif_kb = os.path.getsize(avif) // 1024
        webp_kb = os.path.getsize(webp) // 1024
        print(f'  {width:4}w  avif {avif_kb:4}KB   webp {webp_kb:4}KB')


for filename, widths in TARGETS.items():
    path = os.path.join(assets, filename)
    if not os.path.exists(path):
        print(f'SKIP (not found): {filename}')
        continue

    generate(path, filename.rsplit('.', 1)[0], widths)

print('\nDone.')
PY
