<?php

abstract class Game {
    abstract function initialize();
    abstract function startPlay();
    abstract function endPlay();
 
    //模板
    public final function play(){
       //初始化游戏
      $this->initialize();
       //开始游戏
       $this->startPlay();
       //结束游戏
       $this->endPlay();
    }

 }



  class Basketball extends Game {

    function initialize() {
       echo "篮球游戏初始化完成，请选择角色准备开始游戏！！！\n";
    }
 
     function startPlay() {
        echo "篮球游戏已经开始，请开始投球\n";
    }

    function endPlay() {
        echo  "篮球游戏结束了~~\n";
     }
  
 }

 class Football extends Game {

    function initialize() {
       echo "足球游戏初始化完成，请选择角色准备开始游戏！！！\n";
    }
 
     function startPlay() {
        echo "足球游戏已经开始，请开始投球\n";
    }

    function endPlay() {
        echo  "足球游戏结束了~~\n";
     }
  
 }

$game = new Basketball();
$game->play();
echo "---------分界线----------\n";
$game = new Football();
$game->play();



