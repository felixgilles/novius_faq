<?php
\Nos\I18n::current_dictionary('novius_faq::default');
?>
<div class="novius_faq noviusos_enhancer">
    <h2><?=$faq->faq_title ?></h2>
<?php
$text = strip_tags($faq->wysiwygs->introduction);
if (!empty($text)); {
    echo '<div class="faq_introduction">';
    echo \Nos\Nos::parse_wysiwyg($faq->wysiwygs->introduction);
    echo '</div>';
}
?>
    <div class="qa_list">
<?php
foreach ($faq->questions as $qa) {
    ?>
        <div class="qa_item">
            <div class="qa_question">
                <?= $qa->ques_question ?>
            </div>
            <div class="qa_answer">
                <?= $qa->ques_answer ?>
            </div>
        </div>
    <?php
}
?>
    </div>
</div>