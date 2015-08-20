<head><title>Game of life</title></head>
<form action="GameOfLifeHTML.php" method="post">
<?php
include "ClassLoader.php";
$includer = new ClassLoader(0,0);
$inputFiles = $includer->loadInput();
$outputFiles = $includer->loadOutput();
session_start();

foreach ($inputFiles as $file)
{
    $className = str_replace(".php", "", $file);
    $inputPlugin = new $className(0,0);
    if ($inputPlugin instanceof BaseInput) {
        $var = $inputPlugin->buttonName();
        if(isset($_POST["$var"]))
        {
            $chosenInputPlugin = new $className(0, 0);
        }
    }
}

$startPos = $chosenInputPlugin->startingMatrix();
$chosenInputPlugin->getMatrixDimensions();
$chosenInputPlugin->numberOfGenerations();
$_SESSION["startPos"] = $startPos;
$chosenInputPlugin->outputFormat();
?>
</form>