<?php
class GameOfLife
{
    function main($_startPos, $_height, $_width, $_chosenOutputPlugin, $_numGeneration, $_saveDir)
    {
        require_once "ClassLoader.php";
        require_once "Algorithm.php";
        $includer=new ClassLoader();
        $includer->loadOutput();

        $chosenOutputPlugin = new $_chosenOutputPlugin;

        $myAlgorithm = new Algorithm();
        $initCells = $myAlgorithm->fillArray($_startPos, $_height, $_width);
        $chosenOutputPlugin->processGeneration($initCells, $_height, $_width);
        $nextGen = $myAlgorithm->scan($_height, $_width, $initCells);

        for ($generation = 1; $generation < $_numGeneration; $generation++) {
            $chosenOutputPlugin->processGeneration($nextGen, $_height, $_width);
            $nextGen = $myAlgorithm->scan($_height, $_width, $nextGen);
        }
        $chosenOutputPlugin->finishOutput($_saveDir);
    }
}