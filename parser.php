<?php

class ISMAParser extends ISMAConnect{
  protected function a_parse($str){
    //echo $str; exit;
    $begin = 'Նախադասությունը հասկացվել է հետևյալ կերպ';
    $end = '<u>';
    $str = str_replace('&nbsp;','',$str);
    $posx = strpos($str,$begin);
    $str = substr($str,$posx);
    $posx = strpos($str,$end);
    if($posx)
      $str = substr($str,0,$posx);
    $r = array();

    if(empty($str) )
      return $r;
    $str = explode('<strong>', $str);
    unset($str[0]);
	/*******************/
	$res = $str;
  $result = [];
	foreach($res as $r):
    $t = [];
    $arr = explode('<br>',$r);
    if(count($arr)<3) break;
    //Բառը ու դերը նախադասությունում
    $t['word']=strip_tags($arr[0]);
    $t['role']=strip_tags(substr($arr[1],strpos($arr[1],'<')));
    //Ստուգել լրացում լինելը, ճշտել դերը
    $morepos = strpos($t['role'],"'");
    if($morepos){
      preg_match("/'(.*)?'/", $t['role'],$more);
      $t['add'] = $more[1];
      $t['role'] = substr($t['role'],0,strpos($t['role'],', '));       
    }
    $posx = strpos($t['role'],'-');
    if($posx){
        $t['role'] = substr($t['role'],$posx+2);
      }
    //Խոսքի մասը ու հատկանիշները
    $t['type']=strip_tags(substr($arr[2],strpos($arr[2],'<')));
    $posx = strpos($t['type'],'- ');
      if($posx)
        $t['type'] = substr($t['type'],$posx+2);      


    $size = count($arr);
    if($size-3>0):
      for ($i=3;$i<$size;$i++){ 
         if( empty($arr[$i]) ) break;
         else{
            $moreinfo = (substr($arr[$i],strpos($arr[$i],'<')));
            $moreinfo = explode(' - ',$arr[$i]);
            if(empty($moreinfo[1])) continue;
            $t['info'][strip_tags($moreinfo[0])] = $moreinfo[1]; 
         }
      }
    endif;
    $result[] = $t;
	endforeach;
    return $result;
  }
}