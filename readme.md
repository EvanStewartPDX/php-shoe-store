##Shoe StoreTest

This app will allow the user to manage between store brands and the shoes stores carried by them. The app will allow a user to create, read, update, both brands and shoes, but only able to delete/and update shoes. This app is a many to many, with store carrying many brands and each brand is carried at many stores.

  Version:29/Sept/2016

Author: Evan Stewart (github:stewarea) Desciption

##Technologies
HTML, PHP, CSS, Twig, Silex, Css, Atom, php-twig extension in Atom Notes

Must install composer in project directory to access the composer.json file and vendor folder and corresponding files. https://getcomposer.org/ License

##Installation and Setup Requirements:

Clone this repository to your desktop
Run composer install from root
Find web folder and begin your local server (php -S localhost:8000)
Begin MAMP

* _Setting up new Database by doing the following:_
* _Begin MySql Shell by running $ /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot_
* _CREATE DATABASE shoe_store_
* _USE shoe_store_
* _CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR(255))_
* _CREATE TABLE brands (id, serial PRIMARY KEY, name VARCHAR(255))_
* _CREATE TABLE brands_stores (id serial primary key, brands_id INT, stores_id INT);_
* _Copy the Database shoe_store in myphp under the operations tab.  Rename as shoe_store_test and copy structure only_
* _Unzip the database contained at the top level of this folder and import from phpmyadmin (http://localhost:8888/phpmyadmin/)_
* _In phpmyadmin, create another database for use with phpunit tests files by going to Operations/ Copy Database To/ and remaining database "shoe_store_test" and choosing "structure only"_

* _Change localhost routing in app.php (and php documents in tests folder) to localhost enabled for mySQL. ex mysql:...host=localhost:8889;dbname=....in MAMP, you can find this by going to MAMP > Preferences > Ports> MySql Port_

* _Open Browser and navigate to http://localhost:8000/_

Copyright (c) 2016 Evan Stewart This software is licensed under the MIT license.
