<?php

/*
 * 单例模式：保证系统中一个类只有一个实例，而且该实例易于外界访问（提供一个访问它的全局访问点）。
 * 使用场景：具有资源管理器功能的应用：线程池缓存，日志，对话，打印机等。
 */

class Singleton {
    protected static $_instance = null;
    
    //确保无法在类外使用new实例化对象
    protected function __construct() {}
    
    //确保单例类不能被克隆
    protected function __clone() {}
    
    //返回此类唯一实例
    public static function getInstance() {
        if(is_null(self::$_instance))
            self::$_instance = new Singleton();
		
        return self::$_instance;
    }
    
    //测试方法
    public function display() {
        echo 'Singleton demo' . PHP_EOL;
    }
}
 
// $obj1 = new Singleton();	//实例化出错
$obj1 = Singleton::getInstance();
$obj1->display();
 
$obj2 = Singleton::getInstance();
var_dump($obj1 === $obj2);	//TRUE
