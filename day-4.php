<?php

$input = getInputForDay(4, 'string');
$range = explode('-', $input);

$count = 0;
$count2 = 0;

for ($i = (int) $range[0], $end = (int) $range[1]; $i <= $end; $i++) {
    $sNumber = (string) $i;

    for($j = 0; $j < 5; $j++) {
        if ($sNumber[$j] > $sNumber[$j + 1]) {
            continue 2;
        }
    }

    if (preg_match('/(\d)\1/', $sNumber)) {
        $count++;

        if (array_search(2, count_chars($i, 1), true) !== false) {
            $count2++;
        }
    }
}

echo('Part 1: ' . $count . '<br>');
echo('Part 2: ' . $count2. '<br>');