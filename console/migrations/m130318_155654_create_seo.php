<?php

class m130318_155654_create_seo extends CDbMigration
{
	public function up()
	{
	    $sql = <<<'DOC'
CREATE TABLE `{{seo}}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `param_name` varchar(255) DEFAULT NULL,
  `param_value` varchar(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
DOC;
        $this->execute($sql);
        
        $sql = <<<'DOC'
CREATE TABLE `{{seo_url}}` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modelId` int(11) NOT NULL,
  `modelName` varchar(255) NOT NULL,
  `metaUrl` varchar(255) DEFAULT NULL,
  `metaTitle` varchar(255) DEFAULT NULL,
  `metaDescription` varchar(255) DEFAULT NULL,
  `metaKeywords` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `updated_at` TIMESTAMP DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`),
  KEY modelId_key (`modelId`),
  KEY metaUrl_key (`metaUrl`(5))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
DOC;
        $this->execute($sql);

        echo "SUCCESS: m130318_155654_create_seo migration up.\n";
	}

	public function down()
	{
		echo "m130318_155654_create_seo does not support migration down.\n";
		return false;
	}
}