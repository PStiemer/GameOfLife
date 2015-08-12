<?php
class GifOutput extends BaseOutput
{
private $numberImages;
private $height;
private $width;

function __construct($_height, $_width)
{
require_once "D:/www/GameOfLife/dGifAnimator.inc.php";

$this->gif = new dGifAnimator;
$this->gif->setLoop(0);
$this->gif->setDefaultConfig('Delay_ms', '10');

$this->numberImages=0;
$this->height = $_height;
$this->width = $_width;

$this->im = imagecreatetruecolor($this->height * 10, $this->width * 10);
$this->textColor = imagecolorallocate($this->im, 255, 255, 255);
}

function name()
{
    return "Gif";
}

function processGeneration($_nextGen)
{
$this->im = imagecreatetruecolor($this->height * 10, $this->width * 10);
for($x = 0; $x < $this->width; $x++)
{
for($y = 0; $y < $this->height; $y++)
{
if($_nextGen[$x][$y] == 1)
{
imagefilledrectangle($this->im, $x * 10, $y * 10, ($x+1)*10, ($y+1)*10, $this->textColor);
}
}
}
imagegif($this->im, "D:/www/GameOfLife/images/" . $this->numberImages . ".gif");
$this->gif->addFile("D:/www/GameOfLife/images/" . $this->numberImages . ".gif");
$this->numberImages++;
}

function finishOutput()
{
$this->gif->build("finished.gif");
echo "<img src='finished.gif?".uniqid()."'><br />";
}
}