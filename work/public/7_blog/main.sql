-- テーブル削除
DROP TABLE IF EXISTS blog;

CREATE TABLE blog (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(100) DEFAULT 'No Title',
  content TEXT,
  category INT,
  -- file_path VARCHAR(255) NOT NULL,
  created_at DATETIME NOT NULL default current_timestamp,
  updated_at timestamp NOT NULL default current_timestamp on update current_timestamp,
  status INT DEFAULT 1,
  PRIMARY KEY (id)
);
DESC blog; -- テーブル情報

INSERT INTO blog (title) VALUES ('bbb');
SELECT * FROM blog;

UPDATE blog SET category=1 WHERE id = 1;
SELECT * FROM blog;

DELETE FROM blog WHERE id BETWEEN 3 AND 7;
SELECT * FROM blog;