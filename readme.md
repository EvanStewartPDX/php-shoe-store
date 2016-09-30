Shoe StoreTest

Allows user to enter the name of brands of shoe and names of stores. User can add brands to stores and visa versa.  Version:29/Sept/2016

Author: Evan Stewart (github:stewarea) Desciption

HTML, PHP, CSS, Twig, Silex, Css, Atom, php-twig extension in Atom Notes

Must install composer in project directory to access the composer.json file and vendor folder and corresponding files. https://getcomposer.org/ License

Must upload attached zip file containing database information. Upload to mysql.

Mysql commands to create database and tables:
-mysql.server start
-mysql -uroot -proot
-create database shoe_store;
-use shoe_store;
-create table store (name varchar(255), id serial primary key);
-create table brand (name varchar(255), id serial primary key);
-run localhost:8080phpmyadmin
-copy database to shoe_store_test using structure only;

Copyright (c) 2016 Evan Stewart This software is licensed under the MIT license.
