<?php

/**
 * Class AsciiOutputShell
 * OutputPlugin that generates an Ascii output in the Shell via echo
 */
class AsciiOutputShell extends BaseOutput
{
    function __construct()
    {
    }

    /**
     * not used because there are no buttons in a Shell
     */
    function buttonName()
    {
    }

    /**
     * @param $_nextGen
     * @param $_height
     * @param $_width
     *
     * draws an X for each living cell
     * and an O for each dead cell
     */
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

    /**
     * @param $_saveDir
     * not used within this plugin because the output is printed live in the processGeneration method
     */
    function finishOutput($_saveDir)
    {

    }
}