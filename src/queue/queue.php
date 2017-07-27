<?php
/**
 * 队列.
 *
 * 概念：队列是一种特殊的线性结构，他允许俄在队列的首部(head)进行删除（出队），而在尾部(tail)插入（入队）；
 * 当队列中没有元素时（即head=tail）,称只为空队列；
 * 生活中队列符合队列的情况，比如买票。每个排队买票的窗口就是一个队列，在这个队列中新来的人总是站在队列的最后面，来的越早的人越靠前。
 * 先来的人先服务，称之为"先进先出"（First In First Out, FIFO）原则。
 *
 *
 * Created At 2017/7/27.
 * User: kaiyanh <nzing@aweb.cc>
 */

/**
 * 队列- 解密QQ号
 *
 * 加密结果：631758924
 * 解密算法：首先删除第1个数，在将第2个数放到这串数字的末尾；在将第3个数删除并将第4个数放到末尾……，直到剩下最后一个数并删除。
 * 按照删除顺序把这些数字链接起来即是加密前的QQ号.
 *
 * @param array $arr 原始数据[6,3,1,7,5,8,9,2,4].
 *
 * @return array
 */
function queue($arr)
{
    $head = 0; //第一个元素
    $tail = count($arr); // 计算数组数量，当前数组有9个元素，tail指向队列的最后一个位置
    $result = [];
    while ($head < $tail) {
        // 取出队首，并将队首出队
        array_push($result, $arr[$head]);
        $head++;
        // 先将队首放到队尾
        $arr[$tail] = $arr[$head];
        $tail++;
        // 在将队尾出队
        $head++;
    }
    return $result;

}

// 验证结果
$testArr = [6, 3, 1, 7, 5, 8, 9, 2, 4];
$res = queue($testArr);
print_r($res);