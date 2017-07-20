<?php
/**
 * 冒泡排序
 *
 * 复杂度：O(N^2)
 * 基本思想：每次比较两个相邻的元素，如果它们的顺序错误就交换位置
 * 核心：双重嵌套循环
 *
 * Created At 2017/7/19.
 * User: kaiyanh <nzing@aweb.cc>
 */

/**
 * 冒泡排序(纯数字)
 *
 * 复杂度：O(N^2)
 * 基本思想：每次比较两个相邻的元素，如果它们的顺序错误就交换位置。
 *
 * @param array $arr 要排序的数组[1,3,544,23,343].
 * @param string $sort 排序方式[desc,asc].
 *
 * @return array
 */
function sortbubbing($arr, $sort = 'asc')
{
    $count = count($arr);
    // 冒泡排序的核心实现
    for ($i = 0; $i < $count - 1; $i++) { //n个数排序，制进行n-1趟
        for ($j = 0; $j < $count - 1; $j++) {
            // 比较大小并交换.
            if ($sort == 'asc') {
                if ($arr[$j] > $arr[$j + 1]) {
                    $t = $arr[$j + 1];
                    $arr[$j + 1] = $arr[$j];
                    $arr[$j] = $t;

                }
            } else {
                if ($arr[$j] < $arr[$j + 1]) {
                    $t = $arr[$j + 1];
                    $arr[$j + 1] = $arr[$j];
                    $arr[$j] = $t;

                }
            }
        }
    }
    return $arr;
}

/**
 * 冒泡排序(键值对)
 *
 * 复杂度：O(N^2)
 * 基本思想：每次比较两个相邻的元素，如果它们的顺序错误就交换位置。
 *
 * @param array $arr 要排序的数组array(0=> array('name'=>'ben','age'=>18),1=>array('name'=>'tony','age'=>12)).
 * @param string $sort 排序方式[desc,asc].
 *
 * @return array
 */
function sortbubbingByKey($arr, $key, $sort = 'asc')
{
    $count = count($arr);
    // 冒泡排序的核心实现
    for ($i = 0; $i < $count - 1; $i++) { //n个数排序，制进行n-1趟
        for ($j = 0; $j < $count - 1; $j++) {
            // 比较大小并交换.
            if ($sort == 'asc') {
                if ($arr[$j][$key] > $arr[$j + 1][$key]) {
                    $t = $arr[$j + 1];
                    $arr[$j + 1] = $arr[$j];
                    $arr[$j] = $t;

                }
            } else {
                if ($arr[$j][$key] < $arr[$j + 1][$key]) {
                    $t = $arr[$j + 1];
                    $arr[$j + 1] = $arr[$j];
                    $arr[$j] = $t;

                }
            }
        }
    }
    return $arr;
}

// 验证结果
$arr = [1, 3, 6, 754, 2, 4, 6, 43];
$res = sortbubbing($arr);
$res2 = sortbubbing($arr, 'desc');
var_dump($res, $res2);
// 验证结果
$arr2 = [
    0 => ['name' => 'ben', 'age' => 18],
    1 => ['name' => 'tony', 'age' => 34],
    2 => ['name' => 'nzing', 'age' => 3]
];
$res = sortbubbingByKey($arr2, 'age');
$res2 = sortbubbingByKey($arr2, 'age', 'desc');
var_dump($res, $res2);



