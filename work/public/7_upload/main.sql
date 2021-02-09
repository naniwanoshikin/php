-- テーブル削除
DROP TABLE IF EXISTS upload;

CREATE TABLE upload (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) DEFAULT 'No Name',
  file_path VARCHAR(255) NOT NULL,
  content VARCHAR(140) DEFAULT 'No Coment!',
  created_at timestamp NOT NULL default current_timestamp,
  updated_at timestamp NOT NULL default current_timestamp on update current_timestamp,
  PRIMARY KEY (id),
  UNIQUE KEY(file_path)
);
-- テーブル一覧
SHOW tables;
-- テーブル情報
DESC upload;


INSERT INTO upload (file_path) VALUES ('bbb');
SELECT * FROM upload;

UPDATE upload SET name="limited" WHERE id = 1;
SELECT * FROM upload;

DELETE FROM upload WHERE id BETWEEN 3 AND 7;
SELECT * FROM upload;