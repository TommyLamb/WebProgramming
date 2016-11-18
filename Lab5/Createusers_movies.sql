drop table users_movies;

create TABLE users_movies(
uID int not null,
movieID int not null,
primary key (uID, movieID),
foreign key (uID) references my_users(uID),
foreign key (movieID) references my_movies(movieID)
)ENGINE=INNODB;

insert into users_movies VALUES (1,1);
insert into users_movies VALUES (1,4);
insert into users_movies VALUES (1,5);
insert into users_movies VALUES (2,3);
insert into users_movies VALUES (2,5);
insert into users_movies VALUES (3,2);
insert into users_movies VALUES (4,5);