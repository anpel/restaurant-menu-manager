<?php


$table_head_setup = [
    'data-toggle' => 'table',
    'data-url' => '/index.php?action=ajax_categories_all',
    'data-click-to-select' => 'true',
    'data-checkbox-header' => 'false'
];
$table_row_setup = [
    [
        'data-field' => 'id',
        'data-visible' => 'false',
        'title' => 'id'
    ],
    [
        'data-field' => 'name_en',
        'data-editable' => true,
        'title' => 'Name'
    ],
    [
        'data-field' => 'name_gr',
        'data-editable' => true,
        'title' => 'Greek Name'
    ],
    [
        'data-field' => 'name_it',
        'data-editable' => true,
        'title' => 'Italian Name'
    ],
    [
        'data-field' => 'position',
        'data-editable' => true,
        'title' => 'Position'
    ]
];

?>
