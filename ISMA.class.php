<?php
require_once __DIR__."/convert.php";
require_once __DIR__."/connect.php";
require_once __DIR__."/parser.php";

class ISMA extends ISMAParser{
  protected $str = "";
  protected $res = "";
  function __construct($s){
    $this->str = ISMAConvert\toansi($s);
  }
  function LastResult(){
    return $this->res;
  }
  function Analyse($no_parse = false){
    $result = $this->a_connect();
    /* ******** */
    $this->res = $result;
    if($no_parse)
      return $result;
    /** |-|-|-|-|-|-| **/
    /** |-|-|-|-|-|-| **/
    return $this->a_parse($result);
  }
}