<?php
/**
 *
 * 观察者模式（又称为发布-订阅（Publish/Subscribe）模式，属于行为型模式的一种，它是将行为独立模块化，降低了行为和主体的耦合性。它定义了一种一对多的依赖关系，让多个观察者对象同时监听某一个主题对象。这个主题对象在状态变化时，会通知所有的观察者对象，使他们能够自动更新自己。
 *
 * Subject：抽象主题（抽象被观察者），抽象主题角色把所有观察者对象保存在一个集合里，每个主题都可以有任意数量的观察者，抽象主题提供一个接口，可以增加和删除观察者对象。
 * ConcreteSubject：具体主题（具体被观察者），该角色将有关状态存入具体观察者对象，在具体主题的内部状态发生改变时，给所有注册过的观察者发送通知。
 * Observer：抽象观察者，是观察者者的抽象类，它定义了一个更新接口，使得在得到主题更改通知时更新自己。
 * ConcrereObserver：具体观察者，是实现抽象观察者定义的更新接口，以便在得到主题更改通知时更新自身的状态。
 *
 * PHP 内置了
 * SplSubject 抽象主题 Interface
 * SplObserver 抽象观察者 Interface
 *
 * 收集自： https://segmentfault.com/a/1190000010502678
 *
 * Created At 2018/8/3.
 * User: kaiyanh <nzing@aweb.cc>
 */

/**
 * 主题类（被观察者相当于一个主题，观察者订阅这个主题）
 * 当我们注册用户成功的时候想发送 email 和 sms 通知用户注册成功
 * 则 可以将 SendEmail 和 SendSms 作为观察者
 * 注册到 User 的观察者中
 * 当 User register 成功时 notify 给 observers
 * 各 observe 通过约定的 update 接口进行相应的处理 发邮件或发短信
 */
class User implements SplSubject
{
    public $name;
    public $email;
    public $mobile;

    /**
     * 当前主题下的观察者集合
     *
     * @var array
     */
    private $observers = [];

    /**
     * 模拟注册
     *
     * @param  [type] $name   [description]
     * @param  [type] $email  [description]
     * @param  [type] $mobile [description]
     *
     * @return [type]         [description]
     */
    public function register($name, $email, $mobile)
    {
        $this->name = $name;
        $this->email = $email;
        $this->mobile = $mobile;

        //business handle and register success
        $reg_result = true;
        if ($reg_result) {
            $this->notify(); // 注册成功 所有的观察者将会收到此主题的通知

            return true;
        }

        return false;
    }

    /**
     * 当前主题注册新的观察者
     *
     * @param  SplObserver $observer [description]
     *
     * @return [type]                [description]
     */
    public function attach(SplObserver $observer)
    {
        return array_push($this->observers, $observer);
    }

    /**
     * 当前主题删除已注册的观察者
     *
     * @param  SplObserver $observer [description]
     *
     * @return [type]                [description]
     */
    public function detach(SplObserver $observer)
    {
        $key = array_search($observer, $this->observers, true);

        if (false !== $key) {
            unset($this->observers[$key]);

            return true;
        }

        return false;
    }

    /**
     * 状态更新 通知所有的观察者
     *
     * @return [type] [description]
     */
    public function notify()
    {
        if (!empty($this->observers)) {
            foreach ($this->observers as $key => $observer) {
                $observer->update($this);
            }
        }

        return true;
    }

}

/**
 * 观察者通过 update 来接受主题的更新通知
 */
class EmailObserver implements SplObserver
{
    /**
     * 观察者接收主题通知的接口
     *
     * @param  SplSubject $user [description]
     *
     * @return [type]           [description]
     */
    public function update(SplSubject $user)
    {
        echo "send email to ".$user->email.PHP_EOL;
    }
}

class SmsObserver implements SplObserver
{
    public function update(SplSubject $user)
    {
        echo "send sms to ".$user->mobile.PHP_EOL;
    }
}

// #######################开始执行
// User 主题
$user = new User();

// 为 user 注册 Email 观察者 (Email 观察者订阅 User 主题)
$emailObserver = new EmailObserver();
$user->attach($emailObserver);

// 为 user 注册 Sms 观察者 (Sms 观察者订阅 User 主题)
$smsObserver = new SmsObserver();
$user->attach($smsObserver);

// 从 user 上删除 Sms 观察者 (Sms 观察者取消订阅 User 主题)
//$user->detach($smsObserver);

// register 中会根据注册结果通知观察者 观察者做相应的处理
$user->register("big cat", "32448732@qq.com", "1888888888");