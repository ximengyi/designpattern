<?php
//媒体播放器接口
 interface MediaPlayer
{
    public function  play($audioType, $fileName);
}
//高级媒体播放器
interface AdvancedMediaPlayer 
{    
    public function playVlc($fileName);
    public function playMp4($fileName);
}

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

 // 媒体适配器实现媒体播放器接口
class MediaAdapter implements MediaPlayer {

    protected $advancedMusicPlayer;

    // public  function  __construct(AdvancedMediaPlayer $advancedMusicPlayer)
    // {
    //    $this->advancedMusicPlayer = $advancedMusicPlayer;
    // } 
 
    // public function MediaAdapter($audioType)
    // {
    //    if($audioType == "vlc" ){
    //       $this->advancedMusicPlayer = new VlcPlayer();            
    //    } else if ($audioType=='mp4'){
    //       $this->advancedMusicPlayer = new Mp4Player();
    //    }    
    // }
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
//音频播放器
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
