<?php

namespace App;

class Inject
{
    /**
     * @param array $array
     * @param string $afterKey
     * @param string $newKey
     * @param  $newValue
     * @return array
     */
    public function injectAfter(array $array, string $afterKey, string $newKey,  $newValue): array
    {
        $newArray = []; $checkKey = false;
        foreach ($array as $key=>$item) {
            if ($key != $newKey) {
                $newArray[$key] = $item;
            }
            if ($key == $afterKey){
                $newArray[$newKey] = $newValue;
            }
            if ($afterKey != $key && $newKey !=$key) {
                $checkKey = true;
            }
        }
        if ($checkKey) {
            $newArray[$newKey] = $newValue;
        }

        return $newArray;
    }

}

$result = new Inject();
$array = ["foo" => 3, "bar" => 1];
$afterKey = 'foo';
$newKey = 'baz';
$newValue = 42;

echo json_encode($result->injectAfter($array, $afterKey, $newKey, $newValue));
// Result {"foo":3,"baz":42,"bar":1}
