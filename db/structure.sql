/* CREER LA DATABASE : */
drop database if exists homeburger;
create database if not exists homeburger character set utf8 collate utf8_unicode_ci;
use homeburger;

grant all privileges on homeburger.* to 'homeburger_user'@'localhost' identified by 'secret';

/* CREER LA STRUCTURE : */

drop table if exists t_usr;
drop table if exists t_cat;
drop table if exists t_brg;
drop table if exists t_brg_cat;
drop table if exists t_ing;
drop table if exists t_brg_ing;

create table t_cat (
  cat_id integer not null primary key,
  cat_name varchar(50) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_brg (
  brg_id integer not null primary key,
  brg_name varchar(50) not null,
  brg_resume varchar(2000) not null,
  brg_img_name varchar(50) not null,
  brg_cat integer not null,
  brg_prix float(5) not null,
  constraint fk_cat_brg foreign key(brg_cat) references t_cat(cat_id),
  constraint fk_cat_id foreign key(brg_cat) references t_cat(cat_id)
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_ing (
  ing_id integer not null primary key,
  ing_name varchar(50) not null
)engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_brg_ing (
  brg_id integer not null,
  ing_id integer not null,
  constraint fk_brg_id foreign key(brg_id) references t_brg(brg_id),
  constraint fk_ing_id foreign key(brg_id) references t_ing(ing_id)
)engine=innodb character set utf8 collate utf8_unicode_ci;

create table t_usr (
  usr_id integer not null primary key auto_increment,
  usr_name varchar(50) not null,
  usr_password varchar(88) not null,
  usr_salt varchar(23) not null,
  usr_role varchar(50) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;
