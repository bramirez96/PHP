DROP TABLE IF EXISTS test;
CREATE TABLE test (
user_id TINYINT(4) AUTO_INCREMENT,
email VARCHAR(30),
pass VARCHAR(40),
registration_date DATE,
active BOOLEAN,
PRIMARY KEY (user_id),
UNIQUE KEY (email),
INDEX login (email, pass)
);