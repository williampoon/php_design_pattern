<?php

/*
 * 观察者模式：
 *	观察者模式有时也被称作发布/订阅模式，该模式用于为对象实现发布/订阅功能：
 *	一旦主体对象状态发生改变，与之关联的观察者对象会收到通知，并进行相应操作。
 * 使用场景：
 *	1、对一个对象状态的更新，需要其他对象同步更新，而且其他对象的数量动态可变；
 *	2、对象仅需要将自己的更新通知给其他对象而不需要知道其他对象的细节。
 */

//被观察者类
class Subject implements SplSubject {
	
	protected $data = array();
	
	protected $observers;
	
	public function __construct() {
		$this->observers = new SplObjectStorage();
	}
	
	//附加观察者
	public function attach(SplObserver $observer) {
		$this->observers->attach($observer);
	}
	
	//取消观察者
	public function detach(SplObserver $observer) {
		$this->observers->detach($observer);
	}
	
	//通知观察者方法
	public function notify() {
		foreach($this->observers as $observer) {
			$observer->update($this);
		}
	}
	
	public function __set($key, $value) {
		$this->data[$key] = $value;
		
		//通知观察者用户已改变
		$this->notify();
	}
}

//观察者类
class Observer implements SplObserver {
	
	//观察者要实现的唯一方法，也是被Subject调用的方法
	public function update(SplSubject $subject) {
		echo get_class($subject) . ' has been updated' . PHP_EOL;
	}
	
}

//测试代码
$subject = new Subject();
$observer1 = new Observer();
$observer2 = new Observer();
//附加观察者
$subject->attach($observer1);
$subject->attach($observer2);
//Subject改变，观察者将收到通知
$subject->property = 123;