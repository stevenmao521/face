<?php
/*
 * PHP设计模式
 */
/*
 * 工厂模式，就是由定义的工厂类来具体生成哪个实力
 * 调用自身静态方法来生产对象实例
 * 解决高内聚低耦合
 * 什么时候用，当我用一个类创建了很多实例又发现需要更改类名时，难倒要一个个改吗？采用工厂模式可以一致性解决
*/
/*
interface Transport{
    public function go();

}

class Bus implements Transport{
    public function go(){
        echo "bus每一站都要停";
    }
}

class Car implements Transport{
    public function go(){
        echo "car跑的飞快";
    }
}

class Bike implements Transport{
    public function go(){
        echo "bike比较慢";
    }
}

class transFactory{
    public static function factory($transport)
    {
        
        switch ($transport) {
            case 'bus':
                return new Bus();
                break;

            case 'car':
                return new Car();
                break;
            case 'bike':
                return new Bike();
                break;
        }
    }
}

$transport=transFactory::factory('car');
$transport->go();
*/


/*
 *  单例模式：确保整个系统只有一个实例，自行实例化并向整个系统提供这个实例
 *  特点，单实例，自行创建，给其他对象提供这个实例
 *  场景：与数据库打交道的场景，大量数据库操作，针对数据库连接的句柄的行为，可以使用单例模式减少大量new操作
*/
/*
class Single{
    public $hash;
    static protected $ins=null;
    
    #final修饰的不能被继承不能被重写
    final protected function __construct(){
        $this->hash=rand(1,9999);
    }
    
    #静态实例化方法，如果已存在实例则直接返回，否则在方法内实例化一个对象返回
    static public function getInstance(){
        if (self::$ins instanceof self) {
            return self::$ins;
        }
        self::$ins=new self();
        return self::$ins;
    } 
}
$db = Single::getInstance();
*/
/*
 * 适配器模式
 * 将一个类或接口转化为客户需要的另外一个接口
 * 目标target角色 adaptee原角色 adapter适配器角色
*/
/*
//目标角色  
interface Target {  
    public function simpleMethod1();  
    public function simpleMethod2();  
}  
  
//源角色  
class Adaptee {  
      
    public function simpleMethod1(){  
        echo 'Adapter simpleMethod1'."<br>";  
    }  
}  
  
//类适配器角色  
class Adapter implements Target {  
    private $adaptee;  
      
      
    function __construct(Adaptee $adaptee) {  
        $this->adaptee = $adaptee;   
    }  
      
    //委派调用Adaptee的sampleMethod1方法  
    public function simpleMethod1(){  
        echo $this->adaptee->simpleMethod1();  
    }  
      
    public function simpleMethod2(){  
        echo 'Adapter simpleMethod2'."<br>";     
    }   
}  
  
//客户端  
class Client {  
    public static function main() {  
        $adaptee = new Adaptee();  
        $adapter = new Adapter($adaptee);  
        $adapter->simpleMethod1();  
        $adapter->simpleMethod2();   
    }  
}  
Client::main();
*/


