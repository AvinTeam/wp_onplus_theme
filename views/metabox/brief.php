<?php

$editor_array = [
    'media_buttons' => false,
    'textarea_name' => 'form[brief]',
    'tinymce' => [
        'wpautop' => true,
        'force_p_newlines' => true,
        'br_in_pre' => true,
        'valid_elements' => '*[*]',
        'extended_valid_elements' => 'p[*],br[*],span[*]',
        'remove_linebreaks' => false,

     ],
 ];

wp_editor($arma_brief, 'form_text', $editor_array)?>