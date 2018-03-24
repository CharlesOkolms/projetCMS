#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS page;
DROP TABLE IF EXISTS template;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS style;
DROP TABLE IF EXISTS gallery;
DROP TABLE IF EXISTS picture;
DROP TABLE IF EXISTS page_article;
DROP TABLE IF EXISTS picture_tag;
DROP TABLE IF EXISTS article_tag;

#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user (
	id_user         INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	nickname        VARCHAR(50)                 NOT NULL UNIQUE,
	firstname       VARCHAR(50)                 NOT NULL,
	lastname        VARCHAR(50)                 NOT NULL,
	email           VARCHAR(100)                NOT NULL UNIQUE,
	writer          BOOL                        NOT NULL DEFAULT FALSE,
	publisher       BOOL                        NOT NULL DEFAULT FALSE,
	admin           BOOL                        NOT NULL DEFAULT FALSE,
	password        CHAR(60)                    NOT NULL,
	created         DATETIME                    NOT NULL DEFAULT CURRENT_TIMESTAMP,
	lastupdated     DATETIME                             DEFAULT CURRENT_TIMESTAMP,
	id_user_updater INT UNSIGNED, -- valeur par défaut à régler en trigger pour mettre l'id du user
	deleted         DATETIME,
	id_user_deleter INT UNSIGNED
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: article
#------------------------------------------------------------

