<head><title>Game of life</title></head>
    <h1>Conways Game of Life!</h1>
    <p>Choose Input:</p>
<?php
include "ClassLoader.php";
$includer = new ClassLoader();
$files = $includer->loadInput();

foreach ($files as $file) {
    $className = str_replace(".php", "", $file);
    $inputPlugin = new $className(0, 0);
    if ($inputPlugin instanceof BaseInput) {
        $var = $inputPlugin->buttonName();
        $actionString = "GameOfLife" . $var . ".php";
        echo "<form action=$actionString method=post>";
        echo "<input type=submit name=$var value=$var>";
        echo "</form>";
    }

}
?>