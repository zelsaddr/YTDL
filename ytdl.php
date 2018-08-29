<?php
error_reporting(E_ALL);
// @Author : Izzeldin Addarda 
// @Category : Downloader
// @Title : Youtube Downloader
// @Source API : API By Mazterin.com
class Maqlo {
    public $m="\033[1;31m";
    public $k="\033[1;33m";
    public $h="\033[1;32m";
    public $b="\033[1;34m";
    public $p="\033[1;37m";
    public $c="\033[0m";
    private $key;
    public $url;
    
    public function __construct($key){
        $this->keys = $key;
    }
    public function printz_Key(){
        return "User : $this->keys";
    }
    public function YTDL($url){
        $yt = "https://v1.mazterin.com/youtube_download.php?url=$url&key=".$this->keys;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $yt);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36");
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    public function start(){
        $arr = $this->m.
"
 ::: === :::====      :::====  :::====  :::  ===  === :::= === :::      :::====  :::====  :::==== 
 ::: === :::====      :::  === :::  === :::  ===  === :::===== :::      :::  === :::  === :::  ===
  =====    ===        ===  === ===  === ===  ===  === ======== ===      ===  === ======== ===  ===
   ===     ===        ===  === ===  ===  ===========  === ==== ===      ===  === ===  === ===  ===
   ===     ===        =======   ======    ==== ====   ===  === ========  ======  ===  === =======
   V.1 | Izzeldin Addarda
                                                                                                  \r\n".$this->p;
      print($arr);
      echo "URL => "; $url = trim(fgets(STDIN));
      if(!preg_match("/youtube/i", $url)){
        echo $this->m."URL NOT VALID! \r\n"; sleep(1); echo $this->p."Exiting...\r\n"; exit();
      }
      $dcd = json_decode($this->YTDL($url), true);
      if(isset($dcd['result'])){
        echo $this->k."\n\n===> Title : ".$this->p. $dcd['result'][0]['title'].$this->k."<===\n".$this->p;
        echo $this->k."===> 720 / 480 / 240 / M4A ( SONG ) / WEBM ( SONG ) : "; $type = trim(fgets(STDIN));
        if($type == "720"){
          $dLoad = $dcd['result'][9]['direct_dLoad'];
          $name = $dcd['result'][0]['title'].".mp4";
        }elseif($type == "480"){
          $dLoad = $dcd['result'][8]['direct_dLoad'];
          $name = $dcd['result'][0]['title'].".mp4";
        }elseif($type == "240"){
          $dLoad = $dcd['result'][5]['direct_dLoad'];
          $name = $dcd['result'][0]['title'].".mp4";
        }elseif($type == strtolower("M4A")){
          $dLoad = $dcd['result'][2]['direct_dLoad'];
          $name = $dcd['result'][0]['title'].".m4a";
        }elseif($type == strtolower("WEBM")){
          $dLoad = $dcd['result'][3]['direct_dLoad'];
          $name = $dcd['result'][0]['title'].".webm";
        }else{
          echo $this->m."Type Not found :(\n".$this->p; sleep(1); exit();
        }
        echo $this->k."Downloading....\n".$this->p;
        sleep(1);
        if(!shell_exec('wget -O "'.$name.'" --trust-server-names -q "'.$dLoad.'"')){
          echo $this->h."Downloaded.. as : ".getcwd()."/".$this->b.$name.$this->p;
        }else{
          echo $this->m."Failed to download".$this->p;
        }
      }else{
        echo $this->m."Video Not found :( \n".$this->p;
      }
    }
}

$Maqlo = new Maqlo("83a002e8ffbe10a8e5bfd289b565b247092a9b70"); // Mazterin API Key
$Maqlo->start();
?>