<head><title>Game of life</title></head>
<form action="GameOfLifeCheckbox2.php" method="post">
    <?php
    include "ClassLoader.php";
    $includer = new ClassLoader(0,0);
    $includer->loadInput();
    $includer->loadOutput();

    $myCheckboxInput = new CheckboxInput(0,0);

    $myCheckboxInput->getMatrixDimensions();
    ?>
</form>