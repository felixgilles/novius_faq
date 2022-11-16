<?php
\Nos\I18n::current_dictionary('novius_faq::default');
echo "<div class=\"novius_faq noviusos_enhancer\">\n";
if (count($faq_list) > 0) {
    echo "<ul>\n";
    foreach ($faq_list as $faq) {
        echo '<li>' . $faq->htmlAnchor() . "</li>\n";
    }
    echo "</ul>\n";
}
echo "</div>\n";
