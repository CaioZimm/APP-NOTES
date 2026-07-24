FROM php:8.4-fpm

# Instalar dependências de sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    nodejs \
    npm \
    gettext-base

# Limpar cache do apt
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensões do PHP necessárias para Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar diretório de trabalho
WORKDIR /var/www

# Copiar os arquivos do projeto
COPY . /var/www

# Ajustar permissões para as pastas essenciais do Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Instalar dependências do PHP (sem pacotes de desenvolvimento)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Instalar dependências do Node e buildar os assets (Vite)
RUN npm install
RUN npm run build

# Copiar arquivo de configuração do Nginx
COPY ./docker/nginx.conf /etc/nginx/sites-available/default

# Expor a porta 80 (padrão de plataformas como Render)
EXPOSE 80

# Usar um script de inicialização
COPY ./deploy.sh /usr/local/bin/deploy.sh
RUN chmod +x /usr/local/bin/deploy.sh

# Rodar o script de deploy ao iniciar o container
CMD ["/usr/local/bin/deploy.sh"]
