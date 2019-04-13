FROM php:7.2-apache
COPY ./ /var/www/html
RUN chown www-data:www-data /var/www/html -R
RUN chmod 755 /var/www/html -R

RUN apt-get update -y && apt-get install -y sendmail libpng-dev libpq-dev zlib1g-dev

RUN mkdir -p /usr/share/man/man1 && mkdir -p /usr/share/man/man7

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql

RUN docker-php-ext-install zip
RUN docker-php-ext-install gd

RUN a2enmod rewrite

RUN service apache2 restart

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

EXPOSE 80