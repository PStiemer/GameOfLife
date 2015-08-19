<?PHP
class Algorithm
{
    function fillArray($_startPos, $_height, $_width)
    {
        for ($w = 0; $w < $_height; $w++) {
            for ($h = 0; $h < $_width; $h++) {
                if (!isset($_startPos[$w][$h])) {
                    $_startPos[$w][$h] = "O";
                }
            }
        }
        return $_startPos;
    }

    function countNeighbors($_height, $_width, $_cells) //counts neighbors
    {
        $neighborCounter = 0;

        if (isset($_cells[$_height - 1][$_width]) && $_cells[$_height - 1][$_width] == "X") $neighborCounter++; //up

        if (isset($_cells[$_height - 1][$_width + 1]) && $_cells[$_height - 1][$_width + 1] == "X") $neighborCounter++; //up right

        if (isset($_cells[$_height][$_width + 1]) && $_cells[$_height][$_width + 1] == "X") $neighborCounter++; //right

        if (isset($_cells[$_height + 1][$_width + 1]) && $_cells[$_height + 1][$_width + 1] == "X") $neighborCounter++; //down right

        if (isset($_cells[$_height + 1][$_width]) && $_cells[$_height + 1][$_width] == "X") $neighborCounter++; //down

        if (isset($_cells[$_height + 1][$_width - 1]) && $_cells[$_height + 1][$_width - 1] == "X") $neighborCounter++; //down left

        if (isset($_cells[$_height][$_width - 1]) && $_cells[$_height][$_width - 1] == "X") $neighborCounter++; //left

        if (isset($_cells[$_height - 1][$_width - 1]) && $_cells[$_height - 1][$_width - 1] == "X") $neighborCounter++; //left up

        return $neighborCounter;

    }

    function scan($_height, $_width, $_cells) // checks the value of every cell and evaluates if someone dies, gets born or stays alive.
    {
        if (isset($nextGen)) {
            unset($nextGen); // clearing the old status of nextGen because it only saves status changes and not the whole board
        }

        for ($h = 0; $h < $_height; $h++) {
            for ($w = 0; $w < $_width; $w++) {
                if ($_cells[$h][$w] == "X") {
                    $neighbors = $this->countNeighbors($h, $w, $_cells);

                    if ($neighbors >= 0 && $neighbors < 2) {
                        $nextGen[$h][$w] = "O";
                    } elseif ($neighbors == 2 || $neighbors == 3) {
                        $nextGen[$h][$w] = "X";
                    } elseif ($neighbors > 3 && $neighbors < 9) {
                        $nextGen[$h][$w] = "O";
                    }
                } elseif ($_cells[$h][$w] == "O") {
                    $neighbors = $this->countNeighbors($h, $w, $_cells);

                    if ($neighbors == 3) {
                        $nextGen[$h][$w] = "X";
                    } else {
                        $nextGen[$h][$w] = "O";
                    }
                }
            }
        }
        return $nextGen;
    }
}

