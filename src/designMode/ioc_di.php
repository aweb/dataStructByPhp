<?php
/**
 * 设计模式-控制反转（IoC）和依赖注入（DI）
 *
 * 来源：https://www.insp.top/article/learn-laravel-container
 *
 * Created At 2018/3/23 上午12:23.
 * User: kaiyanh <nzing@aweb.cc>
 */

/**
 * 超能力模组的规范、契约
 */
interface SuperModuleInterface
{
    /**
     * 超能力激活方法
     *
     * 任何一个超能力都得有该方法，并拥有一个参数
     *
     * @param array $target 针对目标，可以是一个或多个，自己或他人
     */
    public function activate(array $target);
}

/**
 * X-超能量
 */
class XPower implements SuperModuleInterface
{
    public function test()
    {
        echo "hello test \n";
    }

    public function activate(array $target)
    {
        echo "恭喜你获得X-超能量\n";
        if (!empty($target)) {
            foreach ($target as $key => $value) {
                echo $key . "<>" . $value . "\n";
            }
        }
    }
}

/**
 * 终极炸弹 （就这么俗）
 */
class UltraBomb implements SuperModuleInterface
{
    public function activate(array $target)
    {
        echo "恭喜你获得终极炸弹\n";
        if (!empty($target)) {
            foreach ($target as $key => $value) {
                echo $key . "<>" . $value . "\n";
            }
        }
    }
}

/**
 * 超人类
 */
class Superman
{
    public $module;

    public function __construct(SuperModuleInterface $module)
    {
        $this->module = $module;
    }
}

/**
 * 更为先进的工厂 —— IoC 容器
 */
class Container
{
    protected $binds;

    protected $instances;

    public function bind($abstract, $concrete)
    {
        if ($concrete instanceof Closure) {
            $this->binds[$abstract] = $concrete;
        } else {
            $this->instances[$abstract] = $concrete;
        }
    }

    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
        array_unshift($parameters, $this);

        return call_user_func_array($this->binds[$abstract], $parameters);
    }
}

// 创建一个容器（后面称作超级工厂）
$container = new Container;

// 向该 超级工厂添加超人的生产脚本
$container->bind('superman', function ($container, $moduleName) {
    return new Superman($container->make($moduleName));
});

// 向该 超级工厂添加超能力模组的生产脚本
$container->bind('xpower', function ($container) {
    return new XPower;
});

// 向该 超级工厂添加终极炸弹模组的生产脚本
$container->bind('ultrabomb', function ($container) {
    return new UltraBomb;
});

// ****************** 华丽丽的分割线 **********************
// 开始启动生产
$superman_1 = $container->make('superman', ['xpower']);
$superman_1->module->activate(['hello', 'worlds']);
$superman_1->module->test();
$superman_2 = $container->make('superman', ['ultrabomb']);
$superman_2->module->activate(['apple', 'orange']);