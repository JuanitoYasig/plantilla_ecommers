# Imagen base con Apache y PHP
FROM php:8.2-apache

# Copia tus archivos del proyecto al directorio raíz del servidor web
COPY . /var/www/html/

# Da permisos correctos a los archivos
RUN chown -R www-data:www-data /var/www/html

# Expone el puerto donde Apache escucha
EXPOSE 80

# Inicia Apache al ejecutar el contenedor
CMD ["apache2-foreground"]
