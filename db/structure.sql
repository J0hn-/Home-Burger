drop table if exists t_categorie;
drop table if exists t_user;
drop table if exists t_burger;

create table t_burger (
    brg_id integer not null primary key auto_increment,
    brg_name varchar(50) not null,
    brg_resume varchar(2000) not null,
	brg_cat integer,
	constraint fk_cat foreign key(brg_cat) references t_categorie(cat_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_user (
    usr_id integer not null primary key auto_increment,
    usr_name varchar(50) not null,
    usr_password varchar(88) not null,
    usr_salt varchar(23) not null,
    usr_role varchar(50) not null 
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_categorie (
    cat_id integer not null primary key auto_increment,
    cat_name varchar(50) not null,
    brg_id integer not null,
    usr_id integer not null,
    constraint fk_com_art foreign key(art_id) references t_article(art_id),
    constraint fk_com_usr foreign key(usr_id) references t_user(usr_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;