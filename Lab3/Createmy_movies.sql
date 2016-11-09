drop table my_movies;

create TABLE my_movies (
movieID int primary key AUTO_INCREMENT,
movieGenre varchar(255) not null,
movieTitle varchar(200) not null,
movieType int not null,
movieRating int not null,
movieURL varchar(2048),
check (movieRating>=0),
check (movieRating<=10)
)ENGINE=INNODB;

insert into my_movies (movieGenre, movieTitle,movieType,movieRating, movieURL) Values ('Science-Fiction','Wargames',1,5,'https://www.youtube.com/watch?v=hbqMuvnx5MU');
insert into my_movies (movieGenre, movieTitle,movieType,movieRating, movieURL) Values ('Thriller/Action','Tomorrow Never Dies',1,9,'https://www.youtube.com/watch?v=eqrk7-mx2D0');
insert into my_movies (movieGenre, movieTitle,movieType,movieRating, movieURL) Values ('Comedy/Crime','Hot Fuzz',1,8,'https://www.youtube.com/watch?v=ayTnvVpj9t4');
insert into my_movies (movieGenre, movieTitle,movieType,movieRating, movieURL) Values ('Fantasy/Action','Labyrinth',1,7,'https://www.youtube.com/watch?v=XRcOZZDvMv4');
insert into my_movies (movieGenre, movieTitle,movieType,movieRating, movieURL) Values ('Crime/Action','Kingsman: The Secret Service',1,8,'https://www.youtube.com/watch?v=kl8F-8tR8to');