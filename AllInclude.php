<?php
class AllInclude
{
    public function AllInclude()
    {
        include_once "BaseOutput.php";

        $dir = __DIR__ . "/OutputPlugins";
        $allFiles = scandir($dir);
        $files = array_diff($allFiles, array('.', '..'));
        $i = 2;
        do
        {
            include_once "/OutputPlugins/" . $files[$i];
            $i++;
        }
        while (isset($files[$i])) ;
    }
}