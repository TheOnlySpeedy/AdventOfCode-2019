<?php

$input = getInputForDay(2, 'string');
// echo($input.'<br>');
$intCodes = explode(',', $input);

// Part 1
/*
 * To do this, before running the program, replace position 1 with the value 12 and replace position 2 with the value 2.
 */
$intCodes[1] = 12;
$intCodes[2] = 2;

$intCodesSize = count($intCodes);

for ($loopIndex = 0; $loopIndex < $intCodesSize; $loopIndex += 4) {
    $opCode = (int) $intCodes[$loopIndex];

    if ($opCode === 99) {
        $loopIndex = $intCodesSize;
        continue;
    }
    if ($opCode !== 1 && $opCode !== 2) {
        die("<h2 style='color: red'>Error!</h2>");
    }

    $firstPosition = (int) $intCodes[$loopIndex + 1];
    $secondPosition = (int) $intCodes[$loopIndex + 2];
    $targetPosition = (int) $intCodes[$loopIndex + 3];

    $firstNumber = (int) $intCodes[$firstPosition];
    $secondNumber = (int) $intCodes[$secondPosition];

    $targetNumber = $opCode === 1 ? $firstNumber + $secondNumber : $firstNumber * $secondNumber;
    $intCodes[$targetPosition] = $targetNumber;
    // echo(implode(',', $intCodes).'<br>');
}

echo ('Value left at Position 0: ' . $intCodes[0]);