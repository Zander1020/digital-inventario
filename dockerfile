# Usa una imagen de PHP con Nginx
FROM php:8.2-fpm

# Instala extensiones necesarias (si usas MySQL, agrega pdo_mysql)
RUN docker-php-ext-install pdo pdo_mysql

# Copia el código de tu aplicación al contenedor
COPY . /var/www/html

# Instala y configura Nginx
RUN apt-get update && apt-get install -y nginx
COPY default.conf /etc/nginx/sites-available/default

# Expone el puerto 80
EXPOSE 80

# Comando para iniciar PHP-FPM y Nginx
CMD service nginx start && php-fpm
