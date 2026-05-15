#!/bin/bash
set -e

echo "==> Clearing config cache..."
php artisan config:clear

echo "==> Running database migrations..."
php artisan migrate --force

echo "==> Creating storage symlink..."
php artisan storage:link --force 2>/dev/null || true

echo "==> Starting Apache..."
exec apache2-foreground
