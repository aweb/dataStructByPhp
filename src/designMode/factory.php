<?php
/**
 * 设计模式---简单工厂模式
 *
 * 一个事例
 *
 * 一个农场，要向市场销售水果
 * 农场里有三种水果 苹果、葡萄
 * 我们设想：
 *       1、水果有多种属性，每个属性都有不同，但是，他们有共同的地方 | 生长、种植、收货、吃
 *       2、将来有可能会增加新的水果、我们需要定义一个接口来规范他们必须实现的方法
 *       3、我们需要获取某个水果的类，要从农场主那里去获取某个水果的实例，来知道如何生长、种植、收货、吃
 */


/**
 * 虚拟产品接口类
 * 定义好需要实现的方法
 */
interface fruit
{

    /**
     * 生长
     */
    public function grow();

    /**
     * 种植
     */
    public function plant();

    /**
     * 收获
     */
    public function harvest();

    /**
     * 吃
     */
    public function eat();

}

/**
 * 定义具体产品类 苹果
 * 首先，我们要实现所继承的接口所定义的方法
 * 然后定义苹果所特有的属性，以及方法
 */
class apple implements fruit
{

    //苹果树有年龄
    private $treeAge;

    //苹果有颜色
    //private $color;

    public function grow()
    {
        echo "apple grow \n";
    }

    public function plant()
    {
        echo "apple plant \n";
    }

    public function harvest()
    {
        echo "apple harvest \n";
    }

    public function eat()
    {
        echo "apple eat \n";
    }

    //取苹果树的年龄
    public function getTreeAge()
    {
        return $this->treeAge;
    }

    //设置苹果树的年龄
    public function setTreeAge($age)
    {
        $this->treeAge = $age;
        return trie;
    }

}

/**
 * 定义具体产品类 葡萄
 * 首先，我们要实现所继承的接口所定义的方法
 * 然后定义葡萄所特有的属性，以及方法
 */
class grape implements fruit
{

    //葡萄是否有籽
    private $seedLess;

    public function grow()
    {
        echo "grape grow \n";
    }

    public function plant()
    {
        echo "grape plant \n";
    }

    public function harvest()
    {
        echo "grape harvest \n";
    }

    public function eat()
    {
        echo "grape eat \n";
    }

    //有无籽取值
    public function getSeedLess()
    {
        return $this->seedLess;
    }

    //设置有籽无籽
    public function setSeedLess($seed)
    {
        $this->seedLess = $seed;
        return true;
    }
}

/**
 *农场主类 用来获取实例化的水果
 *
 */
class farmer
{

    //定义个静态工厂方法
    public static function factory($fruitName)
    {
        switch ($fruitName) {
            case 'apple':
                return new apple();
                break;
            case 'grape':
                return new grape();
                break;
            default:
                throw new badFruitException("Error no the fruit", 1);
                break;
        }
    }
}

// 异常处理类
class badFruitException extends Exception
{
    public $msg;
    public $errType;

    public function __construct($msg = '', $errType = 1)
    {
        $this->msg = $msg;
        $this->errType = $errType;
    }
}

/**
 * 获取水果实例化的方法
 */
try {
    $appleInstance = farmer::factory('apple');
    $appleInstance->grow();
    $appleInstance->eat();
    $appleInstance = farmer::factory('grape');
    $appleInstance->grow();
    $appleInstance->eat();

} catch (badFruitException $err) {
    echo $err->msg . "_______" . $err->errType;
}