<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Server Requirements

- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension

## Installation

- Go to project folder and run the following command on terminal
 ````
  $ composer install
  $ cp .env.example .env (place the database info)
  $ php artisan migrate
  $ php artisan db:seed
  $ sudo chmod 777 storage/ -R
  $ sudo chmod 777 bootstrap/cache/ -R
  $ sudo chmod 777 public/uploads/ -R
  $ php artisan serve
 ````
 ## URL
 - http://localhost:8000
 - http://localhost:8000/admin/login
 ## Credential
 - username: admin@admin.com
 - password: 123456
 
 ## Virtual Host OR Live Server(Example)
  ````
  <VirtualHost *:80>
         DocumentRoot "/opt/lampp/htdocs/auction"
         ServerName dev.auction.com
         ServerAlias www.auction.com
         <Directory /opt/lampp/htdocs/auction/>
                  Options Indexes FollowSymLinks MultiViews
                  AllowOverride All
                  Order allow,deny
                  allow from all
          </Directory>
  </VirtualHost>
   ````
