<?php
abstract class BaseOutput
{
    abstract public function __construct($_height, $_width);

    abstract function processGeneration($_nextGen);
    abstract function name();
    abstract function finishOutput();
}