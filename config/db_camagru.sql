qlDBM: MySQL ******************;
-- ***************************************************;


DROP SCHEMA `SampleDb`;

CREATE SCHEMA `SampleDb`;


-- ************************************** `comments`

CREATE TABLE `comments`
(
	 `id`    NOT NULL ,
	 `text` LONGTEXT NOT NULL ,
	 `date` DATETIME NOT NULL ,

	PRIMARY KEY (`id`)
);





-- ************************************** `users`

CREATE TABLE `users`
(
	 `id`          NOT NULL ,
	 `email`      VARCHAR(45) NOT NULL ,
	 `login`      VARCHAR(45) NOT NULL ,
	 `password`   LONGTEXT NOT NULL ,
	 `validation` TINYINT NOT NULL ,

	PRIMARY KEY (`id`)
);





-- ************************************** `user_has_comments`

CREATE TABLE `user_has_comments`
(
	 `id`           NOT NULL ,
	 `id_users`     NOT NULL ,
	 `id_comments`  NOT NULL ,

	PRIMARY KEY (`id`),
	KEY `fkIdx_158` (`id_users`),
	CONSTRAINT `FK_158` FOREIGN KEY `fkIdx_158` (`id_users`) REFERENCES `users` (`id`),
	KEY `fkIdx_162` (`id_comments`),
	CONSTRAINT `FK_162` FOREIGN KEY `fkIdx_162` (`id_comments`) REFERENCES `comments` (`id`)
);





-- ************************************** `photos`

CREATE TABLE `photos`
(
	 `id`        NOT NULL ,
	 `date`     DATETIME NOT NULL ,
	 `img`      LONGTEXT NOT NULL ,
	 `id_users`  NOT NULL ,

	PRIMARY KEY (`id`),
	KEY `fkIdx_168` (`id_users`),
	CONSTRAINT `FK_168` FOREIGN KEY `fkIdx_168` (`id_users`) REFERENCES `users` (`id`)
);





-- ************************************** `photo_has_comments`

CREATE TABLE `photo_has_comments`
(
	 `id`           NOT NULL ,
	 `id_photos`    NOT NULL ,
	 `id_comments`  NOT NULL ,

	PRIMARY KEY (`id`),
	KEY `fkIdx_146` (`id_photos`),
	CONSTRAINT `FK_146` FOREIGN KEY `fkIdx_146` (`id_photos`) REFERENCES `photos` (`id`),
	KEY `fkIdx_150` (`id_comments`),
	CONSTRAINT `FK_150` FOREIGN KEY `fkIdx_150` (`id_comments`) REFERENCES `comments` (`id`)
);





-- ************************************** `likes`

CREATE TABLE `likes`
(
	 `id`         NOT NULL ,
	 `id_photos`  NOT NULL ,
	 `id_users`   NOT NULL ,

	PRIMARY KEY (`id`),
	KEY `fkIdx_134` (`id_photos`),
	CONSTRAINT `FK_134` FOREIGN KEY `fkIdx_134` (`id_photos`) REFERENCES `photos` (`id`),
	KEY `fkIdx_138` (`id_users`),
	CONSTRAINT `FK_138` FOREIGN KEY `fkIdx_138` (`id_users`) REFERENCES `users` (`id`)
);
