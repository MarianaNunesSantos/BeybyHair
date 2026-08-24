# Usa uma imagem oficial do PHP com o servidor Apache embutido
FROM php:8.2-apache

# Instala as extensões necessárias para o PHP conversar com o MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilita reescrita de URL (útil se você usar arquivos .htaccess)
RUN a2enmod rewrite

# Copia todos os arquivos do seu projeto para a pasta do servidor
COPY . /var/www/html/

# Expõe a porta 80 para a internet
EXPOSE 80