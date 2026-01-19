FROM php:8.1-apache

# Install PHP extensions required for WordPress
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    gd \
    mysqli \
    pdo \
    pdo_mysql \
    zip \
    opcache \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Copy WordPress files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# List and fix MPM modules
RUN echo "=== MPM modules before fix ===" \
    && ls -la /etc/apache2/mods-enabled/mpm_* || true \
    && echo "=== Removing conflicting MPM modules ===" \
    && a2dismod mpm_event mpm_worker 2>&1 || true \
    && rm -f /etc/apache2/mods-enabled/mpm_event.* \
    && rm -f /etc/apache2/mods-enabled/mpm_worker.* \
    && echo "=== Ensuring mpm_prefork is enabled ===" \
    && a2enmod mpm_prefork \
    && echo "=== MPM modules after fix ===" \
    && ls -la /etc/apache2/mods-enabled/mpm_* || true \
    && echo "=== Checking Apache config ===" \
    && apache2ctl -M | grep mpm || true

# Enable Apache modules
RUN a2enmod rewrite headers expires

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expose port
EXPOSE 80

CMD ["/start.sh"]
