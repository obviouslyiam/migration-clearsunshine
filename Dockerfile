FROM wordpress:6.4-php8.1-apache

# Copy WordPress files (wp-content, wp-config.php, etc.)
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Configure Apache to use Railway's PORT environment variable
# Update the default site configuration
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/' /etc/apache2/sites-available/000-default.conf

# Update envvars to set Apache port from PORT environment variable
RUN echo 'export APACHE_PORT=${PORT:-80}' >> /etc/apache2/envvars

# Update ports.conf to listen on PORT variable
RUN sed -i 's/Listen 80/Listen ${PORT:-80}/' /etc/apache2/ports.conf

# Expose port
EXPOSE 80

# Use the default WordPress entrypoint
CMD ["apache2-foreground"]
