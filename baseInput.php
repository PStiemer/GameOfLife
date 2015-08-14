<?php
abstract class BaseInput
{
    public function __construct()
    {
        echo "<head><title>Game of life</title></head>";

        include_once "ClassLoader.php";
        $includer = new ClassLoader();
        $this->files = $includer->loadOutput();
    }

    abstract function numberOfGenerations();
    abstract function startingMatrix();
    abstract function outputFormat();
    abstract function buttonName();
}