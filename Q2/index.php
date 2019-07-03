<?php

$matrix = [
    [0, 1, 0, 0, 1],
    [0, 1, 1, 0, 0],
    [0, 0, 0, 1, 1],
    [0, 0, 0, 1, 0]
];

showMatrix($matrix);
$countIslands = countIslands($matrix);
echo '<p>Количество островов: ' . $countIslands . '</p>';

/**
 * Функция отображения матрицы (1 - остров, 0 - вода)
 *
 * @param array $matrix
 * @return void
 */
function showMatrix(array $matrix): void
{
    ?>
    <style>
        table {
            border-collapse: collapse;
        }
        td {
            border: 2px solid black;
            padding: 5px;
        }
    </style>
    <table>
        <tbody>
        <?php foreach ($matrix as $array): ?>
            <tr>
                <?php foreach ($array as $value): ?>
                    <td><?php echo $value; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php
}

/**
 * Функция подсчёта количества островов
 * Острова могут иметь ломаную форму
 *
 * @param array $matrix
 * @return int
 */
function countIslands(array $matrix): int
{
    $countIslands = 0;
    for ($i = 0; $i < count($matrix); $i++) {
        for ($j = 0; $j < count($matrix[$i]); $j++) {
            //Если значение в индексе [$i][$j] === 1, значит это остров.
            //Нам остаётся вычислить его границы и стереть его из матрицы.
            //Для этого применяем алгоритм заливки изображения.
            if ($matrix[$i][$j] === 1) {
                $matrix = deleteIsland($matrix, $i, $j);
                $countIslands++;
            }
        }
    }
    return $countIslands;
}

/**
 * Функция вычисления границ острова и удаления его из матрицы через алгоритм заливки изображения
 *
 * @param array $matrix
 * @param int $i
 * @param int $j
 * @return array
 */
function deleteIsland(array $matrix, int $i, int $j): array
{
    if ($matrix[$i][$j] === 1) {
        $matrix[$i][$j] = 0;
        $matrix = deleteIsland($matrix, $i + 1, $j);
        $matrix = deleteIsland($matrix, $i - 1, $j);
        $matrix = deleteIsland($matrix, $i, $j + 1);
        $matrix = deleteIsland($matrix, $i, $j - 1);
    }
    return $matrix;
}
?>