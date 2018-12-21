<?php
/**
 * 深度优先算法 - 邻接矩阵遍历(城市地图)
 *
 * Created At 2018/8/16.
 * User: kaiyanh <nzing@aweb.cc>
 */

$book = []; // 哪些点已经访问
$n = 5; //顶点总数
$min = 9999999;

// 图的边（邻接矩阵）∞-无穷大
$map = [
    [0, 2, 4, '∞', 10],
    [2, 0, 3, '∞', 7],
    [4, 3, 0, 4, 3],
    ['∞', '∞', 4, 0, 5],
    [10, 7, 3, 5, 0],
];

$resultMap = [];

/**
 * 图遍历
 *
 * @param integer $cur 当前所在顶点编号
 * @param integer $dis 当前已经走过的路程
 */
function dfs(int $cur, int $dis)
{
    global $n, $min, $map, $book, $resultMap;
    // 当前距离大于之前找到的最小路径，则立即返回
    if ($dis > $min) {
        $tem = null;
        return;
    }
    if ($cur == $n) { // 判断是否到达
        if ($dis < $min) {
            $min = $dis; // 更新最小值
        }
        $tem = null;
        return;
    }
    $tem = null;
    // 从1号顶点到n号顶点依次尝试，看哪些顶点与当前顶点$cur有边相连
    for ($i = 1; $i <= $n; $i++) {
        if ($tem == null) {
            $tem = $i.">>";
        }
        //echo $i.'<cur>'.$cur.'<dis>'.$dis.'<min>'.$min.'<value>'.$map[$cur - 1][$i - 1].'<book>'.$book[$i]."\n";
        if ($map[$cur - 1][$i - 1] != '∞' && $book[$i] == 0) {
            $book[$i] = 1;
            $tem .= $i.'>>';
            dfs($i, $dis + $map[$cur - 1][$i - 1]);
            $book[$i] = 0;
        }
    }
    $resultMap[] = $tem;
    $tem = null;
    return;
}

// 开始运行
for ($i = 1; $i <= $n; $i++) {
    $book[$i] = 0;
}
$book[1] = 1; //标记1号顶点已经访问
dfs(1, 0); // 从一号顶点开始遍历
printf("1~5城市最短路径为： %s \n", $min);
print_r($resultMap);