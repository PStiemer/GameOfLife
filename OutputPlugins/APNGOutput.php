<?php

/**
 * Class APNGOutput
 * OutputPlugin to generate an Animated PNG where living cells are transparent
 */
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

    /**
     * name of the OuttputPlugin-Button
     * @return "APNG"
     */
	function buttonName()
	{
		return "APNG";
	}

    /**
     * @param $_nextGen
     * @param $_height
     * @param $_width
     *
     * Creates a black Image with the size of $_width*10 * $_heigth*10
     * draws a transparent rectangle for each living cell where one cell is 10 +10 in size
     * adds the image to the APNG
     */
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

    /**
     * @param $_saveDir. is the directory in which the APNG will be saved
     * saves the image and opens it in a browser
     */
	function finishOutput($_saveDir)
	{
		$this->animation->save($_saveDir . ".png");
		header("LOCATION: testpng.php");
	}
}