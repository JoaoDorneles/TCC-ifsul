<?php
function carrega_template($template_file){
    $html = file_get_contents ( $template_file);
    return $html;
}
?>