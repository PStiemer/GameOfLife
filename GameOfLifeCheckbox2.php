<head><title>Game of life</title></head>
<form action="GameOfLifeHTML.php" method="post">
    <?php
    include "ClassLoader.php";
    $includer = new ClassLoader(0,0);
    $includer->loadInput();
    $includer->loadOutput();

    $height = $_POST["height"];
    $width = $_POST["width"];

    $myCheckboxInput = new CheckboxInput($height, $width);

    echo "<p><input type=hidden name=height value=$height/><input type=hidden name=width value=$width/></p>";

    $myCheckboxInput->startingMatrix();
    $myCheckboxInput->numberOfGenerations();
    $myCheckboxInput->outputFormat();
    ?>
</form>