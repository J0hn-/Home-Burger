use homeburger;

insert into t_cat values
(1, 'Classique');
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
insert into t_cat values
(8, 'Exotique');


insert into t_brg values
(1, 'Cheeseburger', "L'incontournable cheeseburger !","img1.jpg",1,9.99);
insert into t_brg values
(2, 'Hamburger', "Rien de plus standard !","img1.jpg",1,9.99);
insert into t_brg values
(3, 'Eggburger', "Pour vous les végétariens !","img1.jpg",3,9.99);
insert into t_brg values
(4, 'Vegetoburger', "Pour les plus stricts végétaliens !","img1.jpg",4,9.99);
insert into t_brg values
(5, 'Burnburger', "Appelez les pompiers !","img7.jpg",2,9.99);
insert into t_brg values
(6, 'Chickenburger', "My Life is Potato","img8.jpg",6,9.99);
insert into t_brg values
(7, 'Fishburger', "Magicarp ! Magicarp !","img9.jpg",7,9.99);
insert into t_brg values
(8, 'Le Bleu', "Succombez à sa saveur authentique !","img2.jpg",5,9.99);
insert into t_brg values
(9, 'Exotique', "Un mélange audacieux !","img3.jpg",8,9.99);
insert into t_brg values
(10, 'Le Bistrot', "Un grand classique !","img4.jpg",1,9.99);
insert into t_brg values
(11, 'L\'Olympus Burger', "Triomphez","img5.jpg",5,9.99);
insert into t_brg values
(12, 'The Dark Burger', "Join the Dark side, we have burgers !","img6.jpg",2,9.99);

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
(1, 'john@doe', 'doe', 'john', 'somewhere over the', '12345', 'rainbow', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER');
/* raw password is 'jane' */ /*
insert into t_usr values
(2, 'JaneDoe', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER');
/* raw password is '@dm1n' */ /*
insert into t_usr values
(3, 'admin', 'gqeuP4YJ8hU3ZqGwGikB6+rcZBqefVy+7hTLQkOD+jwVkp4fkS7/gr1rAQfn9VUKWc7bvOD7OsXrQQN5KGHbfg==', 'EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN');


/*
insert into t_comment values
(1, 'Great! Keep up the good work.', 1, 1);
insert into t_comment values
(2, "Thank you, I'll try my best.", 1, 2);
*/
