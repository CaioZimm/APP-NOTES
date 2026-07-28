#!/bin/bash
set -e

echo "Deploy script started..."

# Criar diretório para logs do supervisor
mkdir -p /var/log/supervisor

# Cache das configurações e rotas para otimizar a performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Rodar migrações automaticamente
php artisan migrate --force

# Criar link simbólico do storage (para uploads de fotos)
php artisan storage:link || true

echo "Deploy script finished. Starting Supervisord..."

# Iniciar o Supervisord que vai gerenciar Nginx, PHP-FPM, Queue e Scheduler
exec /usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf
