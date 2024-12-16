# # FROM php:8.2-apache

# # # Instal dependensi yang diperlukan
# # RUN apt-get update && apt-get install -y \
# #     unzip \
# #     git \
# #     libzip-dev \
# #     && docker-php-ext-install zip pdo_mysql

# # # Instal Composer
# # COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# # # Atur direktori root Apache ke folder 'public' Laravel
# # ENV APACHE_DOCUMENT_ROOT /var/www/html/public
# # RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
# # RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# # # Aktifkan modul Apache yang dibutuhkan
# # RUN a2enmod rewrite

# # Gunakan image PHP dengan Apache
# FROM php:8.2-apache

# # Instal dependensi sistem
# RUN apt-get update && apt-get install -y \
#     unzip \
#     git \
#     curl \
#     libzip-dev \
#     && docker-php-ext-install zip pdo_mysql

# # Tambahkan Node.js
# RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
#     && apt-get install -y nodejs

# # Instal Composer
# COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# # Set permissions for the public directory
# RUN chmod -R 777 /var/www/html/public

# # Atur direktori root Apache ke folder 'public' Laravel
# ENV APACHE_DOCUMENT_ROOT /var/www/html/public
# RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
# RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# # Aktifkan modul Apache yang dibutuhkan
# RUN a2enmod rewrite

# # Salin proyek Laravel ke dalam container
# WORKDIR /var/www/html
# COPY . .

# # Instal dependensi PHP dan Node.js
# RUN composer install
# RUN npm install && npm run build

FROM php:8.2-apache

# Instal dependensi sistem
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install zip pdo_mysql

# Tambahkan Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Instal Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Atur direktori root Apache ke folder 'public' Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Aktifkan modul Apache yang dibutuhkan
RUN a2enmod rewrite

# Salin proyek Laravel ke dalam container
WORKDIR /var/www/html
COPY . .

# Instal dependensi PHP dan Node.js
RUN composer install
RUN npm install && npm run build
