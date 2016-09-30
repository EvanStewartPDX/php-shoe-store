mysql commands to create database and tables:
-mysql.server start
-mysql -uroot -proot
-create database shoe_store;
-use shoe_store;
-create table store (name varchar(255), id serial primary key);
-create table brand (name varchar(255), id serial primary key);
-run localhost:8080phpmyadmin
-copy database to shoe_store_test using structure only;
