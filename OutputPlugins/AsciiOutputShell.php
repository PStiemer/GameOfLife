<?php


class AsciiOutputShell extends BaseOutput
{
    function __construct()
    {
    }

    function buttonName()
    {
    }

    function processGeneration($_nextGen, $_height, $_width)
    {
        echo "\n";
        for ($x = 0; $x < $_height; $x++)
        {
            echo"\n";
            for ($y = 0; $y < $_width; $y++)
            {
                if ($_nextGen[$x][$y] == "X")
                {
                    echo "X";
                }
                else
                {
                    echo "O";
                }
            }
        }
    }

    function finishOutput($_saveDir)
    {

    }
}