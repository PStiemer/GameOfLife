<?PHP

class TextfileInput extends BaseInput
{
    private $matrixDimensions;

    function __construct()
    {
        BaseInput::__construct();

        $this->height = 0;
        $this->width = 0;

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
                $this->width = strlen($line);
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
                if(isset($var))
                {
                    echo "<input type=submit name=$var value=$var>";
                }
            }
        }
    }

    function buttonName()
    {
        return "Textfile";
    }
}