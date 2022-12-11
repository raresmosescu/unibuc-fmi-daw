create table product
(
    id    int auto_increment,
    name  text    not null,
    price decimal not null,
    quantity int not null,
    img   text    not null,
    constraint product_pk
        primary key (id)
);

create unique index product_id_uindex
    on product (id);


create table user
(
    id              int auto_increment
        primary key,
    name            text                 not null,
    email           text                 not null,
    hashed_password text                 not null,
    is_admin        tinyint(1) default 0 not null,
    email_validated tinyint(1) default 0 not null,
    constraint user_id
        unique (id)
);

create unique index user_id_uindex
    on user (id);


create table order_item
(
    id    int auto_increment,
    order_id int not null,
    name  text    not null,
    price decimal not null,
    quantity int not null,
    img   text    not null,
    constraint order_item_pk
        primary key (id),
    constraint order_item_order_id_fk
        foreign key (order_id) references `order` (id)
);

create unique index order_item_uindex
    on order_item (id);


create table `order`
(
    id      int auto_increment,
    name    text    not null,
    email   text    not null,
    address text    not null,
    total   decimal not null,
    constraint order_pk
        primary key (id)
);

create unique index order_email_uindex
    on `order` (email);

create unique index order_id_uindex
    on `order` (id);


INSERT INTO product (name, price, quantity, img)
VALUES ('101 Essays That Will Change the Way You Think', 23.97, 22, 'https://images.unsplash.com/photo-1521123845560-14093637aa7d'),
('How Innovation Works', 19.97, 42, 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73'),
('The Psychology of Money', 29.99, 13, 'https://images.unsplash.com/photo-1592496431122-2349e0fbc666'),
('A Storytelling Workbook', 12.97, 94, 'https://images.unsplash.com/photo-1612969308146-066d55f37ccb'),
('V2! 101 Essays That Will Change the Way You Think', 33.97, 22, 'https://images.unsplash.com/photo-1521123845560-14093637aa7d'),
('V2!How Innovation Works', 26.97, 42, 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73'),
('V2!The Psychology of Money', 55.99, 13, 'https://images.unsplash.com/photo-1592496431122-2349e0fbc666'),
('V2!A Storytelling Workbook', 22.97, 94, 'https://images.unsplash.com/photo-1612969308146-066d55f37ccb');

