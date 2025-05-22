FROM nginx:latest

COPY nginx.conf /etc/nginx/conf.d/default.conf

COPY fastcgi-php.conf /etc/nginx/snippets/fastcgi-php.conf

COPY . /var/www/html
