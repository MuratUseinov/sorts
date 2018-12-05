<?php
/**
 * Created by PhpStorm.
 * User: murat
 * Date: 05.12.18
 * Time: 21:17
 */

//Asymptotics is twice faster then bubble in worst case
class Shaker
{
    public static function sortWithFor(&$array)
    {
        $size = count($array) - 1;
        for ($i = 0; $i < $size; $i++) {
            $j = 0;
            while($j < ($size - $i)) {
                $k = $j + 1;
                if ($array[$k] < $array[$j]) {
                    list($array[$j], $array[$k]) = array($array[$k], $array[$j]);
                }
                $j++;
            }
            while($j > $i) {
                $k = $j - 1;
                if ($array[$k] > $array[$j]) {
                    list($array[$j], $array[$k]) = array($array[$k], $array[$j]);
                }
                $j--;
            }

        }
        return $array;
    }
}

$array = [156, 0, 3, 1, 9, 2, 5, 6, 8, 0, 100, 3, 1, 9, 2, 5, 6, 8, 7, 7, 7, 7, 7];
Shaker::sortWithFor($array);
print_r($array);