composer update
php artisan migrate
php artisan db:seed --class=CreateUsersSeeder
php artisan serve
