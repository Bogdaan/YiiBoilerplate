<?php

class m130318_183500_create_news extends CDbMigration
{
	public function up()
	{
	    $sql = <<<'EOF'
CREATE TABLE `{{new}}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short_content` text DEFAULT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_onmain`  tinyint(1) DEFAULT 0,
  `is_visible` tinyint(1) DEFAULT 1,
  `is_deleted`  tinyint(1) DEFAULT 0,
  `ordering` int(3) DEFAULT NULL,
  `updated_at` TIMESTAMP DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
EOF;
        $this->execute($sql);
	}

	public function down()
	{
		echo "m130318_183500_create_news does not support migration down.\n";
		return false;
	}
}