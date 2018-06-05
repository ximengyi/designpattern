<?php

// 我们通过下面的实例来演示适配器模式的使用。
// 其中，音频播放器设备只能播放 mp3 文件，通过使用一个更高级的音频播放器来播放 vlc 和 mp4 文件。

//普通媒体播放器接口
 interface MediaPlayer
{
    public function  play($audioType, $fileName);
}

//高级媒体播放器接口
interface AdvancedMediaPlayer 
{    
    public function playVlc($fileName);
    public function playMp4($fileName);
}

// vlc播放器类实现高级媒体播放器接口
 class VlcPlayer implements AdvancedMediaPlayer{
   
    public function  playVlc($fileName) 
    {
  
       echo "正在播放vlc文件<--文件名-->{$fileName}\n";
    }
 
    public function  playMp4($fileName) 
    {
       //空方法
    }

 }
//mp4播放器类
class Mp4Player implements AdvancedMediaPlayer{


    public function playVlc($fileName)
    {
       //空方法
    }
 
    public function  playMp4($fileName) 
    {
      
      echo "正在播放MP4文件<--文件名-->{$fileName}\n";        
    }
 }

 // 媒体适配器类实现媒体播放器接口
class MediaAdapter implements MediaPlayer {

    protected $advancedMusicPlayer;

    public  function  __construct($audioType)
    {
        if($audioType == "vlc" ){
                  $this->advancedMusicPlayer = new VlcPlayer();            
               } else if ($audioType=='mp4'){
                  $this->advancedMusicPlayer = new Mp4Player();
               }    
    } 
    
    public function play($audioType, $fileName)
     {
       if($audioType=='vlc'){
         $this->advancedMusicPlayer->playVlc($fileName);
       }else if($audioType=='mp4'){
          $this->advancedMusicPlayer->playMp4($fileName);
       }
    }
 }
//音频播放器,通过适配器模式播放vlc格式文件和MP4格式文件
class AudioPlayer implements MediaPlayer {
  //  MediaAdapter mediaAdapter; 
    public function play($audioType, $fileName) {        

       //播放 mp3 音乐文件的内置支持
       if($audioType=="mp3"){
          echo "正在播放mp3文件<--文件名-->{$fileName}\n" ;           
       } 

       //mediaAdapter 提供了播放其他文件格式的支持
       else if($audioType=="vlc"|| $audioType == "mp4"){
          $mediaAdapter = new MediaAdapter($audioType);
          $mediaAdapter->play($audioType, $fileName);
       }
       else{
           echo "错误的格式{$audioType}格式不被支持\n";
        
       }
    }   
 }


//-------------------------------
$audioplayer = new AudioPlayer();
$audioplayer->play('mp3',"老男孩");
$audioplayer->play('mp4',"猛龙过江");
$audioplayer->play('vlc',"七里香");
$audioplayer->play('avi',"我的机器人女友");
