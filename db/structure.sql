DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `crc` varchar(64) NOT NULL COMMENT 'sha1(link)',
  `added_at` datetime NOT NULL,
  `title` varchar(512) NOT NULL,
  `alias` varchar(512) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(64) NOT NULL,
  `source` varchar(256) NOT NULL,
  `orig_title` varchar(512) NOT NULL,
  `orig_content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `crc` (`crc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;