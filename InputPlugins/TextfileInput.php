<?PHP

/**
 * Class TextfileInput.
 * InputPlugin that reads a textfile to get the startingpositions of the cells
 */
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

    /**
     * echoes a text input field "Number of Generations"
     */
    function numberOfGenerations()
    {
        echo "<p>Anzahl der Generationen: <input type=text name=numGeneration /></p>";
    }

    /**
     * @return 2-Dimensional array of living and dead cells
     * reads inputfile.txt
     * $height will become the number of lines
     * $width will become the number of chars in a line
     */
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

    /**
     * saves $height and $width in hidden fields so that it can be received via POST
     */
    function getMatrixDimensions()
    {
        echo "<input type=hidden name=height value=$this->height/><input type=hidden name=width value=$this->width/>";
    }

    /**
     * generates buttons for the output type based off installed OutputPlugins
     */
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

    /**
     * name of the InputPlugin-Button
     * @return "Textfile"
     */
    function buttonName()
    {
        return "Textfile";
    }
}