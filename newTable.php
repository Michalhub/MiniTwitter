<?php

CREATE TABLE Users
(
	id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
	hash_pass VARCHAR(60) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE Tweet
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    text VARCHAR(512),
    creationDate DATE,
    FOREIGN KEY (user_id) REFERENCES Users(id);
);

CREATE TABLE Comment
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_id INT,
    creationDate DATETIME,
    textComment VARCHAR(512),
    FOREIGN KEY (user_id) REFERENCES Users(id)
);

ALTER TABLE Messages ADD CONSTRAINT profile_sender_id FOREIGN KEY (sender_id) REFERENCES Users(id),
ALTER TABLE Messages ADD CONSTRAINT profile_receiver_id FOREIGN KEY (receiver_id) REFERENCES Users(id);


CREATE TABLE Message
(
    id INT PRIMARY KEY,
    user_sender INT,
    user_receiver INT,
    creationDate DATETIME,
    message VARCHAR(512),
    CONSTRAINT fk_sender FOREIGN KEY (user_sender) REFERENCES Users(id),
    CONSTRAINT fk_receiver FOREIGN KEY (user_receiver) REFERENCES Users(id)
);
/*
create table MailSent(

    Id int primary key,

  date datetime,

  profil_sender int,

  profil_receiver int,

  CONSTRAINT fk_sender FOREIGN KEY (profil_sender) REFERENCES User(id),

  CONSTRAINT fk_receiver FOREIGN KEY (profil_receiver) REFERENCES User(id)

)
*/