<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Setting up the server

Make sure you have latest version of Apache, PHP and MySQL.

```#!/bin/sh

$ git clone https://github.com/mr-vara/tillpos-laravel.git
$ cd tillpos-laravel
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan jwt:secret

# Create a MySQL database and update credentials in .env file

$ php artisan migrate
```

## Running the server
```#!/bin/sh

$ php artisan serve

```
Navigate to http://127.0.0.1:8000/
