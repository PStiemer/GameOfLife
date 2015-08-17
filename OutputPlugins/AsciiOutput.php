<?php


class AsciiOutput extends BaseOutput
{
    private $height;
    private $width;

    function __construct($_height, $_width)
    {
        $this->height = $_height;
        $this->width = $_width;
    }

    function buttonName()
    {
        return "Ascii";
    }

    function processGeneration($_nextGen)
    {
        echo "<br />";
        for ($x = 0; $x < $this->height; $x++)
        {
            echo "<br />";
            for ($y = 0; $y < $this->width; $y++)
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

    function finishOutput()
    {

    }
}