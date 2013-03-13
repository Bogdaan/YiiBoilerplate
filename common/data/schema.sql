--
-- frontend database
--

CREATE TABLE IF NOT EXISTS `tbl_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text,

  `language` varchar(2) DEFAULT 'ru',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

 
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,  
  `login_ip` varchar(255) DEFAULT NULL,
  `login_attempts` int DEFAULT 0,
  `login_time` TIMESTAMP DEFAULT 0,
  `validation_key` varchar(255) DEFAULT NULL,
  `password_strategy` varchar(255) DEFAULT NULL,
  `requires_new_password` int(1) DEFAULT NULL,

  `language` varchar(2) DEFAULT 'ru',
  `create_id` int(11) DEFAULT NULL,
  `create_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
  `update_id` int(11) DEFAULT NULL,
  `update_time` TIMESTAMP DEFAULT 0,
  `delete_id` int(11) DEFAULT NULL,
  `delete_time` TIMESTAMP DEFAULT 0,
  `status` int(11) DEFAULT NULL,  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `tbl_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text,

  `language` varchar(2) DEFAULT 'ru',
  `is_visible` int(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `tbl_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_name` varchar(255) NOT NULL,
  `question_content` text NOT NULL,  
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `answer_name` varchar(255) DEFAULT NULL,
  `answer_content` text,  

  `language` varchar(2) DEFAULT 'ru',
  `is_visible` int(1) DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `tbl_article_category`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,

  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,    
  `content` text NOT NULL,

  `language` varchar(2) DEFAULT 'ru',
  `ordering` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `tbl_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,

  `short_content` text DEFAULT NULL,
  `content` text NOT NULL,
  `image` varchar(75) DEFAULT NULL,

  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `external_url` varchar(50) DEFAULT NULL,  
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,

  `language` varchar(2) DEFAULT 'ru',
  `is_visible` tinyint(1) NOT NULL,
  `is_onmain`  tinyint(1) DEFAULT 0,
  `is_specialoffer`  tinyint(1) DEFAULT 0,
  `is_service`  tinyint(1) DEFAULT 0,
  `ordering` int(3) DEFAULT NULL,
  `updated_at` TIMESTAMP DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `tbl_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,

  `language` varchar(2) DEFAULT 'ru',
  `is_visible` tinyint(1) NOT NULL,
  `ordering` int(3) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `tbl_snippet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,

  `content` text DEFAULT NULL,
  `language` varchar(2) DEFAULT 'ru',
  `is_visible` tinyint(1) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
