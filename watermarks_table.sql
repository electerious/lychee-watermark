# Dump of table lychee_watermarks
# Version 1.0
# ------------------------------------------------------------

CREATE TABLE `lychee_watermarks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `active` TINYINT(1) NOT NULL DEFAULT '0',
  `description` varchar(1000) DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'text',
  `text` varchar(200) NOT NULL DEFAULT '',
  `font_path` varchar(1000) DEFAULT 'SourceSansPro.ttf',
  `font_size` int(11) NOT NULL DEFAULT '32',
  `font_color` varchar(7) DEFAULT '#ffffff',
  `font_bgcolor` varchar(7) DEFAULT '#444444',
  `image_path` varchar(1000) DEFAULT 'Image.png',
  `position_align` varchar(15) DEFAULT 'center',
  `position_x` int(11) NOT NULL DEFAULT '0',
  `position_y` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;