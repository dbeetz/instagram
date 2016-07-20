-- adding user entity
CREATE TABLE user (
	userId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userUsername VARCHAR(32) NOT NULL,
	userEmail VARCHAR(128) NOT NULL,
	userName VARCHAR(32),
	userPhone VARCHAR(32),
	userBio VARCHAR(2000),
	-- add Hash, Salt and Gender here when we know the proper commands
	UNIQUE(userEmail),
	UNIQUE(userUsername),
	PRIMARY KEY(userId)
);

-- adding picture entity
CREATE TABLE picture (
	pictureId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	pictureUserId INT UNSIGNED NOT NULL,
	pictureCaption VARCHAR(100),
	pictureTimestamp TIMESTAMP NOT NULL,
	pictureLocation POINT,
-- add File here when we know the proper commands
	FOREIGN KEY (pictureUserId) REFERENCES user(userId),
	PRIMARY KEY (pictureId)
);

-- adding comment entity
CREATE TABLE comment (
	commentId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	commentContent VARCHAR(140) NOT NULL,
	commentUserId INT UNSIGNED NOT NULL,
	commentPictureId INT UNSIGNED NOT NULL,
	-- taking a shot at how to set up a semi-weak entity's keys
	FOREIGN KEY (commentUserId) REFERENCES user(userId),
	FOREIGN KEY (commentPictureId) REFERENCES picture(pictureId),
	PRIMARY KEY (commentId)
);
