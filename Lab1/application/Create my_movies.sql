drop table my_movies;

create TABLE my_movies (
movieID int primary key AUTO_INCREMENT,
movieGenre varchar(255) not null,
movieTitle varchar(200) not null,
movieType int not null,
movieRating int not null,
check (movieRating>=0),
check (movieRating<=10)
)ENGINE=INNODB;

insert into my_movies (movieGenre, movieTitle,movieType,movieRating) Values ('Science-Fiction','Wargames',1,5);
insert into my_movies (movieGenre, movieTitle,movieType,movieRating) Values ('Thriller/Action','Tomorrow Never Dies',1,9);
insert into my_movies (movieGenre, movieTitle,movieType,movieRating) Values ('Comedy/Crime','Hot Fuzz',1,8);
insert into my_movies (movieGenre, movieTitle,movieType,movieRating) Values ('Fantasy/Action','Labyrinth',1,7);
insert into my_movies (movieGenre, movieTitle,movieType,movieRating) Values ('Crime/Action','Kingsman: The Secret Service',1,8);