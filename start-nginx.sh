#!/bin/bash
set -e

# Use Railway's PORT or default to 80
export PORT=${PORT:-80}

echo "Starting services on port $PORT"

# Substitute PORT in nginx configuration
envsubst '${PORT}' < /etc/nginx/nginx.conf > /tmp/nginx.conf
mv /tmp/nginx.conf /etc/nginx/nginx.conf

# Start PHP-FPM in the background
php-fpm &

# Wait a moment for PHP-FPM to start
sleep 2

# Start nginx in the foreground
nginx -g 'daemon off;'
