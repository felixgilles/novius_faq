<?php

namespace Novius\Faq;

use Nos\Controller_Front_Application;

use View;

class Controller_Front_Faq extends Controller_Front_Application
{
    public $page_from = false;

    public function action_faq($args = array())
    {
        if (!empty($args['faq_id'])) {
            $faq = Model_Faq::query()
            ->where('faq_id', $args['faq_id'])
            ->related('questions')
            ->get_one();
            //FAQ should be published and have Q&As
            if (!empty($faq) && $faq->published() && !empty($faq->questions)) {
                if (!empty($this->app_config['use_css']) && $this->app_config['use_css']) {
                    $this->main_controller->addCss('static/apps/novius_faq/css/front.css');
                }
                return \View::forge('novius_faq::front/faq_item', array(
                    'faq' => $faq,
                ), false);
            }
        }
    }

    public function action_main($args = array())
    {
        $this->page_from = $this->main_controller->getPage();

        $enhancer_url = $this->main_controller->getEnhancerUrl();

        if (!empty($enhancer_url)) {
            $segments = explode('/', $enhancer_url);

            if (!empty($segments[0])) {
                return $this->display_faq($segments[0]);
            }

            throw new \Nos\NotFoundException();
        }

        return $this->display_list_faq();
    }

    protected function display_list_faq()
    {
        $params = array(
            'where' => array(),
            'order_by' => array(
                'faq_id' => 'ASC'
            ),
        );

        $params['where'][] = array('faq_context', '=', $this->page_from->page_context);
        $params['where'][] = array('published', true);

        $faq_list =  Model_Faq::find('all', $params);

        return \View::forge('novius_faq::front/faq_list', array(
            'faq_list' => $faq_list,
        ), false);
    }


    protected function display_faq($virtual_name)
    {
        //FAQ should be published and have Q&As
        $faq = Model_Faq::query(array(
            'where' => array(
                array('published', true),
                array('faq_virtual_name', '=', $virtual_name),
                array('faq_context', '=', $this->page_from->page_context)
            )
        ))->related('questions')->where('questions.ques_id', 'IS NOT', \DB::expr('NULL'))->get_one();

        if (empty($faq)) {
            throw new \Nos\NotFoundException();
        }

        $this->main_controller->setTitle($faq->faq_title);
        //$this->main_controller->setMetaDescription($faq->faq_title);

        return \View::forge('novius_faq::front/faq_item', array(
            'faq' => $faq,
        ), false);
    }

    public static function getUrlEnhanced($params = array())
    {
        $item = \Arr::get($params, 'item', false);
        if ($item) {
            // url built according to $item'class
            switch (get_class($item)) {
                case 'Novius\Faq\Model_Faq' :
                    return $item->virtual_name().'.html';
                    break;
            }
        }

        return false;
    }
}
