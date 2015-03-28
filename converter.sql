

CREATE TABLE IF NOT EXISTS `exchange_rate` (
  `currency_code` varchar(3) NOT NULL,
  `exchange_rate` decimal(10,4) NOT NULL,
  `update_date` datetime,
  PRIMARY KEY (`currency_code`)
);

