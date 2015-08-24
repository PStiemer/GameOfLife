<?php

/**
 * Class GifOutput
 * OutputPlugin to generate an Animated GIF
 */
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

    /**
     * name of the OuttputPlugin-Button
     * @return "Gif"
     */
    function buttonName()
    {
        return "Gif";
    }

    /**
     * @param $_nextGen
     * @param $_height
     * @param $_width
     *
     * Creates a black Image with the size of $_width*10 * $_heigth*10
     * draws a white rectangle for each living cell where one cell is 10 +10 in size
     * saves the image in the image folder with the generation number in the filename
     */
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

    /**
     * @param $_saveDir. is the directory in which the Gif will be saved
     * saves the image and opens it in a browser
     */
    function finishOutput($_saveDir)
    {
        $this->gif->build($_saveDir . ".gif");
        header("LOCATION: testgif.php");
    }
}