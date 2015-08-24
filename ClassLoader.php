<?php

/**
 * Class ClassLoader. Loads classes
 */
class ClassLoader
{
    /**
     * Incudes vendor/autoload for ulrichsg getopt
     */
    function __construct()
    {
        include_once "vendor/autoload.php";
    }

    /**
     * @return array with all outputPlugins located in the OutputPlugins Folder
     */
    public function loadOutput()
    {
        include_once "BaseOutput.php";

        foreach(glob("OutputPlugins/*.php") as $file)
        {
            include_once $file;
        }

        return str_replace("OutputPlugins/", "", glob("OutputPlugins/*.php"));
    }

    /**
     * @return array with all inputPlugins located in the InputPlugins Folder
     */
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