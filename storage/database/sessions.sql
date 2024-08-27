create table sessions(
    id int(10) not null primary key auto_increment,
    parent_key varchar(50) not null,
    parent_id int(10) not null,
    message text,
    log_type enum('info','default','danger','warning','success') default 'default',
    datelog datetime
);