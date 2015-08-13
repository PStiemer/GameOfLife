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

		$this->numberImages = 0;
		$this->height = $_height;
		$this->width = $_width;

		$this->im = imagecreatetruecolor($this->height * 10, $this->width * 10);
		$this->textColor = imagecolorallocate($this->im, 255, 255, 255);
	}

	function buttonName()
	{
		return "APNG";
	}

	function processGeneration($_nextGen)
	{
		$this->im = imagecreatetruecolor($this->height * 10, $this->width * 10);
		for ($x = 0; $x < $this->width; $x++)
		{
			for ($y = 0; $y < $this->height; $y++)
			{
				if ($_nextGen[$x][$y] == 1)
				{
					imagefilledrectangle($this->im, $x * 10, $y * 10, ($x + 1) * 10, ($y + 1) * 10, $this->textColor);
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