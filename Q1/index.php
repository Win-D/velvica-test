<?php

$firstArray = [1, 2, 3, 4, 5, 6, 7, 80];
$secondArray = [-10, -5, 10, 15, 100];
$increasingArray = getIncreasingArray($firstArray, $secondArray);
print_r($increasingArray);

/**
 * Функция получения объединённого неубывающего массива
 *
 * @param array $firstArray
 * @param array $secondArray
 * @return array
 */
function getIncreasingArray(array $firstArray, array $secondArray): array
{
    //Если оба массива являются неубывающими
    if (isIncreasingArray($firstArray) && isIncreasingArray($secondArray)) {
        //Так как значения в обоих массивах расположены по возрастанию (т.е. уже отсортированы),
        //не обязательно объединять массивы в один и отсортировывать значения в нём (например, пузырьковой сортировкой).
        //Вместо этого можно применить сортировку слиянием: просто проходим по обоим массивам, а затем - по каждому из них
        return makeIncreasingArray($firstArray, $secondArray);
    } else {
        echo '<p>Один из массивов (или оба из них) является убывающим</p>';
        return [];
    }
}

/**
 * Функция проверки, является ли массив неубывающим
 *
 * @param array $array
 * @return bool
 */
function isIncreasingArray(array $array): bool
{
    $value = $array[0];
    for ($i = 0; $i < count($array); $i++) {
        if ($value <= $array[$i]) {
            $value = $array[$i];
        } else {
            return false;
        }
    }
    return true;
}

/**
 * Функция получения результирующего неубывающего массива с помощью алгоритма сортировки слиянием
 *
 * @param array $firstArray
 * @param array $secondArray
 * @return array
 */
function makeIncreasingArray(array $firstArray, array $secondArray): array
{
    $sortedArray = [];
    $firstArrayIndex = 0;
    $secondArrayIndex = 0;
    $firstArrayLength = count($firstArray); //кол-во элементов в первом массиве
    $secondArrayLength = count($secondArray); //кол-во элементов во втором массиве

    //Проходим по двум массивам одновременно
    while ($firstArrayIndex < $firstArrayLength && $secondArrayIndex < $secondArrayLength) {
        if ($firstArray[$firstArrayIndex] < $secondArray[$secondArrayIndex]) {
            $sortedArray[] = $firstArray[$firstArrayIndex];
            $firstArrayIndex++;
        } else {
            $sortedArray[] = $secondArray[$secondArrayIndex];
            $secondArrayIndex++;
        }
    }

    //Массивы могут быть разной длины, поэтому после совместного прохода по ним, проходим отдельно по каждому из них
    while ($firstArrayIndex < $firstArrayLength) {
        $sortedArray[] = $firstArray[$firstArrayIndex];
        $firstArrayIndex++;
    }
    while ($secondArrayIndex < $secondArrayLength) {
        $sortedArray[] = $secondArray[$secondArrayIndex];
        $secondArrayIndex++;
    }

    return $sortedArray;
}