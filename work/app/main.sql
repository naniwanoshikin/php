・Relationnal DataBase
現在の主流。データを表（Excel）形式で管理。
データ構造を決めてからデータを管理していく
ex. MySQL, PostgreSQL, SQlite
・NoSQL: スキーマレス
あらかじめデータ構造を決めておかなくても良い
ex. MongoDBなど



接続前にバージョン確認。
mysql --version

-- バージョン確認
SELECT version();

SQL(Structured Query Language)：クエリ（命令）を書く為の言語

データ定義言語（Data Definition Language）：テーブル操作
→CREATE, DROP, ALTER, JOIN（作成、削除、カラム追加、）
データ操作言語（Data Manipulation Language）:データ操作
→SELECT, INSERT, UPDATE, DELETE（取得、追加、更新、削除）
データ制御言語（Data Control Language）:アクセス制御
GRANT, BEGIN, COMMIT, ROLLBACK

SHOW databases;
CREATE DATABASE progate; -- 作成
DROP DATABASE progate; -- 削除
USE DB名 -- 選択

-- 基本的に、1アプリで1データベース。2つ以上データベースを作る理由がほとんどないから。（画像投稿youtube#1）


CREATE TABLE articles (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(100),
  summary VARCHAR(250),
  content TEXT,
  message VARCHAR(140),
  likes INT,
  PRIMARY KEY (id)
);


INSERT INTO sutudents (name, course,) VALUES ("aa", "Java",);
INSERT INTO blogs (title, content, created_at, updated_at) VALUES ("aa", "Java", "2011/2/2", "2030/1/1");
INSERT INTO articles (title, summary, content) VALUES
("MySQLの「My」ってなに？", "MySQLの「My」って「自分の」って意味？", "違うよね"),
("うんうん？", "だよね？", "違うよね？");
UPDATE students SET name="Jordan", course="HTML" WHERE id=7;
UPDATE articles SET password="aa" WHERE id=1;
// または
UPDATE articles SET category="limited" WHERE id IN (2, 4);


SELECT * FROM articles WHERE id BETWEEN 2 AND 3;


-- 使用中のDB
select database();


-- 文字コードの確認
show variables like "chara%";

-- カラム追加
ALTER TABLE articles ADD COLUMN category VARCHAR(100) DEFAULT "all";
ALTER TABLE blogs ADD COLUMN photo TEXT;

-- カラム名変更（型を指定）
ALTER TABLE articles CHANGE COLUMN price cost INT;

-- カラム削除
ALTER TABLE users DROP COLUMN category;
ALTER TABLE blogs DROP COLUMN photo;

-- SELECT カラムA, カラムB, food FROM テーブル名 WHERE 条件;
SELECT * FROM users WHERE NOT price >= 1000; -- 1000未満
SELECT * FROM purchases WHERE food LIKE "プリン%"; -- 前方一致
SELECT * FROM purchases WHERE price IS NOT NULL; -- 中身のあるデータ
SELECT * FROM purchases WHERE category="食費" AND character_name = "ひつじ仙人"; -- 2番目から5件
-- ASC（昇順）: 1,2,3...
SELECT * FROM purchases WHERE category="食費" ORDER BY price DESC LIMIT 2, 5;
SELECT DISTINCT(food) FROM purchases; -- 重複を省く
SELECT food, price * 1.08 FROM purchases; -- 四則演算
SELECT SUM(price) FROM purchases WHERE 条件; -- 集計関数
AVG(price) // 平均、COUNT(*) // レコードの数（null含む）、MAX(price) // 最大
グループ化：SELECT で使えるのは、集計関数とグループしたいカラムのみ
SELECT SUM(price), purchased_at FROM purchases GROUP BY purchased_at;
SELECT SUM(price), purchased_at, character_name FROM purchases WHERE category="食費" GROUP BY purchased_at, character_name HAVING SUM(price) > 1000;
-- グループ化 〜毎に（複数可）
-- グループ化後の条件

-- progate3やろう
-- 3つ以上のテーブル結合
JOIN
LEFT JOIN
