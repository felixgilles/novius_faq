<?php

namespace Novius\Faq;

class Model_Category extends \Nos\Orm\Model
{

    protected static $_primary_key = array('cate_id');
    protected static $_table_name = 'novius_faq_categories';

    protected static $_properties = array(
        'cate_id',
        'cate_title',
        'cate_context',
        'cate_context_common_id',
        'cate_context_is_main',
        'cate_created_at',
        'cate_updated_at',
    );

    protected static $_title_property = 'cate_title';

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'mysql_timestamp' => true,
            'property'=>'cate_created_at'
        ),
        'Orm\Observer_UpdatedAt' => array(
            'mysql_timestamp' => true,
            'property'=>'cate_updated_at'
        )
    );

    protected static $_behaviours = array(
        /*
        'Nos\Orm_Behaviour_Publishable' => array(
            'publication_state_property' => 'cate_publication_status',
            'publication_start_property' => 'cate_publication_start',
            'publication_end_property' => 'cate_publication_end',
        ),
        */
        /*
        'Nos\Orm_Behaviour_Urlenhancer' => array(
            'enhancers' => array('faq_category'),
        ),
        */
        /*
        'Nos\Orm_Behaviour_Virtualname' => array(
            'virtual_name_property' => 'cate_virtual_name',
        ),
        */
        'Nos\Orm_Behaviour_Twinnable' => array(
            'context_property'      => 'cate_context',
            'common_id_property' => 'cate_context_common_id',
            'is_main_property' => 'cate_context_is_main',
            'common_fields'   => array(),
        ),
        /*
        'Nos\Orm_Behaviour_Author' => array(
            'created_by_property' => 'cate_created_by_id',
            'updated_by_property' => 'cate_updated_by_id',
        ),
        */
    );

    protected static $_belongs_to  = array(
        /*
        'key' => array( // key must be defined, relation will be loaded via $category->key
            'key_from' => 'cate_...', // Column on this model
            'model_to' => 'Novius\Faq\Model_...', // Model to be defined
            'key_to' => '...', // column on the other model
            'cascade_save' => false,
            'cascade_delete' => false,
            //'conditions' => array('where' => ...)
        ),
        */
    );
    protected static $_has_one   = array();
    protected static $_has_many  = array(
        'faqs' => array( // key must be defined, relation will be loaded via $category->key
            'key_from' => 'cate_id', // Column on this model
            'model_to' => 'Novius\Faq\Model_Faq', // Model to be defined
            'key_to' => 'faq_cate_id', // column on the other model
            'cascade_save' => false,
            'cascade_delete' => false,
            //'conditions' => array('where' => ...)
        ),
    );
    protected static $_many_many = array(
        /*
            'key' => array( // key must be defined, relation will be loaded via $category->key
                'table_through' => '...', // intermediary table must be defined
                'key_from' => 'cate_...', // Column on this model
                'key_through_from' => '...', // Column "from" on the intermediary table
                'key_through_to' => '...', // Column "to" on the intermediary table
                'key_to' => '...', // Column on the other model
                'cascade_save' => false,
                'cascade_delete' => false,
                'model_to'       => 'Novius\Faq\Model_...', // Model to be defined
            ),
        */
    );

    protected static $_twinnable_belongs_to = array();
    protected static $_twinnable_has_one    = array();
    protected static $_twinnable_has_many   = array();
    protected static $_twinnable_many_many  = array();
    protected static $_attachment           = array();
}
