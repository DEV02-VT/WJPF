CREATE TABLE news (
  id          int NOT NULL auto_increment,
  title       varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  content     TEXT CHARACTER SET utf8 COLLATE utf8_general_ci,
  news_date   DATE DEFAULT NULL,
  status      int DEFAULT 1 NOT NULL,
  author_id   int,
  created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at  DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

UPDATEE TABLE association_admin
ADD COLUMN   contact_person  	tinyint(1) DEFAULT 0 NOT NULL;
