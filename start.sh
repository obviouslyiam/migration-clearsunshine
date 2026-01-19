#!/bin/bash
set -e

# Use Railway's PORT or default to 80
export APACHE_PORT=${PORT:-80}

echo "Starting Apache on port $APACHE_PORT"

# Instead of modifying config files, use environment variables for Apache
export APACHE_RUN_USER=www-data
export APACHE_RUN_GROUP=www-data
export APACHE_LOG_DIR=/var/log/apache2
export APACHE_PID_FILE=/var/run/apache2/apache2.pid
export APACHE_RUN_DIR=/var/run/apache2
export APACHE_LOCK_DIR=/var/lock/apache2

# Create run directory
mkdir -p $APACHE_RUN_DIR $APACHE_LOCK_DIR

# Start Apache directly on the specified port
exec /usr/sbin/apache2 -D FOREGROUND -c "Listen $APACHE_PORT"
