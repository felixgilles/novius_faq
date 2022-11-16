<?php
return array(
    'controller' => 'faq/crud',
    'data_mapping' => array(
        'faq_title' => array(
            'title' => __('Title'),
        ),
        'questions' => array(
            'title' => __('Number of Q&As'),
            'value' => function($item) {
                return count($item->questions);
            },
        ),
        'category' => array(
            'title' => __('Category'),
            'value' => function($item) {
                return !empty($item->faq_cate_id) ? $item->category->cate_title : '';
            },
        ),
        'context' => true,
        'publication_status' => true,
    ),
);