<?php

namespace Novius\Faq;

class Model_Faq extends \Nos\Orm\Model
{

    protected static $_primary_key = array('faq_id');
    protected static $_table_name = 'novius_faqs';

    protected static $_properties = array(
        'faq_id',
        'faq_cate_id',
        'faq_title',
        'faq_virtual_name' => array(
            'default' => null,
            'data_type' => 'varchar',
            'null' => false,
            'character_maximum_length' => 100,
        ),
        'faq_publication_status',
        'faq_publication_start',
        'faq_publication_end',
        'faq_context',
        'faq_context_common_id',
        'faq_context_is_main',
        'faq_created_at',
        'faq_updated_at',
    );

    protected static $_title_property = 'faq_title';

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'mysql_timestamp' => true,
            'property'=>'faq_created_at'
        ),
        'Orm\Observer_UpdatedAt' => array(
            'mysql_timestamp' => true,
            'property'=>'faq_updated_at'
        )
    );

    protected static $_behaviours = array(
        'Nos\Orm_Behaviour_Publishable' => array(
            'publication_state_property' => 'faq_publication_status',
            'publication_start_property' => 'faq_publication_start',
            'publication_end_property' => 'faq_publication_end',
        ),
        'Nos\Orm_Behaviour_Urlenhancer' => array(
            'enhancers' => array('faq_url'),
        ),
        'Nos\Orm_Behaviour_Virtualname' => array(
            'virtual_name_property' => 'faq_virtual_name',
        ),
        'Nos\Orm_Behaviour_Twinnable' => array(
            'context_property'      => 'faq_context',
            'common_id_property' => 'faq_context_common_id',
            'is_main_property' => 'faq_context_is_main',
            'common_fields'   => array(),
        ),
    );

    protected static $_belongs_to  = array(
        'category' => array(
            'key_from' => 'faq_cate_id',
            'model_to' => 'Novius\Faq\Model_Category',
            'key_to' => 'cate_id',
            'cascade_save' => false,
            'cascade_delete' => false,
        ),
    );
    protected static $_has_one   = array();
    protected static $_has_many  = array(
        'questions' => array(
            'key_from' => 'faq_id',
            'model_to' => 'Novius\Faq\Model_Question',
            'key_to' => 'ques_faq_id',
            'cascade_save' => true,//questions are strongly related to faq
            'cascade_delete' => true,//questions can not exist without a faq
            'conditions' => array(
                'order_by' => array('ques_order')
            )
        ),
    );
    protected static $_many_many = array(
        /*
            'key' => array( // key must be defined, relation will be loaded via $faq->key
                'table_through' => '...', // intermediary table must be defined
                'key_from' => 'faq_...', // Column on this model
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
