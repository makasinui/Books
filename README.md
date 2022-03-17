
#Installation <br>
composer install<br>
npm install / yarn install<br>

##Database<br>
CREATE DATABASE book DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;<br>
CREATE USER 'user'@'localhost' IDENTIFIED BY '123';<br>
GRANT ALL PRIVILEGES ON book.* TO 'user'@'localhost';<br>

##ENV  <br>
DB_DATABASE=book <br>
DB_USERNAME=user <br>
DB_PASSWORD=123 <br>

##Laravel <br>
php artisan key:generate <br>
php artisan migrate  <br>
php artisan db:seed --class=SectionsTableSeeder <br>
php artisan db:seed --class=AuthorsTableSeeder <br>
php artisan db:seed --class=BooksTableSeeder <br>
php artisan db:seed --class=UserTableSeeder <br>

##Start project <br>
php artisan serve <br>
npm run watch / yarn watch <br>
Admin user: E-mail: admin@r.ru Pass: admin123 <br>
Default user : E-mail: user@r.ru Pass: admin123 <br>
