-- adding user entity
CREATE TABLE user (
	userId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userBio VARCHAR(2000),
	userEmail VARCHAR(128) NOT NULL,
	userGender CHAR(1),
	userHash CHAR(128),
	userName VARCHAR(32),
	userPhone VARCHAR(32),
	userSalt CHAR(64),
	userUsername VARCHAR(32) NOT NULL,
	UNIQUE(userEmail),
	UNIQUE(userUsername),
	PRIMARY KEY(userId)
);

-- adding picture entity
CREATE TABLE picture (
	pictureId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	pictureUserId INT UNSIGNED NOT NULL,
	pictureCaption VARCHAR(100),
	pictureFile VARCHAR(255),
	pictureLocation POINT,
	pictureTimestamp TIMESTAMP NOT NULL,
	FOREIGN KEY (pictureUserId) REFERENCES user(userId),
	PRIMARY KEY (pictureId)
);

-- adding comment entity
CREATE TABLE comment (
	commentId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	commentUserId INT UNSIGNED NOT NULL,
	commentPictureId INT UNSIGNED NOT NULL,
	commentContent VARCHAR(140) NOT NULL,
	FOREIGN KEY (commentUserId) REFERENCES user(userId),
	FOREIGN KEY (commentPictureId) REFERENCES picture(pictureId),
	PRIMARY KEY (commentId)
);
