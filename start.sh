#!/bin/bash
set -e

# Use Railway's PORT or default to 80
PORT=${PORT:-80}

echo "Starting Apache on port $PORT"

# Update Apache configuration to use the correct port
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/000-default.conf

# Start Apache
exec apache2-foreground
