<?php
/**
 * Created by PhpStorm.
 * User: murat
 * Date: 06.12.18
 * Time: 19:52
 */

//Asymptotics is in worst and middle case – O(n^2), in best case – O(n).
class Insertion
{
    public static function sort(&$array)
    {
        $result = [];
        foreach ($array as $item) {
            $result[$item] = $item;
        }
        ksort($result);
        $array = array_values($result);
    }
}

$array = [156, 0, 3, 1, 9, 2, 5, 6, 8, 0, 100, 3, 1, 9, 2, 5, 6, 8, 7, 7, 7, 7, 7];
Insertion::sort($array);
print_r($array);