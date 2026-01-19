FROM wordpress:6.4-php8.1-apache

# Copy only WordPress files
COPY --chown=www-data:www-data . /var/www/html/

# Set proper permissions
RUN find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Expose port 80 (Railway will handle port mapping)
EXPOSE 80
