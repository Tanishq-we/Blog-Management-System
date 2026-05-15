#!/bin/bash
set -e

echo "==> Clearing config cache..."
php artisan config:clear

echo "==> Running database migrations and seeding..."
php artisan migrate --seed --force

echo "==> Creating storage symlink..."
php artisan storage:link --force 2>/dev/null || true

echo "==> Starting Apache..."
exec apache2-foreground
