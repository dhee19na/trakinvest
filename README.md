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
- Import DB or Migrate `php artisan migrate --seed`
- Build front with `npm run dev` or `npm run watch` 

If you did'nt set a virtual host, launch application with the `php artisan serve` command. By default, application will be served at `http://localhost:8000` or Change in env and App.js

## Configuration

You can change the length of time (in minutes) that the token will be valid for by changin the `JWT_TTL` value in the `.env` file.

STEP 1: Register 
<img src="https://akm-img-a-in.tosshub.com/indiatoday/images/story/201906/Google_Pixel_4_Slash_Leaks.jpeg?vOVKS5y37s5nM.thpPQ9EsRGUN.AyYC9">

STEP 2: Login 
STEP 3: Dashboard (Listing & Add & Edit & Search)


