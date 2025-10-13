@echo off
echo Starting deployment...

echo 1. Pull latest changes...
git pull

echo 2. Install dependencies...
composer install --no-dev --optimize-autoloader

echo 3. Run migrations...
php artisan migrate --force

echo 4. Clear and cache...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

echo 5. Generate sitemap...
php artisan sitemap:generate

echo 6. Set permissions...
icacls storage /grant "IIS_IUSRS:(OI)(CI)F"
icacls bootstrap/cache /grant "IIS_IUSRS:(OI)(CI)F"

echo Deployment completed!
pause