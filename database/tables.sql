SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE settings
(
  id                        int NOT NULL,
  smtp_host                 varchar(100)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  smtp_port                 int DEFAULT 465,
  smtp_user                 varchar(100)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  smtp_mail                 varchar(100)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  smtp_password             varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci,
  smtp_transport            varchar(20)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  smtp_sender               varchar(100)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  email_board               varchar(100)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  email_webteam             varchar(100)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  account_bank				varchar(100)  CHARACTER SET utf8 COLLATE utf8_general_ci,
  account_iban				varchar(70)  CHARACTER SET utf8 COLLATE utf8_general_ci,
  account_bic				varchar(70)  CHARACTER SET utf8 COLLATE utf8_general_ci,

  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`id`, `smtp_host`, `smtp_port`, `smtp_user`, `smtp_mail`, `smtp_password`, `smtp_transport`, `smtp_sender`, `email_board`, `email_webteam`) VALUES
(0, '', 465, '', '', '', 'ssl', '', '', '');


CREATE TABLE user
(
  id                        int NOT NULL auto_increment,
  first_name                varchar(70)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  last_name                 varchar(70)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  email                     varchar(70)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  password                  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
  password_reset_key        varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci,
  password_reset_time	 	DATETIME,
  status                    int DEFAULT 0 NOT NULL,
  phone		                varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  birthday			 		DATE,
  nationality_code          varchar(2)  NOT NULL,
  street 					varchar(100) NOT NULL,
  house_number 				varchar(20) NOT NULL,
  zip						varchar(10) NOT NULL,
  town						varchar(100) NOT NULL,
  country_code              varchar(2)  NOT NULL,
  last_login		 		DATETIME,
  administrator             tinyint(1) DEFAULT 0 NOT NULL,
  board_role	            int DEFAULT 1 NOT NULL,
  wjpf_email                varchar(70)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  image                     varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,

  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE member
(
    id                        int NOT NULL auto_increment,
    type                      int DEFAULT 1 NOT NULL,
    name                      varchar(255),
    registration_number       varchar(70)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    foundation_date	 		  DATE,
    tax_id                    varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
    country_code              varchar(2)  NOT NULL,
    member_count              int DEFAULT 0 NOT NULL,
    street 					  varchar(100) NOT NULL,
    house_number 			  varchar(20) NOT NULL,
    zip						  varchar(10) NOT NULL,
    town					  varchar(100) NOT NULL,
    country_code              varchar(2)  NOT NULL,
    website                   varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
    email                     varchar(70)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    status                    int DEFAULT 0 NOT NULL,
    phone		              varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    begin_of_membership		  DATE,
    end_of_membership		  DATE,
    last_login		 		  DATETIME,
    comment                   TEXT,
    member          		  tinyint(1) DEFAULT 0 NOT NULL,

    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE member_admin
(
    id                  int NOT NULL auto_increment,
    member_id    	    int NOT  null,
    user_id             int NOT NULL,
    role                varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci,

    PRIMARY KEY (id),
    constraint `fk_member_admin_user` foreign key (user_id) references user (id) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
