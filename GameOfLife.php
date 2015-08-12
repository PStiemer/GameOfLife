<?php
include "ClassLoader.php";
$includer = new ClassLoader();
$includer->ClassLoader();

$height = $_POST["height"];
$width = $_POST["width"];

if(isset($_POST["checkbox"]))
{
    $startPos = $_POST["checkbox"];
}
else
{
    $startPos[0][0] = 0;
}

if (isset($_POST['Ascii']))
{
    $output = new AsciiOutput($height, $width);
}
else if (isset($_POST['Gif']))
{
    $output = new GifOutput($height, $width);
}

function main($_startPos, $_height, $_width,$_output)
{
    $initCells = fillArray($_startPos, $_height, $_width);
    $_output->processGeneration($initCells);
    $nextGen = scan($_height, $_width, $initCells);

    for($generation=1; $generation < 30; $generation++) //number of generations. For debug purpose only
    {
        $_output->processGeneration($nextGen);
        $nextGen = scan($_height, $_width, $nextGen);
    }
    $_output->finishOutput();
}



function fillArray($_startPos, $_height, $_width)
{
    for ($w = 0; $w < $_height; $w++)
    {
        for($h = 0; $h < $_width; $h++)
        {
            if (!isset($_startPos[$w][$h]))
            {
                $_startPos[$w][$h] = 0;
            }
        }
    }
    return $_startPos;
}

function scan($_height, $_width, $_cells) // checks the value of every cell and evaluates if someone dies, gets born or stays alive.
{

    if(isset($nextGen))
    {
        unset($nextGen); // clearing the old status of nextGen because it only saves status changes and not the whole board
    }

    for($h = 0; $h < $_height; $h++)
    {
        for($w = 0; $w < $_width; $w++)
        {
            if($_cells[$h][$w] == 1)
            {
                $neighbors = countNeighbors($h, $w, $_cells);

                if ($neighbors >= 0 && $neighbors < 2)
                {
                    $nextGen[$h][$w] = 0;
                }
                elseif ($neighbors == 2 || $neighbors == 3)
                {
                    $nextGen[$h][$w] = 1;
                }
                elseif ($neighbors > 3 && $neighbors < 9)
                {
                    $nextGen[$h][$w] = 0;
                }
            }
            elseif ($_cells[$h][$w] == 0)
            {
                $neighbors = countNeighbors($h, $w, $_cells);

                if ($neighbors == 3)
                {
                    $nextGen[$h][$w] = 1;
                }
                else
                {
                    $nextGen[$h][$w] = 0;
                }
            }
        }
    }

    return $nextGen;
}

function countNeighbors($_height, $_width, $_cells) //counts neighbors
{
    $neighborCounter = 0;

    if (isset($_cells[$_height - 1][$_width]) && $_cells[$_height - 1][$_width] == 1) $neighborCounter++; //up

    if (isset($_cells[$_height - 1][$_width + 1]) && $_cells[$_height - 1][$_width + 1] == 1) $neighborCounter++; //up right

    if (isset($_cells[$_height][$_width + 1]) && $_cells[$_height][$_width + 1] == 1) $neighborCounter++; //right

    if (isset($_cells[$_height + 1][$_width + 1]) && $_cells[$_height + 1][$_width + 1] == 1) $neighborCounter++; //down right

    if (isset($_cells[$_height + 1][$_width]) && $_cells[$_height + 1][$_width] == 1) $neighborCounter++; //down

    if (isset($_cells[$_height + 1][$_width - 1]) && $_cells[$_height + 1][$_width - 1] == 1) $neighborCounter++; //down left

    if (isset($_cells[$_height][$_width - 1]) && $_cells[$_height][$_width - 1] == 1) $neighborCounter++; //left

    if (isset($_cells[$_height-1][$_width - 1]) && $_cells[$_height-1][$_width - 1] == 1) $neighborCounter++; //left up

    return $neighborCounter;
}

main($startPos, $height, $width, $output);
