<?php

$input = getInputForDay(2, 'string');
// echo($input.'<br>');
$intCodes = explode(',', $input);

$intCodesSize = count($intCodes);

for ($noun = 0; $noun < 100; $noun++) {
    for ($verb = 0; $verb < 100; $verb++) {
        $intCodes = explode(',', $input);
        $intCodes[1] = $noun;
        $intCodes[2] = $verb;

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
        }

        if ($noun === 12 && $verb === 2) {
            echo('Output part 1: ' . $intCodes[0].'<br>');
        }

        if ((int)$intCodes[0] === 19690720) {
            echo('Solution part 2 - 100 * noun + verb: ' . ((100 * $noun) + $verb).'<br>');
            if ($noun > 12 && $verb > 2) {
                // Part 1 already has been finished, no need to execute code further
                exit;
            }
        }
    }
}