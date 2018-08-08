<?php
/**
 * 广度优先算法 - 邻接矩阵便利
 *
 * Created At 2018/8/8.
 * User: kaiyanh <nzing@aweb.cc>
 */

$book = []; // 哪些点已经访问
$sum = 1; // 已经访问过多少顶点
$n = 5; //顶点总数
$que = []; // 队列
$head = 1;
$tail = 1;

// 图的边（邻接矩阵）99999-无穷大
$map = [
    [0, 1, 1, 99999, 1],
    [1, 0, 99999, 1, 99999],
    [1, 99999, 0, 99999, 1],
    [99999, 1, 99999, 0, 99999],
    [1, 99999, 1, 99999, 0],
];


// 开始运行
$que[$tail] = 1;
$tail++;
for ($i = 1; $i <= $n; $i++) {
    $book[$i] = 0;
}
$book[1] = 1;

// 队列不为空时候循环
while ($head < $tail && $tail <= $n) {
    $cur = $que[$head]; // 当前顶点
    // 从1~n依次尝试
    for ($i = 1; $i <= $n; $i++) {
        if ($map[$cur - 1][$i - 1] == 1 && $book[$i] == 0) {
            $que[$tail] = $i;
            $tail++;
            $book[$i] = 1;
        }
        if ($tail > $n) {
            break;
        }
    }
    $head++;
}

for ($i = 1; $i < $tail; $i++) {
    printf("%d \n", $que[$i]);
}