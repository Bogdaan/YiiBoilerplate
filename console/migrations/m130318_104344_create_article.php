<?php

class m130318_104344_create_article extends CDbMigration
{
	public function up()
	{

    $sql = <<<'DOC'
CREATE TABLE `{{article}}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `short_content` text DEFAULT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_onmain`  tinyint(1) DEFAULT 0,
  `is_visible` tinyint(1) NOT NULL,
  `is_deleted`  tinyint(1) DEFAULT 0,
  `ordering` int(3) DEFAULT NULL,
  `updated_at` TIMESTAMP DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
DOC;
        $this->execute($sql);


    $sql = <<<'DOC'
CREATE TABLE `{{article_category}}`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,   
  `content` text NOT NULL,
  `ordering` int(3) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
DOC;
        $this->execute($sql);

        echo "SUCCESS: m130318_104344_create_article migration up.\n";
	}

	public function down()
	{
	    echo "FAIL: m130318_104344_create_article does not support migration down.\n";
	    return false;
		$this->dropTable('{{article}}');
        $this->dropTable('{{article_category}}');
	}
}