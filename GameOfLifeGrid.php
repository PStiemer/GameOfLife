<form action="GameOfLife.php" method="post">
    <p>Waehlen sie die Startpositionen:</p>

<?php
$height = $_POST["height"];
$width = $_POST["width"];

for($w = 0; $w < $width; $w++)
{
    for ($h = 0; $h < $height; $h++)
    {
        echo "<input type=checkbox name=checkbox[$h][$w] value=1>";
    }
    echo "<br />";
}
    echo "<input type=hidden name=height value=$height />";
    echo "<input type=hidden name=width value=$width />";
?>
    <p>Ausgabeformat: <input type="submit" name="Ascii" value="Ascii"/> <input type="submit" name="Gif" value="Gif"</p>
    </form>

