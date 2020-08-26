# Forum-Website
Q&amp;A (Questions, Answer) website with profiles, question subscriptions, filtering, real-time notifications etc. written in PHP, Laravel, VueJS, following TDD (Test Driven Development) 


## Follow steps to setup this project. 

Once cloned and entered directory.

### `git clone https://github.com/payafterwork/Forum-Website.git`

### `cd Form-Website`

### `composer update`

### Save and update your `.env` file (added .env.example for reference)
 
> DB_CONNECTION=mysql
> DB_HOST=127.0.0.1
> DB_PORT=3306
> DB_DATABASE=laravel
> DB_USERNAME=root
> DB_PASSWORD=

### Create database with same name as `DB_DATABASE` value.

### Run `php artisan migrate` to setup the database.

### Intall Redis https://github.com/microsoftarchive/redis

### Run `php artisan serve` or  `php -S localhost:8000 -t public/`

