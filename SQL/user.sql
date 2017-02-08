create table users
(
user_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
first_name VARCHAR(20) NOT NULL,
last_name VARCHAR(40) NOT NULL,
email VARCHAR(60) NOT NULL,
pass CHAR(40) NOT NULL,
registration_date DATETIME NOT NULL,
user_type VARCHAR(20) NOT NULL,
PRIMARY KEY (user_id)
)