CREATE TABLE article (
	id_article        INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	title             VARCHAR(100)                NOT NULL UNIQUE,
	content           TEXT                        NOT NULL,
	headerphoto       VARCHAR(100),
	attachment        VARCHAR(100), -- a changer pour gerer chaque piece jointe separement s'il yen a plusieurs
	premium           BOOL                        NOT NULL DEFAULT FALSE,
	written           DATETIME                    NOT NULL DEFAULT CURRENT_TIMESTAMP,
	id_user_writer    INT UNSIGNED                NOT NULL,
	published         DATETIME,
	id_user_publisher INT UNSIGNED,
	deleted           DATETIME,
	id_user_deleter   INT UNSIGNED
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: page
#------------------------------------------------------------

CREATE TABLE page (
	id_page         INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	title           VARCHAR(50)                 NOT NULL UNIQUE,
	created         DATETIME                    NOT NULL DEFAULT CURRENT_TIMESTAMP,
	id_user_creator INT UNSIGNED                NOT NULL,
	id_template     INT UNSIGNED                NOT NULL DEFAULT 1, -- par default le 1er template
	id_style        INT UNSIGNED                NOT NULL DEFAULT 1 -- par defaut le 1er css
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: template
#------------------------------------------------------------

CREATE TABLE template (
	id_template     INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	name            VARCHAR(25)                 NOT NULL UNIQUE,
	created         DATETIME                    NOT NULL DEFAULT CURRENT_TIMESTAMP,
	id_user_creator INT UNSIGNED                NOT NULL
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: tag
#------------------------------------------------------------

CREATE TABLE tag (
	id_tag INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	label  VARCHAR(30)                 NOT NULL UNIQUE
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: style
#------------------------------------------------------------

CREATE TABLE style (
	id_style INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	name     VARCHAR(25)                 NOT NULL UNIQUE
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: gallery
#------------------------------------------------------------

CREATE TABLE gallery (
	id_gallery      INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	title           VARCHAR(30)                 NOT NULL UNIQUE,
	description     VARCHAR(250), -- un default en trigger style "Galerie de Jean Dupont"
	created         DATETIME                    NOT NULL DEFAULT CURRENT_TIMESTAMP,
	id_user_creator INT UNSIGNED                NOT NULL, -- trigger default current user
	last_edited     DATETIME                    NOT NULL DEFAULT CURRENT_TIMESTAMP,
	id_user_editor  INT UNSIGNED                NOT NULL -- default current user
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: picture
#------------------------------------------------------------

CREATE TABLE picture (
	id_picture       INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	name             VARCHAR(30)                 NOT NULL,
	description      VARCHAR(250),
	uploaded         DATETIME                    NOT NULL DEFAULT CURRENT_TIMESTAMP,
	id_user_uploader INT UNSIGNED                NOT NULL,
	id_gallery       INT UNSIGNED                NOT NULL,
	UNIQUE (name, id_user_uploader)
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: page_article
#------------------------------------------------------------

CREATE TABLE page_article (
	id_article INT UNSIGNED NOT NULL,
	id_page    INT UNSIGNED NOT NULL,
	PRIMARY KEY (id_article, id_page)
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: article_tag
#------------------------------------------------------------

CREATE TABLE article_tag (
	id_article INT UNSIGNED NOT NULL,
	id_tag     INT UNSIGNED NOT NULL,
	PRIMARY KEY (id_article, id_tag)
) ENGINE = InnoDB;

#------------------------------------------------------------
# Table: picture_tag
#------------------------------------------------------------

CREATE TABLE picture_tag (
	id_tag     INT UNSIGNED NOT NULL,
	id_picture INT UNSIGNED NOT NULL,
	PRIMARY KEY (id_tag, id_picture)
) ENGINE = InnoDB;

#------------------------------------------------------------
# FOREIGN KEYS
#------------------------------------------------------------

ALTER TABLE user
	ADD CONSTRAINT fk_user_id_user_1 FOREIGN KEY (id_user_updater) REFERENCES user (id_user);
ALTER TABLE user
	ADD CONSTRAINT fk_user_id_user_2 FOREIGN KEY (id_user_deleter) REFERENCES user (id_user);
ALTER TABLE article
	ADD CONSTRAINT fk_article_id_user FOREIGN KEY (id_user_writer) REFERENCES user (id_user);
ALTER TABLE article
	ADD CONSTRAINT fk_article_id_user_1 FOREIGN KEY (id_user_publisher) REFERENCES user (id_user);
ALTER TABLE article
	ADD CONSTRAINT fk_article_id_user_2 FOREIGN KEY (id_user_deleter) REFERENCES user (id_user);
ALTER TABLE page
	ADD CONSTRAINT fk_page_id_user FOREIGN KEY (id_user_creator) REFERENCES user (id_user);
ALTER TABLE page
	ADD CONSTRAINT fk_page_id_template FOREIGN KEY (id_template) REFERENCES template (id_template);
ALTER TABLE page
	ADD CONSTRAINT fk_page_id_style FOREIGN KEY (id_style) REFERENCES style (id_style);
ALTER TABLE template
	ADD CONSTRAINT fk_template_id_user FOREIGN KEY (id_user_creator) REFERENCES user (id_user);
ALTER TABLE gallery
	ADD CONSTRAINT fk_gallery_id_user FOREIGN KEY (id_user_creator) REFERENCES user (id_user);
ALTER TABLE gallery
	ADD CONSTRAINT fk_gallery_id_user_1 FOREIGN KEY (id_user_editor) REFERENCES user (id_user);
ALTER TABLE picture
	ADD CONSTRAINT fk_picture_id_user FOREIGN KEY (id_user_uploader) REFERENCES user (id_user);
ALTER TABLE picture
	ADD CONSTRAINT fk_picture_id_gallery FOREIGN KEY (id_gallery) REFERENCES gallery (id_gallery);
ALTER TABLE page_article
	ADD CONSTRAINT fk_page_article_id_article FOREIGN KEY (id_article) REFERENCES article (id_article);
ALTER TABLE page_article
	ADD CONSTRAINT fk_page_article_id_page FOREIGN KEY (id_page) REFERENCES page (id_page);
ALTER TABLE article_tag
	ADD CONSTRAINT fk_article_tag_id_article FOREIGN KEY (id_article) REFERENCES article (id_article);
ALTER TABLE article_tag
	ADD CONSTRAINT fk_article_tag_id_tag FOREIGN KEY (id_tag) REFERENCES tag (id_tag);
ALTER TABLE picture_tag
	ADD CONSTRAINT fk_picture_tag_id_tag FOREIGN KEY (id_tag) REFERENCES tag (id_tag);
ALTER TABLE picture_tag
	ADD CONSTRAINT fk_picture_tag_id_picture FOREIGN KEY (id_picture) REFERENCES picture (id_picture);


#------------------------------------------------------------
# DATA
#------------------------------------------------------------


INSERT INTO `user` (`id_user`, `nickname`, `firstname`, `lastname`, `email`, `writer`, `publisher`, `admin`, `password`,
                    `created`, `lastupdated`, `id_user_updater`, `deleted`, `id_user_deleter`)
VALUES (1, 'Charleclerc', 'Charles', 'Coulon', 'c.coulon@cs2i-bourgogne.com', 1, 1, 1,
           '$2y$10$nsv7Keji61EpNXDfJ5yzkOOUmJV2whe7wHxBUnTRHvQ03r2wFDlIu', '2018-03-24 18:19:28', NULL, NULL, NULL, NULL);
