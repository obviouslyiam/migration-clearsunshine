FROM wordpress:6.4-php8.1-fpm

# Install nginx and gettext (for envsubst)
RUN apt-get update && apt-get install -y nginx gettext-base && rm -rf /var/lib/apt/lists/*

# Copy WordPress files
COPY --chown=www-data:www-data . /var/www/html/

# Copy nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Set proper permissions
RUN find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Copy startup script
COPY start-nginx.sh /usr/local/bin/start-nginx.sh
RUN chmod +x /usr/local/bin/start-nginx.sh

# Expose port
EXPOSE 80

CMD ["/usr/local/bin/start-nginx.sh"]
