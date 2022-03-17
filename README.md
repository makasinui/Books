## 
#Installation 
composer install
npm install / yarn install

##Database
CREATE DATABASE book DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
CREATE USER 'user'@'localhost' IDENTIFIED BY '123';
GRANT ALL PRIVILEGES ON book.* TO 'user'@'localhost';

##ENV 
DB_DATABASE=book
DB_USERNAME=user
DB_PASSWORD=123

##Laravel 
php artisan key:generate
php artisan migrate 
php artisan db:seed --class=SectionsTableSeeder
php artisan db:seed --class=AuthorsTableSeeder
php artisan db:seed --class=BooksTableSeeder
php artisan db:seed --class=UserTableSeeder

##Start project
php artisan serve
npm run watch / yarn watch
