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

