<?php

function getInputForDay($day) {
    return file ("inputs/$day");
}

if (isset($_GET['day']) && $_GET['day'] !== '') {
    $day = $_GET['day'];
    include "day-$day.php";
} else {
    ?>
        <h1>Advent of Code</h1>
        <ul>
            <li><a href="?day=1">Day 1</a></li>
        </ul>
    <?php
}