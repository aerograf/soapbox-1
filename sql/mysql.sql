
#
# Structure table for `soapbox_sbcolumns` (8 fields)
#

CREATE TABLE  `soapbox_sbcolumns` (
`columnID` TINYINT (4)  NOT NULL  AUTO_INCREMENT,
`author` INT (8)  NOT NULL ,
`name` VARCHAR (255)  NOT NULL ,
`description` TEXT  NOT NULL ,
`total` INT (11)  NOT NULL DEFAULT 0,
`weight` INT (11)  NOT NULL DEFAULT 1,
`colimage` VARCHAR (255)  NOT NULL DEFAULT 'blank.png',
`created` DATETIME  NOT NULL ,
PRIMARY KEY (`columnID`)
) 
  ENGINE = MyISAM;
#
# Structure table for `soapbox_sbarticles` (22 fields)
#

CREATE TABLE  `soapbox_sbarticles` (
`articleID` INT (8)  NOT NULL  AUTO_INCREMENT,
`columnID` TINYINT (4)  NOT NULL DEFAULT 0,
`headline` VARCHAR (255)  NOT NULL DEFAULT '0',
`lead` TEXT  NOT NULL ,
`bodytext` TEXT  NOT NULL ,
`teaser` TEXT  NOT NULL ,
`uid` INT (6)  NULL DEFAULT 1,
`submit` INT (1)  NOT NULL DEFAULT 0,
`datesub` DATETIME  NOT NULL ,
`counter` INT (8) unsigned NOT NULL DEFAULT 0,
`weight` INT (11)  NOT NULL DEFAULT 1,
`html` INT (11)  NOT NULL DEFAULT 0,
`smiley` INT (11)  NOT NULL DEFAULT 0,
`xcodes` INT (11)  NOT NULL DEFAULT 0,
`breaks` INT (11)  NOT NULL DEFAULT 1,
`block` INT (11)  NOT NULL DEFAULT 0,
`artimage` VARCHAR (255)  NOT NULL ,
`votes` INT (11)  NOT NULL DEFAULT 0,
`rating` DOUBLE (6,4)  NOT NULL DEFAULT '0.0000',
`commentable` INT (11)  NOT NULL DEFAULT 0,
`offline` INT (11)  NOT NULL DEFAULT 0,
`notifypub` INT (11)  NOT NULL DEFAULT 0,
PRIMARY KEY (`articleID`)
) 
  ENGINE = MyISAM;
#
# Structure table for `soapbox_sbvotedata` (6 fields)
#

CREATE TABLE  `soapbox_sbvotedata` (
`ratingid` INT (11) unsigned NOT NULL  AUTO_INCREMENT,
`lid` INT (11) unsigned NOT NULL DEFAULT 0,
`ratinguser` INT (11)  NOT NULL DEFAULT 0,
`rating` TINYINT (3) unsigned NOT NULL DEFAULT 0,
`ratinghostname` VARCHAR (60)  NOT NULL ,
`ratingtimestamp` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`ratingid`)
) 
  ENGINE = MyISAM;