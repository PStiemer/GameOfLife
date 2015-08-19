<?php
abstract class BaseOutput
{
    abstract public function __construct();

    abstract function processGeneration($_nextGen, $_height, $_width);
    abstract function buttonName();
    abstract function finishOutput($_saveDir);
}