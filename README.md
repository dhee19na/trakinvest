# Trakinvet SPA

This tutorial about creating a SPA with Laravel and Vue.

This tutorial is available 

## Required

- PHP 7
- Composer
- NodeJs
- MySQL

## Installation

- Clone the repository
- Installer back dependencies with `composer install`
- Install front dependencies with `npm i`
- Change .env configuration below like
    - Database credentials (`DB_HOST`, `DB_PORT`, ...)
    - Application url (`APP_URL`). Either virtual host address if you configure one, either address form the command `php artisan serve`
- Generate application key with `php artisan key:generate`
- Generate JWT key with `php artisan jwt:secret`
- Import DB (trakinvest.sql) or Migrate `php artisan migrate --seed`
- Build front with `npm run dev` or `npm run watch` 

If you did'nt set a virtual host, launch application with the `php artisan serve` command. By default, application will be served at `http://localhost:8000` or Change in env and App.js

## Configuration

You can change the length of time (in minutes) that the token will be valid for by changin the `JWT_TTL` value in the `.env` file.

STEP 1: Register 
<img src="https://github.com/dhee19na/trakinvest/blob/master/Register.png">

STEP 2: Login 
<img src="https://github.com/dhee19na/trakinvest/blob/master/login.png">

STEP 3: Dashboard (Listing & Add & Edit & Search)
<img src="https://github.com/dhee19na/trakinvest/blob/master/Edit.png">
<img src="https://github.com/dhee19na/trakinvest/blob/master/Add.png">


