-- adding user entity
CREATE TABLE user (
	userId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	userUsername VARCHAR(32) NOT NULL,
	userEmail VARCHAR(128) NOT NULL,
	userName VARCHAR(32),
	userPhone VARCHAR(32),
	-- add Hash and Salt here when we know the proper commands

	UNIQUE(userEmail),
	UNIQUE(userUsername),
	PRIMARY KEY(userId)
);