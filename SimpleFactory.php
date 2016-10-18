<?php

/*
 * 简单工厂模式：
 *	简单工厂的作用是实例化对象，而不需要客户了解这个对象属于哪个具体的子类。
 *	简单工厂实例化的类具有相同的接口或者基类，在子类比较固定并不需要扩展时，可以使用简单工厂。
 * 使用场景：
 *	1、工厂类负责创建的对象比较少；
 *	2、客户只知道传入工厂类的参数，对于如何创建对象（逻辑）不关心；
 *	3、由于简单工厂很容易违反高内聚责任分配原则，因此一般只在很简单的情况下应用。
 */

//每种车子都要继承此接口
interface VehicleInterface {
	//速度接口
	public function speed();
	
}

//自行车类
class Bicycle implements VehicleInterface {
	
	public function speed() {
		echo '15 km/h' . PHP_EOL;
	}
	
}

//摩托车类
class Motorcycle implements VehicleInterface {
	
	public function speed() {
		echo '30 km/h' . PHP_EOL;
	}
	
}

//汽车类
class Car implements VehicleInterface {
	
	public function speed() {
		echo '80 km/h' . PHP_EOL;
	}
	
}

//创建具体车子的工厂
class SimpleFactory {
	
	protected static $class = array();
	
	//创建具体的车子
	public static function createVehicle($type) {
		$className = ucfirst($type);
		
		if(in_array($className, self::$class))
			return self::$class[$className];
		
		$class = new $className();
		self::$class[$className] = $class;
		
		return $class;
	}
}


//测试代码
$bicycle = SimpleFactory::createVehicle('bicycle');
$bicycle->speed();

$motorcycle = SimpleFactory::createVehicle('motorcycle');
$motorcycle->speed();

$car = SimpleFactory::createVehicle('car');
$car->speed();
