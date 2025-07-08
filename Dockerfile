FROM php:8.2-cli

WORKDIR /app
COPY . .

RUN apt-get update && apt-get install -y unzip curl && \
    curl -sS https://getcomposer.org/installer | php && \
    php composer.phar install

EXPOSE 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
