FROM php

ENV APP_DIR /app

WORKDIR $APP_DIR
VOLUME $APP_DIR

RUN apt-get update && apt-get install -y \
        git \
        wget \
        apt-utils \
        zlib1g-dev \
        libxml2-dev \
        zlib1g-dev \
        libzip-dev

# Node
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -
RUN pecl install apcu

RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-enable apcu

RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# Memory Limit
#RUN echo "memory_limit=-1" > $PHP_INI_DIR/conf.d/memory-limit.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');    \
    \$sig = file_get_contents('https://composer.github.io/installer.sig');      \
    if (trim(\$sig) === hash_file('SHA384', 'composer-setup.php')) exit(0);     \
    echo 'ERROR: Invalid installer signature' . PHP_EOL;                        \
    unlink('composer-setup.php');                                               \
    exit(1);"                                                                   \
 && php composer-setup.php -- --filename=composer --install-dir=/usr/local/bin  \
 && rm composer-setup.php

EXPOSE 8080

CMD ["symfony", "server:start"]
