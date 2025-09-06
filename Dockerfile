# Usar imagen base de PHP con Node.js
FROM php:8.2-cli

# Variables de entorno
ENV DEBIAN_FRONTEND=noninteractive
ENV NODE_VERSION=20

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    curl git unzip zip \
    libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev default-mysql-client \
    nano supervisor \
    && rm -rf /var/lib/apt/lists/*

# Instalar Node.js y npm
RUN curl -fsSL https://deb.nodesource.com/setup_${NODE_VERSION}.x | bash - \
    && apt-get install -y nodejs

# Verificar versiones instaladas
RUN node --version && npm --version

# Instalar extensiones PHP necesarias para Laravel
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql mbstring exif pcntl bcmath gd zip sockets

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# Crear usuario no root para Laravel
RUN groupadd -g 1000 laravel \
    && useradd -u 1000 -g laravel -m -s /bin/bash laravel

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar dependencias primero (para usar cache de Docker)
COPY --chown=laravel:laravel composer.json composer.lock* package.json package-lock.json* ./

# Instalar dependencias PHP (todavía como root)
RUN composer install --no-scripts --no-autoloader --prefer-dist --no-dev

# Cambiar a usuario laravel antes de npm install
USER laravel

# Instalar dependencias Node.js
RUN npm install

# Volver a root para copiar el resto del código y preparar storage
USER root
COPY --chown=laravel:laravel . .

RUN composer dump-autoload --optimize

RUN mkdir -p storage/logs \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    bootstrap/cache \
    && chown -R laravel:laravel storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Cambiar a usuario laravel para correr el proyecto
USER laravel


# Exponer puertos
EXPOSE 8000 5173

# Comando por defecto
CMD ["npm", "run", "dev"]
