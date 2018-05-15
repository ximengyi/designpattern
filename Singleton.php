

<?php
// PHP单例模式的缺点
// 众所周知，PHP语言是一种解释型的脚本语言，这种运行机制使得每个PHP页面被解释执行后，所有的相关资源都会被回收。
// 也就是说，PHP在语言级别上没有办法让某个对象常驻内存，这和asp.net、Java等编译型是不同的，
// 比如在Java中单例会一直存在于整个应用程序的生命周期里，
// 变量是跨页面级的，真正可以做到这个实例在应用程序生命周期中的唯一性。
// 然而在PHP中，所有的变量无论是全局变量还是类的静态成员，都是页面级的，每次页面被执行时，都会重新建立新的对象，都会在页面执行完毕后被清空，
// 这样似乎PHP单例模式就没有什么意义了，所以PHP单例模式我觉得只是针对单次页面级请求时出现多个应用场景并需要共享同一对象资源时是非常有意义的。

class Singleton 
{
      private static $instance = null;

    private function __construct()
    {
         echo "hello word";
    }
    
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Singleton();
        }
          return self::$instance;
    } 

} 

$abc =  Singleton::getInstance();

//-----------------------------------------------------------------------------------------------
//数据库单例示例伪代码
// class Database extends MySQLi {
//     private static $instance = null ;

//     private function __construct($host, $user, $password, $database){ 
//         parent::__construct($host, $user, $password, $database);
//     }

//     public static function getInstance(){
//         if (self::$instance == null){
//             self::$instance = new self(HOST, USER, PASSWORD, DATABASE);
//         }
//         return self::$instance ;
//     }
// }

// $db = Database::getInstance();
// $result = $db->query("SELECT 1 FROM table");