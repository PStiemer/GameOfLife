<?php

class APNGOutput extends BaseOutput
{
	private $numberImages;
	private $height;
	private $width;

	function __construct($_height, $_width)
	{
		require_once __DIR__ . "/../AnimationClasses/APNG_Creator.php";

		$this->animation = new APNG_Creator();
		$this->animation->save_alpha = false;
		$this->animation->save_time = false;
		$this->animation->transparent_color = array(255, 255, 255); //this color will be transparent

		$this->numberImages = 0;
		$this->height = $_height;
		$this->width = $_width;

		$this->im = 0;
		$this->textColor = 0;
	}

	function buttonName()
	{
		return "APNG";
	}

	function processGeneration($_nextGen)
	{
		$this->im = imagecreatetruecolor($this->width * 10, $this->height * 10);
		$white = imagecolorallocate($this->im, 255, 255, 255);
		for ($x = 0; $x < $this->height; $x++)
		{
			for ($y = 0; $y < $this->width; $y++)
			{
				if ($_nextGen[$x][$y] == "X")
				{
					imagefilledrectangle($this->im, $y * 10, $x * 10, ($y + 1) * 10, ($x + 1) * 10, $white);
				}
			}
		}
		$this->animation->add_image($this->im, null, 100, 0, 0);
		$this->numberImages++;
	}

	function finishOutput()
	{
		$this->animation->save("FinishedOutput/finished.png");
		echo "<img src='FinishedOutput/finished.png?" . uniqid() . "'><br />";
	}
}