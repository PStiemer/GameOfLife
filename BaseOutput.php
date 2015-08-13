<?php
abstract class BaseOutput
{
    abstract public function __construct($_height, $_width);

    abstract function processGeneration($_nextGen);
    abstract function buttonName();
    abstract function finishOutput();
}