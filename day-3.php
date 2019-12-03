<?php

$lines = getInputForDay(3);

$grid = [];
$crossings = [];
$lineNumber = 0;

foreach ($lines as $line) {
    $parts = explode(',', $line);
    $x = 0;
    $y = 0;
    $lineNumber++;

    foreach ($parts as $part) {
        $deltaX = 0;
        $deltaY = 0;

        $direction = $part[0];
        switch ($direction) {
            case 'R':
                $deltaX = 1;
                break;
            case 'L':
                $deltaX = -1;
                break;
            case 'U':
                $deltaY = 1;
                break;
            case 'D':
                $deltaY = -1;
        }

        $length = (int)substr($part, 1);
        for ($i = 0; $i < $length; $i++) {
            $x += $deltaX;
            $y += $deltaY;

            if (!isset($grid[$x])) {
                $grid[$x] = [];
            }
            if (!isset($grid[$x][$y])) {
                $grid[$x][$y] = 0;
            }

            if ($lineNumber === 2) {
                if ($grid[$x][$y] === 1) {
                    $crossings[] = new Crossing($x, $y);
                } else {
                    $grid[$x][$y] = 2;
                }
            } else {
                $grid[$x][$y] = 1;
            }
        }
    }
    // echo('<pre>'.print_r($grid, true).'</pre><hr>');
}

$closestDistanz = PHP_INT_MAX;
/** @var Crossing $crossing */
foreach($crossings as $crossing) {
    $closestDistanz = min($closestDistanz,
        abs($crossing->getX()) + abs($crossing->getY())
    );
}
echo("Closest Distanz: $closestDistanz");

class Crossing {
    /** @var int */
    private int $x;

    /** @var int */
    private int $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    public function __toString()
    {
        return $this->getX() . ' - ' . $this->getY();
    }
}