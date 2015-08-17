<?php

class GifOutput extends BaseOutput
{
    private $numberImages;
    private $height;
    private $width;

    function __construct($_height, $_width)
    {
        require_once __DIR__ . "/../AnimationClasses/dGifAnimator.inc.php";

        $this->gif = new dGifAnimator;
        $this->gif->setLoop(0);
        $this->gif->setDefaultConfig('Delay_ms', '-1');

        $this->numberImages = 0;
        $this->height = $_height;
        $this->width = $_width;

        $this->im = 0;
        $this->textColor = 0;
    }

    function buttonName()
    {
        return "Gif";
    }

    function processGeneration($_nextGen)
    {
        $this->im = imagecreatetruecolor($this->width * 10, $this->height * 10);
        $this->textColor = imagecolorallocate($this->im, 255, 255, 255);
        for ($x = 0; $x < $this->height; $x++)
        {
            for ($y = 0; $y < $this->width; $y++)
            {
                if ($_nextGen[$x][$y] == "X")
                {
                    imagefilledrectangle($this->im, $y * 10, $x * 10, ($y + 1) * 10, ($x + 1) * 10, $this->textColor);
                }
            }
        }
        imagegif($this->im, __DIR__. "/../images/". $this->numberImages . ".gif");
        $this->gif->addFile(__DIR__ . "/../images/" . $this->numberImages . ".gif");
        $this->numberImages++;
    }

    function finishOutput()
    {
        $this->gif->build("FinishedOutput/finished.gif");
        echo "<img src='FinishedOutput/finished.gif?" . uniqid() . "'><br />";
    }
}