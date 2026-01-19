FROM wordpress:6.4-php8.1-apache

# Copy WordPress files (wp-content, wp-config.php, etc.)
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Copy startup script to handle Railway PORT
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Expose port
EXPOSE 80

CMD ["/usr/local/bin/start.sh"]
