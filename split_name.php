<?php

$parts = explode(' ', 'Billy Bobby Test sdfsdf Johnson'); // $meta->post_title
$name_first = array_shift($parts);

$name_middle = trim(implode(' ', $parts));
$name_last = array_pop($parts);

echo 'First: ' . $name_first . ', ';
echo 'Last: ' . $name_last . ', ';
echo 'Middle: ' . $name_middle . '.';
?>
