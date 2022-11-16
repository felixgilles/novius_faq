<?php
namespace Novius\Faq;

class Controller_Admin_Faq_Crud extends \Nos\Controller_Admin_Crud
{
    public function prepare_i18n()
    {
        parent::prepare_i18n();
        \Nos\I18n::current_dictionary('novius_faq::default');
    }

    protected function fieldset($fieldset)
    {
        $fieldset = parent::fieldset($fieldset);
        $context = empty($this->item->faq_context) ? \Input::param('context', null) : $this->item->faq_context;
        $options = \Arr::assoc_to_keyval(Model_Category::query(array(
            'where' => array(
                array('cate_context', $context),
            )
        ))->get(), 'cate_id', 'cate_title');
        $fieldset->field('faq_cate_id')->set_options($options);
        return $fieldset;
    }

    public function action_add_question($index)
    {
        $item = Model_Question::forge();
        $params = array(
            'index' => $index,
            'config' => $this->app_config,
            'item' => $item
        );
        $return = (string) \View::forge('novius_faq::admin/question', $params, false);
        \Response::forge($return)->send(true);
        exit();
    }

    public function before_save($item, $data) {
        //cascade_save will save questions if everything goes right. The only thing to set is the relation "questions" on the FAQ
        $questions = \Input::post('question', array());
        $ids =  array();
        $item->questions = array();
        foreach ($questions as $index => $q) {

            //if both question and answer are empty; then continue (and delete the former question later)
            if (empty($q['ques_question']) && empty($q['ques_answer'])) {
                continue;
            }
            //in case only one of them is empty, throw a message
            if (empty($q['ques_question'])) {
                $this->send_error(new \Exception(str_replace('{{X}}', $index, __('Question n°{{X}} is missing'))));
            } elseif (empty($q['ques_answer'])) {
                $this->send_error(new \Exception(str_replace('{{X}}', $index, __('Answer n°{{X}} is missing'))));
            }
            $question = null;
            if (!empty($q['ques_id'])) {
                $question = Model_Question::find($q['ques_id']);
                $ids[] = $q['ques_id'];
            }
            //if the question did not formerly exist
            if (empty($question)) {
                $question = Model_Question::forge();
                $question->ques_context = $item->faq_context;
            }

            $question->ques_question = $q['ques_question'];
            $question->ques_answer = $q['ques_answer'];
            $question->ques_order = $q['ques_order'];
            // Save additional fields
            foreach (\Arr::get($this->app_config, 'question_additional_fields') as $key => $field) {
                $question->{$key} = \Arr::get($q, $key, '');
            }

            //add in the relation
            //in case of a new question, $question->ques_id = null
            if (!empty($question->ques_id)) {
                $item->questions[$question->ques_id] = $question;
            } else {
                $item->questions[] = $question;
            }
        }

        if (!$item->is_new()) {
            // delete former questions if it's an updated faq
            $questions_delete = Model_Question::query()->where('ques_faq_id', (int) $item->faq_id);
            if (!empty($ids))
            {
                $questions_delete->where('ques_id', \DB::expr('NOT IN'), $ids);
            }
            foreach ($questions_delete->get() as $d_q) {
                $d_q->delete();
            }
        }
    }

    public function save($item, $data) {
        $return = parent::save($item, $data);
        $return['action']['tab']['reload'] = true;
        $return['action']['tab']['url'] = $this->config['controller_url'].'/insert_update/'.$this->item->{$this->pk};
        return $return;
    }
}
