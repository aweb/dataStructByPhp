<?php
/**
 * 插入排序（Insert Sort）： 将数组中的元素逐一与已排序好的数据进行比较，前两个元素先排好，在将第三个元素插入适当位置。所以这三个元素仍然是已排序好的，接着第四个元素加入，重复此步骤直至排序完成。
 * 时间复杂度：O(N²)，最好时间复杂度是O(N)
 * 空间复杂度：一个额外空间，空间复杂度最佳
 * 是否稳定： 是
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
function sortInsert(&$sourceVal)
{
    $count = count($sourceVal);
    for ($i = 1; $i < $count; $i++) {
        $tem = $sourceVal[$i];
        $now = $i - 1;
        while ($now >= 0 && $tem < $sourceVal[$now]) {
            $sourceVal[$now + 1] = $sourceVal[$now];
            $now -= 1;
        }
        $sourceVal[$now + 1] = $tem;

    }
}

// 开始排序
sortInsert($sourceVal);

print_r($sourceVal);