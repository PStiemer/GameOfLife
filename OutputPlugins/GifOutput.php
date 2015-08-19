<?php

class GifOutput extends BaseOutput
{
    private $numberImages;

    function __construct()
    {
        require_once __DIR__ . "/../AnimationClasses/dGifAnimator.inc.php";

        $this->gif = new dGifAnimator;
        $this->gif->setLoop(0);
        $this->gif->setDefaultConfig('Delay_ms', '-1');

        $this->numberImages = 0;

        $this->im = 0;
        $this->textColor = 0;
    }

    function buttonName()
    {
        return "Gif";
    }

    function processGeneration($_nextGen, $_height, $_width)
    {
        $this->im = imagecreatetruecolor($_width * 10, $_height * 10);
        $this->textColor = imagecolorallocate($this->im, 255, 255, 255);
        for ($x = 0; $x < $_height; $x++)
        {
            for ($y = 0; $y < $_width; $y++)
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

    function finishOutput($_saveDir)
    {
        $this->gif->build($_saveDir . ".gif");
        header("LOCATION: testgif.php");
    }
}