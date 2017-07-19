<?php
/**
 *
 * Created At 2017/7/18 下午12:46.
 * User: kaiyanh <nzing@aweb.cc>
 */

/**
 * 简单实现桶排序.
 * 存在问题：灵活度不够，非常浪费空间
 *
 * @param array $arr 要排序的数组.
 * @param string $sort 排序方式[desc,asc].
 *
 * @return array
 */
function sortSimpleBucket($arr, $sort = 'asc')
{
    $max = max($arr);
    $book = $result = array();
    // 初始化桶.
    for ($i = 0; $i <= $max; $i++) {
        $book[$i] = 0;
    }
    // 判断每个数据的数量.
    foreach ($arr as $value) {
        $book[$value]++; // 进行计数。
    }
    // 根据桶内装入数量进行排序返回.
    if ($sort == 'asc') {
        for ($i = 0; $i <= $max; $i++) { //依次判断所用的桶。
            for ($j = 1; $j <= $book[$i]; $j++) { //桶里面有几个数据就输出几个。
                array_push($result, $i);
            }
        }
    } else {
        for ($i = $max; $i >= 0; $i--) { //依次判断所用的桶。
            for ($j = 1; $j <= $book[$i]; $j++) { //桶里面有几个数据就输出几个。
                array_push($result, $i);
            }
        }
    }
    return $result;
}

$arr = [1, 3, 6, 754, 2, 4, 6, 43];
$res = sortSimpleBucket($arr);
$res2 = sortSimpleBucket($arr, 'desc');
var_dump($res, $res2);
