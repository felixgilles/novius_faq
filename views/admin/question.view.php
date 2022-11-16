<?php
\Nos\I18n::current_dictionary('novius_faq::default');
?>
<div class="qa_item" data-qa-index="<?= $index ?>">
    <input type="hidden" name="question[<?= $index ?>][ques_id]" value="<?= !empty($item->ques_id) ? $item->ques_id : 0 ?>" />
    <input type="hidden" name="question[<?= $index ?>][ques_order]" value="<?= !empty($item->ques_order) ? $item->ques_order : $index ?>" />
    <span
        class="faq_icon faq_delete_question"
        data-question="<?= __('Are you sure you want to delete this Q&A?') ?>"
        data-removed="<?= !empty($item->ques_id) ? __('This Q&A will be deleted when the FAQ is saved') : '' ?>"
        >
    </span>
    <span class="faq_icon faq_icon_arrow qa-up-js"></span>
    <span class="faq_icon faq_icon_arrow qa-down-js"></span>
    <table>
        <tr>
            <th>
                <?= __('Q') ?>
            </th>
            <td>
                <input type="text" placeholder="<?= __('You can leave both question and answer empty to delete a Q&A') ?>" name="question[<?= $index ?>][ques_question]" value="<?= !empty($item->ques_question) ? e($item->ques_question) : '' ?>" />
            </td>
        </tr>
        <tr>
            <th>
                <?= __('A') ?>
            </th>
            <td>
                <?php
                echo Nos\Renderer_Wysiwyg::renderer(array(
                    'name' => 'question['.$index.'][ques_answer]',
                    'class' => 'tinymce',
                    'value' => !empty($item->ques_answer) ? $item->ques_answer : '',
                    'renderer_options' => array(
                        'theme' => 'nos',
                        'theme_advanced_buttons1' => 'bold,italic,underline,strikethrough,|,bullist,numlist,|,noslink,|,removeformat',
                        'theme_advanced_buttons2' => '',
                        'theme_advanced_buttons3' => '',
                        'theme_advanced_buttons4' => '',
                        'theme_advanced_buttons5' => '',
                        'theme_advanced_resizing' => true,
                        'theme_advanced_resize_horizontal' => false,
                    ),
                ));
                ?>
            </td>
        </tr>
        <?php foreach (Arr::get($config, 'question_additional_fields', array()) as $name => $field): ?>
            <?php
            $fieldName = 'question['.$index.']['.$name.']';
            ?>
            <?php if (Arr::get($field, 'renderer')): ?>
                <tr>
                    <th><?= Arr::get($field, 'label') ?></th>
                    <td>
                        <?php
                        $renderer = Arr::get($field, 'renderer');
                        echo $renderer::renderer(array(
                            'name' => $fieldName,
                            'value' => !empty($item->{$name}) ? $item->{$name} : '',
                            'renderer_options' => Arr::get($field, 'renderer_options', array()),
                        ));
                        ?>
                    </td>
                </tr>
            <?php else: ?>
                <?php
                $fieldset = new \Fuel\Core\Fieldset();
                $fieldsetField = new Fieldset_Field($fieldName, Arr::get($field, 'label'), Arr::get($field, 'form'));
                if (!empty($item->{$name})) {
                    $fieldsetField->set_value($item->{$name});
                }
                $fieldset->add($fieldsetField);
                echo $fieldsetField->build();
                ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
</div>