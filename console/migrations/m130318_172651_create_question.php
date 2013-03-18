<?php

class m130318_172651_create_question extends CDbMigration
{
	public function up()
	{
	    $sql = <<<'DOC'
CREATE TABLE `{{question}}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_name` varchar(255) NOT NULL,
  `question_content` text NOT NULL,  
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `answer_name` varchar(255) DEFAULT NULL,
  `answer_content` text,  
  `is_visible` int(1) DEFAULT 0,
  `is_deleted`  tinyint(1) DEFAULT 0,
  `updated_at` TIMESTAMP DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
DOC;

        $this->execute($sql);
        echo "SUCCESS: m130318_172651_create_question migration up.\n";
	}

	public function down()
	{
		echo "m130318_172651_create_question does not support migration down.\n";
		return false;
	}
}