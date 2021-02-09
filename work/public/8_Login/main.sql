-- テーブル削除
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS posts;

CREATE TABLE members (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) DEFAULT 'No Name',
  email VARCHAR(255),
  pass VARCHAR(100),
  picture VARCHAR(255),
  created_at DATETIME NOT NULL default current_timestamp,
  updated_at timestamp NOT NULL default current_timestamp on update current_timestamp,
  PRIMARY KEY (id) -- 最後カンマ消したらエラー消えた
);

CREATE TABLE posts (
  id INT NOT NULL AUTO_INCREMENT,
  message TEXT,
  member_id INT,
  reply_message_id INT,
  created_at DATETIME NOT NULL default current_timestamp,
  updated_at TIMESTAMP NOT NULL default current_timestamp on update current_timestamp,
  PRIMARY KEY (id)
);

-- テーブル一覧
SHOW tables;
-- テーブル情報
DESC members;


INSERT INTO members (pass) VALUES ('bbb');
SELECT * FROM members;

UPDATE members SET name="limited" WHERE id = 1;
SELECT * FROM members;

DELETE FROM members WHERE id BETWEEN 3 AND 7;
SELECT * FROM members;