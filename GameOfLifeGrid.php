<form action="GameOfLife.php" method="post">
    <p>Waehlen sie die Startpositionen:</p>
<?php
include "ClassLoader.php";
$includer = new ClassLoader();
$files = $includer->ClassLoader();

$height = $_POST["height"];
$width = $_POST["width"];

echo "<input type=hidden name=height value=$height/><input type=hidden name=width value=$width/>";

for($w = 0; $w < $width; $w++)
{
    for ($h = 0; $h < $height; $h++)
    {
        echo "<input type=checkbox name=checkbox[$h][$w] value=1>";
    }
    echo "<br />";
}
echo "<p>Ausgabeformat:</p>";
foreach($files as $file)
{
    $className = str_replace(".php", "", $file);
    $outputPlugin = new $className($height, $width); //TODO: Constructor at this point unnecessary
    if ($outputPlugin instanceof BaseOutput)
    {
        $var = $outputPlugin->buttonName();
        echo "<input type=submit name=$var value=$var>";
    }
    else
    {
        echo "Fatal Error: Du dumme Nuss hast das OutputPlugin nicht von BaseOutput abgeleitet!";
    }
}
?>
</form>