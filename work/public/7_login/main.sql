-- テーブル削除
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(64),
  email varchar(191) UNIQUE,
  pass varchar(191),
  PRIMARY KEY (id)
);
desc users;

SHOW tables;


INSERT INTO users (name, email, pass) VALUES ("aa", "ddd", "dbb");
INSERT INTO users (name, email, pass) VALUES ("わんこ", "wanko@a", "ninja");
SELECT * FROM users;

UPDATE users SET name=1 WHERE id = 1;
SELECT * FROM users;

DELETE FROM users WHERE id BETWEEN 3 AND 7;
SELECT * FROM users;