<?php
return array(
    'controller_url'  => 'admin/novius_faq/faq/crud',
    'model' => 'Novius\Faq\Model_Faq',
    'require_js' => array('static/apps/novius_faq/js/admin.js'),
    'layout' => array(
        'large' => true,
        'title' => 'faq_title',
        'content' => array(
            'faq' => array(
                'view' => 'nos::form/expander',
                'params' => array(
                    'title'   => __('Introduction'),
                    'nomargin' => true,
                    'options' => array(
                        'allowExpand' => true,
                    ),
                    'content' => array(
                        'view' => 'nos::form/fields',
                        'params' => array(
                            'fields' => array(
                                'wysiwygs->introduction->wysiwyg_text'
                            ),
                        ),
                    ),
                ),
            ),
            'questions' => array(
                'view' => 'nos::form/expander',
                'params' => array(
                    'title'   => __('Questions & Answers'),
                    'nomargin' => true,
                    'options' => array(
                        'allowExpand' => true,
                    ),
                    'content' => array(
                        'view' => 'novius_faq::admin/questions',
                        'params' => array(
                        ),
                    ),
                ),
            ),
        ),
        'menu' => array(
            __('Administration') => array(
                'faq_cate_id',
                'faq_virtual_name'
            ),
        ),
    ),
    'fields' => array(
        'faq_id' => array (
            'label' => 'ID: ',
            'form' => array(
                'type' => 'hidden',
            ),
            'dont_save' => true,
        ),
        'faq_cate_id' => array (
            'label' => __('Category'),
            'form' => array(
                'type' => 'select',
            ),
        ),
        'faq_title' => array(
            'label' => __('Title'),
            'form' => array(
                'type' => 'text',
            ),
        ),
        'wysiwygs->introduction->wysiwyg_text' => array(
            'label' => __('Introduction'),
            'renderer' => 'Nos\Renderer_Wysiwyg',
            /*'renderer_options' => array(
                'theme_nos_buttons1' => 'styleselect,|,bold,italic,underline,strikethrough,|,justifycontrols,|,link',
                'theme_nos_buttons2' => '',
                'theme_nos_buttons3' => '',
                'theme_nos_buttons4' => '',
                'theme_nos_buttons5' => '',
            ),*/
            'template' => '{field}',
            'form' => array(
                'style' => 'width: 100%; height: 100px;',
            ),
        ),
        'faq_virtual_name' => array(
            'label' => __('URL: '),
            'renderer' => 'Nos\Renderer_Virtualname',
            'validation' => array(
                'required',
                'min_length' => array(2),
            ),
        ),
    )
);
