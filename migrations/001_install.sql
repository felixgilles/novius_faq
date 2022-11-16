CREATE TABLE IF NOT EXISTS `faqs` (
    `faq_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `faq_title` varchar(255) NOT NULL,
    `faq_virtual_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
    `faq_context` varchar(25) NOT NULL,
    `faq_context_common_id` int(11) NOT NULL,
    `faq_context_is_main` tinyint(1) NOT NULL DEFAULT '0',
    `faq_publication_status` tinyint(1) NOT NULL,
    `faq_publication_start` datetime DEFAULT NULL,
    `faq_publication_end` datetime DEFAULT NULL,
    `faq_created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `faq_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`faq_id`),
    KEY `faq_created_at` (`faq_created_at`),
    KEY `faq_updated_at` (`faq_updated_at`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `questions` (
    `ques_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `ques_question` varchar(255) NOT NULL,
    `ques_answer` text,
    `ques_context` varchar(25) NOT NULL,
    `ques_context_common_id` int(11) NOT NULL,
    `ques_context_is_main` tinyint(1) NOT NULL DEFAULT '0',
    `ques_created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `ques_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`ques_id`),
    KEY `ques_created_at` (`ques_created_at`),
    KEY `ques_updated_at` (`ques_updated_at`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `categories` (
    `cate_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `cate_title` varchar(255) NOT NULL,
    `cate_context` varchar(25) NOT NULL,
    `cate_context_common_id` int(11) NOT NULL,
    `cate_context_is_main` tinyint(1) NOT NULL DEFAULT '0',
    `cate_created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `cate_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`cate_id`),
    KEY `cate_created_at` (`cate_created_at`),
    KEY `cate_updated_at` (`cate_updated_at`)
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
