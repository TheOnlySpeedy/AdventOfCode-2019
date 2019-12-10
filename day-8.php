<?php

$input = getInputForDay('8', 'string');

$width = 25;
$height = 6;

$currentWidth = -1;
$currentHeight = 0;
$currentLayer = 0;

$layers = [];
$layerMetadata = [];
$image = [];

for($i = 0, $inputLength = strlen($input); $i < $inputLength; $i++) {
    $currentWidth++;
    if ($currentWidth >= $width) {
        $currentWidth = 0;
        $currentHeight++;
        if ($currentHeight >= $height) {
            $currentHeight = 0;
            $currentLayer++;
        }
    }
    if (!isset($layers[$currentLayer])) {
        $layers[$currentLayer] = [];
    }
    if (!isset($layers[$currentLayer][$currentHeight])) {
        $layers[$currentLayer][$currentHeight] = [];
    }
    $number = (int)$input[$i];
    $layers[$currentLayer][$currentHeight][$currentWidth] = $number;

    if (!isset($layerMetadata[$currentLayer])) {
        $layerMetadata[$currentLayer] = [];
    }

    if (!isset($layerMetadata[$currentLayer][$number])) {
        $layerMetadata[$currentLayer][$number] = 0;
    }
    $layerMetadata[$currentLayer][$number]++;

    // Code for Part 2
    if ($currentLayer === 0) {
        if (!isset($image[$currentHeight])) {
            $image[$currentHeight] = [];
        }
        $image[$currentHeight][$currentWidth] = $number;
    } elseif($number !== 2) {
        $imagePixel = $image[$currentHeight][$currentWidth];
        if ($imagePixel === 2) {
            $image[$currentHeight][$currentWidth] = $number;
        }
    }
}
ppr($layerMetadata);
/*
echo('<table>');
foreach ($layers[0] as $row) {
    echo('<tr>');
    foreach($row as $value) {
        echo("<td>$value</td>");
    }
    echo('</tr>');
}
echo('</table>');
*/

$lowestZeros = ($width * $height)+1;
$savedLayer = null;
for ($j = 0, $layersCount = count($layerMetadata); $j < $layersCount; $j++) {
    $metadata = $layerMetadata[$j];
    if ($metadata[0] < $lowestZeros) {
        $lowestZeros = $metadata[0];
        $savedLayer = $j;
    }
}
echo('Part 1: ' . ($layerMetadata[$savedLayer][1] * $layerMetadata[$savedLayer][2]).'<br>');
echo('Part 2:<br>');
echo('<table>');
foreach ($image as $row) {
    echo('<tr>');
    foreach($row as $value) {
        echo("<td style='background-color: black; opacity: $value'>&nbsp;</td>");
    }
    echo('</tr>');
}
echo('</table>');