<?php

function string2price(string $input)
{
    $output = floatval(str_replace(',', '.', str_replace('.', '', $input)));
    return round($output, 2);
}
