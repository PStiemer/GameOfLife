<?php

/**
 * Class CheckboxInput. InputPlugin for the HTML based checkbox input
 */
class CheckboxInput extends BaseInput
{
    /**
     * @param $_height
     * @param $_width
     */
    function __construct($_height, $_width)
    {
        BaseInput::__construct();

        $this->height = $_height;
        $this->width = $_width;
    }

    /**
     * echoes a text input field "Number of Generations"
     */
    function numberOfGenerations()
    {
        echo "<p>Number of Generations: <input type=text name=numGeneration /></p>";
    }

    /**
     * echoes checkboxes based off the previous set height and width values
     */
    function startingMatrix()
    {
        echo "<p>Choose your starting positions:</p>";
        for ($w = 0; $w < $this->width; $w++) {
            for ($h = 0; $h < $this->height; $h++) {
                echo "<input type=checkbox name=startPos[$w][$h] value=X>";
            }
            echo "<br />";
        }
    }

    /**
     * generates buttons for the output type based off installed OutputPlugins
     */
    function outputFormat()
    {
        echo "<p>Output-format:</p>";
        foreach ($this->files as $file) {
            $className = str_replace(".php", "", $file);
            $outputPlugin = new $className($this->height, $this->width);
            if ($outputPlugin instanceof BaseOutput) {
                $var = $outputPlugin->buttonName();
                if(isset($var))
                {
                    echo "<input type=submit name=$var value=$var>";
                }
            }
        }
    }

    /**
     * echoes 2 textfields to receive height and width from user
     * used in GameOfLifeCheckbox.php
     */
    function getMatrixDimensions()
    {
        echo "<p>Height: <input type=text name=height /></p>";
        echo "<p>Width: <input type=text name=width /></p>";
        echo "<input type=submit value=Send />";
    }

    /**
     * name of the InputPlugin-Button
     * @return "Checkbox"
     */
    function buttonName()
    {
        return "Checkbox";
    }
}