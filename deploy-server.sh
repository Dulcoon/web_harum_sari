#!/usr/bin/env bash

# Exit immediately if a command exits with a non-zero status
set -e
set -o pipefail

PROJECT_DIR="${PROJECT_DIR:-/home/homelivi/laravel-crud}"
PUBLIC_HTML_DIR="${PUBLIC_HTML_DIR:-/home/homelivi/public_html}"

echo "=========================================="
echo " Starting Deployment..."
echo " Date: $(date '+%Y-%m-%d %H:%M:%S')"
echo "=========================================="

# 1. Pindah ke direktori project
echo "[1/7] Navigating to project directory..."
cd "$PROJECT_DIR"
echo "Current directory: $(pwd)"

# 2. Setup Node environment via NVM
echo "[2/7] Loading NVM & Node.js..."
export NVM_DIR="$HOME/.nvm"
if [ -s "$NVM_DIR/nvm.sh" ]; then
    \. "$NVM_DIR/nvm.sh"
    nvm use 18 || echo "Warning: Failed to switch to Node 18, using: $(node -v 2>/dev/null || echo 'none')"
else
    echo "Info: nvm.sh not found at $NVM_DIR, using default node: $(node -v 2>/dev/null || echo 'none')"
fi

# 3. Pull update terbaru dari repo
echo "[3/7] Pulling latest code from Git (main)..."
git pull origin main

# 4. Dependency PHP (Composer)
echo "[4/7] Optimizing Composer dependencies..."
composer clear-cache
composer install --no-dev --optimize-autoloader
composer dump-autoload

# 5. Build Frontend Assets (Vite)
echo "[5/7] Installing NPM packages & building assets..."
# Remove the Vite dev-server marker. If present, Laravel loads assets from
# http://127.0.0.1:5173 (dev server) instead of the compiled build/ folder,
# which breaks all styling on production. `rm -rf` handles files, dirs, links.
rm -rf public/hot "$PUBLIC_HTML_DIR/hot"
find "$PROJECT_DIR/public" "$PUBLIC_HTML_DIR" -maxdepth 1 -name hot -exec rm -rf {} + 2>/dev/null || true
npm install
npm run build

if [ ! -f public/build/manifest.json ]; then
    echo "ERROR: public/build/manifest.json not found after build. Aborting."
    exit 1
fi

# Fail fast if the dev-server marker somehow survived; otherwise production
# would silently keep serving assets from 127.0.0.1:5173.
if [ -e public/hot ] || [ -e "$PUBLIC_HTML_DIR/hot" ]; then
    echo "ERROR: a Vite 'hot' file still exists. Remove it and re-run."
    exit 1
fi

# 6. Salin build assets ke public_html
echo "[6/7] Deploying build assets to public_html..."
rm -rf "$PUBLIC_HTML_DIR/build"
cp -r public/build "$PUBLIC_HTML_DIR/"

# 6b. Sync public assets (images, favicon, robots.txt) so the compressed WebP
# images in public/assets reach the web root. build/, index.php and .htaccess
# are excluded because they are handled separately / server-specific.
# rsync is preferred (it can prune stale files); tar is a portable fallback
# because rsync is often missing on shared hosting.
echo "[6b/7] Syncing public assets to public_html..."
if command -v rsync >/dev/null 2>&1; then
    rsync -a --delete --exclude=build --exclude=build.zip --exclude=index.php --exclude=.htaccess --exclude=hot --exclude=storage public/ "$PUBLIC_HTML_DIR/"
else
    echo "Info: rsync not found, falling back to tar."
    tar -C public \
        --exclude=./build \
        --exclude=./build.zip \
        --exclude=./index.php \
        --exclude=./.htaccess \
        --exclude=./hot \
        --exclude=./storage \
        -cf - . | tar -C "$PUBLIC_HTML_DIR" -xf -
fi

# 7. Laravel Artisan Optimization & Migration
echo "[7/7] Running artisan commands..."
php artisan storage:link --force
php artisan migrate --force
php artisan optimize:clear
php artisan optimize

echo "=========================================="
echo "====== DEPLOY SUCCESS ======"
echo "=========================================="
