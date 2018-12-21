<?php
/**
 * 选择排序（Selection Sort）： 在所有的数据中，从大到小的排序，将最大值放在第一个位置，在从第二项开始挑选一个最大值放到第二位，以此重复，直到完成排序.
 * 时间复杂度：O(N²)
 * 空间复杂度：一个额外空间，空间复杂度最佳
 * 是否稳定： 否
 *
 * Created At 2018/12/19.
 * User: kaiyanh <nzing@aweb.cc>
 */
$sourceVal = [16, 25, 39, 27, 12, 63, 8, 45];

/**
 * 选择排序【ASC】
 *
 * @param array $sourceVal 需要排序的原始数据
 *
 * @return array
 *
 */
function sortSelect(&$sourceVal)
{
    $count = count($sourceVal);
    for ($i = 0; $i < $count; $i++) {
        for ($j = $i + 1; $j < $count; $j++) {
            if ($sourceVal[$i] > $sourceVal[$j]) { // 比较第i个和第j个元素大小
                $t = $sourceVal[$i];
                $sourceVal[$i] = $sourceVal[$j];
                $sourceVal[$j] = $t;
            }
        }
    }
}

// 开始排序
sortSelect($sourceVal);

print_r($sourceVal);