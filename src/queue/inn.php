<?php
/**
 * 栈-后进先出的数据结构
 * 概念：栈限定只能在一端进行插入和删除操作，比如说有一个直径只能放一个小球的小桶，依次放入2、1、3号小球。
 * 假如需要拿出2号小球，必须先取出3号小球，在拿出1号小球，最后才能将2号小球取出。即最先进最后出。
 *
 * Created At 2017/8/2 下午12:59.
 * User: kaiyanh <hongkaiyan@pxsj.com>
 */


/**
 * 栈 - 判断回文字符串
 *
 * 回文字符串示例：deed，level，记书记……
 *
 * @param string $str 原始数据
 *
 * @return boolean
 */
function palindromeByInn($str)
{
    if (empty($str)) {
        return false;
    }
    $strlen = strlen($str);
    $mid = $strlen / 2 - 1; //求字符串的中间点
    $inn = [];
    // 将mid之前的字符依次入栈
    $top = 0;// 栈初始化
    for ($i = 0; $i <= $mid; $i++) {
        $inn[++$top] = $str[$i];
    }
    // 判断字符串是基数还是偶数，并找出需要进行字符串匹配的起始下标
    if ($strlen % 2 == 0) {
        $next = $mid + 1;
    } else {
        $next = $mid + 2;
    }
    $next = floor($next);
    // 开始匹配
    for ($i = $next; $i <= $strlen - 1; $i++) {
        if (@$str[$i] != $inn[$top]) {
            break;
        }
        $top--;
    }
    if ($top == 0) {
        return 'YES';
    } else {
        return 'NO';
    }
    return floor($next);


}


echo palindromeByInn('abc');
echo "\n";
echo palindromeByInn('ab');
echo "\n";
echo palindromeByInn('aba');
echo "\n";
echo palindromeByInn('level');
echo "\n";
