<?php

$lines = [
    'hello there this is a string',
    'sometimes',
    'they are very long',
    'and sometimes they are very short',
    'but who knows'
];

$w = 15;

function createTelegrams($lines, $w) {
     $output = [];

    $message = implode(" ", $lines);
    $words = explode(" ", $message);
    $current = "";

    foreach($words as $word) {
        $temp = trim($current . " " . $word);

        if (strlen($temp) <= $w) {
            $current = $temp;
        } else {
            $output[] = $current;
            $current = $word;
        }
    }

    return $output;
}

var_dump($lines);
$output = createTelegrams($lines, $w);
var_dump($output);