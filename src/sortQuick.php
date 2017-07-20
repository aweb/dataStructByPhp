<?php
/**
 * 快速排序
 *
 * 最大复杂度：O(N^2)，平均时间复杂度O(NlogN)
 * 基本思想：；快速排序是基于"二分"思想
 * 核心：每次排序设置一个基准点，将小于等于基点的数放在左边，将大于等于基点的数放在右边
 *
 * Created At 2017/7/20.
 * User: kaiyanh <nzing@aweb.cc>
 */

/**
 * 快速排序(纯数字)
 *
 * 最大复杂度：O(N^2)，平均时间复杂度O(NlogN)
 * 基本思想：；快速排序是基于"二分"思想
 * 核心：每次排序设置一个基准点，将小于等于基点的数放在左边，将大于等于基点的数放在右边
 *
 * @param array $arr 要排序的数组[6, 1,9, 2, 7, 3, 4, 5, 10, 8].
 * @param string $sort 排序方式[desc,asc].
 *
 * @return array
 */
function quickSort($arr, $sort = 'asc')
{
    // 匿名函数实现.
    $sortFun = function ($left, $right) use (&$arr, &$sortFun) {
        $i = $j = $baseNum = $tem = '';
        if ($left > $right) {
            return;
        }
        $baseNum = $arr[$left]; // $baseNum存的基准数
        $i = $left;
        $j = $right;
        while ($i != $j) {
            // 顺序很重要，从右往左找
            while ($arr[$j] >= $baseNum && $i < $j) {
                $j--;
            }
            // 在从左往右找
            while ($arr[$i] <= $baseNum && $i < $j) {
                $i++;
            }
            // 交换两个数在数组中的位置
            if ($i < $j) {
                $tem = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $tem;
            }
        }
        $arr[$left] = $arr[$i];
        $arr[$i] = $baseNum;

        $sortFun($left, $i - 1); // 继续处理左边的，这是一个递归的过程
        $sortFun($i + 1, $right); // 继续处理右边的，这是一个递归的过程
    };
    // 去数组第一位与最后一位调用排序方法
    $sortFun(0, count($arr) - 1);
    $result = array();
    if ($sort == 'desc') {
        for ($i = count($arr) -1; $i >= 0; $i--) {
               array_push($result, $arr[$i]);
        }
    } else {
        $result = $arr;
    }
    return $result;
}

$arr = [6, 1, 9, 2, 7, 3, 4, 5, 10, 8];
$res = quickSort($arr);
$res2 = quickSort($arr, 'desc');
var_dump($res, $res2);