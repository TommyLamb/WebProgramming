drop table users_movies

create TABLE users_movies(
uID int not null,
movieID int not null,
primary key (uID, movieID),
foreign key (uID) references my_users(uID),
foreign key (movieID) references my_movies(movieID)
)

insert into users_movies VALUES (1,3);
insert into users_movies VALUES (1,6);
insert into users_movies VALUES (1,7);
insert into users_movies VALUES (2,5);
insert into users_movies VALUES (2,7);
insert into users_movies VALUES (3,4);
insert into users_movies VALUES (4,7);