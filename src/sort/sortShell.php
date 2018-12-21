<?php
/**
 * 希尔排序（Shell Sort）： 数据已经排好的情况，插入排序非常有效率，因为不需要执行太多的数据搬移操作。"希尔排序法"是D.L.Shell在1959年发明的排序法，可以减少插入排序中数据搬移的次数。
 * 排序原则是将数据区分成特点间隔的几个小区块，以插入排序法完成区块内的数据后在渐渐减少间隔的距离。
 *
 * 时间复杂度：O(N3/²)
 * 空间复杂度：一个额外空间，空间复杂度最佳
 * 是否稳定： 是
 *
 * Created At 2018/12/21.
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
function sortShell(&$sourceVal)
{
    $k = 1; // 打印计数
    $count = count($sourceVal);
    $jmp = floor($count / 2);
    while ($jmp != 0) {
        for ($i = $jmp; $i < $count; $i += $jmp) { // $i为扫描次数，$jmp为设置间距位移量
            $tem = $sourceVal[$i]; // $tem 用来暂存数据
            $j = $i - $jmp; // 以$j来定位比较的元素
            while ($j >= 0 && $tem < $sourceVal[$j]) {
                $sourceVal[$j + $jmp] = $sourceVal[$j];
                $j = $j - $jmp;
            }
            $sourceVal[$jmp + $j] = $tem;
        }
        printf("第 %d 此排序过程：\n", $k);
        $k++;
        echo implode(' ', $sourceVal)."\n";
        echo "-----------------------------------------------\n";
        $jmp = floor($jmp / 2);
    }
}

// 开始排序
echo "原始数据\n";
echo implode(' ', $sourceVal)."\n";
sortShell($sourceVal);
echo "排序结果\n";
echo implode(' ', $sourceVal)."\n";