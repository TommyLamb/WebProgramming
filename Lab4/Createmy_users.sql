DROP table my_users;

CREATE table my_users(
uID int primary key AUTO_INCREMENT,
username varchar(64) not null UNIQUE,
password varchar(256) not null
)ENGINE=INNODB;

--Passwords should never, ever, under any circumstances, be stored in plaintext like this.
insert into my_users (username, password) VALUES ('JamesPond', 'fi5h');
insert into my_users (username, password) VALUES ('CommanderShepard', 'NormandySR2');
insert into my_users (username, password) VALUES ('Data', 'EnterPrise');
insert into my_users (username, password) VALUES ('Sonic', 'GreenHill91');