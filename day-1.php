<?php

$input = getInputForDay(1);

function getFuel($mass, $fuelForFuel = false)
{
    $fuel = floor($mass / 3) - 2;
    if ($fuelForFuel && $fuel > 6) {
        $fuel += getFuel($fuel, true);
    }
    return $fuel;
}

$fuelForModules = 0;
$totalFuel = 0;
foreach ($input as $mass) {
    $fuelForModules += getFuel((int)$mass);
    $totalFuel += getFuel((int)$mass, true);
}
?>
<h1>Day 1</h1>
<a href="/">Back</a>
<p>Fuel for modules: <?= $fuelForModules ?></p>
<p>Total Fuel:<?= $totalFuel ?></p>