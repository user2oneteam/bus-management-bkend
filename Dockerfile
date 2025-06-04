FROM wordpress:php8.2-apache

# Install PHP CLI and required extensions (Mbstring) 
RUN sh -c 'set -x; retry=0; until apt-get update; do if [ $retry -gt 3 ]; then echo "Failed to update apt repositories after multiple retries." >&2; exit 1; fi; echo "Retrying apt-get update..."; sleep 5; retry=$((retry+1)); done; apt-get install -y curl unzip git php8.2-cli php8.2-mbstring; curl -sS https://getcomposer.org/installer | php; mv composer.phar /usr/local/bin/composer'

# Clean up to reduce image size
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Ensure that Apache mod_rewrite is enabled for WordPress
RUN a2enmod rewrite

# Copy your WordPress code into the container
COPY . /var/www/html

# Install SSH
RUN apt-get update && apt-get install -y openssh-server

# Configure SSH
RUN mkdir -p /run/sshd
RUN echo "root:rs123*" | chpasswd
RUN sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -i 's/PasswordAuthentication no/PasswordAuthentication yes/' /etc/ssh/sshd_config

# Expose SSH port
EXPOSE 22

# Start SSH service
ENTRYPOINT service ssh start && /usr/sbin/sshd -D && cat /var/www/html/wp-config.php && service apache2 status
