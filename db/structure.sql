/* CREER LA DATABASE : */

create database if not exists hombeburger character set utf8 collate utf8_unicode_ci;
use hombeburger;

grant all privileges on hombeburger.* to 'hombeburger_user'@'localhost' identified by 'secret';

/* CREER LA STRUCTURE : */

drop table if exists t_usr;
drop table if exists t_cat;
drop table if exists t_brg;
drop table if exists t_brg_cat;
drop table if exists t_ing;
drop table if exists t_brg_ing;

create table t_brg (
    brg_id integer not null primary key,
    brg_name varchar(50) not null,
    brg_resume varchar(2000) not null,
	brg_img_path varchar(50) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_cat (
    cat_id integer not null primary key,
    cat_name varchar(50) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_brg_cat (
	brg_id integer not null,
	cat_id integer not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_ing (
	ing_id integer not null,
	ing_name varchar(50)
);

create table t_brg_ing (
	brg_id integer not null,
	ing_id integer not null
)engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_usr (
    usr_id integer not null primary key auto_increment,
    usr_name varchar(50) not null,
    usr_password varchar(88) not null,
    usr_salt varchar(23) not null,
    usr_role varchar(50) not null 
) engine=innodb character set utf8 collate utf8_unicode_ci;