<?php

include "Algorithm.php";
include "ClassLoader.php";
$includer = new ClassLoader();
$includer->loadInput();
$outputFiles = $includer->loadOutput();

if (isset($_POST["height"])) $height = $_POST["height"];
if (isset($_POST["width"])) $width = $_POST["width"];
if (isset($_POST["numGeneration"]))$numGeneration = $_POST["numGeneration"];

session_start();
if (isset($_SESSION["startPos"])) $startPos = $_SESSION["startPos"];
if (isset($_POST["startPos"])) $startPos = $_POST["startPos"];

if(!isset($argv))
{
    foreach ($outputFiles as $file)
    {
        $className = str_replace(".php", "", $file);
        $outputPlugin = new $className();
        if ($outputPlugin instanceof BaseOutput)
        {
            $var = $outputPlugin->buttonName();
            if (isset($_POST["$var"]))
            {
                $chosenOutputPlugin = new $className();
            }
        }
    }
}

if (isset($argv))
{
    $height = 0;
    $width = 0;
    $handle = fopen($argv[1], "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $initCells[$height] = str_split($line);
            $height++;
            $width = strlen($line);
        }
        fclose($handle);
    }
    $outputPlugin = new $argv[4]($height, $width);
    main($initCells, $height, $width, $outputPlugin, $argv[5], $argv[6]);
}
else
{
    main($startPos, $height, $width, $chosenOutputPlugin, $numGeneration, "FinishedOutput/finished");
}


function main($_startPos, $_height, $_width, $_chosenOutputPlugin, $_numGeneration, $_saveDir)
    {
        $myAlgorithm = new Algorithm();
        $initCells = $myAlgorithm->fillArray($_startPos, $_height, $_width);
        $_chosenOutputPlugin->processGeneration($initCells, $_height, $_width);
        $nextGen = $myAlgorithm->scan($_height, $_width, $initCells);

        for ($generation = 1; $generation < $_numGeneration; $generation++) {
            $_chosenOutputPlugin->processGeneration($nextGen, $_height, $_width);
            $nextGen = $myAlgorithm->scan($_height, $_width, $nextGen);
        }
        $_chosenOutputPlugin->finishOutput($_saveDir);
    }

