<?php

$input = getInputForDay('10_0');
$grid = [];
foreach ($input as $row) {
    $newColumn = '';
    foreach ($input as $column) {
        $newColumn .= $column[count($grid)];
    }
    $grid[] = $newColumn;
}
unset($newColumn, $input, $column);

$possibleStations = [];

for($dX = 0, $rows = count($grid); $dX < $rows; $dX++) {
    $row = $grid[$dX];
    for ($dY = 0, $length = strlen($row); $dY < $length; $dY++) {
        $field = $grid[$dX][$dY];
        $grid[$dX][$dY] = 'X';
        if ($field === '#') {
            countAstroids($dX, $dY);
        }
    }
}

function countAstroids($x, $y) {
    
}