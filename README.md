<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## How to use
- git clone
- copy .env.example and change to .env
- and change your database name 
- composer update it will download a new or lastest dependencies.
- composer install it will download the same as my project dependencies, 
  about two month ago when I create      this project.
- php artisan key:generate
- php artisan migrate:fresh --seed
- php artisan storage:link
- composer require hashids/hashids
- php artisan serve
- for the user you can look at the seed file.

## 1-Clone Project
 - `git clone https://github.com/Lysunsoeung/famely_income_expends_laravel`
## 2-Install Composer for Vendor
 - `composer install`
## 3-Configure Database
 - `cp .env.example .env` ចម្លង Database configuration ពី file .env.example ទៅបង្កើតនិងដាក់កូដទាំងអស់ចូល .env file ថ្មី
 - កំណត់កូដខាងក្រោមដើម្បី​ភ្ជាប់ Database ក្នុង file `.env`
   ```javascript
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=laravel_family_income_db
      DB_USERNAME=root
      DB_PASSWORD=
  - បង្កើត `APP_KEY= ` ដោយប្រើ command `php artisan key:generate`
  - បង្កើត Table ដោយប្រើ command : `php artisan migrate` ប្រសិនបើមានបញ្ហា Error កើតឡើងយើងត្រូវទៅពិនិត្យថាតើមានឈ្មោះ Database នៅក្នុងប្រព័ន្ធ Database ហើយនៅ? បើគ្មានត្រូវបង្កើតអោយដូចឈ្មោះក្នុង `.env` file
    
## 4- Run Storage link ដើម្បីបង្កើត​ជា directory សម្រាប់រក្សារូបភា
  ដោយ ប្រើ command ខាងក្រោម៖
  - `php artisan storage:link`

## 5- Run composer require ដើម្បីបង្កើត​ជា hash code
  ដោយ ប្រើ command ខាងក្រោម៖
  - `composer require hashids/hashids`
    
## 6- Run Seed ដើម្បីបង្កើត​ Users
  ដោយសារយើងបានបង្កើត Record Users រួចហើយយើងអាចបង្កើត ទាំងអស់ហ្នឹងដោយ ប្រើ command ខាងក្រោម៖
  - `php artisan migrate:fresh --seed`

## 7- Run Server
  ដោយ ប្រើ command ខាងក្រោម៖
  - `php artisan serve`

## 8- Login ជាមួយ User ខាងក្រោម
  ដោយសារយើងមាន User Admin ដែលយើងបាន Seed ខាងលើ យើងអាច Login បានដោយ៖
  - Admin : `admin@admin.com`
  - Parent : `parent@parent.com`
  - Child : `child@child.com`
  - Password : `123`
