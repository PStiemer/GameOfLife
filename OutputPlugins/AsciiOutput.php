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

    function name()
    {
        return "Ascii";
    }

    function processGeneration($_nextGen)
    {
        echo "<br />";
        for ($x = 0; $x < $this->width; $x++)
        {
            echo "<br />";
            for ($y = 0; $y < $this->height; $y++)
            {
                if ($_nextGen[$x][$y] == 1)
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
