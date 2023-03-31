#!/usr/bin/env bash

# create .env file
if [ ! -f .env ]
then
    cp .env.example .env
fi

# craete env key
php artisan key:gen;

composer install;


if [ ! -d public/storage ]
then
    php artisan storage:link
fi

echo 'Environment build finish!';
