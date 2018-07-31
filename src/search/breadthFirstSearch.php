<?php
/**
 * 万能的搜索 -- 广度优先搜索也称为宽度优先搜索（Breadth First Search）
 *
 * 设置5行*4列的迷宫，设置目标点(p,q),从开始点(startX,startY) 开始搜索，找到最短路径
 *
 *
 * Created At 2018/7/31.
 * User: kaiyanh <nzing@aweb.cc>
 */

// 存储队列
$que = [
    'y' => 0, //横坐标
    'x' => 0, // 纵坐标
    'f' => 0, // 父亲在队列中的标号
    's' => 0 // 步数
];

// 迷宫地图 [0-表示空地 1-障碍物]
$n = 5; // 行
$m = 4; // 列
$map = [
    [0, 0, 1, 0],
    [0, 0, 0, 0],
    [0, 0, 1, 0],
    [0, 1, 0, 0],
    [0, 0, 0, 1],
];
// 预先生成10*10 的储物格 book
$book = [];
for ($i = 0; $i <= 10; $i++) {
    for ($j = 0; $j <= 10; $j++) {
        $book[$i][$j] = 0;
    }
}

// 走的方向的数组
$next = [
    [0, 1], // 向右走
    [1, 0], // 向下走
    [0, -1], // 向左走
    [-1, 0] // 向上走
];

// 相关初始化操作
$head = $tail = $startX = $startY = 1;
$flag = $tx = $ty = 0; // 标记是否达到目标点
$book[$startX][$startY] = 1; // 开始点
// 目标位置
$p = 4;
$q = 3;

$que[$tail]['x'] = $startX;
$que[$tail]['y'] = $startY;
$que[$tail]['f'] = 0;
$que[$tail]['s'] = 0;
$tail++;

// 当队列不为空的时候循环
while ($head < $tail) {
    // 枚举4个方向
    for ($k = 0; $k <= 3; $k++) {
        // 计算下一个点的坐标
        $tx = $que[$head]['x'] + $next[$k][0];
        $ty = $que[$head]['y'] + $next[$k][1];
        // 判断是否越界
        if ($tx < 1 || $tx > $n || $ty < 1 || $ty > $m) {
            continue;
        }
        // 判断是否是障碍物或已经在路径中
        // php地图数组下标是从0开始
        if ($map[$tx-1][$ty-1] == 0 && $book[$tx][$ty] == 0) {
            // 标记当前点已经走过
            $book[$tx][$ty] = 1;
            // 插入到新队列
            $que[$tail]['x'] = $tx;
            $que[$tail]['y'] = $ty;
            $que[$tail]['f'] = $head;
            $que[$tail]['s'] = $que[$head]['s'] + 1;
            $tail++;
        }
        // 如果到达目标点，停止拓展，任务结束，退出循环
        if ($tx == $p && $ty == $q) {
            $flag = 1;
            break;
        }
    }
    if ($flag == 1) {
        break;
    }
    $head++; // 一个点拓展结束后，head++ 对后面的点拓展
}
// 输出进行步数
echo "找到目标点： ".$p.'<>'.$q." 最少需要进行： ".$que[$tail - 1]['s']."步 \n";
