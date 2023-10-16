#!/bin/sh
cd /files
/usr/local/bin/composer install
/usr/bin/php artisan serve --host 0.0.0.0
