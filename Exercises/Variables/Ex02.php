<?php

$intToBool = (bool)-25;
echo var_export($intToBool, true) . "<br>";

$floatToInt = (int)12.25;
echo var_export($floatToInt, true) . "<br>";

$stringToInt = (int)"hello 123";
echo var_export($stringToInt, true) . "<br>";

$stringToBool = (bool)"";
echo var_export($stringToBool, true) . "<br>";

$intToString = (string)123;
echo var_export($intToString, true) . "<br>";
