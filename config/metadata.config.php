<?php
return array(
    'name'    => 'FAQ',
    'version' => '1',
    'provider' => array(
        'name' => 'Novius',
    ),
    'namespace' => "Novius\Faq",
    'permission' => array(
    ),
    'icons' => array( //@todo: to be defined
        64 => 'static/apps/novius_faq/img/64/icon.png',
        32 => 'static/apps/novius_faq/img/32/icon.png',
        16 => 'static/apps/novius_faq/img/16/icon.png',
    ),
    'launchers' => array(
        'FAQ::Faq' => array(
            'name'    => 'FAQ', // displayed name of the launcher
            'action' => array(
                'action' => 'nosTabs',
                'tab' => array(
                    'url' => 'admin/novius_faq/faq/appdesk', // url to load
                ),
            ),
        ),
    ),
    // Enhancer configuration
    'enhancers' => array(
        'faq_url' => array( // key must be defined
            'title' => 'FAQ',
            'desc'  => 'Manage all FAQs and display a list by default',
            'urlEnhancer' => 'novius_faq/front/faq/main',
        ),
        'faq_one' => array( // key must be defined
            'title' => 'One FAQ',
            'desc'  => 'Display one selected FAQ',
            'enhancer' => 'novius_faq/front/faq/faq',
            'dialog' => array(
                'contentUrl' => 'admin/novius_faq/faq/enhancer/popup',
                'ajax' => true,
                'width' => 200,
                'height' => 200,
            ),
        ),
    ),
);
