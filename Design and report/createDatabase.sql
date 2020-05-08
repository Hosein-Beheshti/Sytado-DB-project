create database db_sytado;
create table customer (
customer_id bigint(10) PRIMARY KEY AUTO_INCREMENT,
firstName varchar(255) NOT NULL,
lastName varchar(255) NOT NULL,
nationalCode varchar(255) NOT NULL,
phoneNumber varchar(255) NOT NULL,
age int(3) NOT NULL
);

create table address (
address_id bigint(10) PRIMARY KEY AUTO_INCREMENT,
addressName varchar(255) NOT NULL,
address varchar(255) NOT NULL,
phone bigint(20) NOT NULL,
customer_id bigint(10) NOT NULL,
Foreign key(customer_id ) references customer(customer_id) on delete cascade
);

create table delivery(
delivery_id bigint(10) PRIMARY KEY AUTO_INCREMENT,
firstName varchar(255) NOT NULL,
lastName varchar(255) NOT NULL,
nationalCode varchar(255) NOT NULL,
phoneNumber varchar(255) NOT NULL
);

create table order_factor(
factor_id bigint(10) PRIMARY KEY AUTO_INCREMENT,
address_id bigint(10) ,
customer_id bigint(10) ,
delivery_id bigint(10) ,
totalPrice varchar(255) NOT NULL default 0,
date DATE not null,
Foreign key(customer_id) references customer(customer_id) ON DELETE SET NULL,
Foreign key(address_id) references address(address_id) ON DELETE SET NULL,
Foreign key(delivery_id) references delivery(delivery_id) ON DELETE SET NULL
);


create table food_list(
factor_id bigint(10) NOT NULL,
food varchar(255) NOT NULL,
price varchar(255) NOT NULL,
Foreign key(factor_id) references order_factor(factor_id)
);

create table menu(
factor_id bigint(10) PRIMARY KEY AUTO_INCREMENT,
food_list varchar(255) NOT NULL,
price_list varchar(10) NOT NULL
);

create table store(
store_id bigint(10) PRIMARY KEY AUTO_INCREMENT,
storeName varchar(255) NOT NULL,
valid boolean NOT NULL DEFAULT 1
);

create table material_factor(
material_factor_id bigint(10) PRIMARY KEY AUTO_INCREMENT,
store_id bigint(10) NOT NULL,
totalPrice varchar(255) NOT NULL default 0,
date DATE not null,
Foreign key(store_id) references store(store_id)
);

create table material_list(
material_factor_id bigint(10) NOT NULL,
material varchar(255) NOT NULL,
price varchar(255) NOT NULL,
Foreign key(material_factor_id) references material_factor(material_factor_id)
);

create table log(
table_name varchar(255) NOT NULL,
query varchar(255) NOT NULL,
date Date NOT NULL
);

CREATE TRIGGER if not exists customer_insert AFTER INSERT on customer
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('customer', 'insert', CURDATE());
    
CREATE TRIGGER if not exists customer_update AFTER UPDATE on customer
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('customer', 'update', CURDATE());
 
 CREATE TRIGGER if not exists customer_delete AFTER INSERT on customer
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('customer', 'delete', CURDATE());
 
 
 CREATE TRIGGER if not exists address_insert AFTER INSERT on address
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('adress', 'insert', CURDATE());
    
CREATE TRIGGER if not exists address_update AFTER UPDATE on address
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('address', 'update', CURDATE());
 
 CREATE TRIGGER if not exists address_delete AFTER INSERT on address
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('address', 'delete', CURDATE());
 
    
CREATE TRIGGER if not exists delivery_insert AFTER INSERT on delivery
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('delivery', 'insert', CURDATE());
    
CREATE TRIGGER if not exists delivery_update AFTER UPDATE on delivery
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('delivery', 'update', CURDATE());
 
 CREATE TRIGGER if not exists delivery_delete AFTER INSERT on delivery
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('delivery', 'delete', CURDATE());
    
   
   
   CREATE TRIGGER if not exists order_factor_insert AFTER INSERT on order_factor
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('order_factor', 'insert', CURDATE());
    
CREATE TRIGGER if not exists order_factor_update AFTER UPDATE on order_factor
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('order_factor', 'update', CURDATE());
 
 CREATE TRIGGER if not exists order_factor_delete AFTER INSERT on order_factor
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('order_factor', 'delete', CURDATE());
 
 
 
   
   
   
   
   
CREATE TRIGGER if not exists food_list_insert AFTER INSERT on food_list
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('food_list', 'insert', CURDATE());
    
CREATE TRIGGER if not exists food_list_update AFTER UPDATE on order_factor
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('food_list', 'update', CURDATE());
 
 CREATE TRIGGER if not exists food_list_delete AFTER INSERT on order_factor
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('food_list', 'delete', CURDATE());
 
 
 
 
 CREATE TRIGGER if not exists menu_insert AFTER INSERT on menu
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('menu', 'insert', CURDATE());
    
CREATE TRIGGER if not exists menu_update AFTER UPDATE on menu
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('menu', 'update', CURDATE());
 
 CREATE TRIGGER if not exists menu_delete AFTER INSERT on menu
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('menu', 'delete', CURDATE());
 
 
 
CREATE TRIGGER if not exists store_insert AFTER INSERT on store
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('store', 'insert', CURDATE());
    
CREATE TRIGGER if not exists store_update AFTER UPDATE on store
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('store', 'update', CURDATE());
 
 CREATE TRIGGER if not exists store_delete AFTER INSERT on store
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('store', 'delete', CURDATE());
 
 
 
 CREATE TRIGGER if not exists material_factor_insert AFTER INSERT on material_factor
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('material_factor', 'insert', CURDATE());
    
CREATE TRIGGER if not exists material_factor_update AFTER UPDATE on material_factor
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('material_factor', 'update', CURDATE());
 
 CREATE TRIGGER if not exists material_factor_delete AFTER INSERT on material_factor
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('material_factor', 'delete', CURDATE());
 
 
 
 CREATE TRIGGER if not exists material_list_insert AFTER INSERT on material_list
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('material_list', 'insert', CURDATE());
    
CREATE TRIGGER if not exists material_list_update AFTER UPDATE on material_list
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('material_list', 'update', CURDATE());
 
 CREATE TRIGGER if not exists material_list_delete AFTER INSERT on material_list
 FOR EACH ROW
 INSERT INTO log(table_name , query , date) VALUES('material_list', 'delete', CURDATE());
 
    