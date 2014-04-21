# Dump of table lychee_watermarks
# Version 1.0
# ------------------------------------------------------------

CREATE TABLE `lychee_watermarks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(200) NOT NULL DEFAULT '',
  `font_path` varchar(1000) NOT NULL DEFAULT 'Arial.ttf',
  `font_size` int(11) NOT NULL DEFAULT '32',
  `font_color_red` int(3) NOT NULL DEFAULT '0',
  `font_color_green` int(3) NOT NULL DEFAULT '0',
  `font_color_blue` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;