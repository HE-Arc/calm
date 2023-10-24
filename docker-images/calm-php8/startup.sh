#!/bin/sh
cd /files
/usr/local/bin/composer install
/usr/bin/npm install

/usr/bin/php artisan serve --host 0.0.0.0&
/usr/bin/npm run dev
