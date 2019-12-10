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
    $moves = 0;

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
            $moves++;
            $x += $deltaX;
            $y += $deltaY;

            if (!isset($grid[$x])) {
                $grid[$x] = [];
            }
            if (!isset($grid[$x][$y])) {
                $grid[$x][$y] = 0;
            }

            if ($lineNumber === 2) {
                if (isset($grid[$x][$y][1])) {
                    $line1Moves = $grid[$x][$y][1];
                    $crossings[] = new Crossing($x, $y, $line1Moves, $moves);
                } else {
                    if (!isset($grid[$x][$y][2])) {
                        $grid[$x][$y] = [
                            2 => $moves
                        ];
                    }
                }
            } else {
                if (!isset($grid[$x][$y][1])) {
                    $grid[$x][$y] = [
                        1 => $moves
                    ];
                }
            }
        }
    }
    ppr($grid);
}

$closestDistance = PHP_INT_MAX;
$shortestWireDistance = PHP_INT_MAX;
/** @var Crossing $crossing */
foreach($crossings as $crossing) {
    $closestDistance = min($closestDistance,
        abs($crossing->getX()) + abs($crossing->getY())
    );
    $shortestWireDistance = min($shortestWireDistance, $crossing->getTotalSteps());
}
echo("Closest distance: $closestDistance<br>");
echo('Shortest wire distance: ' . $shortestWireDistance);

class Crossing {
    /** @var int */
    private int $x;

    /** @var int */
    private int $y;
    private int $xSteps;
    private int $ySteps;

    public function __construct(int $x, int $y, $xSteps, $ySteps)
    {
        $this->x = $x;
        $this->y = $y;
        $this->xSteps = $xSteps;
        $this->ySteps = $ySteps;
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

    public function getTotalSteps(): int
    {
        return $this->xSteps + $this->ySteps;
    }

    public function __toString()
    {
        return $this->getX() . ' - ' . $this->getY();
    }
}