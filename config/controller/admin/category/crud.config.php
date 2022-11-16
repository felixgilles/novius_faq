<?php
return array(
    'controller_url'  => 'admin/novius_faq/category/crud',
    'model' => 'Novius\Faq\Model_Category',
    'layout' => array(
        'large' => true,
        'title' => 'cate_title',
        'content' => array(
            'category' => array(
                'view' => 'nos::form/expander',
                'params' => array(
                    'title'   => __('Category'),
                    'nomargin' => true,
                    'options' => array(
                        'allowExpand' => false,
                    ),
                    'content' => array(
                        'view' => 'nos::form/fields',
                        'params' => array(
                            'fields' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'fields' => array(
        'cate__id' => array (
            'label' => 'ID: ',
            'form' => array(
                'type' => 'hidden',
            ),
            'dont_save' => true,
        ),
        'cate_title' => array(
            'label' => __('Title'),
            'form' => array(
                'type' => 'text',
            ),
        ),
    )
);
