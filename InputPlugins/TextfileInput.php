<?PHP

class TextfileInput extends BaseInput
{
    private $matrixDimensions;

    function __construct($_height, $_width)
    {
        BaseInput::__construct();

        $this->height = $_height;
        $this->width = $_width;

        $this->matrixDimensions;
    }

    function numberOfGenerations()
    {
        echo "<p>Anzahl der Generationen: <input type=text name=numGeneration /></p>";
    }

    function startingMatrix()
    {
        $handle = fopen("inputfile.txt", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $initCells[$this->height] = str_split($line);
                $this->height++;
                $this->width = strlen($line) -2;
            }
            fclose($handle);
        }
        return $initCells;
    }

    function getMatrixDimensions()
    {
        echo "<input type=hidden name=height value=$this->height/><input type=hidden name=width value=$this->width/>";
    }

    function outputFormat()
    {
        echo "<p>Ausgabeformat:</p>";
        foreach ($this->files as $file) {
            $className = str_replace(".php", "", $file);
            $outputPlugin = new $className($this->height, $this->width);
            if ($outputPlugin instanceof BaseOutput) {
                $var = $outputPlugin->buttonName();
                echo "<input type=submit name=$var value=$var>";
            }
        }
    }

    function buttonName()
    {
        return "Textfile";
    }
}