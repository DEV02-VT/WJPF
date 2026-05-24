ALTER TABLE user ADD COLUMN passport_number varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER wjpf_email;

CREATE TABLE association_link (
  id              int NOT NULL auto_increment,
  association_id  int NOT NULL,
  link_type       int NOT NULL,
  url             varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (id),
  constraint `fk_association_link_association`
    foreign key (association_id) references association (id) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE association_admin
(
    id                  int NOT NULL auto_increment,
    association_id    	int NOT  null,
    user_id             int NOT NULL,
    role                varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
    contact_person  	tinyint(1) DEFAULT 0 NOT NULL,

    PRIMARY KEY (id),
    constraint `fk_association_admin_association` foreign key (association_id) references association (id) on delete cascade,
    constraint `fk_association_admin_user` foreign key (user_id) references user (id) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


