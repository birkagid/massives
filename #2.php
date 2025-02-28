<?php
$numbs = [0, 5, 100, 1000, 1, 11, 101, 1001];
rsort($numbs, $flags = SORT_NUMERIC);
$thirdMax = $numbs[2];
echo "Третье максимальное число: " . $thirdMax . PHP_EOL;
