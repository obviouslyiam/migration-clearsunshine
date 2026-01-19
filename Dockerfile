FROM wordpress:6.4-php8.1-apache

# Copy WordPress files (wp-content, wp-config.php, etc.)
COPY . /var/www/html/

# Copy Apache virtual host configuration with PORT variable support
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Update ports.conf to use PORT environment variable
RUN echo 'Listen ${PORT:-80}' > /etc/apache2/ports.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Expose port
EXPOSE 80

# Use the default WordPress entrypoint
CMD ["apache2-foreground"]
