
CREATE TABLE french_iots (
  i_no bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '일련번호번호',
  i_partner int(10) unsigned NOT NULL DEFAULT 0 COMMENT '파트너번호',
  i_name varchar(50) NOT NULL DEFAULT '' COMMENT '룸이름',
  i_sex char(1) NOT NULL DEFAULT 'M' COMMENT '파트너번호',
  i_type char(1) NOT NULL DEFAULT 'R' COMMENT '구분',
  i_iot1 varchar(20) NOT NULL DEFAULT '' COMMENT 'IOT1',
  i_iot2 varchar(20) NOT NULL DEFAULT '' COMMENT 'IOT2',
  i_iot3 varchar(20) NOT NULL DEFAULT '' COMMENT 'IOT3',
  i_iot4 varchar(20) NOT NULL DEFAULT '' COMMENT 'IOT4',
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  deleted_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (i_no)
) ENGINE=InnoDB;