<?php
include "ClassLoader.php";
require_once "Algorithm.php";
include "GameOfLife.php";

$game = new GameOfLife();
$includer = new ClassLoader();
$includer->loadInput();
$outputFiles = $includer->loadOutput();

if (isset($_POST["height"])) $height = $_POST["height"];
if (isset($_POST["width"])) $width = $_POST["width"];
if (isset($_POST["numGeneration"]))$numGeneration = $_POST["numGeneration"];

session_start();
if (isset($_SESSION["startPos"])) $startPos = $_SESSION["startPos"];
if (isset($_POST["startPos"])) $startPos = $_POST["startPos"];

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

$game->main($startPos, $height, $width, $chosenOutputPlugin, $numGeneration, "FinishedOutput/finished");