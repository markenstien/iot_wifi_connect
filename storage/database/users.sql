create table users(
    id int(10) not null primary key auto_increment,
    firstname varchar(50) not null,
    lastname varchar(50) not null,
    username varchar(12) not null,
    password varchar(250) not null,
    is_active boolean default true,
    created_at timestamp default now(),
    updated_at timestamp default now() ON UPDATE now()
);