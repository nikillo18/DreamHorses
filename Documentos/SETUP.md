
# DreamHorses - Guía de Instalación y Configuración con Docker

## 1. Requisitos

Antes de comenzar, asegúrate de tener instalados:

- **Docker** y **Docker Compose**
- Acceso con permisos de **sudo** si es necesario
- Navegador para acceder a Laravel y n8n

---

## 2. Estructura del Proyecto

```text
dreamhorses/
├─ docker-compose.yml
├─ Dockerfile
├─ .env
├─ composer.json
├─ package.json
├─ package-lock.json
├─ database/
│  └─ migrations/
└─ ...resto del proyecto Laravel

3. Dockerfile para Laravel + Node.js

Crea un archivo Dockerfile en la raíz del proyecto:


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


4. Docker Compose (docker-compose.yml)

Crea docker-compose.yml en la raíz del proyecto:

services:
    # Aplicación Laravel + Vite
    laravel:
        build:
            context: .
            dockerfile: Dockerfile
        container_name: dreamhorses_laravel
        restart: unless-stopped
        ports:
            - "8000:8000" # Laravel artisan serve
            - "5173:5173" # Vite dev server para HMR
        volumes:
            - ./:/var/www/html
            - /var/www/html/node_modules # Evitar conflictos con node_modules local
        working_dir: /var/www/html
        environment:
            - APP_NAME=${APP_NAME}
            - APP_ENV=${APP_ENV}
            - APP_DEBUG=${APP_DEBUG}
            - APP_URL=${APP_URL}
            # Base de datos
            - DB_CONNECTION=mysql
            - DB_HOST=mysql
            - DB_PORT=3306
            - DB_DATABASE=${DB_DATABASE}
            - DB_USERNAME=${DB_USERNAME}
            - DB_PASSWORD=${DB_PASSWORD} # ← Se lee del .env
            # N8N Integration
            - N8N_WEBHOOK_URL=http://n8n:5678
            - N8N_API_KEY=${N8N_API_KEY} # ← Se lee del .env
            # Cache usando file driver (por defecto de Laravel)
            - CACHE_DRIVER=${CACHE_DRIVER}
            - SESSION_DRIVER=${SESSION_DRIVER}
            - QUEUE_CONNECTION=${QUEUE_CONNECTION}
        depends_on:
            mysql:
                condition: service_healthy
            n8n:
                condition: service_started
        networks:
            - dreamhorses_network

    # Base de datos MySQL
    mysql:
        image: mysql:8.0
        container_name: dreamhorses_mysql
        restart: unless-stopped
        command: --default-authentication-plugin=mysql_native_password
        environment:
            MYSQL_DATABASE: ${DB_DATABASE}
            MYSQL_ROOT_PASSWORD: ${DB_ROOT_PASSWORD:-root_secure_password}
            MYSQL_USER: ${DB_USERNAME}
            MYSQL_PASSWORD: ${DB_PASSWORD} # ← Se lee del .env
        ports:
            - "3306:3306"
        volumes:
            - mysql_data:/var/lib/mysql
            - ./database/init:/docker-entrypoint-initdb.d
        healthcheck:
            test: ["CMD", "mysqladmin", "ping", "-h", "localhost"]
            interval: 10s
            timeout: 5s
            retries: 5
            start_period: 30s
        networks:
            - dreamhorses_network

    # N8N para automatización
    n8n:
        image: n8nio/n8n:latest
        container_name: dreamhorses_n8n
        restart: unless-stopped
        ports:
            - "5678:5678"
        environment:
            - N8N_BASIC_AUTH_ACTIVE=true
            - N8N_BASIC_AUTH_USER=${N8N_BASIC_AUTH_USER}
            - N8N_BASIC_AUTH_PASSWORD=${N8N_BASIC_AUTH_PASSWORD} # ← Se lee del .env
            # Configuración de red
            - N8N_HOST=0.0.0.0
            - N8N_PORT=5678
            - N8N_PROTOCOL=http
            - WEBHOOK_URL=http://localhost:5678/
            # Base de datos N8N (usando MySQL)
            - DB_TYPE=mysqldb
            - DB_MYSQLDB_HOST=mysql
            - DB_MYSQLDB_PORT=3306
            - DB_MYSQLDB_DATABASE=n8n_db
            - DB_MYSQLDB_USER=${DB_USERNAME}
            - DB_MYSQLDB_PASSWORD=${DB_PASSWORD} # ← Se lee del .env
            # Configuraciones adicionales
            - NODE_ENV=production
            - GENERIC_TIMEZONE=${APP_TIMEZONE:-America/Argentina/Buenos_Aires}
            - N8N_LOG_LEVEL=info
            - N8N_METRICS=true
            - EXECUTIONS_PROCESS=main
        volumes:
            - n8n_data:/home/node/.n8n
            - ./n8n/workflows:/home/node/.n8n/workflows
            - ./n8n/credentials:/home/node/.n8n/credentials
        depends_on:
            mysql:
                condition: service_healthy
        networks:
            - dreamhorses_network

    # Worker para procesar colas usando database driver
    worker:
        build:
            context: .
            dockerfile: Dockerfile
        container_name: dreamhorses_worker
        restart: unless-stopped
        command: php artisan queue:work database --sleep=3 --tries=3 --timeout=90
        volumes:
            - ./:/var/www/html
        working_dir: /var/www/html
        environment:
            - APP_ENV=${APP_ENV}
            - APP_DEBUG=${APP_DEBUG}
            - DB_CONNECTION=mysql
            - DB_HOST=mysql
            - DB_PORT=3306
            - DB_DATABASE=${DB_DATABASE}
            - DB_USERNAME=${DB_USERNAME}
            - DB_PASSWORD=${DB_PASSWORD} # ← Se lee del .env
            - QUEUE_CONNECTION=${QUEUE_CONNECTION}
            - N8N_WEBHOOK_URL=http://n8n:5678
            - N8N_API_KEY=${N8N_API_KEY} # ← Se lee del .env
        depends_on:
            mysql:
                condition: service_healthy
        networks:
            - dreamhorses_network

volumes:
    mysql_data:
        driver: local
    n8n_data:
        driver: local

networks:
    dreamhorses_network:
        driver: bridge

 5. Docker ignore
 crear un archivo .dockerignore

 node_modules
vendor
.git
.gitignore
.env
npm-debug.log
yarn-error.log
Dockerfile
docker-compose.yml


6. Comandos Principales
Levantar el stack por primera vez:

sudo docker compose up -d --build

Ver contenedores corriendo:

sudo docker compose ps

Ver logs en tiempo real (ej. n8n):

sudo docker compose logs -f n8n

Detener contenedores:

sudo docker compose down

Detener contenedores y eliminar volúmenes (reinicio limpio):

sudo docker compose down -v

7. Accesos

Laravel app: http://localhost:8000

Vite / React: http://localhost:5173

n8n: http://localhost:5678
Usuario: admin
Contraseña: admin

8. Notas importantes

Si n8n queda pegado en migraciones, espera unos minutos o reinicia con down -v y up -d --build.

Mantener permisos correctos en los volúmenes para evitar warnings.

Para cambiar credenciales de n8n o Laravel, modificar .env y docker-compose.yml.

Para acceder a MySQL desde fuera del contenedor, usar puerto 3306.
"""

