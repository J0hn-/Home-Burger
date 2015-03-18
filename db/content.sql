use homeburger;

truncate table t_usr;
truncate table t_cat;
truncate table t_brg;
truncate table t_brg_cat;
truncate table t_ing;
truncate table t_brg_ing;

insert into t_cat values
(1, 'Classiques');
insert into t_cat values
(2, 'Épicé');
insert into t_cat values
(3, 'Végétarien');
insert into t_cat values
(4, 'Végétalien');
insert into t_cat values
(5, 'Boeuf');
insert into t_cat values
(6, 'Poulet');
insert into t_cat values
(7, 'Poisson');


insert into t_brg values
(1, 'Cheeseburger', "L'incontournable cheeseburger !","");
insert into t_brg values
(2, 'Hamburger', "Rien de plus standart !","");
insert into t_brg values
(3, 'Eggburger', "Pour vous les végétariens !","");
insert into t_brg values
(4, 'Vegetoburger', "Pour les plus stricts végétaliens !","");
insert into t_brg values
(5, 'Burnburger', "Appelez les pompiers !","");
insert into t_brg values
(6, 'Chickenburger', "Cot cot cot !","");
insert into t_brg values
(7, 'Fishburger', "Magicarp ! Magicarp !","");


insert into t_brg_cat values (1, 1);
insert into t_brg_cat values (1, 5);
insert into t_brg_cat values (2, 1);
insert into t_brg_cat values (2, 5);
insert into t_brg_cat values (3, 3);
insert into t_brg_cat values (4, 4);
insert into t_brg_cat values (5, 2);
insert into t_brg_cat values (5, 5);
insert into t_brg_cat values (6, 6);
insert into t_brg_cat values (6, 2);
insert into t_brg_cat values (7, 7);


insert into t_ing values (1, 'Cornichons');
insert into t_ing values (2, 'Salade, Tomates, Oignons');
insert into t_ing values (3, 'Fromage');
insert into t_ing values (4, 'Steak');
insert into t_ing values (5, 'Poulet');
insert into t_ing values (6, 'Poisson');
insert into t_ing values (7, 'Oeuf');
insert into t_ing values (8, 'Steak Végétarien');
insert into t_ing values (9, 'Piment');


insert into t_brg_ing values (1, 1);
insert into t_brg_ing values (1, 2);
insert into t_brg_ing values (1, 3);
insert into t_brg_ing values (1, 4);
insert into t_brg_ing values (2, 1);
insert into t_brg_ing values (2, 2);
insert into t_brg_ing values (2, 4);
insert into t_brg_ing values (3, 2);
insert into t_brg_ing values (3, 3);
insert into t_brg_ing values (3, 7);
insert into t_brg_ing values (4, 2);
insert into t_brg_ing values (4, 8);
insert into t_brg_ing values (5, 2);
insert into t_brg_ing values (5, 4);
insert into t_brg_ing values (5, 9);
insert into t_brg_ing values (6, 2);
insert into t_brg_ing values (6, 3);
insert into t_brg_ing values (6, 5);
insert into t_brg_ing values (7, 1);
insert into t_brg_ing values (7, 2);
insert into t_brg_ing values (7, 6);


/* raw password is 'john' */
insert into t_usr values
(1, 'JohnDoe', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER');
/* raw password is 'jane' */
insert into t_usr values
(2, 'JaneDoe', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER');
/* raw password is '@dm1n' */
insert into t_usr values
(3, 'admin', 'gqeuP4YJ8hU3ZqGwGikB6+rcZBqefVy+7hTLQkOD+jwVkp4fkS7/gr1rAQfn9VUKWc7bvOD7OsXrQQN5KGHbfg==', 'EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN');


/*
insert into t_comment values
(1, 'Great! Keep up the good work.', 1, 1);
insert into t_comment values
(2, "Thank you, I'll try my best.", 1, 2);
*/

