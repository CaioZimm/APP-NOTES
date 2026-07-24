#!/bin/bash
set -e

echo "Deploy script started..."

# Rodar o PHP-FPM em background
php-fpm &

# Cache das configurações e rotas para otimizar a performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Rodar migrações automaticamente
php artisan migrate --force

echo "Deploy script finished. Starting Nginx..."

# Substituir a variável $PORT no nginx.conf e copiar para o lugar certo
export PORT=${PORT:-80}
envsubst '${PORT}' < /etc/nginx/sites-available/default > /etc/nginx/sites-enabled/default

# Iniciar o Nginx no modo foreground para manter o container vivo
nginx -g "daemon off;"
