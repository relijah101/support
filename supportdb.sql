CREATE TABLE roles(
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(15) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE users(
	id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(15) NOT NULL,
	email VARCHAR(30) NOT NULL,
	password VARCHAR(60) NOT NULL,
	status INT NOT NULL,
	role INT NOT NULL,
	registered_date DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	FOREIGN KEY (role) REFERENCES roles (id) 
);

CREATE TABLE categories(
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(30) NOT NULL,
	description TEXT NOT NULL, 
	added_on DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE questions(
	id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	category_id INT NOT NULL,
	question TEXT NOT NULL,
	date DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES users (id), 
	FOREIGN KEY (category_id) REFERENCES categories (id) 
);

CREATE TABLE answers(
	id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	question_id INT NOT NULL,
	answers TEXT NOT NULL,
	date DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES users (id), 
	FOREIGN KEY (question_id) REFERENCES questions (id) 
);


## Create user roles
INSERT INTO roles (name) VALUES ('admin');
INSERT INTO roles (name) VALUES ('user');


## Set default admin account
INSERT INTO users (username, email, password, status, role) VALUES ('admin', 'admin@ictsupport.com', sha('admin'), 1, 1);