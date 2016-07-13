<?php

class ISMAConnect{
  protected function a_connect(){
    $url = 'http://www.translator.am/am/analyse.php';
    $fields = "inputtext=".$this->str;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,30); 
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
  }
}