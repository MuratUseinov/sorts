<?php
/**
 * Created by PhpStorm.
 * User: murat
 * Date: 04.12.18
 * Time: 18:15
 */

//Asymptotics is in worst case – O(n2), in best case – O(n).
class Bubble
{
    public static function sortWithForeach(&$array)
    {
        foreach ($array as $firstKey => $item) {
            foreach ($array as $secondKey => $nextItem) {
                if (isset($array[$secondKey + 1])) {
                    if ($array[$secondKey] > $array[$secondKey + 1]) {
                        list($array[$secondKey], $array[$secondKey + 1]) = array($array[$secondKey + 1], $array[$secondKey]);
                        continue;
                    }
                }
            }
        }
    }

    public static function sortWithFor(&$array)
    {
        $size = count($array) - 1;
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size - $i; $j++) {
                $k = $j + 1;
                if ($array[$k] < $array[$j]) {
                    list($array[$j], $array[$k]) = array($array[$k], $array[$j]);
                }
            }
        }
        return $array;
    }
}

$array = [156, 0, 3, 1, 9, 2, 5, 6, 8, 0, 100, 3, 1, 9, 2, 5, 6, 8, 7, 7, 7, 7, 7];
Bubble::sortWithFor($array);
print_r($array);

$array = [156, 0, 3, 1, 9, 2, 5, 6, 8, 0, 100, 3, 1, 9, 2, 5, 6, 8, 7, 7, 7, 7, 7];
Bubble::sortWithFor($array);
print_r($array);