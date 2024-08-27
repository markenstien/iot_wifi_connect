create table wifi_datas(
    id int(10) not null primary key auto_increment,
    wifi_ssid varchar(100) not null,
    wifi_password varchar(100) not null,
    description text,
    is_active boolean default true,
    created_at timestamp default now()
);