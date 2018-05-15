<?php
//故事背景
//小明有一天要从北京到上海新天地找他女朋友，他怎么到上海呢?计划-------------->高铁->打车，
//小红有一天要从北京到上海五角场找他男朋友，他怎么到上海呢？计划------------->飞机->公交车->摩拜
interface Transport{     
public function go($address);
}

class Bus implements Transport{   
public function go($address){       
echo "----乘坐公交车到达{$address}----\n";
    }
}

class Car implements Transport{   
public function go($address){       
echo "----乘坐出租车到达{$address}----\n";
    }
}

class Bike implements Transport{   
public function go($address){       
echo "----骑着摩拜到达{$address}----\n";
    }
}

class Airplane implements Transport{   
    public function go($address){       
    echo "----乘坐飞机到达{$address}----\n";
        }
    }
class Highiron implements Transport{   
        public function go($address){       
        echo "----乘坐高铁到达{$address}-----\n";
            }
        }

class transFactory{   
public static function factoryTool($name,$transport)
    {     
      echo "{$name}";
        switch ($transport) {           
        case 'bus':               
        return new Bus();               
        break;           
        case 'car':               
        return new Car();               
        break;           
        case 'bike':               
        return new Bike(); 
        case 'airplane':               
        return new Airplane();              
        break;
        case 'highiron':               
        return new Highiron();              
        break;
        default:
        echo "-----没有{$transport}交通工具,请先创建";

        }
    }
}

//小红-----------------------
$xiaoMing=transFactory::factoryTool('小明','highiron');
$xiaoMing->go("上海");
$xiaoMing=transFactory::factoryTool('小明','car');
$xiaoMing->go("新天地");

echo "\n";
//------------------------------- 小红
$xiaoHong=transFactory::factoryTool('小红','airplane');
$xiaoHong->go("上海");
$xiaoHong=transFactory::factoryTool('小红','bus');
$xiaoHong->go("邯郸路");
$xiaoHong=transFactory::factoryTool('小红','bike');
$xiaoHong->go("五角场");

//--------------------------------小红想坐飞碟去上海
$xiaoHong=transFactory::factoryTool('小红','feidie');
//$xiaoHong->go('上海');