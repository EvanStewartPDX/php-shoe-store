Shoe StoreTest

This app will allow the user to manage between store brands and the shoes stores carried by them. The app will allow a user to create, read, update, both brands and shoes, but only able to delete/and update shoes. This app is a many to many, with store carrying many brands and each brand is carried at many stores.

  Version:29/Sept/2016

Author: Evan Stewart (github:stewarea) Desciption

HTML, PHP, CSS, Twig, Silex, Css, Atom, php-twig extension in Atom Notes

Must install composer in project directory to access the composer.json file and vendor folder and corresponding files. https://getcomposer.org/ License

Installation and Setup Requirements:

Clone this repository to your desktop
Run composer install from root
Find web folder and begin your local server (php -S localhost:8000)
Begin MAMP

Setting up new Database by doing the following:
Begin MySql Shell by running $ /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
CREATE DATABASE shoe_store
USE hair_salong
CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR(255))
CREATE TABLE brands (id, serial PRIMARY KEY, name VARCHAR(255))
Unzip the database contained at the top level of this folder and import from phpmyadmin (http://localhost:8888/phpmyadmin/)
in phpmyadmin, create another database for use with phpunit tests files by going to Operations/ Copy Database To/ and remaining database "shoe_store_test" and choosing "structure only"

Change localhost routing in app.php (and php documents in tests folder) to localhost enabled for mySQL. ex mysql:...host=localhost:8889;dbname=....in MAMP, you can find this by going to MAMP > Preferences > Ports> MySql Port

_In terminal, navigate to _
Open Browser and navigate to http://localhost:8000/

Copyright (c) 2016 Evan Stewart This software is licensed under the MIT license.
