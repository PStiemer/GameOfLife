<?php


class AsciiOutputBrowser extends BaseOutput
{
    function __construct()
    {
    }

    function buttonName()
    {
        return "Ascii";
    }

    function processGeneration($_nextGen, $_height, $_width)
    {
        echo "<br />";
        for ($x = 0; $x < $_height; $x++)
        {
            echo "<br />";
            for ($y = 0; $y < $_width; $y++)
            {
                if ($_nextGen[$x][$y] == "X")
                {
                    echo "░";
                }
                else
                {
                    echo "▓";
                }
            }
        }
    }

    function finishOutput($_saveDir)
    {
    }
}