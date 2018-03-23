<?php

/**
 * 设计模式---单例模式
 *
 * $_instance必须声明为静态的私有变量
 * 构造函数和析构函数必须声明为私有,防止外部程序new类从而失去单例模式的意义
 * getInstance()方法必须设置为公有的,必须调用此方法以返回实例的一个引用
 * ::操作符只能访问静态变量和静态函数
 * new对象都会消耗内存
 * 使用场景:最常用的地方是数据库连接。使用单例模式生成一个对象后，该对象可以被其它众多对象所使用。
 *
 * Created At 2018/3/22 下午4:55.
 * User: kaiyanh <nzing@aweb.cc>
 */
class singleInstance
{
    private static $_instance = null;

    private function __construct()
    {
        // nothing
    }

    public function __clone()
    {
        // throw Exception
        throw new Exception('Clone is not allow!');
    }

    // get Instance
    public static function getInstance()
    {
        if (!self::$_instance instanceof self) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    // test function
    public function test()
    {
        echo "验证成功 \n";
    }
}

// new 类要报错
//$sigle = new singleInstance();

// 单列方式调用
$sigle = singleInstance::getInstance();
$sigle->test();

// 复制(克隆)对象将导致一个
$clone  =  clone $sigle;