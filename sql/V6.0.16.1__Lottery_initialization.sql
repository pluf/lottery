
CREATE TABLE `lottery_bets` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `game` varchar(128) NOT NULL DEFAULT '',
  `state` varchar(64) DEFAULT '',
  `bet` decimal(32,8) NOT NULL DEFAULT 0.0,
  `reward` decimal(32,8) DEFAULT 0.0,
  `is_win` tinyint(1) NOT NULL DEFAULT 0,
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `account_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `account_id_foreignkey_idx` (`account_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `lottery_bets` 
   ADD CONSTRAINT `fk__account_of_lottery_bet` 
   FOREIGN KEY (`account_id`) 
   REFERENCES `user_accounts` (`id`);
   
CREATE TABLE `lottery_bet_metas` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(256) NOT NULL DEFAULT '',
  `value` varchar(256) DEFAULT '',
  `bet_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bet_meta_idx` (`tenant`,`key`,`bet_id`),
  KEY `bet_id_foreignkey_idx` (`bet_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `lottery_bet_metas` 
   ADD CONSTRAINT `fk__lottery_bet_of_meta` 
   FOREIGN KEY (`bet_id`) 
   REFERENCES `lottery_bets` (`id`);   


CREATE TABLE `lottery_bet_secure_metas` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(256) NOT NULL DEFAULT '',
  `value` varchar(256) DEFAULT '',
  `bet_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bet_meta_idx` (`tenant`,`key`,`bet_id`),
  KEY `bet_id_foreignkey_idx` (`bet_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `lottery_bet_secure_metas` 
   ADD CONSTRAINT `fk__lottery_bet_of_secure_meta` 
   FOREIGN KEY (`bet_id`) 
   REFERENCES `lottery_bets` (`id`);

CREATE TABLE `lottery_profiles` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `bets` int(11) DEFAULT 0,
  `wins` int(11) DEFAULT 0,
  `account_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `account_id_foreignkey_idx` (`account_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `lottery_profiles` 
   ADD CONSTRAINT `fk__account_of_lottery_profile` 
   FOREIGN KEY (`account_id`) 
   REFERENCES `user_accounts` (`id`);
   
CREATE TABLE `lottery_referrals` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(256) NOT NULL DEFAULT '',
  `account_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `referral_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_unique_idx` (`tenant`,`code`),
  KEY `account_foreignkey_idx` (`tenant`,`account_id`),
  KEY `referral_foreignkey_idx` (`tenant`,`referral_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `lottery_referrals` 
   ADD CONSTRAINT `fk__account_of_lottery_referral` 
   FOREIGN KEY (`account_id`) 
   REFERENCES `user_accounts` (`id`);
   
ALTER TABLE `lottery_referrals` 
   ADD CONSTRAINT `fk__referral_id_of_lottery_referral` 
   FOREIGN KEY (`referral_id`) 
   REFERENCES `lottery_referrals` (`id`);
   