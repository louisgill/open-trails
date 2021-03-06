DROP TABLE IF EXISTS trailRelationship;
DROP TABLE IF EXISTS rating;
DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS trail;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS segment;

CREATE TABLE segment(
	segmentId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	segmentStart POINT NOT NULL,
	segmentStop POINT NOT NULL,
	segmentStartElevation MEDIUMINT  NOT NULL,
	segmentStopElevation MEDIUMINT NOT NULL,
	PRIMARY KEY (segmentId)
);

CREATE TABLE user (
	userId          INT UNSIGNED AUTO_INCREMENT NOT NULL,
	browser         VARCHAR(128)                NOT NULL,
	createDate      DATETIME                    NOT NULL,
	ipAddress       VARBINARY(16)               NOT NULL,
	userAccountType CHAR(1)                     NOT NULL,
	userEmail       VARCHAR(128)                NOT NULL,
	userHash        CHAR(128)                   NOT NULL,
	userName        VARCHAR(64)                 NOT NULL,
	userSalt        CHAR(64) NOT NULL,
	UNIQUE (userEmail),
	UNIQUE (userName),
	PRIMARY KEY (userId)
);

CREATE TABLE trail (
	trailId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userId INT UNSIGNED NOT NULL,
	browser VARCHAR (128) NOT NULL,
	createDate DATETIME NOT NULL,
	ipAddress VARBINARY (16) NOT NULL,
	submitTrailId INT UNSIGNED NULL,
	trailAmenities VARCHAR (256) NULL,
	trailCondition VARCHAR (256) NULL,
	trailDescription VARCHAR (512)NULL,
	trailDifficulty TINYINT NULL,
	trailDistance FLOAT NULL,
	trailName VARCHAR (64) NOT NULL,
	trailSubmissionType INT (1) NOT NULL,
	trailTerrain VARCHAR (128) NULL,
	trailTraffic VARCHAR (48) NOT NULL,
	trailUse VARCHAR (64) NULL,
	trailUuid CHAR (22) UNIQUE NULL,
	INDEX (submitTrailId),
	INDEX (userId),
	FOREIGN KEY (submitTrailId) REFERENCES trail (trailId),
	FOREIGN KEY (userId) REFERENCES user (userId),
	PRIMARY KEY (trailId)
);

CREATE TABLE comment (
	commentId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	trailId INT UNSIGNED NOT NULL,
	userId INT UNSIGNED NOT NULL,
	browser VARCHAR (128) NOT NULL,
	createDate DATETIME NOT NULL,
	ipAddress VARBINARY (16) NOT NULL,
	commentPhoto VARCHAR (255) NULL,
	commentPhotoType VARCHAR (12) NULL,
	commentText VARCHAR (256) NOT NULL,
	INDEX (trailId),
	INDEX (userId),
	FOREIGN KEY (trailId) REFERENCES trail (trailId),
	FOREIGN KEY (userId) REFERENCES user (userId),
	PRIMARY KEY (commentId)
);

CREATE TABLE rating(
	trailId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userId INT UNSIGNED NOT NULL,
	ratingValue INT NOT NULL,
	INDEX (trailId),
	INDEX (userId),
	FOREIGN KEY (trailId) REFERENCES trail (trailId),
	FOREIGN KEY (userId) REFERENCES user (userId)
);

CREATE TABLE trailRelationship (
	trailId       INT UNSIGNED AUTO_INCREMENT NOT NULL,
	segmentId     INT UNSIGNED                NOT NULL,
	segmentType CHAR(1)                     NOT NULL,
	INDEX (trailId),
	INDEX (segmentId),
	FOREIGN KEY (trailId) REFERENCES trail (trailId),
	FOREIGN KEY (segmentId) REFERENCES segment (segmentId)
);
