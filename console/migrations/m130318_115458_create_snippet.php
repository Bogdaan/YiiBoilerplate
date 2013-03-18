<?php

class m130318_115458_create_snippet extends CDbMigration
{
	public function up()
	{
	    $sql = <<<'DOC'
CREATE TABLE `{{snippet}}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT 1,
  `is_deleted` tinyint(1) DEFAULT 0,
  `updated_at` TIMESTAMP DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
DOC;
        $this->execute($sql);
        
        echo "SUCCESS: m130318_115458_create_snippet migration up.\n";
	}

	public function down()
	{
		echo "FAIL: m130318_115458_create_snippet does not support migration down.\n";
		return false;
        $this->dropTable('{{snippet}}');
	}
}