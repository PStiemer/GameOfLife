<?php
class ClassLoader
{
    public function loadAll()
    {
        include_once "BaseOutput.php";

        foreach(glob("OutputPlugins/*.php") as $file)
        {
            include_once $file;
        }
        return str_replace("OutputPlugins/", "", glob("OutputPlugins/*.php"));
    }
}