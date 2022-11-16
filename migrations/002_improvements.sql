ALTER TABLE `faqs` ADD `faq_cate_id` INT NULL AFTER `faq_title` ,
ADD INDEX ( `faq_cate_id` );

RENAME TABLE `faqs` TO `novius_faqs` ;
RENAME TABLE `questions` TO `novius_faq_questions` ;
RENAME TABLE `categories` TO `novius_faq_categories` ;

ALTER TABLE `novius_faq_questions` ADD `ques_faq_id` INT NULL AFTER `ques_id` ,
ADD INDEX ( `ques_faq_id` );

ALTER TABLE `novius_faq_questions`
  DROP `ques_context_common_id`,
  DROP `ques_context_is_main`;