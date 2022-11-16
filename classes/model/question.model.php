<?php

namespace Novius\Faq;

class Model_Question extends \Nos\Orm\Model
{

    protected static $_primary_key = array('ques_id');
    protected static $_table_name = 'novius_faq_questions';

    protected static $_properties = array(
        'ques_id',
        'ques_faq_id',
        'ques_question',
        'ques_answer',
        'ques_order',
        'ques_context',
        'ques_created_at',
        'ques_updated_at',
    );


    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'mysql_timestamp' => true,
            'property'=>'ques_created_at'
        ),
        'Orm\Observer_UpdatedAt' => array(
            'mysql_timestamp' => true,
            'property'=>'ques_updated_at'
        )
    );

    protected static $_behaviours = array(
        /*
        'Nos\Orm_Behaviour_Publishable' => array(
            'publication_state_property' => 'ques_publication_status',
            'publication_start_property' => 'ques_publication_start',
            'publication_end_property' => 'ques_publication_end',
        ),
        */
        /*
        'Nos\Orm_Behaviour_Urlenhancer' => array(
            'enhancers' => array('faq_question'),
        ),
        */
        /*
        'Nos\Orm_Behaviour_Virtualname' => array(
            'virtual_name_property' => 'ques_virtual_name',
        ),
        */

        'Nos\Orm_Behaviour_Contextable' => array(
            'context_property'      => 'ques_context',
            'events' => array('before_insert')
        ),

        /*
        'Nos\Orm_Behaviour_Author' => array(
            'created_by_property' => 'ques_created_by_id',
            'updated_by_property' => 'ques_updated_by_id',
        ),
        */
    );

    protected static $_belongs_to  = array(
        'faq' => array( // key must be defined, relation will be loaded via $question->key
            'key_from' => 'ques_faq_id', // Column on this model
            'model_to' => 'Novius\Faq\Model_Faq', // Model to be defined
            'key_to' => 'faq_id', // column on the other model
            'cascade_save' => false,
            'cascade_delete' => false,
            //'conditions' => array('where' => ...)
        ),
    );
    protected static $_has_one   = array();
    protected static $_has_many  = array(
        /*
        'key' => array( // key must be defined, relation will be loaded via $question->key
            'key_from' => 'ques_...', // Column on this model
            'model_to' => 'Novius\Faq\Model_...', // Model to be defined
            'key_to' => '...', // column on the other model
            'cascade_save' => false,
            'cascade_delete' => false,
            //'conditions' => array('where' => ...)
        ),
        */
    );
    protected static $_many_many = array(
        /*
            'key' => array( // key must be defined, relation will be loaded via $question->key
                'table_through' => '...', // intermediary table must be defined
                'key_from' => 'ques_...', // Column on this model
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
