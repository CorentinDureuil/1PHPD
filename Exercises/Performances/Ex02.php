<?php

function generateAndSplitArray($size) {
    $startTime = microtime(true);

    $hugeArray = [];
    for ($i = 0; $i < $size; $i++) {
        $hugeArray[] = rand(0, 100);
    }

    sort($hugeArray);

    $lowerHalf = [];
    $upperHalf = [];
    foreach ($hugeArray as $value) {
        if ($value < 50) {
            $lowerHalf[] = $value;
        } else {
            $upperHalf[] = $value;
        }
    }

    echo "Items in lower half (0-49): " . count($lowerHalf) . "\n";
    echo "Items in upper half (50-100): " . count($upperHalf) . "\n";

    $endTime = microtime(true) - $startTime;
    echo "Time taken for $size items: " . $endTime . " seconds.\n";
}

generateAndSplitArray(100000);
echo "<br/>";
generateAndSplitArray(1000000);
