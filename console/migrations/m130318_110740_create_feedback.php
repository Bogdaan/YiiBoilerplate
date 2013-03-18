<?php

class m130318_110740_create_feedback extends CDbMigration
{
	public function up()
	{
	    $sql = <<<'DOC'
CREATE TABLE `{{feedback}}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text,
  `is_visible` tinyint(1) DEFAULT 1,
  `is_deleted`  tinyint(1) DEFAULT 0,
  `updated_at` TIMESTAMP DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
DOC;

        $this->execute($sql);
        echo "SUCCESS: m130318_110740_create_feedback migration up.\n";
	}

	public function down()
	{
		echo "FAIL: m130318_110740_create_feedback does not support migration down.\n";
		return false;
        $this->dropTable('{{feedback}}');
	}
}