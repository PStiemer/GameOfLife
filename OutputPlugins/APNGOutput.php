<?php

class APNGOutput extends BaseOutput
{
	private $numberImages;

	function __construct()
	{
		require_once __DIR__ . "/../AnimationClasses/APNG_Creator.php";

		$this->animation = new APNG_Creator();
		$this->animation->save_alpha = false;
		$this->animation->save_time = false;
		$this->animation->transparent_color = array(255, 255, 255); //this color will be transparent

		$this->numberImages = 0;

		$this->im = 0;
		$this->textColor = 0;
	}

	function buttonName()
	{
		return "APNG";
	}

	function processGeneration($_nextGen, $_height, $_width)
	{
		$this->im = imagecreatetruecolor($_width * 10, $_height * 10);
		$white = imagecolorallocate($this->im, 255, 255, 255);
		for ($x = 0; $x < $_height; $x++)
		{
			for ($y = 0; $y < $_width; $y++)
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

	function finishOutput($_saveDir)
	{
		$this->animation->save($_saveDir . ".png");
		header("LOCATION: testpng.php");
	}
}