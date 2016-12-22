<?php
$mysql_db = "mvc_mobile";
$mysql_user = "***";
$mysql_pass = "***";
$mysql_link = mysql_connect("localhost", $mysql_user, $mysql_pass);
mysql_select_db($mysql_db, $mysql_link);

/*
CREATE TABLE IF NOT EXISTS `opportunities` (
`opp_id` int(11) NOT NULL AUTO_INCREMENT,
`opp_person` varchar(100) NOT NULL,
`opp_contact` varchar(50) NOT NULL,
`opp_description` varchar(500) NOT NULL,
UNIQUE KEY `opp_id` (`opp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;
*/
