<?php

class CheckboxInput extends BaseInput
{
    function __construct($_height, $_width)
    {
        BaseInput::__construct();

        $this->height = $_height;
        $this->width = $_width;
    }

    function numberOfGenerations()
    {
        echo "<p>Number of Generations: <input type=text name=numGeneration /></p>";
    }

    function startingMatrix()
    {
        echo "<p>Choose your starting positions:</p>";
        for ($w = 0; $w < $this->width; $w++) {
            for ($h = 0; $h < $this->height; $h++) {
                echo "<input type=checkbox name=checkbox[$h][$w] value=X>";
            }
            echo "<br />";
        }
    }

    function outputFormat()
    {
        echo "<p>Output-format:</p>";
        foreach ($this->files as $file) {
            $className = str_replace(".php", "", $file);
            $outputPlugin = new $className($this->height, $this->width);
            if ($outputPlugin instanceof BaseOutput) {
                $var = $outputPlugin->buttonName();
                echo "<input type=submit name=$var value=$var>";
            }
        }
    }

    function getMatrixDimensions()
    {
        echo "<p>Height: <input type=text name=height /></p>";
        echo "<p>Width: <input type=text name=width /></p>";
        echo "<input type=submit value=Send />";
    }

    function buttonName()
    {
        return "Checkbox";
    }
}