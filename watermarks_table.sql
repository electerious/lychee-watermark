# Dump of table lychee_watermarks
# Version 1.0
# ------------------------------------------------------------

CREATE TABLE `lychee_watermarks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(1000) DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'text',
  `text` varchar(200) NOT NULL DEFAULT '',
  `font_path` varchar(1000) DEFAULT 'Arial.ttf',
  `font_size` int(11) NOT NULL DEFAULT '32',
  `font_color_red` int(3) NOT NULL DEFAULT '0',
  `font_color_green` int(3) NOT NULL DEFAULT '0',
  `font_color_blue` int(3) NOT NULL DEFAULT '0',
  `position_x` int(11) NOT NULL DEFAULT '100',
  `position_y` int(11) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;