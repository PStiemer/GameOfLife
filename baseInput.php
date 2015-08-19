<?php
abstract class BaseInput
{
    public function __construct()
    {
        include_once "ClassLoader.php";
        $includer = new ClassLoader();
        $this->files = $includer->loadOutput();
    }

    abstract function numberOfGenerations();
    abstract function startingMatrix();
    abstract function outputFormat();
    abstract function buttonName();
}