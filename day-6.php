<?php

$input = getInputForDay('6_0');
$directOrbits = [];
$parents = [];

foreach($input as $item) {
    $parts = explode(')', $item);
    $central = trim($parts[0]);
    $orbiter = trim($parts[1]);
    if (!isset($directOrbits[$central])) {
        $directOrbits[$central] = [];
    }
    $directOrbits[$central][] = $orbiter;
}

$totalOrbits = countChildOrbits($directOrbits['COM'], 1);
echo('Total Orbits: ' . $totalOrbits.'<br>');

$pathToSanta = [];

function countChildOrbits(array $childOrbits, $level) {
    global $directOrbits;
    $childCount = count($childOrbits);
    if (in_array('YOU', $childOrbits, false)) {
        $childCount--;
    }
    if (in_array('SAN', $childOrbits, false)) {
        $childCount--;
    }
    $count = $level * $childCount;
    foreach ($childOrbits as $child) {
        if (is_array($directOrbits[$child])) {
            $count += countChildOrbits($directOrbits[$child], $level+1);
        }
    }
    return $count;
}
