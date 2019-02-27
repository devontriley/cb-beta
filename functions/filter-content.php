<?php
/**
 * Color $header periods red when last in string or before <br />
 * @param string $string String to match periods against
 * @param array $matches Types of periods to replace. ['beforeBR', 'end']
 * @return string $string String with red period html
 */
function colorPeriodsRed($string, $matches = array('end'))
{
    if(in_array('beforeBR', $matches))
    {
        $needle = ".<br />";
        $lastPos = 0;
        $positions = array();

        while (($lastPos = strpos($string, $needle, $lastPos))!== false) {
            $positions[] = $lastPos;
            $lastPos = $lastPos + strlen($needle);
        }

        for($i = count($positions); $i > 0; $i--) {
            $string = substr_replace($string, '<span class="text-red">.</span>', $positions[$i - 1], 1);
        }
    }

    if(in_array('end', $matches))
    {
        $string = (substr($string, -1, 1) === '.') ? substr_replace($string, '<span class="text-red">.</span>', -1, 1) : $string;
        $string = (substr($string, -1, 1) === '?') ? substr_replace($string, '<span class="text-red">?</span>', -1, 1) : $string;
    }

    return $string;
}

/**
 * Add .pure-css class to tables
 * @param string $string String to search for <table>
 * @return string $string Updated string
 */
function pureCSSTables($string)
{
    $needle = "<table";
    $lastPos = 0;
    $positions = array();

    while (($lastPos = strpos($string, $needle, $lastPos))!== false) {
        $positions[] = $lastPos;
        $lastPos = $lastPos + strlen($needle);
    }

    for($i = count($positions); $i > 0; $i--) {
        $string = substr_replace($string, '<table class="pure-table"', $positions[$i - 1], 1);
    }

    return $string;
}
?>