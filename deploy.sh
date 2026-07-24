#!/bin/bash
set -e

echo "Deploy script started..."

# Rodar o PHP-FPM em background
php-fpm &

# Aguardar o PHP-FPM estar pronto
sleep 2

# Cache das configurações e rotas para otimizar a performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Rodar migrações automaticamente
php artisan migrate --force

# Criar link simbólico do storage (para uploads de fotos)
php artisan storage:link || true

echo "Deploy script finished. Starting Nginx on port 80..."

# Testar configuração do nginx antes de iniciar
nginx -t

# Iniciar o Nginx no modo foreground para manter o container vivo
exec nginx -g "daemon off;"
