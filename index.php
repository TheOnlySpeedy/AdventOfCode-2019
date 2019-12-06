<?php

function getInputForDay($day, $type = 'array') {
    if ($type === 'array') {
        return file ("inputs/$day");
    }

    if ($type === 'string') {
        return file_get_contents("inputs/$day");
    }
}

if (isset($_GET['day']) && $_GET['day'] !== '') {
    $day = $_GET['day'];
    include "day-$day.php";
} else {
    ?>
        <h1>Advent of Code</h1>
        <ul>
            <?php
                for ($i = 1; $i <= 6; $i++) {
                    echo("<li><a href='?day=$i'>Day $i</a></li>");
                }
            ?>
        </ul>
    <?php
}