require(['jquery-nos-wysiwyg'], function ($) {

    //Add one Q&A
    $(document).on('click', 'button.add-question-js', function(e) {
        var $container = $(this).closest('form');
        var next = parseInt($container.find('.count-questions-js').data('nb-questions')) + 1;

        $.ajax({
            type : "GET",
            url: 'admin/novius_faq/faq/crud/add_question/' + next,
            data : {
            },
            success : function(vue) {
                var $vue = $(vue);
                $vue.nosFormUI();
                $container.find('.qa_list').append($vue);
                $container.find('.count-questions-js').data('nb-questions', next);
            }
        });
        e.preventDefault();
    });

    //Delete a Q&A
    $(document).on('click', '.faq_delete_question', function() {
        var question = $(this).data('question');
        var removed = $(this).data('removed');
        if (confirm(question))
        {
            if(removed.length > 0) {
                $(this).closest('.qa_item').html('<table><tr><th></th><td class="qa_message">' + removed + '</td></tr></table>');
            } else {
                $(this).closest('.qa_item').remove();
            }

        }
    });

    //Move a Q&A
    $(document).on('click', '.faq_icon_arrow', function() {
        var down = $(this).hasClass('qa-down-js');
        var $qa = $(this).closest('.qa_item');
        var $textarea = $qa.find('textarea.tinymce');
        var id_ans = $textarea.attr('id');
        var former_value = parseInt($qa.find('input[name$="[ques_order]"]').val());
        var $swapper = down ? $qa.next() : $qa.prev();
        $swapper.find('input[name$="[ques_order]"]').val(former_value);
        tinyMCE.get(id_ans).save();
        tinyMCE.get(id_ans).remove();
        if (down) {
            $qa.find('input[name$="[ques_order]"]').val(former_value + 1);
            $swapper.after($qa);
        } else {
            $qa.find('input[name$="[ques_order]"]').val(former_value - 1);
            $swapper.before($qa);
        }
        $textarea.wysiwyg($textarea.data('wysiwyg-options'));
    });
});