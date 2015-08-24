<?php

/**
 * Class AsciiOutputBrowser
 * OutputPlugin that generates an Ascii output in the browser via echo
 */
class AsciiOutputBrowser extends BaseOutput
{
    function __construct()
    {
    }

    /**
     * name of the OutputPlugin-Button
     * @return "Ascii"
     */
    function buttonName()
    {
        return "Ascii";
    }

    /**
     * @param $_nextGen
     * @param $_height
     * @param $_width
     *
     * draws a bright-ish rectangle for each living cell
     * and a dark-ish rectangle for each dead cell
     */
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

    /**
     * @param $_saveDir
     * not used within this plugin because the output is printed live in the processGeneration method
     */
    function finishOutput($_saveDir)
    {
    }
}