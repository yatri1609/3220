CREATE DATABASE SuperStore;

CREATE TABLE SuperStore.customer (
    customer_id int(11),
    first_name varchar(255),
    last_name varchar(255),
    email varchar(320),
    phone int(11),
    address_id int(11),
    PRIMARY KEY (customer_id)
);

CREATE TABLE SuperStore.`order` (
    order_id int(11),
   customer_id int(11),
   address_id int(11),
   PRIMARY KEY (order_id)
);

CREATE TABLE SuperStore.product (
    product_id int(11),
    product_name varchar(255),
    description varchar(255),
    weight int,
    base_cost int(11),
    PRIMARY KEY (product_id)

);
CREATE TABLE SuperStore.order_item (
     order_id int(11),
     product_id int(11),
quantity int(11) ,
   	price decimal(13,2)
);

CREATE TABLE SuperStore.address (
    address_id int(11),
    street varchar(255),
    city varchar(255),
    state varchar(255),
    zip varchar(5),
    PRIMARY KEY (address_id)
);



CREATE TABLE SuperStore.warehouse (
    warehouse_id int,
    name varchar(255),
    address_id int(11),
    PRIMARY KEY (warehouse_id) 

);
CREATE TABLE SuperStore.product_warehouse (
   product_id int(11),
   warehouse_id int(11)
);

ALTER TABLE SuperStore.product_warehouse
ADD FOREIGN KEY (product_id) REFERENCES product(product_id);

ALTER TABLE SuperStore.product_warehouse
ADD FOREIGN KEY (warehouse_id) REFERENCES warehouse(warehouse_id);

ALTER TABLE SuperStore.warehouse
ADD FOREIGN KEY (address_id) REFERENCES address(address_id);

ALTER TABLE SuperStore.order_item
ADD FOREIGN KEY (order_id) REFERENCES `order`(order_id);

ALTER TABLE SuperStore.order_item
ADD FOREIGN KEY (product_id) REFERENCES product(product_id);

ALTER TABLE SuperStore.`order`
ADD FOREIGN KEY (customer_id) REFERENCES customer(customer_id);

ALTER TABLE SuperStore.`order`
ADD FOREIGN KEY (address_id) REFERENCES address(address_id);

ALTER TABLE SuperStore.customer
ADD FOREIGN KEY (address_id) REFERENCES address(address_id);






