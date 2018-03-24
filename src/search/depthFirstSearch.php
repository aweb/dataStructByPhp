<?php
/**
 * 万能的搜索 -- 深度优先搜索（Depth First Search）
 *
 * Created At 2018/3/24 下午5:41.
 * User: kaiyanh <nzing@aweb.cc>
 */

$books = $result = $box = [];
$arr = [1, 2, 3];
// 卡片拿到手上
foreach ($arr as $value) {
    $books[$value] = 0;
}

/**
 * 输入一个数组求数组的全排列； 如：123，132，213，231……
 * 假如有编号为1,2,3 的三张卡片和编号为1，2，3的三个盒子
 *
 * @param int   $step   当前在哪个盒子
 * @param array $arr    要排列的数字
 * @param array $result 返回的结果
 * @param array $books  手上的卡片
 * @param array $box    盒子
 *
 */
function dfs(int $step, $arr, &$result, &$books, &$box)
{
    $n = count($arr);
    if ($step == $n + 1) { // 如果站在第n+1个盒子面前，则表示前n个盒子已经放好卡片
        // 输出第一中排列（1-n号盒子中的卡片编号）
        $str = '';
        for ($i = 1; $i <= $n; $i++) {
            $str .= $box[$i];
        }
        array_push($result, $str);
        return $result; // 返回之前的一步（最近一次调用dfs函数的能力）
    }
    // 此时站在第step个盒子面前，因该放哪张卡片
    // 按照1,2,3……，n的顺序一一尝试
    foreach ($arr as $i) {
        // 判断卡片$i 是否还在手上
        if ($books[$i] == 0) { // $books[$i] 等于0表示$i号卡片在手上
            // 开始尝试使用卡片$i
            $box[$step] = $i; // 将$i号卡片放入第$step个盒子中
            $books[$i] = $i; // 将$books[$i]设为1，表示$i号卡片已经不在手上

            // 第$step个盒子已经放好卡片，接下来需要走到下一个盒子面前
            dfs($step + 1, $arr, $result, $books, $box); // 这里通过函数的递归调用来实现
            $books[$i] = 0; // 这是非常重要的一步，一定要将刚才尝试的卡片收回，才能进行下一次尝试
        }
    }
}

// 调用方法
dfs(1, $arr, $result, $books, $box);
var_dump($result);

/*=======================XXX+XXX=XXX====================*/
$a = $book = [];
for ($i = 1; $i <= 9; $i++) {
    $book[$i] = 0;
}
$total = 0;
/**
 * 手中有编号为1～9的九张卡片，然后将张九张卡片放在九个盒子中，使XXX+XXX=XXX成立
 *
 * @param  integer $step
 * @param  array   $book
 * @param  integer $total
 * @param array    $a
 */
function dfsExhaustion($step, &$book, &$total, &$a)
{
    if ($step == 10) { // 如果站在第10个盒子面前，则表示前9个盒子已经放好卡片
        // 判断等式是否成立
        if ($a[1] * 100 + $a[2] * 10 + $a[3] + $a[4] * 100 + $a[5] * 10 + $a[6] == $a[7] * 100 + $a[8] * 10 + $a[9]) {
            $total++;
            // 如果满足要求，可行解+1,并打印这个解
            printf("%d%d%d + %d%d%d = %d%d%d \n", $a[1], $a[2], $a[3], $a[4], $a[5], $a[6], $a[7], $a[8], $a[9]);
        }
        return; // 返回之前的一步（最近调用的地方）
    }
    // 此时站在第step个盒子面前，因该放哪张卡片
    // 按照1,2,3……，n的顺序一一尝试
    for ($i = 1; $i <= 9; $i++) {
        // 判断卡片$i是否还在手上
        if ($book[$i] == 0) { // $book[$i]为0表示卡片还在手上
            // 开始尝试卡片$i
            $a[$step] = $i; // 将卡片$i放到第$step盒子中
            $book[$i] = 1;

            // 第$step个盒子已经放置好卡片，走到下一个盒子面前
            dfsExhaustion($step + 1, $book, $total, $a);
            // 这里使非常重要的一步，一定要将刚才尝试的卡片收回，才能进行下一次尝试
            $book[$i] = 0;
        }
    }
    return;
}

dfsExhaustion(1, $book, $total, $a);
printf("total=%d \n", $total / 2);