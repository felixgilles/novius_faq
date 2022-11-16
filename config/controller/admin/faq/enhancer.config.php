<?php
$options = \Arr::assoc_to_keyval(\Novius\Faq\Model_Faq::find('all'), 'faq_id', 'faq_title');
$config = array(
    'fields' => array(
        'faq_id' => array(
            'label' => __('Choose a FAQ to display'),
            'form' => array(
                'type' => 'select',
                'options' => $options
            ),
        ),
    ),
);
return $config;