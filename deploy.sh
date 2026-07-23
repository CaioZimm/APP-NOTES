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
# (Certifique-se que o banco já esteja provisionado e rodando)
php artisan migrate --force

echo "Deploy script finished. Starting Nginx..."
# Iniciar o Nginx no modo foreground para manter o container vivo
nginx -g "daemon off;"
