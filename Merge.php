<?php
/**
 * Created by PhpStorm.
 * User: murat
 * Date: 10.12.18
 * Time: 20:56
 *
 * Original example - https://www.w3resource.com/php-exercises/searching-and-sorting-algorithm/searching-and-sorting-algorithm-exercise-17.php
 */

class Merge
{
    protected $array;

    public function __construct($array)
    {
        $this->array = $array;
    }

    public function splice($array)
    {
        //If this is last element
        if (count($array) == 1) {
            return $array;
        }

        //Explode array
        $middle = count($array) / 2;
        $left = array_slice($array, 0, $middle);
        $right = array_slice($array, $middle);

        //Recursive sort
        $left = $this->splice($left);
        $right = $this->splice($right);

        //Merge and return
        return $this->merge($left, $right);
    }

    public function merge($left, $right)
    {
        $result = array();
        while (count($left) > 0 && count($right) > 0) {
            if ($left[0] > $right[0]) {
                $result[] = $right[0];
                $right = array_slice($right, 1);
            } else {
                $result[] = $left[0];
                $left = array_slice($left, 1);
            }
        }
        while (count($left) > 0) {
            $result[] = $left[0];
            $left = array_slice($left, 1);
        }
        while (count($right) > 0) {
            $result[] = $right[0];
            $right = array_slice($right, 1);
        }
        return $result;
    }

    public function getArray()
    {
        return $this->splice($this->array);
    }
}

$test_array = array(100, 54, 7, 2, 5, 4, 1);
echo "Original Array : ";
echo implode(', ', $test_array);
echo "\nSorted Array :";
$merge = new Merge($test_array);
echo implode(', ', $merge->getArray()) . "\n";