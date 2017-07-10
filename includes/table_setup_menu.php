<?php


$table_head_setup = [
    'data-toggle' => 'table',
    'data-url' => '/index.php?action=get_print&language='.$language,
];
$table_row_setup = [
    [
        'data-field' => 'id',
        'data-visible' => 'false',
        'title' => 'id'
    ],
    [
        'data-field' => 'category_name',
        'data-class' => 'category',
        'title' => 'Category'
    ],
    [
        'data-field' => 'name',
        'title' => 'Name'
    ],
    [
        'data-field' => 'price',
        'data-class' => 'price',
        'title' => 'Price'
    ]
];

?>
