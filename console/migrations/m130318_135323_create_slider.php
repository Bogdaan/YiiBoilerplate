<?php

class m130318_135323_create_slider extends CDbMigration
{
	public function up()
	{
	    $sql = <<<'DOC'
CREATE TABLE `{{slider}}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stype` int(11) DEFAULT 0,
  `position` varchar(255) DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT 1,
  `is_deleted` tinyint(1) DEFAULT 0,
  `updated_at` TIMESTAMP DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
DOC;
        $this->execute($sql);

        $sql = <<<'DOC'
CREATE TABLE  `{{slider_image}}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT 1,
  `is_deleted` tinyint(1) DEFAULT 0,
  `ordering` int(3) DEFAULT NULL,
  `updated_at` TIMESTAMP DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
DOC;
        $this->execute($sql);
        
        echo "SUCCESS: m130318_135323_create_slider migration up.\n";

	}

	public function down()
	{
		echo "m130318_135323_create_slider does not support migration down.\n";
		return false;
        $this->dropTable('{{slider}}');
        $this->dropTable('{{slider_image}}');
	}

}