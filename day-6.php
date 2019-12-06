<?php

$input = getInputForDay('6');
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
    $parents[$orbiter] = $central;
}

$totalOrbits = countChildOrbits($directOrbits['COM'], 1);
echo('Total Orbits: ' . $totalOrbits.'<br>');

$myPath = pathToRoot('YOU');
$santaPath = pathToRoot('SAN');
$pathToTake = array_merge(array_diff($myPath, $santaPath), array_diff($santaPath, $myPath));
echo('Orbital transfers: ' . count($pathToTake));

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
        if (isset($directOrbits[$child]) && is_array($directOrbits[$child])) {
            $count += countChildOrbits($directOrbits[$child], $level+1);
        }
    }
    return $count;
}

function pathToRoot($name) {
    global $parents;
    $path = [];
    if ($name !== 'YOU' && $name !== 'SAN'){
        $path[] = $name;
    }
    $parent = $parents[$name];
    if ($parent !== 'COM') {
        $path = array_merge(pathToRoot($parent),  $path);
    }
    return $path;
}