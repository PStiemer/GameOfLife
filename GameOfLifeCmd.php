<?php
include "ClassLoader.php";
include "GameOfLife.php";
$includer = new ClassLoader();
$includer->loadInput();
$game = new GameOfLife();

$getopt = new \Ulrichsg\Getopt\Getopt(array(
    new \Ulrichsg\Getopt\Option("h", "height", \Ulrichsg\Getopt\Getopt::OPTIONAL_ARGUMENT),
    new \Ulrichsg\Getopt\Option("w", "width", \Ulrichsg\Getopt\Getopt::OPTIONAL_ARGUMENT),
    new \Ulrichsg\Getopt\Option(null, "inputplugin", \Ulrichsg\Getopt\Getopt::REQUIRED_ARGUMENT),
    new \Ulrichsg\Getopt\Option(null, "inputfile", \Ulrichsg\Getopt\Getopt::OPTIONAL_ARGUMENT),
    new \Ulrichsg\Getopt\Option(null, "outputplugin", \Ulrichsg\Getopt\Getopt::REQUIRED_ARGUMENT),
    new \Ulrichsg\Getopt\Option(null, "outputfile", \Ulrichsg\Getopt\Getopt::OPTIONAL_ARGUMENT),
    new \Ulrichsg\Getopt\Option("g", "generation", \Ulrichsg\Getopt\Getopt::REQUIRED_ARGUMENT)
));

$getopt->parse();

if($getopt->getOption("inputplugin")==="TextfileInput")
{
    $height = 0;
    $handle = fopen($getopt->getOption("inputfile"), "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $initCells[$height] = str_split($line);
            $height++;
            $width = strlen($line);
        }
        fclose($handle);
    }
    $chosenOutputPlugin = $getopt->getOption("outputplugin");
    $numGeneration = $getopt->getOption("g");
    $outputDir = $getopt->getOption("outputfile");
    $game->main($initCells, $height, $width, $chosenOutputPlugin, $numGeneration, $outputDir);
}
else
{
    echo"Error\n";
    print_r($getopt->getOptions());
}