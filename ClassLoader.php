<?php
class ClassLoader
{
    public function loadOutput()
    {
        include_once "BaseOutput.php";

        foreach(glob("OutputPlugins/*.php") as $file)
        {
            include_once $file;
        }

        return str_replace("OutputPlugins/", "", glob("OutputPlugins/*.php"));
    }

    public function loadInput()
    {
        include_once "baseInput.php";

        foreach(glob("InputPlugins/*.php") as $file)
        {
            include_once $file;
        }

        return str_replace("InputPlugins/", "", glob("InputPlugins/*.php"));
    }
}